<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Manajemen Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa; }
        .login-card { display: flex; width: 800px; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .login-form { padding: 40px; flex: 1; }
        .login-image { flex: 1; background: #198754; display: flex; align-items: center; justify-content: center; color: white; padding: 20px; text-align: center; }
        .btn-green { background-color: #198754; color: white; }
        .btn-green:hover { background-color: #157347; color: white; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-image">
        <div>
            <i class="fas fa-box-open" style="font-size: 80px;"></i>
            <h3>Sistem Manajemen Aset</h3>
            <p>Kelola inventaris barang Anda dengan mudah dan efisien.</p>
        </div>
    </div>

    <div class="login-form">
        <h3 class="mb-4 text-center">Login</h3>
        <form action="proses_login.php" method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-green w-100">Login</button>
        </form>
    </div>
</div>

</body>
</html>