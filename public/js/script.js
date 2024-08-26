document.addEventListener("DOMContentLoaded", function() {
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
            <button type="submit" class="dropdown-item primary-button">Checkout</button>
        </form>
    `;
    }
}

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

document.querySelectorAll('.item-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        const itemId = this.dataset.id;
        fetch(`/items/${itemId}`)
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
    const orderType = document.querySelector('#order-type').value; // Get the selected order type


    let cart = JSON.parse(getCookie('cart') || '[]');
    cart.push({
        id: itemId,
        name: itemName,
        image: itemImage,
        price: itemPrice,
        quantity: itemQuantity,
        custom_description: itemCustomDescription,
        order_type: orderType // Add order type to cart

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
});