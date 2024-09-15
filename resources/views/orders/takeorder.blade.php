<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EveryPlate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.pinsearch@1.0.5/src/Leaflet.PinSearch.css" crossorigin=""></script>
 <style>
    body {
    font: normal 100% Helvetica, Arial, sans-serif;
}
    .plate img {
    width: 100%; /* Ensures the image takes up the full width of its container */
    height: 250px; /* Sets a consistent height for all images */
    object-fit: cover; /* Ensures the image covers the entire area without stretching */
    border-radius: 10px 10px 0 0; 
}
        .order-type-select {
            display: flex;
            align-items: center;
            margin-left: 290px;
        }
        .order-type-select label {
            font-size: 16px;
            margin-bottom: 0;
        }
        .order-type-select select {
            width: 150px;
            height: 35px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background-color: #f0f0f0;
            cursor: pointer;
        }
        .order-type-select select:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .plate { 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s; 
        }
        .plate:hover { 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
            transform: translateY(-2px); 
        }
        .plate img { 
            border-radius: 10px 10px 0 0; 
        }
        .plate-grid a:hover { 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
            transform: translateY(-2px); 
        }
        .modal-lg {
  max-width: 1000px; /* adjust the width to your liking */
}
    </style>
</head>
<body>
    <div class="modal fade" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="map-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="map-modal-label">Select Location</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="map" style="height: 400px; width: 400px;"></div>
            </div>
          </div>
        </div>
      </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><i>Roxi</i></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    @foreach ($categories->take(4) as $category)
                        <li class="nav-item active">
                            <a class="nav-link" href="#{{$category->id}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                    <form class="form-inline my-2 my-lg-0 ml-2" id="search-form">
                        <input class="form-control mr-sm-2" type="search" id="search-input" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                </ul>
                <div class="order-type-select">
                    <label for="order-type" style="color: rgb(252, 252, 252);">Order Type:</label>
                    <select id="order-type" class="form-control" style="border-color: red; color: red;">
                        <option value="pickup">Pickup</option>
                        <option value="delivery">Delivery</option>
                    </select>
                </div>
                
                <div class="ml-auto mr-4 position-relative">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-pill badge-light position-absolute" style="top: -8px; right: -8px;" id="cart-count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="cart-dropdown">
                        <a class="dropdown-item" href="#">Your cart is empty</a>
                        
                    </div>
                </div>
            </div>
         
        </nav>
    </header>
  
    <main class="container py-4">
        @foreach ($categories as $category)
            <section id="{{$category->id}}">
                <h2>{{$category->name}}</h2>
                <div class="row">
                    @foreach ($category->items as $item)
                        <a href="#" class="col-md-4 mb-4 item-link text-decoration-none text-dark" data-id="{{ $item->id }}">
                            <div class="plate">
                                <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid" />
                                <h3>{{$item->name}}</h3>
                                <p>{{$item->description}}</p>
                                <p>{{$item->price}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </main>

    <div class="modal fade" id="item-modal" tabindex="-1" role="dialog" aria-labelledby="item-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="item-modal-label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="item-modal-image" src="" alt="" class="img-fluid mb-3" />
                    <p id="item-modal-description"></p>
                    <p id="item-modal-price"></p>
                    <div class="form-group">
                        <label for="item-quantity">Quantity:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="decrease-quantity">-</button>
                            </div>
                            <input type="number" id="item-quantity" class="form-control" value="1" min="1" />
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="increase-quantity">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item-custom-description">Custom Description:</label>
                        <textarea id="item-custom-description" class="form-control" cols="30" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="add-to-cart" data-dismiss="modal">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>   

    
    <!-- Defer loading of JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
    
   <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
     
     
     
   <script src="https://unpkg.com/leaflet.pinsearch@1.0.5/src/Leaflet.PinSearch.js" crossorigin=""></script>

    <script>
          var selectedLocation = null;
            document.addEventListener('DOMContentLoaded', function () {
    // Initialize the map
    var map = L.map('map').setView([33, 9.5], 10);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker; // declare a global variable to store the marker

    // Update location when the user clicks on the map
    map.on('click', function (event) {
        var lat = event.latlng.lat;
        var lng = event.latlng.lng;

        // Remove existing marker if any
        if (marker) {
            map.removeLayer(marker);
        }

        // Add a new marker to the map at the clicked location
        marker = L.marker([lat, lng], {
            title: 'Chosen place'
        }).addTo(map);

        // Fetch address from lat and lon
        var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                var address = data.display_name;
                console.log('Address:', address);
                selectedLocation = address;

                // Update the hidden input field with the selected location
                document.getElementById('delivery-location-input').value = selectedLocation;
            })
            .catch(error => console.error('Error:', error));
    });

    // Ensure the form input is updated and the form submits correctly
    const checkoutForm = document.getElementById('checkout-form');
    checkoutForm.addEventListener('submit', function (e) {
        if (!selectedLocation) {
            e.preventDefault(); // Stop form submission if location is not selected
            alert("Please select a delivery location on the map.");
        } else {
            // Update the hidden input with the selected location before submitting
            document.getElementById('delivery-location-input').value = selectedLocation;
        }
    });
});

            function updateTotalPrice() {
                const price = parseFloat(document.querySelector('#item-modal-price').dataset.price);
                const quantity = parseInt(document.querySelector('#item-quantity').value);
                document.querySelector('#item-modal-price').textContent = 'Price: ' + (price * quantity).toFixed(2);
            }
            

            function updateCart() {
                let cart = JSON.parse(getCookie('cart') || '[]');
                document.querySelector('#cart-count').textContent = cart.length;
                updateCartDropdown();
            }

            function updateCartDropdown() {
                let cart = JSON.parse(getCookie('cart') || '[]');
                const cartDropdown = document.querySelector('#cart-dropdown');
                cartDropdown.innerHTML = '';
                if (cart.length === 0) {
                    cartDropdown.innerHTML = '<a class="dropdown-item" href="#">Your cart is empty</a>';
                } else {
                    cart.forEach(item => {
                        cartDropdown.innerHTML += `
                            <a class="dropdown-item" href="#">
                                <img src="/images/${item.image}" alt="${item.name}" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                                ${item.name} - ${item.price.toFixed(2)} (${item.quantity})<br>
                                <small>${item.custom_description}</small>
                                <button type="button" class="btn btn-danger btn-sm float-right remove-item" data-id="${item.id}">Remove</button>
                            </a>
                        `;
                    });
                    cartDropdown.innerHTML += '<div class="dropdown-divider"></div>';
                    cartDropdown.innerHTML += `
                    <form action="{{ route('order.process') }}" method="post">
                        @csrf
                          <input type="hidden" name="delivery_location" id="delivery-location-input">
                        <button type="submit" class="dropdown-item primary-button">Checkout</button>
                    </form>
                `;
                }
      
            }
            document.getElementById('search-input').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase(); // Get the current input value and convert to lowercase
    const items = document.querySelectorAll('.item-link'); // Select all items

    // Loop through all items and filter based on the search term
    items.forEach(function(item) {
        const itemName = item.querySelector('h3').textContent.toLowerCase(); // Get item name
        const itemDescription = item.querySelector('p').textContent.toLowerCase(); // Get item description
        
        if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
            item.style.display = ''; // Show item if it matches the search term
        } else {
            item.style.display = 'none'; // Hide item if it doesn't match
        }
    });
});

            function setCookie(name, value, minutes) {
                const expires = minutes ? `; expires=${new Date(Date.now() + minutes * 60 * 1000).toUTCString()}` : '';
                document.cookie = `${name}=${value || ''}${expires}; path=/`;
            }

            function getCookie(name) {
                const nameEQ = `${name}=`;
                return document.cookie.split(';').reduce((acc, cookie) => {
                    cookie = cookie.trim();
                    return cookie.indexOf(nameEQ) === 0 ? cookie.substring(nameEQ.length) : acc;
                }, null);
            }
            document.querySelector('#order-type').addEventListener('change', function() {
    if (this.value === 'delivery') {
      $('#map-modal').modal('show');
    } else {
      $('#map-modal').modal('hide');
    }
  });

            document.querySelectorAll('.item-link').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const itemId = this.dataset.id;
                    fetch(`/items/${itemId}/?ajax=1`)
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector('#item-modal-label').textContent = data.name;
                            document.querySelector('#item-modal-label').dataset.id = data.id;
                            document.querySelector('#item-modal-image').src = `/images/${data.image}`;
                            document.querySelector('#item-modal-description').textContent = data.description;
                            document.querySelector('#item-modal-price').dataset.price = data.price;
                            updateTotalPrice();
                            $('#item-modal').modal('show');
                        })
                        .catch(() => alert('Could not retrieve item details'));
                });
            });

            document.querySelector('#increase-quantity').addEventListener('click', function() {
                const quantityInput = document.querySelector('#item-quantity');
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateTotalPrice();
            });

            document.querySelector('#decrease-quantity').addEventListener('click', function() {
                const quantityInput = document.querySelector('#item-quantity');
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                    updateTotalPrice();
                }
            });

            document.querySelector('#add-to-cart').addEventListener('click', function() {
                const itemId = document.querySelector('#item-modal-label').dataset.id;
                const itemName = document.querySelector('#item-modal-label').textContent;
                const itemImage = document.querySelector('#item-modal-image').src.split('/').pop();
                const itemPrice = parseFloat(document.querySelector('#item-modal-price').textContent.replace('Price: ', ''));
                const itemQuantity = document.querySelector('#item-quantity').value;
                const itemCustomDescription = document.querySelector('#item-custom-description').value;
                const orderType = document.querySelector('#order-type').value; 
                const location = selectedLocation; // Get the selected order type
       
                let cart = JSON.parse(getCookie('cart') || '[]');
                cart.push({
                    id: itemId,
                    name: itemName,
                    image: itemImage,
                    price: itemPrice,
                    quantity: itemQuantity,
                    custom_description: itemCustomDescription,
                    order_type: orderType,
                    location: location   // Add order type to cart

                });
                setCookie('cart', JSON.stringify(cart), 60);
                updateCart();
            });

            document.querySelector('#cart-dropdown').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-item')) {
                    const itemId = event.target.dataset.id;
                    let cart = JSON.parse(getCookie('cart') || '[]');
                    cart = cart.filter(item => item.id !== itemId);
                    setCookie('cart', JSON.stringify(cart), 60);
                    updateCart();
                }
            });
            
            // Initialize cart on page load
            updateCart();
    
     
    </script>
   



</body>
</html> 