<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cilantro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    

</head>
<body>

<div class="card login-card">

    <div class="card-body">

        <h2 class="text-center brand">Cilantro</h2>

        <p class="text-center text-muted mb-4">
            Welcome Back
        </p>

        <form action="{{ route('login') }}" method="POST" id = 'loginForm'>

            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    id = 'email'
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
                    type="password"
                    id = 'pass'
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password"
                    required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between mb-4">

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <a href="#">
                    Forgot Password?
                </a>

            </div>

            <button type ='submit' class="btn btn-login w-100 py-2">
                Login
            </button>

        </form>
        
        <hr class="border-secondary">

        <p class="text-center mb-0">
            Don't have an account?
            <a href="{{ route('register') }}"><strong>Create One</strong></a>
        </p>

    </div>

</div>

<script src = '{{asset ("js/auth/login.js")}}' ></script>
</body>
</html>