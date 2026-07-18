<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category | Cilantro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-dark text-warning text-center py-3">
                    <h3 class="mb-0">Add New Category</h3>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('categories.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Category Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="e.g. Coffee, Desserts, Cold Drinks">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('admin') }}"
                               class="btn btn-secondary">
                                Back
                            </a>

                            <button type="submit"
                                    class="btn btn-warning px-4">
                                Add Category
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>