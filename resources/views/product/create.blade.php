<!-- product create -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products | Cilantro Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel ='stylesheet' href="{{asset('css/product/create.css')}}">
</head>
<h1>Add Product</h1>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}">

        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div>
        <label>Description</label><br>
        <textarea name="description">{{ old('description') }}</textarea>

        @error('description')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div>
        <label>Price</label><br>
        <input type="number" name="price" step="0.01" value="{{ old('price') }}">

        @error('price')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <div>
        <label>Quantity</label><br>
        <input type="number" name="quantity" min="0" value="{{ old('quantity') }}">

        @error('quantity')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <div>
        <label>Category</label><br>

        <select name="category_id">
            <option value="">Choose Category</option>

            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('category_id')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <div>
        <label>Product Image</label><br>
        <input type="file" name="image">

        @error('image')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <button type="submit">Add Product</button>
</form>