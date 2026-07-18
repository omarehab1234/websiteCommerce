<!-- product Index -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products | Cilantro Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel ='stylesheet' href="{{asset('css/product/index.css')}}">
</head>
<div class="d-flex justify-content-between align-items-center mb-4" >

        <h2 class="fw-bold">products</h2>

        <div>

            <a href="{{ route('admin') }}"
            class="btn btn-outline-dark me-2">
                ← Dashboard
            </a>
            <a href="{{ route('products.create') }}"
            class="btn btn-warning">
                + Add Product
            </a>

        </div>

    </div>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" >
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>quantity</th>
        <th>category name</th>
        <th>Actions</th>
    </tr>

    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}EGP</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->category->name }}</td>
            
            <td>
                <a href="{{ route('products.edit',$product) }}"
                        class="btn btn-sm btn-primary">
                        Edit
                </a>

                <form action="{{ route('products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>