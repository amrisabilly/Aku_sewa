<?php
require 'koneksi.php';

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $tipe = $_POST["tipe"];

    // Periksa duplikasi username
    $duplicate = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username sudah ada'); </script>";
    } else {
        $query = "INSERT INTO tb_user (username, email, password, tipe) VALUES ('$username', '$email', '$password', '$tipe')";
        mysqli_query($koneksi, $query);
        echo "<script>alert('Buat akun sukses'); window.location.href='../signup.php';</script>";
    }
}
