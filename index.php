<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['user'])){
    header("Location: auth/login.php");
    exit;
}

$userLogin = $_SESSION['user'];

$totalUser = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM users")
)['total'];

$totalAdmin = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM users WHERE role='Admin'")
)['total'];

$totalAktif = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM users WHERE status='Aktif'")
)['total'];

$totalNonaktif = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM users WHERE status='Nonaktif'")
)['total'];

$dataUser = mysqli_query($conn,"SELECT * FROM users");
?>

<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>

<div class="wrapper">
<div class="sidebar">
    <div class="logo-section">
    <img
    src="assets/img/logo-univ.jpg"
    alt="Logo"
    class="sidebar-logo">
    <h4>Users Control</h4>
    <small>Control Panel</small>
    </div>
    <hr>
    <ul class="menu">
        <li class="active">
            <a href="#">
                <i class="bi bi-grid"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-people"></i>
                Manajemen User
            </a>
        </li>
        <li>
            <a href="#"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
                <i class="bi bi-person-plus"></i>
                Tambah User
            </a>
        </li>
        <li>
            <a href="logout.php" class="badge text-bg-danger">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </li>
    </ul>
</div>

<div class="content">
    <div class="topbar">
        <h4>Dashboard</h4>
        <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah">
            <i class="bi bi-person-plus"></i>
            Tambah User
        </button>
    </div>
    <div class="welcome-card">
        <small id="liveClock"></small>
        <h2>
            Selamat Datang,
            <span><?= $userLogin ?></span>!
        </h2>
        <p>
            Kelola seluruh pengguna dari dashboard ini.
        </p>
    </div>
    <div class="row g-3 mt-3">

        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-people-fill"></i>
                <h2><?= $totalUser ?></h2>
                <p>Total User</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-shield-check"></i>
                <h2><?= $totalAdmin ?></h2>
                <p>Admin</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-check-circle-fill"></i>
                <h2><?= $totalAktif ?></h2>
                <p>Aktif</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <i class="bi bi-x-circle-fill"></i>
                <h2><?= $totalNonaktif ?></h2>
                <p>Nonaktif</p>
            </div>
        </div>
    </div>

    <div class="table-card mt-4">
        <h5 class="mb-3">
            Manajemen Pengguna
        </h5>
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Diperbarui</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($dataUser)){ ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td>
                        <span class="badge bg-primary">
                            <?= $row['role'] ?>
                        </span>
                    </td>
                    <td>
                    <?php if($row['status']=="Aktif"){ ?>
                    <span class="badge bg-success">Aktif</span>
                    <?php } else { ?><span class="badge bg-danger">Nonaktif</span>
                    <?php } ?></td>
                    <td>
                        <?= $row['created_at']
                        ? date('d/m/Y H:i', strtotime($row['created_at']))
                        : '-' ?>
                    </td>
                    <td>
                        <?= $row['updated_at']
                        ? date('d/m/Y H:i', strtotime($row['updated_at']))
                        : '-' ?>
                    </td>
                    <td>
                        <button
                        class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#edit<?= $row['id'] ?>">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <a
                        href="utils/hapus_user.php?id=<?= $row['id'] ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>

                <div class="modal fade"
                id="edit<?= $row['id'] ?>"
                tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Edit User
                                </h5>
                                <button
                                type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="utils/edit_user.php" method="POST">
                                <input
                                type="hidden"
                                name="id"
                                value="<?= $row['id'] ?>">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Username</label>
                                        <input
                                        type="text"
                                        name="username"
                                        class="form-control"
                                        value="<?= $row['username'] ?>"
                                        required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Password Baru</label>
                                        <input
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Kosongkan jika tidak diubah">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Role</label>
                                            <select
                                            name="role"
                                            class="form-select">
                                                <option
                                                <?= $row['role']=="Admin" ? "selected" : "" ?>>
                                                Admin
                                                </option>
                                                <option
                                                <?= $row['role']=="User" ? "selected" : "" ?>>
                                                User
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Status</label>
                                            <select
                                            name="status"
                                            class="form-select">
                                                <option
                                                <?= $row['status']=="Aktif" ? "selected" : "" ?>>
                                                Aktif
                                                </option>
                                                <option
                                                <?= $row['status']=="Nonaktif" ? "selected" : "" ?>>
                                                Nonaktif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                    Batal
                                    </button>
                                    <button
                                    type="submit"
                                    class="btn btn-warning">
                                    Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Tambah User Baru
            </h5>
            <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal">
            </button>
        </div>

        <form action="utils/tambah_user.php" method="POST">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Username</label>
                    <input
                    type="text"
                    name="username"
                    class="form-control"
                    required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Role</label>
                        <select
                        name="role"
                        class="form-select">
                            <option>User</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select
                        name="status"
                        class="form-select">
                            <option>Aktif</option>
                            <option>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
                Batal
                </button>
                <button
                type="submit"
                class="btn btn-primary">
                Simpan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function updateClock() {

    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };

    const tanggal = now.toLocaleDateString('id-ID', options);

    const jam = now.toLocaleTimeString('id-ID');

    document.getElementById('liveClock').innerHTML =
        tanggal + ' | ' + jam;
}

updateClock();
setInterval(updateClock, 1000);
</script>
</body>
</html>
