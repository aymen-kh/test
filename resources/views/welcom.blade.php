<!DOCTYPE html>
<html lang="en">
<head>
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
  <?php  //@dd(auth()->user()) ?> 
 @include('layouts.nav')

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="display-4"> <i>Welcome to Roxi</i></h1>
            <p class="lead">Delicious food and great service in a cozy setting.</p>
            <a href="{{route('items.index')}}" class="btn btn-light btn-lg">Order Now</a>
        </div>
    </header>

    <div id="x" > 
        @include('menus.index')
    </div>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center">About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque imperdiet, nulla id iaculis vestibulum, arcu arcu laoreet erat, non tincidunt sapien justo nec erat. Duis vitae urna vel purus cursus condimentum.</p>
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
   
</body>
</html>
