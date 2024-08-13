<!-- resources/views/items/create.blade.php -->
<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <!-- other input fields -->
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create Item</button>
</form>
