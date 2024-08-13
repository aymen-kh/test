
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>/* Additional custom styles */
    .card-img-top {
        height: 800px;
        object-fit: relative;
    }
    
    .card-body {
        flex: 1;
    }
    
    .list-unstyled li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #ddd;
    }
    .menu-card {
        display: grid;
        grid-template-rows: 1fr auto;
    }
    
    .menu-card i {
        font-size: 1.25rem;
        font-weight: 700;
        padding: 15px;
        background-color: rgba(255, 255, 255, 0.7);
        justify-self: end; /* Align to the right within its grid area */
        border-top: 1px solid #ddd;
        border-radius: 0 0 15px 15px;
    }
    </style>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<div class="container">
    <h1 class="text-center mb-4 text-white">Our Menus</h1>

    <div class="row">
        @foreach($menus as $menu)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm menu-card" style="background-image: url('{{ asset('images/3.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="card-body d-flex flex-column text-white">
                        <h5 class="card-title  text-center text-black">{{ $menu->name }}</h5>
                        <p class="card-text text-black">{{ $menu->description }}</p>
                   <!--     <span class="badge {{ $menu->availability? 'bg-success' : 'bg-danger' }} text-black">
                            {{ $menu->availability? 'Available' : 'Not Available' }}
                        </span> -->
                  <!--      <h6 class="mt-3 text-white">Items Included:</h6>-->
                        <ul class="list-unstyled">
                            @foreach($menu->items as $item)
                                <li class="d-flex justify-content-between text-black">
                                    <span>{{ $item->name }}</span>
                              <!--      <span>${{ number_format($item->price, 2) }}</span>-->
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <i class="card-text font-weight-bold text-black">{{ number_format($menu->price, 2) }}</i>

                </div>
            </div>
        @endforeach
    </div>
</div>
