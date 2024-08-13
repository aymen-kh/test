<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{
    public function show($id)
{
    $order = Order::findOrFail($id);
    return view('orders.show', compact('order'));
}

    // Show checkout page with cart details
    public function showCheckoutForm()
    { 
        $cartItems = json_decode($_COOKIE['cart'] ?? '[]', true);
            $cart = [];
        $total = 0;

        foreach ($cartItems as $item) {
            $itemData = Item::find($item['id']);
            if ($itemData) {
                $cart[] = [
                    'id' => $item['id'],
                    'name' => $itemData->name,
                    'quantity' => $item['quantity'],
                    'price' => $itemData->price*100,
                    'image'=>$itemData->image,
                    'custom_description' => $item['custom_description']
                ];
                $total += $item['quantity'] * $itemData->price;
            }
        }
   
        return view('checkout', compact('cart', 'total'));
    }

    // Process checkout and payment




    public function index()
    {
        // Fetch orders for the authenticated user
        $orders = Order::where('client_id', Auth::id())->orderBy('order_date', 'asc')->get();

        // Pass orders to the view
        return view('orders.index', compact('orders'));
    }




    public function process(Request $request)
    {
      //  dd();
      
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $cartItems = json_decode($_COOKIE['cart'] ?? '[]', true);

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
                    'unit_amount' => $product['price']*100,
                ],
                'quantity' => $product['quantity'],
              
            ];
        }
    
     
      $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
           
            'mode' => 'payment',
      'success_url' => route('order.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
    //     'success_url' => route('items.index'),
            'cancel_url' => route('order.cancel', [], true),
        ]);
     
      
        $user=Auth::user();
 //      dd($user->id);
        $paymentMethod = $request->input('payment_method');
       $order = new Order();
     //  $order->id=$session->id;
        $order->status = 'unpaid';
        $createdTimestamp = $session->created;
        $orderDate = date('Y-m-d H:i:s', $createdTimestamp);    
        $order->order_date= $orderDate;
        $order->total_amount = $totalPrice;
        $order->payment_method=$paymentMethod;
        $order->order_type=$cartItems[0]['order_type'];
        $order->delivery_address = $user->location;
        $order->client_id=$user->id;
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
        $orders = Order::where('client_id', Auth::id())->orderBy('order_date', 'desc')->get();

        // Pass orders to the view
        return view('orders.index', compact('orders'));
    } catch (\Exception $e) {
        // Handle exception or log error
        throw new NotFoundHttpException();
    }
}

    /*public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            $customer = \Stripe\Customer::retrieve($session->customer);
            $order = Order::where('stripe_session_id ', $session->id)->first();
           
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
            $response = view('items.index');
            Cookie::queue(Cookie::forget('cart'));
          //return view('areas.index');
           
          //  return view('product.checkout-success', compact('customer'));
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }
*/

    public function cancel()
    {
        return redirect(URL::previous());
    }

      /*  if (!Auth::check()) {
            return redirect()->route('register')->with('redirectTo', url()->previous());
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'order_type' => 'required|string', // Add validation for order_type
            'payment_method' => 'required|string',
        ]);
    
        // Process payment, save order, etc.
        // For example, you can use a payment gateway like Stripe or PayPal
        // $payment = Payment::create($validatedData);
    
        // Save the order
        $order = Order::create([
            'client_id' => auth()->id(), // assuming you're using authentication
            'order_date' => now(),
            'status' => 'pending',
            'order_type' => $request->input('order_type'),
            'total_amount' => $request->input('total'),
            'delivery_address' => $request->input('address'),
            'table_id' => null, // You can set this if you have table-based ordering
        ]);
    
        // Save the order items
        $cartItems = $request->input('cart_items');
        $cartItemsArray = explode(';', $cartItems);
        foreach ($cartItemsArray as $item) {
            if (!empty($item)) {
                list($id, $quantity, $customDescription) = explode(':', $item);
                $itemData = Item::find($id);
                if ($itemData) {
                    $order->items()->attach($id, [
                        'quantity' => $quantity,
                        'price' => $itemData->price,
                        'custom_description' => $customDescription,
                    ]);
                }
            }
        }
    
        // Clear cart
        $response = redirect()->route('checkout1')->with('success', 'Order placed successfully!');
        $response->cookie('cart', json_encode([]), -1); // Clear the cart cookie
        return $response;
        */     
        
    

    // Show success page after order is placed
  /*  public function checkoutSuccess()
    {
        return view('checkout1');
    }
    public function cancel()
    {
        return view('checkout1');
    }
*/
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
} 
