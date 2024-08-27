<?php 
    declare(strict_types=1);
    session_start();
    if(empty($_SESSION["username"])){
        header("Location: login.php");
    }

    include "proses/koneksi.php";

    $id = $_GET['id'];
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
            <a href="dashboard.php#produk"><i data-feather="arrow-left" class="shopping"></i></a>
        </div>

    <!-- Content -->
     <div class="container-fluid p-5">
        <div class="row w-100">
            <div class="col-5 p-5">
                <div class="container-fluid" style="background-color: #e0e0e085;display:flex;justify-content:center;align-items:center;border-radius:14px;">
                    <img src="asset/<?= $data['foto'] ?>" alt="" width="70%" style="mix-blend-mode:multiply">
                </div>
            </div>
            <div class="col-7 p-5">
                <div class="container-fluid p-3" style="background-color: #e0e0e085;border-radius:14px;">
                    <h4><?= $data['nama_produk'] ?></h4>
                    <hr>
                    <div class="d-flex" style="justify-content: space-between; margin-bottom:-1em;">
                        <p>Kategori: <?= $data['jenis'] ?></p>
                        <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <?= $data['lokasi'] ?>
                        </p>
                    </div>
                    <hr>
                    <h5>Rp. <?= $data['harga'] ?><span style="font-size:12px;opacity:70%"> /Hari</span></h5><br>
                    <p><?= $data['deskripsi'] ?></p><br>
                    <div style="display: flex; justify-content:space-between;margin-bottom:-1em">
                        <h6>Jumlah/Kuantitas:</h6>
                        <h6 id="jumlah">0</h6>
                    </div>
                    <hr>
                    <div style="display: flex; justify-content:space-between;margin-bottom:-1em">
                        <h5>Subtotal:</h5   >
                        <h5 id="subtotal">0</h5>
                    </div>
                    <hr>
                    <div class="d-flex gap-4">

                        <div class="counter" >
                            <button class="minus" id="decrease">
                                -
                            </button>
                            <div class="quantity" id="counter">
                                0
                            </div>
                            <button class="plus" id="increase">
                                +
                            </button>
                        </div>
                        
                        <button class="pesan" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>    
                            Pesan Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
     </div>

     
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="order.php" method="POST">
                    <input type="hidden" name="id" value="<?= $data['id_produk'] ?>">
                    <input type="hidden" name="subtotal" id="hargasubtotal">
                    <input type="hidden" name="jumlah" id="jumlahBarang">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
            <div class="modal-body">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input required type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nama</label>
                <input required type="text" class="form-control" id="exampleInputPassword1" name="nama">
            </div>

            <div class="mb-3">
                Tanggal Sewa : <input required type="date" style="border:1px solid black; padding:0.2em; border-radius:5px" name="start_date">
            </div>

            <div class="mb-3">
                Tanggal Pengembalian : <input required type="date" style="border:1px solid black; padding:0.2em; border-radius:5px" name="end_date">
            </div>
            
            <div class="mb-3 form-check">
                <input required type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Saya menyetujui Syarat & Ketentuan</label>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>

            </div>

            
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
    // script.js
    document.addEventListener('DOMContentLoaded', () => {
        const harga = <?php echo $data['harga']; ?>;
        const counterElement = document.getElementById('counter');
        const Jumlah = document.getElementById('jumlah');
        const subtotall = document.getElementById('subtotal');
        let count = 0;
        let subtotal = 0;


        // Jumlah Barang
        document.getElementById('increase').addEventListener('click', () => {
            count++;
            subtotal = count * harga;
            updateCounter();
        });

        document.getElementById('decrease').addEventListener('click', () => {
            count--;
            if (count < 0){
                alert('Jumlah tidak bisa dibawah 0!');
            }else{
                subtotal = count * harga;
                updateCounter();
            }
        });

        function updateCounter() {
            document.getElementById('hargasubtotal').value = subtotal;
            document.getElementById('jumlahBarang').value = count;
            counterElement.textContent = count;
            jumlah.textContent = count;
            subtotall.textContent = subtotal;
        }
    });
    </script>

    <script>
      feather.replace();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>