<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = mysqli_query($conn,
    "SELECT * FROM users
    WHERE username='$username'
    AND password='$password'
    AND role='$role'");

    if(mysqli_num_rows($query) > 0){
        $_SESSION['user'] = $username;
        header("Location: ../index.php");
        exit;
    } else {
        echo "<script>alert('Login gagal');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

<div class="shape1"></div>
<div class="shape2"></div>

<div class="login-card">

    <div class="text-center mb-4">
    <img src="../assets/img/logo-univ.jpg"
         alt="Logo"
         class="login-logo">
        </div>

    <h1 class="text-center fw-bold mb-5">
        Login
    </h1>
    <form method="POST">

    <div class="input-wrapper mb-4">
        <i class="bi bi-person"></i>
        <input
            type="text"
            name="username"
            class="form-control"
            placeholder="Username"
            required>
    </div>

    <div class="input-wrapper mb-3">
        <i class="bi bi-lock"></i>
        <input
        type="password"
        name="password"
        class="form-control"
        placeholder="Password"
        required>
    </div>
    
    <div class="input-wrapper mb-4">
        <i class="bi-person-badge"></i>
    <select name="role" class="form-select ps-5" required>
        <option value="Admin">Admin</option>
        <option value="User">User</option>
    </select>
    </div>

    <div class="input-wrapper mb-4">


    </div>

    <button
        type="submit"
        name="login"
        class="btn btn-login text-white w-100">
        Login
    </button>
    </form>

    <div class="text-center mt-4">
    <p class="mb-0">
        Belum punya akun?
        <a href="register.php" class="register-link">
            Register
        </a>
    </p>
    </div>

</div>
</body>
</html>