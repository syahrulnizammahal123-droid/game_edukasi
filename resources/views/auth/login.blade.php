<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #1e3c72, #2a5298);">

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 400px; border-radius: 15px;">

        <h3 class="text-center mb-4 text-primary">Welcome Back</h3>

        <form method="POST" action="/login">
            @csrf

            <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>

            <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

            <button class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center mt-3">
            Belum punya akun?
            <a href="/register" class="text-primary fw-bold">Register</a>
        </p>

    </div>
</div>

</body>
</html>