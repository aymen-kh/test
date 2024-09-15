<?php

namespace App\Http\Controllers;


use App\Models\Area;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Models\OrderItem;
use App\Models\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{
    public function show($id)
{
    
    $order = Order::findOrFail($id);
    if ((Auth::user()->hasRole(['Admin', 'Chef','Server','Deliverer']))|| ($order->user_id==Auth::user()->id)) {
    
        return view('orders.show', compact('order')); }

   
     abort(403);

  

    

}

 
    public function index()
    {
        // Fetch orders for the authenticated user
        $roles = ['Admin', 'Server', 'Chef'];

        if (Auth::user()->hasRole(['Admin', 'Chef','Server'])) {            // Fetch all orders if the user has the permission
            $orders = Order::orderBy('created_at', 'desc')->get();
        }
        elseif( Auth::user()->hasRole('Deliverer')){
            $orders = Order::where('status', 'in_delivery')
            ->orderBy('created_at', 'desc')
            ->get();

        }
         else {
            // Fetch orders for the authenticated user if they do not have the permission
            $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }
        // Pass orders to the view
        return view('orders.index', compact('orders'));
    }




    public function process(Request $request)
    {
      //  dd();
      
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $cartItems = json_decode($_COOKIE['cart'] ?? '[]', true);
       // $deliveryLocation = $cartItems['location'] ?? null;
        //dd($request->delivery_location);
       // dd($cartItems);
      //  return view('checkout1', compact('cartItems'));
     $lineItems = [];
        $totalPrice = 0;
        foreach ($cartItems as $product) {
            $totalPrice += $product['price'];
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product['name'],
                       // 'orderType'=>$product['order_type']
                      
                     //   'images' => [$product->image]
                    ],
                    'unit_amount' => ($product['price']*100)/$product['quantity'],
                ],
                'quantity' => $product['quantity'],
                
              
            ];
        }
       
  //  dd( $cartItems[0]);
     
      $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
           
            'mode' => 'payment',
      'success_url' => route('order.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
    //     'success_url' => route('items.index'),
            'cancel_url' => route('order.cancel', [], true),
        ]);
     
      
        $user=Auth::user();
 //      dd($user->id);
       // $paymentMethod = $request->input('payment_method');
       $order = new Order();
     //  $order->id=$session->id;
        $order->status = 'unpaid';
        $createdTimestamp = $session->created;
        $orderDate = date('Y-m-d H:i:s', $createdTimestamp);    
        $order->order_date= $orderDate;
        $order->total_amount = $totalPrice;
        $order->payment_method='card';
        $order->order_type=$cartItems[0]['order_type'];
        $order->delivery_address = $request->delivery_location;
        $order->user_id=$user->id;
        $order->stripe_session_id = $session->id;
        $order->save(); 
       
      /*  $e = Order::where('stripe_session_id', $session->id)->first();
        $e->status = 'paid';
        $e->save();*/
        foreach ($cartItems as $product) {
            $order->items()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'custom_description' => $product['custom_description'] ?? '', // Provide custom description
            ]);
        }
       return redirect($session->url);
    }
// app/Http/Controllers/CheckoutController.php

