<?php
    require "koneksi.php";

    $id_produk = $_POST['id_produk'];
    $foto = $_POST['foto'];
    $nama_produk = $_POST['nama_produk'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $lokasi = $_POST['lokasi'];

    $query = mysqli_query($koneksi,"UPDATE produk SET nama_produk='$nama_produk', harga='$harga', foto='$foto', jenis='$jenis', lokasi='$lokasi' WHERE id_produk ='$id_produk'");

    if($query){
        echo "<script>alert('Update berhasil'); window.location.href='../admin.php#produk';</script>";
    }
    else{
        echo "<script>alert('Update gagal'); window.location.href='../edit.php';</script>";

    }

?>