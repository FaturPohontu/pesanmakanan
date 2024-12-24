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
    $query = "UPDATE transaksi SET status = 'diterima' WHERE id_trx = '$id_trx'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect back to the previous page with a success message
        header('Location: ../index.php?message=success');
    } else {
        // Redirect back to the previous page with an error message
        header('Location: ../index.php?message=error');
    }
} else {
    // Redirect back if no 'id' parameter is provided
    header('Location: ../index.php?message=invalid_request');
}

// Close the database connection
mysqli_close($conn);
