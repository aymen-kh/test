<?php
// app/Http/Controllers/ReservationController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;
class ReservationController extends Controller
{
    public function confirm($id)
    {
        // Find the reservation by ID
        $reservation = Reservation::findOrFail($id);
        
        $reservation->status = 'confirmed';
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation confirmed.');
    }

    public function cancel($id)
    {
       
        $reservation = Reservation::findOrFail($id);
        
        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation cancelled.');
    }
    public function __construct()
    {
        
        new Middleware('log', only: ['store']);
    }

public function reserve(Request $request)
{
    $user=Auth::user();
    // Get form data if any
    $number_of_guests = $request->input('numPeople', 1); // Default to 1 if not provided
    $date = $request->input('date', today()->toDateString()); // Default to today's date if not provided
    $time = $request->input('time', null); // No default time
    $event = $request->input('eventType', 'null'); // 
   // $startTime = $request->input('time', '00:00:00'); // Default to midnight if not provided
   // $endTime = $request->input('end_time', '23:59:59'); // Default to end of the day if not provided

    $startTime = Carbon::parse("$date $time");
   // $formattedDateTime = $startTime->format('Y-m-d H:i:s');

    $endTime = $startTime->copy()->addHours(2); 

    $availableTablesWithAreas = Table::with('area')
    ->where('status', 'available')
        ->whereNotIn('id', function ($query) use ($number_of_guests, $startTime, $endTime) {
            $query->select('table_id')
                  ->from('reservations')
                  //->where('event_date', $date)
                  ->where(function ($query) use ($startTime, $endTime,$number_of_guests) {
                   $query  ->where('event_date', '>', $startTime)
                            ->where('end_time', '<', $endTime)
                            ->where('number_of_guests','<',(int)$number_of_guests);
                  });
        })
        ->get();
        
     // Get only table_id column   
    // Return view with available tables
    return view('reservations.create2',[
        'event' => $event,
        'date' => $date,
        'time' => $time,
        'user' => $user,
        'number_of_guests' => $number_of_guests,
        'tables'=> $availableTablesWithAreas,
    
       
        
    ]);
}

    public function index()
    {
        $user = Auth::user();
        
        // Check if the user has the 'Client' role
        if ($user->hasRole(['Client','Chef','Delivrer'])) {
            // If user is a client, return only their reservations
            $reservations = $user->reservations()->get();
        } else {
            // If user is not a client (e.g., admin), return all reservations
            $reservations = Reservation::all();
        }
        
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $tables = Table::all();
        return view('reservations.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'event_date' => 'required|date',
            'number_of_guests' => 'required|integer',
            'event_type' => 'required|string',
            'additional_information' => 'nullable|string',
        ]);
        $eventDateTime = Carbon::parse($request->event_date . ' ' . $request->time);

    
        // Calculate end_time as 2 hours after event_date
        $end_time = Carbon::parse($eventDateTime)->addHours(2);
    
        // Make sure the number_of_guests does not exceed the table capacity
        $table = Table::findOrFail($request->table_id);
        if ($request->number_of_guests > $table->capacity) {
            return redirect()->back()->withErrors(['number_of_guests' => 'Number of guests exceeds table capacity.']);
        } 
        $user=Auth::user();
        Reservation::create([
            'user_id' =>$user->id,   //Auth::id(), // Use the currently authenticated user
            'table_id' => $request->table_id,
            'end_time' => $end_time,
            'event_date' => $eventDateTime,
            'number_of_guests' => $request->number_of_guests,
            'event_type' => $request->event_type,
            'additional_information' => $request->additional_information,
        ]);
    
    
        return redirect()->route('reservations.index')->with('status', 'Reservation created successfully!');
    }
    

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
      
       
        if ((Auth::user()->hasRole(['Admin', 'Chef','Server']))|| ($reservation->user_id==Auth::user()->id)) {
        
            return view('reservations.show', compact('reservation')); }
    
        
         abort(403);
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $tables = Table::all();
        return view('reservations.edit', compact('reservation','tables'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'event_date' => 'required|date',
            'number_of_guests' => 'required|integer',
            'event_type' => 'required|string',
            'additional_information' => 'nullable|string',
        ]);

        $reservation = Reservation::findOrFail($id);

        // Calculate end_time as 2 hours after event_date
        $end_time = Carbon::parse($request->event_date)->addHours(2);

        $reservation->update([
            'user_id' => Auth::id(), // Use the currently authenticated user
            'table_id' => $request->table_id,
            'end_time' => $end_time,
            'event_date' => $request->event_date,
            'number_of_guests' => $request->number_of_guests,
            'event_type' => $request->event_type,
            'additional_information' => $request->additional_information,
        ]);

        return redirect()->route('reservations.index')->with('status', 'Reservation updated successfully!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('status', 'Reservation deleted successfully!');
    }
}
