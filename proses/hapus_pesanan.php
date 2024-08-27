<?php
    include "koneksi.php";
    $id= $_GET['id'];
    $query = mysqli_query($koneksi,"DELETE FROM pesanan WHERE id = $id");
    if($query)
    {
        echo "<script>alert('Hapus Berhasil'); window.location.href='../admin.php#pemesanan';</script>";
    }
    else {
        echo "<script>alert('Hapus Gagal'); window.location.href='../admin.php#pemesanan';</script>";

    }
?>