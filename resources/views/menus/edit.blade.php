
<div class="container">
    <form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Other fields for menu -->
        <div class="form-group">
            <label for="items">Items</label>
            <select name="items[]" id="items" class="form-control" multiple>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
