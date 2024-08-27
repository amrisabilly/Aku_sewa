<?php
session_start();
if(empty($_SESSION["username"])){
    header("Location: login.php");
}

$id = $_POST['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $subtotal = $_POST['subtotal'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jumlah = $_POST['jumlah'];

    // Validasi input tanggal
    if (strtotime($startDate) && strtotime($endDate)) {
        // Konversi string tanggal ke objek DateTime
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        if($startDate>$endDate){
            echo "<script>alert('Tanggal Tidak Valid');window.location.href='../detailproduk.php?id=$id'</script>";
        }

        if($subtotal<=0){
            echo "<script>alert('Jumlah Barang Tidak Valid!');window.location.href='../detailproduk.php?id=$id'</script>";
        }

        // Hitung selisih hari
        $difference = $start->diff($end);

        // Tampilkan hasil
        $sewa = $start->format('Y-m-d');
        $kembali = $end->format('Y-m-d');
        $selisih = $difference->days;
        $totalharga = $selisih * $subtotal;
    } else {
        echo "Invalid date input.";
    }
} else {
    echo "Invalid request method.";
}

    include "proses/koneksi.php";

    $query = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk = '$id'");
    $data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Page</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .counter{
            display: flex;
            align-items: center;
            height: 3em;
            background-color: white;
            width: 7em;
            border: 1px solid #004577;
            border-radius: 0.3em;
        }   
        .counter .minus,
        .counter .plus,
        .counter .quantity{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            border-radius: 0.4em;
            background-color: white;
        }
        .pesan{
            gap: 1em;
            border-radius: 0.3em;
            color: white;
            background-color: #004577;
            padding: 1em;
            height: 3em;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>


<body>
    <!-- Navbar Start -->
    <nav class="navbar" style="position: fixed;">
        <div class="navbar-container">
            <div class="logo">
                <h2>Aku<span>Sewa.</span></h2>
            </div>
            <ul class="menu-items">
                <li><a href="#home">Home</a></li>
                <li><a href="#sellers">About</a></li>
                <li><a href="#news">Documentation</a></li>
                <li><a href="#contact">Produk</a></li>
            </ul>
        </div>

    <!-- Content -->
    <div class="container-fluid border border-3" style="display: flex; align-items:center;justify-content:center">
        <div class="border border-3 p-5" style="background-color:#e0e0e085; margin-top:0.5em; margin-bottom:5em; width:50%; display:flex; justify-content:center;flex-direction:column">    
            <form action="proses/simpanorder.php" method="POST">
                
            <center>
                <h2>Konfirmasi Pemesanan</h2><hr>
            </center>
            <div class="row d-flex align-items-center">
                <div class="col-5">
                    <h5>Nama Barang</h5>
                </div>
                <div class="col-4 text-center">
                    <h5>Harga</h5>
                </div>
                <div class="col-3 text-end">
                    <h5>Jumlah</h5>
                </div>
            </div>
            <hr>
            <div class="row d-flex align-items-center">
                <div class="col-5">
                    <?= $data['nama_produk'] ?>
                    <input type="hidden" value="<?=$data['nama_produk']?>" name="nama_produk">
                </div>
                <div class="col-4 text-center">
                    Rp.<?= $data['harga'] ?>
                    <input type="hidden" value="<?=$data['harga']?>" name="harga">
                </div>
                <div class="col-3 text-end">
                    <?= $jumlah ?>
                    <input type="hidden" value="<?=$jumlah?>" name="jumlah">
                </div>
            </div>
            <hr>
            <div class="row d-flex align-items-center mt-5">
                <div class="col-6">
                    <h6>Tanggal Pemesanan</h6>
                </div>
                <div class="col-6 text-start">
                    <?= $sewa ?>
                    <input type="hidden" value="<?=$sewa?>" name="tanggal_sewa">
                </div>
            </div>
            <hr>
            
            <div class="row d-flex align-items-center">
                <div class="col-6">
                    <h6>Tanggal Pengembalian</h6>
                </div>
                <div class="col-6 text-start">
                    <?= $kembali ?>
                    <input type="hidden" value="<?=$kembali?>" name="tanggal_pengembalian">
                </div>
            </div>
            <hr>
            <div class="row d-flex align-items-center">
                <div class="col-6">
                    <h6>Durasi Peminjaman</h6>
                </div>
                <div class="col-6 text-start">
                    <p><?= $selisih ?>  Hari</p>
                    <input type="hidden" value="<?=$selisih?>" name="durasi">
                </div>
            </div>
            <hr>
            
            <div class="row d-flex align-items-center">
                <div class="col-6">
                   <h3>Total Harga</h3>
                </div>
                <div class="col-6 text-end">
                    <h5>Rp.<?= $totalharga ?></h5>
                    <input type="hidden" value="<?=$totalharga?>" name="total">
                </div>
            </div>
            <hr>
            
            <h>Nama Pemesan = <?= $nama ?></h>
            <input type="hidden" value="<?=$nama?>" name="nama">

            <p>Email Pemesan = <?= $email ?></p>
            <input type="hidden" value="<?=$email?>" name="email">
              

               
              
               

                
              

               

                <input type="submit" class="btn btn-primary">
            </form>
        </div>    
    </div>


    <!-- Footer Start -->
 <footer style="background-color: #004577;padding-bottom: 1em; width:100%;">
    <div class="container" style="margin-top: 7em;color: #C7C8CC;">
    <div class="row d-flex justify-content-center text-center">
        <div class="col-3">
            <div style="margin-top: 7em;">
                <p>Sewa<span style="color: #C7C8CC;">Produk</span><br></p>
            </div>
        </div>
        <div class="col-3 mt-4 foter">
            <h2>Link</h2>
            <p class="mt-5">
                <a href="#home" class="footer-hover">Home</a>
            </p>
            <p>
                <a href="#about" class="footer-hover">About</a>
            </p>
            <p>
                <a href="#galeri" class="footer-hover">Dokumentasi</a>
            </p>
            <p>
                <a href="#tour" class="footer-hover">Produk</a>
            </p>
        </div>
        <div class="col-3 mt-4">
        <h2>Popular Produk</h2>
            <p class="mt-5">
                <a href="#" style="text-decoration: none;color: #C7C8CC">Camera</a>
            </p>
            <p>
                <a href="#" style="text-decoration: none;color: #C7C8CC">Microphone</a>
            </p>
            <p>
                <a href="#" style="text-decoration: none;color: #C7C8CC">Camera</a>
            </p>
            <p>
                <a href="#" style="text-decoration: none;color: #C7C8CC">Microphone</a>
            </p>
        </div>
        <div class="col-3 mt-4">
            <h2>Alamat</h2>
            <div class="mt-5">
                +1 (300) 1234 6543<br>
            Indonesia.Com<br>
            Jakarta 336/A<br>
            </div>
        </div>
    </div>
    </div>
</footer>



    <!-- My Javascript -->
    <script src="main.js"></script>

    <script>
      feather.replace();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
