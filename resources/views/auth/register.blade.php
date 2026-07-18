<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Cilantro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<div class="card register-card">

    <div class="card-body">

        <h2 class="text-center brand">Cilantro</h2>

        <p class="text-center text-muted mb-4">
            Create your account
        </p>

        <form action="{{ route('register') }}" method="POST" id="formReg" >

            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input
                    id = "name"
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Enter your full name"
                    required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    id = 'email'
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter your email"
                    required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    id = 'pass'
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Create a password"
                    required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input
                    id = 'passC'
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Confirm your password"
                    required>
            </div>

            <button type ="submit" class="btn btn-register w-100 py-2">
                Create Account
            </button>
            
        </form>

        <hr class="border-secondary">

        <p class="text-center mb-0">
            Already have an account?
            <a href="{{ route('login') }}">
                <strong>Login</strong>
            </a>
        </p>

    </div>

</div>

<script src="{{ asset('js/auth/register.js') }}"></script>

</body>
</html>