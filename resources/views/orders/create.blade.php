@can('order_edit')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .item-card, .table-card, .menu-card {
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .item-card:hover, .table-card:hover, .menu-card:hover {
            transform: scale(1.02);
        }
        
        .item-details, .table-details {
            margin-top: 10px;
        }
        
        .bg-light {
            background-color: #f8f9fa !important;
        }
        
        .selected-item, .selected-table, .selected-menu {
            border: 2px solid #007bff;
            border-radius: 0.25rem;
        }

        .item-card .item-details {
            display: none;
        }

        .item-card.selected-item .item-details {
            display: block;
        }

        .order-details-section {
            display: none;
        }

        .order-details-section.active {
            display: block;
        }

        .table-card {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .table-card.selected-table {
            background-color: #007bff;
            color: white;
        }

        .menu-card {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .menu-card.selected-menu {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Create Order</h1>
        
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <!-- Order Type -->
            <div class="form-group">
                <label for="order_type">Order Type</label>
                <select name="order_type" id="order_type" class="form-control">
                    <option value="dine_in">Dine In</option>
                    <option value="takeaway">Takeaway</option>
                    <option value="delivery">Delivery</option>
                </select>
            </div>

            <!-- Order Date for Takeaway and Delivery -->
            <div class="form-group order-details-section" id="order_date_section">
                <label for="order_date">Order Date</label>
                <input type="datetime-local" name="order_date" id="order_date" class="form-control">
            </div>

            <!-- Address for Delivery -->
            <div class="form-group order-details-section" id="address_section">
                <label for="address">Delivery Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Enter delivery address here..."></textarea>
            </div>

            <!-- Select Table for Dine-In -->
            <div class="order-details-section" id="table_selection">
                <h3>Select a Table</h3>
                <div id="table_areas">
                    @foreach($areas as $area)
                        <h4>{{ $area->name }}</h4>
                        <div class="row mb-3">
                            @foreach($tables->where('area_id', $area->id) as $table)
                                <div class="col-md-3">
                                    <div class="card table-card" id="table-card-{{ $table->id }}" data-table-id="{{ $table->id }}">
                                        <div class="card-body">
                                            <h5 class="card-title">Table #{{ $table->number }}</h5>
                                            <p class="card-text">Area: {{ $area->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Select Items by Category -->
            @foreach($categories as $category)
                <div class="card my-3">
                    <div class="card-header">
                        <h4>{{ $category->name }}</h4>
                    </div>
                    <div class="card-body">
                        @if($category->items->count() > 0)
                            <div class="row">
                                @foreach($category->items as $item)
                                    <div class="col-md-4 mb-3">
                                        <div class="card item-card" id="item-card-{{ $item->id }}" data-item-id="{{ $item->id }}" data-item-price="{{ $item->price }}">
                                            <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">

                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->name }}</h5>
                                                <p class="card-text">${{ number_format($item->price, 2) }}</p>
                                                <div class="item-details">
                                                    <div class="form-group">
                                                        <label for="quantity-{{ $item->id }}">Quantity</label>
                                                        <input type="number" name="items[{{ $item->id }}][quantity]" id="quantity-{{ $item->id }}" class="form-control item-quantity" min="1" value="1" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description-{{ $item->id }}">Custom Description</label>
                                                        <textarea name="items[{{ $item->id }}][custom_description]" id="description-{{ $item->id }}" class="form-control" placeholder="Add any special instructions here..." disabled></textarea>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-success select-btn">Select</button>
                                                <button type="button" class="btn btn-danger deselect-btn d-none">Deselect</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No items available in this category.</p>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Select Menu -->
            <div class="card my-3">
                <div class="card-header">
                    <h4>Select a Menu</h4>
                </div>
                <div class="card-body">
                    @if($menus->count() > 0)
                        <div class="row">
                            @foreach($menus as $menu)
                                <div class="col-md-4 mb-3">
                                    <div class="card menu-card" id="menu-card-{{ $menu->id }}" data-menu-id="{{ $menu->id }}" data-menu-price="{{ $menu->price }}">
                                        <img src="{{ asset('images/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $menu->name }}</h5>
                                            <p class="card-text">${{ number_format($menu->price, 2) }}</p>
                                            <button type="button" class="btn btn-primary select-menu-btn">Add Menu</button>
                                            <button type="button" class="btn btn-danger deselect-menu-btn d-none">Remove Menu</button>
                                            <!-- Hidden input to hold menu items -->
                                            <div class="menu-items d-none" id="menu-items-{{ $menu->id }}"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No menus available.</p>
                    @endif
                </div>
            </div>

            <!-- Total Price -->
            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="text" id="total_price" class="form-control" readonly>
            </div>

            <!-- Hidden inputs for total amount and user ID -->
            <input type="hidden" name="total_amount" id="total_amount">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <!-- Hidden inputs for selected items -->
            <div id="selected_items"></div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    <option value="cash" selected>Cash</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    
                    <!-- Add more payment methods as needed -->
                </select>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
    <script>
       $(document).ready(function() {
    let selectedItems = [];
    let selectedMenus = [];
    let selectedTableId = null;

    function updateTotalPrice() {
        let totalPrice = 0;

        selectedItems.forEach(item => {
            const itemPrice = parseFloat($(`#item-card-${item.id}`).data('item-price'));
            const itemQuantity = parseInt($(`#quantity-${item.id}`).val());
            totalPrice += itemPrice * itemQuantity;
        });

        selectedMenus.forEach(menu => {
            const menuPrice = parseFloat($(`#menu-card-${menu.id}`).data('menu-price'));
            totalPrice += menuPrice;
        });

        $('#total_price').val(totalPrice.toFixed(2));
        $('#total_amount').val(totalPrice.toFixed(2));
    }

    function toggleOrderDetails() {
        const selectedOrderType = $('#order_type').val();
        $('.order-details-section').removeClass('active');

        if (selectedOrderType === 'dine_in') {
            $('#table_selection').addClass('active');
        } else if (selectedOrderType === 'takeaway' || selectedOrderType === 'delivery') {
            $('#order_date_section').addClass('active');
            if (selectedOrderType === 'delivery') {
                $('#address_section').addClass('active');
            }
        }
    }

    $('#order_type').on('change', function() {
        toggleOrderDetails();
    });

    // Initialize the form based on the current order type
    toggleOrderDetails();

    // Table selection
    $('.table-card').on('click', function() {
        $('.table-card').removeClass('selected-table');
        $(this).addClass('selected-table');
        selectedTableId = $(this).data('table-id');
    });

    // Item selection
    $('.select-btn').on('click', function() {
        const card = $(this).closest('.item-card');
        const itemId = card.data('item-id');

        if (!selectedItems.find(item => item.id === itemId)) {
            selectedItems.push({ id: itemId });
            card.addClass('selected-item');
            card.find('.item-details input, .item-details textarea').removeAttr('disabled');
            $(this).siblings('.deselect-btn').removeClass('d-none');
            $(this).addClass('d-none');
            updateTotalPrice();
        }
    });

    // Item deselection
    $('.deselect-btn').on('click', function() {
        const card = $(this).closest('.item-card');
        const itemId = card.data('item-id');

        selectedItems = selectedItems.filter(item => item.id !== itemId);
        card.removeClass('selected-item');
        card.find('.item-details input, .item-details textarea').attr('disabled', true);
        $(this).siblings('.select-btn').removeClass('d-none');
        $(this).addClass('d-none');
        updateTotalPrice();
    });

    // Menu selection
    $('.select-menu-btn').on('click', function() {
        const card = $(this).closest('.menu-card');
        const menuId = card.data('menu-id');
        const menuItemsContainer = $(`#menu-items-${menuId}`);

        if (!selectedMenus.find(menu => menu.id === menuId)) {
            selectedMenus.push({ id: menuId });
            card.addClass('selected-menu');
            $(this).siblings('.deselect-menu-btn').removeClass('d-none');
            $(this).addClass('d-none');

            // Add menu items to the form
            menuItemsContainer.empty();
            $.each(@json($menus), function(index, menu) {
                if (menuId === menu.id) {
                    $.each(menu.items, function(itemId, item) {
                        menuItemsContainer.append(`
                            <input type="hidden" name="menus[${menuId}][items][${itemId}][id]" value="${itemId}">
                            <input type="hidden" name="menus[${menuId}][items][${itemId}][price]" value="${item.price}">
                        `);
                    });
                }
            });

            updateTotalPrice();
        }
    });

    // Menu deselection
    $('.deselect-menu-btn').on('click', function() {
        const card = $(this).closest('.menu-card');
        const menuId = card.data('menu-id');

        selectedMenus = selectedMenus.filter(menu => menu.id !== menuId);
        card.removeClass('selected-menu');
        $(this).siblings('.select-menu-btn').removeClass('d-none');
        $(this).addClass('d-none');

        // Remove menu items from the form
        $(`#menu-items-${menuId}`).empty();

        updateTotalPrice();
    });

    // On form submit, ensure selected items, menus, and table are properly included
    $('form').on('submit', function() {
        if (selectedTableId) {
            $(this).append(`<input type="hidden" name="table_id" value="${selectedTableId}">`);
        }

        selectedItems.forEach(item => {
            $(this).append(`<input type="hidden" name="items[${item.id}][id]" value="${item.id}">`);
            $(this).append(`<input type="hidden" name="items[${item.id}][quantity]" value="${$(`#quantity-${item.id}`).val()}">`);
            $(this).append(`<input type="hidden" name="items[${item.id}][custom_description]" value="${$(`#description-${item.id}`).val()}">`);
        });

        selectedMenus.forEach(menu => {
            $(this).append(`<input type="hidden" name="menus[${menu.id}][id]" value="${menu.id}">`);
        });
    });
});

    </script>
@endcan
