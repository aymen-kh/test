<!-- resources/views/menus/show.blade.php -->

<div class="container">
    <h1>{{ $menu->name }}</h1>
    <p><strong>Price:</strong> ${{ $menu->price }}</p>
    <p><strong>Category:</strong> {{ $menu->name }}</p>
    <p><strong>Description:</strong> {{ $menu->description }}</p>
 
   @foreach ($menu->items as $item )
   <p><strong>Item:</strong> {{ $item->name }}</p>
       
   @endforeach

    @if($menu->image)
    <p><strong>Image:</strong></p>
    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
    @endif
</div>
