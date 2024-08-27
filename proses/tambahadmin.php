<?php
    include "koneksi.php";

    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $jenis = $_POST['jenis'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_POST['foto'];

    $query = mysqli_query($koneksi,"INSERT INTO produk VALUES ('','$nama_produk','$harga','$foto','$jenis','$lokasi','$deskripsi')");

    if($query){
        echo "<script>alert('input berhasil'); window.location.href='../admin.php#produk';</script>";
    }
    else{
        echo "<script>alert('input gagal'); window.location.href='../tambahadmin.php';</script>";
    }

?>