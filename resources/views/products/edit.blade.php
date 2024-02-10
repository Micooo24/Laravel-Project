
    <h1>Edit Product: {{ $product->name }}</h1>

    {{-- Display validation errors if any --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Form --}}
    <form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>

        {{-- Product Description --}}
        <label for="description">Description:</label>
        <textarea name="description" required>{{ old('description', $product->description) }}</textarea>

        {{-- Product Price --}}
        <label for="price">Price:</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" required>

        {{-- Product Stock --}}
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>

        {{-- Product Category --}}
        <label for="category">Category:</label>
        <input type="text" name="category" value="{{ old('category', $product->category) }}" required>

        {{-- Product Image --}}
        <label for="image">Product Image:</label>
        <input type="file" name="image">

        {{-- Display current image if exists --}}
        @if($product->image)
            <p>Current Image: <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }} Image" style="max-width: 300px;"></p>
        @endif

        {{-- Submit Button --}}
        <button type="submit">Update Product</button>
    </form>
