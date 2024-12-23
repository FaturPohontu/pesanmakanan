<?php
if (!isset($_SESSION)) {
    session_start();
}

include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_barang = $_POST['id_barang'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $customer = $_SESSION['user_id'];
    $total = $harga * $jumlah;
    $tanggal = date('Y-m-d H:i:s');

    if ($conn) {
        $query = "INSERT INTO transaksi (barang, jumlah, total, tanggal, customer) 
                  VALUES ('$id_barang', '$jumlah', '$total', '$tanggal', $customer)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirect ke halaman riwayat setelah transaksi berhasil
            header("Location:../index.php?page=riwayat.php");
            exit;
        } else {
            echo "<div class='alert alert-danger text-center'>Gagal menyimpan transaksi: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Koneksi database gagal!</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>Akses tidak diizinkan!</div>";
}
