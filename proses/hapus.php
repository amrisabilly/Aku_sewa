<?php
    include "koneksi.php";
    $id_produk = $_GET['id_produk'];
    $query = mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk = $id_produk");
    if($query)
    {
        echo "<script>alert('Hapus Berhasil'); window.location.href='../admin.php#produk';</script>";
    }
    else {
        echo "<script>alert('Hapus Gagal'); window.location.href='../admin.php';</script>";

    }
?>