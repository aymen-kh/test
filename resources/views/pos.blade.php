@extends('layouts.dashboard')

@section('content')
    <!-- Manage Orders Card -->
    @can('order_edit')
    <div class="col-md-4 mb-4">        
        <div class="card dashboard-card"  style="background-image: url('{{ asset('images/12.jpg') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Orders</h5>
                <p class="card-text"><br></p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Go to Orders</a>
            </div>
        </div>
    </div>
    @endcan

    <!-- Manage Users Card -->
    @can('user_edit')
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/user.jpg') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Users</h5>
                <br>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Go to Users</a>
            </div>
        </div>
    </div>
    @endcan

    <!-- Manage Reservations Card -->
    @can('table_edit')
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/res.jpg') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Reservations</h5>
                <br>
                <a href="{{ route('reservations.index') }}" class="btn btn-primary">Go to Reservations</a>
            </div>
        </div>
    </div>
    @endcan

    <!-- Manage Items Card -->
    @can('item_edit')
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/125.jpg') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Items</h5>
                <br>
                <a href="{{ route('items.index') }}" class="btn btn-primary">Go to Items</a>
            </div>
        </div>
    </div>
    @endcan
@can('item_edit')
    <!-- Manage Menus Card -->
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/menu.png') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Menus</h5>
                <br>
                <a href="{{ route('menus.index') }}" class="btn btn-primary">Go to Menus</a>
            </div>
        </div>
    </div>
@endcan
    <!-- Manage Categories Card -->
    @can('category_create')
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/55.jpg') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Categories</h5>
                <p class="card-text"></p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Go to Categories</a>
            </div>
        </div>
    </div>
    @endcan

    <!-- Manage Restaurants Card -->
    @can('restaurant_edit')
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/Savage-2019-top-50-busy-restaurant.webp') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Restaurants</h5>
                <p class="card-text"><br></p>
                <a href="{{ route('restaurants.index') }}" class="btn btn-primary">Go to Restaurants</a>
            </div>
        </div>
    </div>
    @endcan

    <!-- Manage Areas Card -->
    @can('area_edit')
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/360_F_294263329_1IgvqNgDbhmQNgDxkhlW433uOFuIDar4.jpg') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Areas</h5>
                <p class="card-text"><br></p>
                <a href="{{ route('areas.index') }}" class="btn btn-primary">Go to Areas</a>
            </div>
        </div>
    </div>
    @endcan

    <!-- Manage Tables Card -->
    @can('table_edit')
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('{{ asset('images/Close-Up-Of-a-Free-Restaurant-Table-Mockup-PSD-Template.jpg') }}');">
            <div class="card-body">
                <h5 class="card-title">Manage Tables</h5>
                <p class="card-text"><br></p>
                <a href="{{ route('tables.index') }}" class="btn btn-primary">Go to Tables</a>
            </div>
        </div>
    </div>
    @endcan

    <!-- Manage Deliveries Card -->
    @role(['Admin'])
    <div class="col-md-4 mb-4">
        <div class="card dashboard-card" style="background-image: url('https://via.placeholder.com/300x200?text=Deliveries');">
            <div class="card-body">
                <h5 class="card-title">Manage Deliveries</h5>
                <p class="card-text">View and manage delivery orders and logistics.</p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Go to Deliveries</a>
            </div>
        </div>
    </div>
    @endrole
@can('user_edit')
    <!-- Reports Section -->
    <div class="col-md-12 mt-4">
        <div class="card dashboard-card" style="background-color: #007bff; color: #ffffff;">
            <div class="card-body">
                <h5 class="card-title">Reports</h5>
                <p class="card-text">Generate and export reports for different aspects of the POS system.</p>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="{{route('users.report')}}" class="btn btn-outline-light">Clients Report</a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{route('orders.report')}}" class="btn btn-outline-light">Orders Report</a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="" class="btn btn-outline-light">Items Report</a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="" class="btn btn-outline-light">Menus Report</a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="" class="btn btn-outline-light">Reservations Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection
