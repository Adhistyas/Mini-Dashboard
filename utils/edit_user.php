<?php

include '../config/koneksi.php';

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$status = $_POST['status'];

if(!empty($password)){

mysqli_query(
$conn,
"UPDATE users SET
username='$username',
password='$password',
role='$role',
status='$status'
WHERE id='$id'"
);

}else{

mysqli_query(
$conn,
"UPDATE users SET
username='$username',
role='$role',
status='$status'
WHERE id='$id'"
);

}

header("Location: ../index.php");