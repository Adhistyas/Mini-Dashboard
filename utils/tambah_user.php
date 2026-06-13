<?php

include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$status = $_POST['status'];

mysqli_query(
$conn,
"INSERT INTO users(username,password,role,status)
VALUES(
'$username',
'$password',
'$role',
'$status'
)"
);

header("Location: ../index.php");