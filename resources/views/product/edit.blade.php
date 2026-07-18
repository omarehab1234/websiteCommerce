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

<form action="{{ route('products.edit',$product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div>
        <label>Name</label><br>
        @if(old('name'))
            <input type="text" name="name" value="{{ old('name')  }}">
        @else
            <input type="text" name="name" value="{{ $product->name }}">
        @endif
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div>
        <label>Description</label><br>
        @if(old('description'))
            <textarea name="description">{{ old('description') }}</textarea>    
        @else
            <textarea name="description">{{ $product->description }}</textarea>
        @endif

        @error('description')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div>
        <label>Price</label><br>
        @if(old('price'))
            <input type="number" name="price" step="0.01" value="{{ old('price')  }}">
        @else
            <input type="number" name="price" step="0.01" value="{{ $product->price }}">
        @endif
        @error('price')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <div>
        <label>Quantity</label><br>
        @if(old('quantity'))
            <input type="number" name="quantity" min="0" value="{{ old('quantity')  }}">
        @else
            <input type="number" name="quantity" min="0" value="{{ $product->quantity }}">
        @endif
        
        @error('quantity')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <div>
        <label>Category</label><br>

        <select name="category_id">
            <option value="{{ $product->category->id }}" {{ old('category_id') == $product->category->id ? 'selected' : '' }}>
                {{$product->category->name}}</option>

            @foreach($categories as $category)
                @if($product->category->id != $category->id)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endif
            @endforeach
        </select>

        @error('category_id')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    <div>
        <label>Product Image</label><br>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" width="150" alt="Current Image">
        @endif

        <input type="file" name="image">
        @error('image')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <button type="submit">Edit Product</button>
</form>