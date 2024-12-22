<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi sesuai dengan struktur direktori Anda

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validasi input
    if (empty($username) || empty($password)) {
        $_SESSION['alert'] = "danger | Username dan Password tidak boleh kosong";
        header("Location: ../login.php"); // Kembali ke halaman login
        exit();
    }

    // Query ke database
    $stmt = $conn->prepare("SELECT id, pass FROM db_cust WHERE nama = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        var_dump($row['pass']);

        // Verifikasi password menggunakan password_verify
        if (password_verify($password, $row['pass'])) {
            // Login berhasil
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id']; // Simpan ID pengguna jika diperlukan
            header("Location: ../index.php"); // Arahkan ke halaman home
            exit();
        } else {
            // Password salah
            $_SESSION['alert'] = "danger | Password Salah";
        }
    } else {
        // Username tidak ditemukan
        $_SESSION['alert'] = "warning | Username Tidak Ditemukan";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../login.php"); // Kembali ke halaman login jika gagal
    exit();
}
?>