public function success(Request $request)
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    $sessionId = $request->get('session_id');
  //  dd($sessionId);
    try {
     //   $session = \Stripe\Checkout\Session::retrieve($sessionId);
        if (!$sessionId) {
            throw new NotFoundHttpException;
        }

      //  $customer = \Stripe\Customer::retrieve($session->customer);
        $order = Order::where('stripe_session_id', $sessionId)->first();

        if (!$order) {
            throw new NotFoundHttpException();
        }

        if ($order->status === 'unpaid') {
            $order->status = 'paid';
            $order->save();
        }

        Cookie::queue(Cookie::forget('cart'));
        $orders = Order::where('user_id', Auth::id())->orderBy('order_date', 'desc')->get();

        // Pass orders to the view
        return view('orders.index', compact('orders'));
    } catch (\Exception $e) {
        // Handle exception or log error
        throw new NotFoundHttpException();
    }
}
    public function cancel()
    {
        return redirect(URL::previous());
    }

     
        public function store(Request $request)
        {
          
            $validated = $request->validate([
                
                'user_id' => 'required|integer|exists:users,id',
                'order_date' => 'nullable|date',
                'status' => 'nullable|string|in:unpaid,paid,preparing,in_delivery,completed,cancelled',
                'order_type' => 'required|string',
                'total_amount' => 'required|numeric',
                'delivery_address' => 'nullable|string|max:255',
                'table_id' => 'nullable|integer|exists:tables,id',
                'payment_method' => 'nullable|string',
                'stripe_session_id' => 'nullable|string',
                'items' => 'nullable|array',
                'items.*.id' => 'required|integer|exists:items,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.custom_description' => 'nullable|string',
            ]);


            $order = new Order();
            $order->user_id = $validated['user_id'];
            $order->order_type = $validated['order_type'];
            $order->status = 'preparing';
    
          //  $order->order_date=now();

           $order->order_date = $validated['order_date'] ?? now();
         
         $order->delivery_address = $validated['delivery_address'] ?? null;

            $order->table_id = $validated['table_id'] ?? null;
            $order->payment_method = $validated['payment_method'];
            $order->total_amount = $validated['total_amount'];
        
           $order->save();
           if   ($validated['order_type']=='dine_in'){
            if (!(is_null($order->table_id))){
           Table::where('id', $validated['table_id'])->update(['status' => 'not available']);}
            }
            if ($request->has('items')) {
                foreach ($request->input('items') as $item) {
                    $order->items()->attach($item['id'], [
                        'quantity' => $item['quantity'],
                        'custom_description' => $item['custom_description'] ?? '',
                    ]);
                }
            }
            if (Auth::user()->hasRole(['Server','Admin'])) {
            //    $pdf = app(PDF::class);
               // $pdf->loadView('orders.invoice', compact('order'));
                $pdf = Pdf::loadView('orders.invoice', compact('order'))
                ->setPaper([0, 0, 250, 350], 'portrait'); // Smaller page size (custom dimensions)
  
                // Generate the PDF content as a stream
                $pdfContent = $pdf->output();
                
                // Store PDF content in the session for later retrieval
                session(['pdf_content' => $pdfContent]);
                // Return a view to handle the iframe display and redirection
                return view('orders.invoice_redirect', [
                    'pdfContent' => base64_encode($pdfContent)
                ]);
            }

            return redirect()->route('orders.index')->with('success', 'Order created successfully.');
        }
        public function edit(Order $order)
        {
            $items = Item::all(); // Load items for the order edit form
            return view('orders.edit', compact('order', 'items'));
        }
        public function clientOrder(Order $order)
        {
            $categories = Category::with('items')->get(); 
            return view('orders.takeorder', compact('categories'));
        }
public function webhook()
{
    // This is your Stripe CLI webhook secret for testing your endpoint locally.
    $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $event = null;

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
    } catch (\UnexpectedValueException $e) {
        // Invalid payload
        return response('', 400);
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        return response('', 400);
    }

// Handle the event
    switch ($event->type) {
        case 'checkout.session.completed':
            $session = $event->data->object;

            $order = Order::where('stripe_session_id', $session->id)->first();
            if ($order && $order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
                // Send email to customer
            }

        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->type;
    }

    return response('');
}
public function create()
{
 //   $items = Item::all(); // Load items for the order creation form
    $categories = Category::with('items')->get();
    $menus=Menu::with('items')->get();
  //  $items=Item::all();
  $areas = Area::all();
    $tables = Table::with('area')->where('status', 'available')->get();
    return view('orders.create', compact('categories','tables','menus','areas'));
}

