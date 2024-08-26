<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'permissions')->get();
        return view('users.index', compact('users'));
    }
    public function report(Request $request)
    {
        // Retrieve clients (users with the 'Client' role)
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'Client');
        })->with('orders', 'reservations')->get();

        // Calculate total spent, number of orders, and number of reservations
        $clients->map(function ($client) {
            $client->total_spent = $client->orders->sum('total_amount');
            $client->num_orders = $client->orders->count();
            $client->num_reservations = $client->reservations->count();
        });

        if ($request->has('export')) {
            $exportType = $request->query('export');

            if ($exportType === 'pdf') {
                $timestamp = now()->format('Y-m-d_H-i-s');
                $pdf = Pdf::loadView('users.client_pdf', compact('clients'))
                          ->setPaper('a4', 'landscape');  // Landscape for maximum width
                return $pdf->download("clients_report_{$timestamp}.pdf");
            }            

            if ($exportType === 'excel') {
                return Excel::download(new UserExport, 'client_report.xlsx');
            }
        }

        // Pass the clients to the view
        return view('users.report', compact('clients'));
    }

    public function exportExcel()
    {
        return Excel::download(new UserExport, 'client_report.xlsx');
    }

    public function edit($id)
    {
        $user = User::with('roles', 'permissions')->findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validate the request
        $request->validate([
            'roles' => 'array|nullable',
            'permissions' => 'array|nullable',
        ]);

        // Sync roles and permissions
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
