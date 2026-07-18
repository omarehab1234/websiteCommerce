<!-- category Index -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories | Cilantro Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel ='stylesheet' href="{{asset('css/product/index.css')}}">
</head>
<div class="d-flex justify-content-between align-items-center mb-4" >

        <h2 class="fw-bold">categories</h2>

        <div>

            <a href="{{ route('admin') }}"
            class="btn btn-outline-dark me-2">
                ← Dashboard
            </a>
            <a href="{{ route('categories.create') }}"
            class="btn btn-warning">
                + Add category
            </a>

        </div>

    </div>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color:red">
        {{ session('error') }}
    </p>
@endif
<table border="1" cellpadding="10" >
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>

    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            
            <td>
                <a href="{{ route('categories.edit',$category) }}"
                        class="btn btn-sm btn-primary">
                        Edit
                </a>

                <form action="{{ route('categories.destroy', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>