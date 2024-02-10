<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        /* Colors */
        body {
            background-color: #f8fae5; /* Primary color */
            color: #43766c; /* Secondary color */
        }

        /* Provided CSS styles */
        .product-container {
            display: flex; /* Use flexbox */
            flex-wrap: wrap; /* Wrap items if they exceed the container */
            justify-content: space-between; /* Add space between items */
            padding: 20px; /* Add padding to the container */
        }

        .product-details {
            flex-basis: calc(33.33% - 20px); /* Set the width of each product */
            border: 1px solid #b19470; /* Third color */
            padding: 10px;
            margin-bottom: 20px;
            background-color: #fff; /* White background for each product */
            box-sizing: border-box; /* Include padding and border in the width */
        }

        .product-name {
            font-size: 1.2em;
            font-weight: bold;
        }

        .product-description {
            margin-top: 5px;
            color: #666;
        }

        .product-price {
            margin-top: 5px;
            font-weight: bold;
        }

        .product-stock {
            margin-top: 5px;
            color: #666;
        }

        .product-category {
            margin-top: 5px;
            color: #666;
        }

        .product-image {
            max-width: 100%;
            height: auto;
            max-height: 150px; /* Limit image height */
        }

        .product-links {
            margin-top: 10px;
        }

        .product-links button {
            background-color: #b19470; /* Button color */
            color: #fff; /* Button text color */
            border: none;
            border-radius: 5px; /* Rounded corners */
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product-links button:hover {
            background-color: #8a6d52; /* Button color on hover */
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <!-- Search Form -->
    <form action="{{ route('products.search') }}" method="GET">
    <input type="text" name ="query"type="search" placeholder="Search products...">
    <button type="submit">Search</button>

        @if(isset($searchTerm))
        <h3>Search Results for "{{ $searchTerm }}"</h3>
        @endif

        <div class="product-container">
            @foreach($products as $product)
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
            @endforeach
        </div>
    </form>
</body>
</html>
