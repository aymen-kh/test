<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('welcom')}}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>
            @can('order_edit')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="bi bi-cart"></i> Manage Orders
                </a>
            </li>
            @endcan
            @can('user_edit')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="bi bi-person"></i> Manage Users
                </a>
            </li>
            @endcan
            @can('table_edit')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reservations.index') }}">
                    <i class="bi bi-calendar-check"></i> Manage Reservations
                </a>
            </li>
            @endcan
            @can('item_edit')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('items.index') }}">
                    <i class="bi bi-box"></i> Manage Items
                </a>
            </li>
         
        
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menus.index') }}">
                    <i class="bi bi-menu-button"></i> Manage Menus
                </a>
            </li>
            @endcan
            @can('category_create')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="bi bi-tags"></i> Manage Categories
                </a>
            </li>
            @endcan
            @can('restaurant_edit')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('restaurants.index') }}">
                    <i class="bi bi-building"></i> Manage Restaurants
                </a>
            </li>
            @endcan
            @can('area_edit')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('areas.index') }}">
                    <i class="bi bi-geo-alt"></i> Manage Areas
                </a>
            </li>
           @endcan
           @can('table_edit')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tables.index') }}">
                    <i class="bi bi-table"></i> Manage Tables
                </a>
            </li>
            @endcan
            @role(['Admin'])
                
           
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menus.index') }}">
                    <i class="bi bi-truck"></i> Manage Deliveries
                </a>
            </li>
            @endrole
        </ul>
    </div>
</nav>

<style>
    #sidebar {
        background-color: #f8f9fa; /* Light background color */
        border-right: 1px solid #dee2e6; /* Light border for separation */
        height: 100vh; /* Full height */
        padding-top: 1rem; /* Padding from the top */
        transition: all 0.3s ease; /* Smooth transition for hover effects */
    }

    .nav-link {
        color: #495057; /* Default text color */
        font-weight: 500; /* Slightly bold text */
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 0.25rem; /* Rounded corners */
    }

    .nav-link:hover {
        background-color: #e9ecef; /* Light gray background on hover */
        color: #007bff; /* Primary color for text on hover */
        text-decoration: none; /* Remove underline */
    }

    .nav-link.active {
        color: #007bff; /* Primary color for active link */
        background-color: #e9ecef; /* Light gray background for active link */
    }

    .nav-link i {
        margin-right: 0.5rem; /* Spacing between icon and text */
        font-size: 1.2rem; /* Size of the icons */
    }

    .nav-item {
        margin-bottom: 0.5rem; /* Space between items */
    }

    .position-sticky {
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0; /* Sticky at the top */
    }

    @media (max-width: 768px) {
        #sidebar {
            width: 100%; /* Full width on smaller screens */
            padding: 0.5rem; /* Reduced padding */
        }

        .nav-link {
            font-size: 0.875rem; /* Smaller text on smaller screens */
        }

        .nav-link i {
            font-size: 1rem; /* Smaller icons on smaller screens */
        }
    }
</style>
