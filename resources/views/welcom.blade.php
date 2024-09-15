<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurant Homepage</title>
    <style>
        #x {
        /*/    color: white; */
            background: rgba(180, 164, 164, 0.5); /* Black overlay with 50% opacity 
           /* background-color: rgb(87, 30, 30); /* Fallback color */
        /*    background-image: url('{{ asset('images/360_F_324739203_keeq8udvv0P2h1MLYJ0GLSlTBagoXS48.jpg') }}');
            background-size: cover; /* Cover the entire div */
            background-position: center; /* Center the image */
            height: 500; /* Set a height for the div */
            color: white; /* Text color */
        }
    </style>
    <style>
        /* Global Styles */
        body {
            background-color: #a38e8e; /* Light grey background color */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif; /* Set a default font */
        }
        .dropdown-menu {
            transform: translateX(-65%); /* Center align the dropdown */
            left: 50%; /* Align dropdown to the center of the button */
            right: auto; /* Override any default right alignment */
            min-width: 160px; /* Ensure a minimum width for the dropdown */
        }
    
        /* Hero section styles */
        .hero {
            position: relative;
            background-image: url('{{ asset('images/table-italian-food-dishes-330408137.jpg') }}'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            height: 100vh; /* Full viewport height */
            color: white;
            overflow: hidden;
        }
    
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Black overlay with 50% opacity */
            z-index: 1;
        }
    
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 5rem 1rem;
        }
    
        .hero-content h1 {
            font-size: 4rem; /* Larger font size for better impact */
            font-weight: 700; /* Bold font for emphasis */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Text shadow for better readability */
        }
    
        .hero-content p {
            font-size: 1.5rem;
        }
    
        .hero-content a {
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for button hover */
        }
    
        .hero-content a:hover {
            background-color: rgba(255, 255, 255, 0.8);
            color: #007bff; /* Change color on hover */
        }
    
        /* About Section Styles */
        section {
            background: #f8f9fa; /* Light gray background for contrast */
            padding: 5rem 0;
        }
    
        section h2 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }
    
        section p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #555; /* Darker gray text */
        }
    
        /* Footer Styles */
        footer {
            background: #343a40; /* Dark background for footer */
            color: white;
            padding: 2rem 0;
        }
    
        footer a {
            color: #f8f9fa; /* Light color for links */
            text-decoration: none;
        }
    
        footer a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
</head>
<body>
    @include('layouts.nav')

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="display-4"><i>Welcome to Roxi</i></h1>
            <p class="lead">{{$restaurants->description}}</p>
            @cannot('order_edit')   <a href="{{ route('orders.takeorder') }}" class="btn btn-light btn-lg">Order Now</a>@endcannot
            @role('Admin')   <a href="{{ route('orders.takeorder') }}" class="btn btn-light btn-lg">Order Now</a>@endrole
        </div>
    </header>
    <div class=" bg-light py-5" id="x">
        @include('menus.index')
    </div>
    <!-- About Section -->
    <!-- About Section -->
    <section class="py-5 bg-light">
        <div class="container" id="abt">
            <div class="row">
                <!-- Image beside the story -->
                <div class="col-md-6">
                    <img src="{{asset('images/chef.jpeg')}}" alt="Our Story" class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <h4 class="text-primary mb-3">Our Story</h4>
                    <p style="font-size: 1.1rem; line-height: 1.6;">
                        Founded in 2020, Roxi started with a passion for bringing people together over delicious meals. What began as a small family-run establishment has grown into a beloved community hub, known for our warm atmosphere and dedication to high-quality ingredients. Every dish we serve tells the story of our journey, blending tradition with innovation to create unforgettable dining experiences.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <h4 class="text-primary mb-3">Contact Information</h4>
                    <p style="font-size: 1.1rem;"><strong>Phone:</strong> {{ $restaurants->phone }}</p>
                    <p style="font-size: 1.1rem;"><strong>Mail:</strong> {{ $restaurants->email }}</p>
                    <p style="font-size: 1.1rem;"><strong>Location:</strong> {{ $restaurants->address }}</p>
                    <h5 class="mt-4 text-primary">Open Days</h5>
                    <ul style="font-size: 1.1rem;">
                        <li>{{ $restaurants->open_days }}: {{ $restaurants->open_time }} - {{ $restaurants->close_time }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('images/r.jpg')}}" alt="Contact Us" class="img-fluid rounded shadow" style="max-height: 250px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>
    

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 Restaurant. All rights reserved.</p>
            <p class="mb-0"><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>

    <!-- Modal -->
    @include('layouts.reserve')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>