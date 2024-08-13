@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Our Menus</h1>

    <div class="row">
        @foreach($menus as $menu)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="menu-card" style="background-image: url('{{ asset('storage/' . $menu->background_image) }}');">
                    <div class="overlay"></div>
                    <div class="menu-card-content">
                    <div class="menu-card-image">
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="img-fluid">
                    </div>
                    <!-- Menu Content -->
                    <div class="menu-card-content">
                        <h5 class="menu-card-title">{{ $menu->name }}</h5>
                        <p class="menu-card-description">{{ $menu->description }}</p>
                        <p class="menu-card-price">${{ number_format($menu->price, 2) }}</p>
                        <p class="menu-card-availability">
                            <span class="badge {{ $menu->availability ? 'bg-success' : 'bg-danger' }}">
                                {{ $menu->availability ? 'Available' : 'Not Available' }}
                            </span>
                        </p>

                        <!-- Menu Items -->
                        <h6 class="menu-items-title">Items Included:</h6>
                        <div class="menu-items">
                            @foreach($menu->items as $item)
                                <div class="menu-item">
                                    <span class="item-name">{{ $item->name }}</span>
                                    <span class="item-price">${{ number_format($item->price, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
