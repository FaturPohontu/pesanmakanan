<?php 
    $conn = mysqli_connect("localhost", "root", "", "pesanmakanan");
    if($conn === false) {
        echo "Koneksi Gagal";
    }
?>