public function update(Request $request, Order $order)
{
    $request->validate([
        'user_id' => 'required|integer|exists:clients,id',
        'order_date' => 'required|date',
        'status' => 'required|string|in:unpaid,paid,preparing,in_delivery,completed,cancelled',
        'order_type' => 'required|string',
        'total_amount' => 'required|numeric',
        'delivery_address' => 'nullable|string|max:255',
        'table_id' => 'nullable|integer|exists:tables,id',
        'payment_method' => 'nullable|string',
        'stripe_session_id' => 'nullable|string',
        'items' => 'nullable|array',
        'items.*.id' => 'required|integer|exists:items,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.custom_description' => 'nullable|string',
    ]);

    $order->update($request->except('items'));

    // Update order items
    if ($request->has('items')) {
        $order->items()->sync([]);
        foreach ($request->input('items') as $item) {
            $order->items()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'custom_description' => $item['custom_description'] ?? '',
            ]);
        }
    }

    return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
}

/**
 * Remove the specified order from storage.
 *a
 * @param \App\Models\Order $order
 * @return \Illuminate\Http\RedirectResponse
 */
public function destroy(Order $order)
{
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
}
public function invoice($id)
{
    // Retrieve the order by ID
    $order = Order::findOrFail($id);

    // Load the view and pass the order data to it
   // $pdf = app(Pdf::class);

    // Set custom paper size and margins
  //  $pdf->setPaper([0, 0, 250, 350], 'portrait'); // Smaller page size (custom dimensions)

   // $pdf->loadView('orders.invoice', compact('order'));
   $pdf = Pdf::loadView('orders.invoice', compact('order'))
              ->setPaper([0, 0, 250, 350], 'portrait'); // Smaller page size (custom dimensions)

    // Stream the PDF to the browser
    return $pdf->stream('invoice-' . $id . '.pdf');
}

public function markAsPreparing(Order $order)
{
    if ($order->status === 'paid') {
        $order->status = 'preparing';
        $order->save();
        return redirect()->back()->with('success', 'Order marked as preparing.');
    }
    return redirect()->back()->with('error', 'Order cannot be marked as preparing.');
}
public function markAsPaid(Order $order)
{
    if ($order->status === 'unpaid') {
        $order->status = 'paid';
    if(is_null($order->payment_method )){
        $order->payment_method='Cash';
    }
       // dd($order);
        $order->save();
        return redirect()->back()->with('success', 'Order marked as paid.');
    }
    return redirect()->back()->with('error', 'Order cannot be marked as paid.');
}


public function markAsReady(Order $order)
{
    if ($order->status === 'preparing' && $order->order_type === 'pickup' || ($order->order_type === 'dine_in')) {
        $order->status = 'ready';
        $order->save();
        return redirect()->back()->with('success', 'Order marked as ready for pickup.');
    }
    return redirect()->back()->with('error', 'Order cannot be marked as ready.');
}

public function markAsInDelivery(Order $order)
{
    if ($order->status === 'preparing' && $order->order_type === 'delivery') {
        $order->status = 'in_delivery';
        $order->save();
        return redirect()->back()->with('success', 'Order marked as in delivery.');
    }
    return redirect()->back()->with('error', 'Order cannot be marked as in delivery.');
}

public function markAsCompleted(Order $order)
{
    if ($order->status === 'ready' || $order->status === 'in_delivery') {
        $order->status = 'completed';
        $order->save();
        return redirect()->back()->with('success', 'Order marked as completed.');
    }
    return redirect()->back()->with('error', 'Order cannot be marked as completed.');
}

public function cancelOrder(Order $order)
{
    if ($order->status !== 'completed' && $order->status !== 'cancelled') {
        $order->status = 'cancelled';
        $order->save();
        return redirect()->back()->with('success', 'Order has been cancelled.');
    }
    return redirect()->back()->with('error', 'Order cannot be cancelled.');
}




public function ordersReport()
{
    // Fetch orders data or any other logic to prepare the report
    $orders = Order::with('user')->get();    // This is just an example, adjust as needed

    return view('orders.report', compact('orders'));
}
public function exportPdf()
{
    $orders = Order::with('user')->get();
    $pdf =PDF::loadView('orders.report_pdf', compact('orders'));
    return $pdf->download('orders_report.pdf');
}

public function exportExcel()
{
    return Excel::download(new OrdersExport, 'orders_report.xlsx');
}
} 
