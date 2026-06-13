<?php
include '../config/koneksi.php';

// if(isset($_POST['register'])){

//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $role     = $_POST['role'];

//     mysqli_query(
//         $conn,
//         "INSERT INTO users(username,password,role,status)
//         VALUES('$username','$password','$role','Aktif')"
//     );

//     echo "
//     <script>
//         alert('Registrasi berhasil!');
//         window.location='login.php';
//     </script>
//     ";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/register.css">
</head>

<body>
<div class="shape1"></div>
<div class="shape2"></div>

<!-- <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="registerToast" class="toast align-items-center text-bg-warning border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        Mohon maaf, untuk saat ini register belum dibuka
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto"
              data-bs-dismiss="toast"></button>
    </div>
  </div> -->

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="registerToast"
       class="toast"
       role="alert"
       aria-live="assertive"
       aria-atomic="true">
    <div class="toast-header">
      <img src="../assets/img/logo-univ.jpg"
           class="rounded me-2"
           style="width:25px; height:25px;"
           alt="logo">
      <strong class="me-auto">Bagas Aditiya</strong>
      <small class="text-muted">now</small>
      <button type="button"
              class="btn-close"
              data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body">
      Mohon maaf, untuk saat ini register belum dibuka!
    </div>
  </div>
</div>

<div class="register-card">
    <div class="text-center mb-4">
        <img src="../assets/img/logo-univ.jpg"
             class="regist-logo mb-3">
        <h2 class="register-title">
            Create New Account
        </h2><p class="register-subtitle">
            Register to access the Dashboard</p>
    </div>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input
                type="text"
                name="username"
                class="form-control"
                placeholder="Enter username"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select
                name="role"
                class="form-select">
                <option>User</option>
                <option>Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Enter password"
                required>
        </div>

        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <input
                type="password"
                class="form-control"
                placeholder="Re-enter password"
                required>
        </div>

        <button
            type="button"
            class="btn btn-register text-white w-100 btn-lg"
            id="btnRegister" >
            <i class="bi bi-person-plus me-2"></i>
            Register
        </button>
    </form>

    <div class="text-center mt-4">
        Sudah punya akun?
        <a href="login.php" class="login-link">
            Login
        </a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("btnRegister").addEventListener("click", function () {

    const toastEl = document.getElementById("registerToast");
    const toast = new bootstrap.Toast(toastEl);
    toast.show();

});
</script>
</body>
</html>