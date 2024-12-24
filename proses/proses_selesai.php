<?php
// proses_terima_pesanan.php

// Include your database connection file
require 'koneksi.php';

// Check if the 'id' parameter is provided in the query string
if (isset($_GET['id'])) {
    // Get the transaction ID from the query string
    $id_trx = $_GET['id'];

    // Sanitize the input to prevent SQL injection
    $id_trx = mysqli_real_escape_string($conn, $id_trx);

    // Update the order status to 'completed'
    $query = "UPDATE transaksi SET status = 'selesai' WHERE id_trx = '$id_trx'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Redirect back to the same page with a success message
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
        header("Location: $redirect&message=success");
    } else {
        // Redirect back with an error message
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
        header("Location: $redirect&message=error");
    }
} else {
    // Redirect back if no 'id' parameter is provided
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
    header("Location: $redirect&message=invalid_request");
}

// Close the database connection
mysqli_close($conn);
