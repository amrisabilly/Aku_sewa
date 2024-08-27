<?php declare(strict_types=1); 
session_start();
if(empty($_SESSION["username"])){
    header("Location: login.php");
}

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
                <li><a href="#about">About</a></li>
                <li><a href="#dokumentasi">Documentation</a></li>
                <li><a href="#produk">Produk</a></li>
            </ul>
            <a href="logout.php" id="shopping-cart-button"><i data-feather="log-out" class="shopping"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Halaman 1 -->
    <div class="hal1" id="home">
        <div class="text">
            <h1>Welcom to<br>Aku Sewa</h1>
            <h5>Website persewaan barang adalah platform inovatif <br>
             yang dirancang untuk memudahkan proses penyewaan <br> berbagai jenis barang, mulai dari peralatan rumah tangga, <br> alat elektronik, kendaraan, hingga perlengkapan acara. </h5>
        </div>
        <img class="mic" src="asset/mic.png" alt="">
        <img class="camera" src="asset/camera.png" alt="">
        <a href="#produk"><button>Product</button></a>
    </div>
    <!-- Halaman 1 End -->

    <!-- Halaman 2 -->
    <div class="about" id="about">
        <div class="title">
            <h2>Tentang Kami</h2>
        </div>
        <div class="container-fluid">
            <div class="row baris">
                <div class="col-4 kolom">
                    <div class="kot shadow">
                        <div class="ket">
                            <h5>Layanan 24/7</h5>
                        </div>
                        <div class="log">
                            <i data-feather="clock"></i>
                        </div> 
                        <p class="text-center mt-4 p-3">Kami adalah penyedia layanan persewaan barang terpercaya yang berkomitmen untuk memenuhi kebutuhan Anda kapan saja</p>                   
                    </div>
                </div>
                <div class="col-4 kolom">
                    <div class="kot shadow">
                        <div class="ket">
                            <h5>Jaminan Kepuasan</h5>
                        </div>
                        <div class="log">
                            <i data-feather="package"></i>
                        </div> 
                        <p class="text-center mt-4 p-3">Kami menjamin kepuasan Anda dengan layanan persewaan barang terbaik. Kepuasan pelanggan adalah prioritas utama kami.</p>                   
                    </div>
                </div>
                <div class="col-4 kolom">
                    <div class="kot shadow">
                        <div class="ket">
                            <h5>Gratis Ongkos Kirim</h5>
                        </div>
                        <div class="log">
                            <i data-feather="truck"></i>
                        </div> 
                        <p class="text-center mt-4 p-3">Sewa barang pilihan Anda sekarang dan dapatkan layanan gratis ongkos kirim ke seluruh Indonesia.</p>                   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Halaman 2 End -->


    <!-- Halaman 3 -->
    <div class="card text-center" style="margin-top: 7em;" id="dokumentasi">
        <div class="card-header">
            Documentation
        </div>
    <div class="card-body bdy" style="height: 18em;">
        <h5 class="card-title" style="margin-top: 5em;">Aku Sewa</h5>
            <p class="card-text">Misi kami adalah mempermudah akses masyarakat terhadap barang-barang yang diperlukan tanpa harus membeli. Dengan sistem sewa yang fleksibel, Anda dapat menghemat biaya dan ruang penyimpanan,</p>
            <a href="#produk"><button class="explore">Product</button></a>
    </div>
    <div class="card-footer text-muted">
        2 days ago
    </div>
    </div>
    <!-- Halaman 3 End -->

    <!-- Halaman 4 -->
    <div class="container-fluid" style="margin-top: 6em;" id="produk">
    <div class="title">
        <h2>Produk Sewa Pilihan</h2>
    </div>
    <div class="container" style="margin-top: 3em;">
        <form class="d-flex justify-content-center" role="search" method="GET" action="">
            <input class="cari" type="search" name="search" placeholder="Search Product" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="cari-tombol" type="submit"><i data-feather="search" style="color: #004577;"></i></button>
        </form>
    </div>
    <div class="row" style="margin-top: 3em;">
        <!-- Perulangan Card -->
        <?php
        require "proses/koneksi.php";
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        if ($search) {
            $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk LIKE '%$search%'");
        } else {
            $query = mysqli_query($koneksi, "SELECT * FROM produk");
        }

        while ($data = mysqli_fetch_array($query)) { ?>
            <div class="col-3 d-flex justify-content-center mb-5">
                <div class="card shadow" style="width: 18rem;">
                    <img src="asset/<?php echo $data['foto']; ?>" class="card-img-top" alt="..." style="height: 12em">
                    <div class="card-body" style="background-color: #F5F5F5;">
                        <p class="card-title text-muted"><?php echo $data['jenis']; ?></p>
                        <h5 class="card-title"><?php echo $data['nama_produk']; ?></h5>
                        <h5 class="card-title" style="color: #004577;">Rp. <?php echo $data['harga']; ?><span class="text-muted">/hari</span></h5>
                        <div class="harga mt-4 d-flex">
                            <p class="d-flex" style="gap: 0.5em"><i data-feather="map-pin" class="shopping"></i>Jakarta</p>
                            <a href="detailproduk.php?id=<?= $data['id_produk'] ?>"><button class="booking">Booking</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

    <footer style="background-color: #004577;padding-bottom: 1em">
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
            <a href="#dokumentasi" class="footer-hover">Dokumentasi</a>
        </p>
        <p>
            <a href="#produk" class="footer-hover">Produk</a>
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
            <a href="#" style="text-decoration: none;color: #C7C8CC">Genset</a>
        </p>
        <p>
            <a href="#" style="text-decoration: none;color: #C7C8CC">Lighting</a>
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


    <script>
      feather.replace();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>