@extends('products.index')

@section('content')

    <!-- Search Form -->
    <form action="{{ url('/search') }}" method="get">
        <input type="text" name="query" placeholder="Search products...">
        <button type="submit">Search</button>
    </form>

    @if(isset($searchTerm))
        <h3>Search Results for "{{ $searchTerm }}"</h3>
    @endif

    <div class="product-container">
        @forelse($products as $product)
            <div class="product-details">
                <h2 class="product-name">{{ $product->name }}</h2>
                <p class="product-description">Description: {{ $product->description }}</p>
                <p class="product-price">Price: ${{ $product->price }}</p>
                <p class="product-stock">Stock: {{ $product->stock }}</p>
                <p class="product-category">Category: {{ $product->category }}</p>

                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }} Image" class="product-image">
                @else
                    <p>No image available</p>
                @endif

                <!-- Update Button -->
                <div class="product-links">
                    <a href="{{ route('products.edit', $product->id) }}">
                        <button type="button">Update</button>
                    </a>

                    <form method="post" action="{{ route('products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No products found</p>
        @endforelse
    </div>

@endsection
