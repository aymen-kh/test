<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
    <a class="navbar-brand" href="{{ route('welcom') }}">Roxi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
           

            <li class="nav-item">
                <a class="nav-link" href="{{route('menus.index')}}">Menus</a>
            </li>
            <li  class="nav-item" >
                @if (Request::is('/') || Request::is('home'))
                <a class="nav-link" href="#abt">About Us <span class="sr-only">(current)</span></a>

            
            @endif
              
            </li>
           @cannot('order_edit')
            <li class="nav-item">
                <button id="openModalBtn" class="btn btn-outline-success my-2 my-sm-0 ml-2 btn-floating" data-toggle="modal" data-target="#reservationModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-plus" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h9V.5a.5.5 0 0 1 1 0V1h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H1a.5.5 0 0 1-.5-.5V1A.5.5 0 0 1 1 0h1v.5a.5.5 0 0 1 .5-.5zm-1 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2H2.5zM8 8.5a.5.5 0 0 1 .5-.5h2V6a.5.5 0 0 1 1 0v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2H8.5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    Reservation
                </button>
            </li>
            @endcannot
            @role('Admin')
            <li class="nav-item">
                <button id="openModalBtn" class="btn btn-outline-success my-2 my-sm-0 ml-2 btn-floating" data-toggle="modal" data-target="#reservationModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-plus" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h9V.5a.5.5 0 0 1 1 0V1h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H1a.5.5 0 0 1-.5-.5V1A.5.5 0 0 1 1 0h1v.5a.5.5 0 0 1 .5-.5zm-1 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2H2.5zM8 8.5a.5.5 0 0 1 .5-.5h2V6a.5.5 0 0 1 1 0v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2H8.5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    Reservation
                </button>
            </li>
            @endrole
            @can('order_edit')
            <li class="nav-item">
                <a href="{{ route('pos') }}" class="btn btn-outline-primary my-2 my-sm-0 ml-2 btn-floating">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2H0zm16 3v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V7h16zm0-1H0V5h16v1z"/>
                        <path d="M2 11h12a1 1 0 0 0 1-1H1a1 1 0 0 0 1 1z"/>
                        <path d="M0 12h16v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-1zm8-5a2 2 0 1 1 0 4 2 2 0 0 1 0-4z"/>
                    </svg>
                    POS
                </a>
            </li>
            @endcan
        </ul>
        @guest
            <!-- User is not logged in -->
            <a class="btn btn-outline-primary ml-2" href="{{ route('register') }}">Register</a>
            <a class="btn btn-secondary ml-2" href="{{ route('login') }}">Login</a>
        @else
            <!-- User is logged in -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        <span class="d-none d-md-inline">Profile</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('orders.index') }}">@cannot('order_edit')My @endcannot Orders</a>
                        @can('reservation_show')
                        <a class="dropdown-item" href="{{ route('reservations.index') }}">
                            @can('table_edit')
                                Reservations
                            @else
                                My Reservations
                            @endcan
                        </a>
                    @endcan
                    
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); 
                                    document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
               
            </ul>
        @endguest
    </div>
</nav>

<style>
    .navbar {
        border-radius: 0;
        transition: all 0.3s ease;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #333;
        font-weight: 500;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        color: #007bff;
    }

    .btn-floating {
        border-radius: 50%;
        padding: 0.5rem 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .btn-floating:hover {
        background-color: #007bff;
        color: #fff;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .dropdown-menu {
        min-width: 160px;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        border-radius: 0.25rem;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
    }

    .nav-link svg {
        margin-right: 8px;
        vertical-align: middle;
    }

    .navbar-toggler {
        border-color: transparent;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 30 30'%3E%3Cpath stroke='currentColor' stroke-width='2' d='M5 7h20M5 15h20M5 23h20'/%3E%3C/svg%3E");
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: #007bff;
    }
</style>
