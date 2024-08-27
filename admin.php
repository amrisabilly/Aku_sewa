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
    <link rel="stylesheet" href="css/admin.css">
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
            <ul class="menu-items " style="margin-left: 24em">
                <li><a href="#home">Home</a></li>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#pemesanan">Pemesan</a></li>
            </ul>
            <a href="logout.php" id="shopping-cart-button"><i data-feather="log-out" class="shopping"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Halaman 1 -->
    <div class="hal1" id="home">
        <div class="text">
            <h1>Welcom  <?= $_SESSION["username"]; ?></h1>
            <h5>Selamat datang di Aku Sewa, <br>
             solusi terbaik untuk persewaan peralatan konser Anda! <br>
            Kami menyediakan berbagai macam peralatan berkualitas tinggi,<br>
            mulai dari sound system, panggung, lighting, hingga perlengkapan audiovisual lainnya.</h5>
        </div>
        <img class="mic" src="asset/mic.png" alt="">
        <img class="camera" src="asset/camera.png" alt="">
        <a href="#produk"><button>Product</button></a>
    </div>
    <!-- Halaman 1 End -->

    <!-- Halaman 4 -->
    <div class="container-fluid" style="margin-top: 6em;" id="produk">
    <div class="title">
        <h2>Produk Sewa Pilihan</h2>
    </div>
    <div class="container" style="margin-top: 3em;">
        <form class="d-flex justify-content-center" role="search" method="GET" action="#produk">
            <input class="cari" type="search" name="search" placeholder="Search Product" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="cari-tombol" type="submit"><i data-feather="search" style="color: #004577;"></i></button>
        </form>
    </div>
    <div class="row" style="margin-top: 3em;">
        <!-- Perulangan Card -->
        <?php
        require "proses/koneksi.php";

        // Get the search term from the GET request
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Modify the query to filter results based on the search term
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
                        <div class="harga mt-4 d-flex">
                            <a href="edit.php?id_produk=<?php echo $data['id_produk'];?>"><button class="booking"><i data-feather="edit"></i></button></a>
                            <a href="proses/hapus.php?id_produk=<?php echo $data['id_produk'];?>"><button class="booking"><i data-feather="trash-2"></i></button></a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-3 d-flex justify-content-center mb-5">
                <div class="card shadow" style="width: 18rem;">
                    <div class="card-body" style="background-color: #F5F5F5;display:flex;align-items:center;justify-content: center;">
                   <a href="tambahadmin.php"><button><i data-feather="plus" style="color: #004577;width: 70px; height: 70px;"></i></button></a> 
                    </div>
                </div>
            </div>
    </div>
</div>


<div class="container-fluid" style="margin-top: 6em;" id="pemesanan">
    <div class="title">
        <h2>Pemesan</h2>
    </div>
    <table class="table" style="margin-top: 4em;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Jumalah</th>
      <th scope="col">Harga</th>
      <th scope="col">Tanggal Sewa</th>
      <th scope="col">Tanggal pengembalian</th>
      <th scope="col">Durasi</th>
      <th scope="col">Total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    include "proses/koneksi.php";
    $no = 1;
    $query = mysqli_query($koneksi,"SELECT * FROM pesanan");
    while($data = mysqli_fetch_array($query))
    {?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td><?php echo $data['nama']; ?></td>
      <td><?php echo $data['email']; ?></td>
      <td><?php echo $data['nama_produk']; ?></td>
      <td><?php echo $data['jumlah']; ?></td>
      <td><?php echo $data['harga']; ?></td>
      <td><?php echo $data['tanggal_sewa']; ?></td>
      <td><?php echo $data['tanggal_pengembalian']; ?></td>
      <td><?php echo $data['durasi']; ?></td>
      <td><?php echo $data['total']; ?></td>
      <td><a href="proses/hapus_pesanan.php?id=<?php echo $data['id'];?>"><i data-feather="trash-2" style="color: #004577;"></i></a></td>    
    </tr>
    <?php
    $no++;}
    ?>
  </tbody>
</table>
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
            <a href="#produk" class="footer-hover">Produk</a>
        </p>
        <p>
            <a href="#pemesanan" class="footer-hover">Pemesan</a>
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
            <a href="#" style="text-decoration: none;color: #C7C8CC">Lighting</a>
        </p>
        <p>
            <a href="#" style="text-decoration: none;color: #C7C8CC">Genset</a>
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