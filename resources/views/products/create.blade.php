<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Product Description:</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" name="image" class="form-control-file">
        <small class="form-text text-muted">Upload a JPEG, PNG, JPG, or GIF file (max: 2048 KB).</small>
    </div>
    <div class="form-group">
        <label for="price">Product Price ($):</label>
        <input type="number" step="0.01" name="price" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock Quantity:</label>
        <input type="number" name="stock" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="category">Product Category:</label>
        <input type="text" name="category" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Product</button>
</form>