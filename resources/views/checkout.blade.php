<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('items.index')}}"><i>Roxi</i></a>
            <!-- Add more navigation items if needed -->
        </nav>
    </header>
    <main class="container py-4">
        <h1>Checkout</h1>
        <div id="cart-contents" class="mb-4">
            @if(empty($cart))
                <p>Your cart is empty.</p>
            @else
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    <div class="cart-item mb-3">
                        <img src="/images/{{$item['image']}}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px; object-fit: cover;">
                        {{ $item['name'] }} - ${{ number_format($item['price'], 2) }} ({{ $item['quantity'] }})<br>
                        <small>{{ $item['custom_description'] }}</small>
                        @php $total += $item['price'] * $item['quantity']; @endphp
                    </div>
                @endforeach
                <h3>Total: ${{ number_format($total, 2) }}</h3>
            @endif
        </div>
        <h3>Order Type</h3>
        <form id="payment-form" method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <div class="form-group">
                <label for="order-type">Select Order Type:</label>
                <select id="order-type" name="order_type" class="form-control">
                    <option value="in-place">In-Place</option>
                    <option value="delivery">Delivery</option>
                    <option value="pick-up">Pick-Up</option>
                </select>
            </div>
            <div class="form-group">
                <label for="payment-method">Select Payment Method:</label>
                <select id="payment-method" name="payment_method" class="form-control">
                    <option value="credit-card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <!-- Add more payment options if needed -->
                </select>
            </div>
            <input type="hidden" name="cart_items" value="{{ implode(';', array_map(function($item) {
                return $item['id'] . ':' . $item['quantity'] . ':' . $item['custom_description'];
            }, $cart)) }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <button type="submit" class="btn btn-primary">Complete Purchase</button>
        </form>
    </main>
    
</body>
</html>
