<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Cilantro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold text-warning" href="#">
        Cilantro Admin
    </a>

    <div class="text-white">
        Welcome,
        <strong>{{ Auth::user()->name }}</strong>
    </div>
</nav>

<div class="container py-5">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row g-4">
        
    <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Total Users</h5>
                    <h2>{{ $users }}</h2>

                    <a href="{{ route('users.index') }}"
                       class="btn btn-warning mt-3">
                        View Users
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Total Products</h5>
                    <h2>{{ $products }}</h2>

                    <a href="{{ route('products.index') }}"
                       class="btn btn-warning mt-3">
                        View Products
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Categories</h5>
                    <h2>{{ $categories }}</h2>

                    <a href="{{ route('categories.index') }}"
                       class="btn btn-warning mt-3">
                        View Categories
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Orders</h5>
                    <h2>{{$orders}}</h2>

                    <a href="#"
                       class="btn btn-warning mt-3">
                        View Orders
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-5">

        <h4 class="mb-3">
            Quick Actions
        </h4>

        <div class="d-flex gap-3">

            <a href="{{ route('products.create') }}"
               class="btn btn-success">
                + Add Product
            </a>

            <a href="{{ route('categories.create') }}"
               class="btn btn-primary">
                + Add Category
            </a>

        </div>

    </div>

</div>

</body>
</html>