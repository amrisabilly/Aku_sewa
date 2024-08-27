<?php
    include "koneksi.php";

    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nama_produk = $_POST['nama_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $durasi = $_POST['durasi'];
    $total = $_POST['total'];

    // Menggunakan prepared statements untuk keamanan
    $stmt = $koneksi->prepare("INSERT INTO pesanan (nama, email, nama_produk, jumlah, harga, tanggal_sewa, tanggal_pengembalian, durasi, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiissss", $nama, $email, $nama_produk, $jumlah, $harga, $tanggal_sewa, $tanggal_pengembalian, $durasi, $total);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Pemesanan Berhasil! Cek Email anda untuk info lebih lanjut.');window.location.href='../dashboard.php'</script>";
    } else {
        echo "<script>alert('Pemesanan Gagal!');window.location.href='../dashboard.php'</script>";
    }

    // Tutup statement
    $stmt->close();

    // Tutup koneksi
    $koneksi->close();
?>
