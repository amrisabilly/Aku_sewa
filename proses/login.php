<?php
    require 'koneksi.php';

    
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hasil = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' or password='$password'");
        $row = mysqli_fetch_assoc($hasil);
        if(mysqli_num_rows($hasil) > 0){
            if($row["tipe"] == "admin"){
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["password"] = $row["password"];
                header("Location: ../admin.php");    
            }
            else if($password == $row["password"]){
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["password"] = $row["password"];
                header("Location: ../dashboard.php");
            }
            else{
                echo "<script>alert('Wrong password'); window.location.href='../login.php';</script>";
            }
        }
        else{
            echo "<script>alert('User not registered'); window.location.href='../login.php';</script>";
        }
    }



?>