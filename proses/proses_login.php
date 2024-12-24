<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi sesuai dengan struktur direktori Anda

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validasi input
    if (empty($username) || empty($password)) {
        $_SESSION['alert'] = "danger | Username dan Password tidak boleh kosong";
        header('location:../login.php'); // Kembali ke halaman login
        exit();
    }

    // Pertama, cek apakah username ada di tabel db_adm (admin)
    $stmt_admin = $conn->prepare("SELECT id_adm, passwd, role FROM db_admin WHERE useradmin = ?");
    $stmt_admin->bind_param("s", $username);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows === 1) {
        // Username ditemukan di db_adm (admin)
        $row = $result_admin->fetch_assoc();

        // Verifikasi password untuk admin
        if ($password === $row['passwd']) {
            // Login berhasil
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id']; // Simpan ID admin
            $_SESSION['role'] = $row['role']; // Simpan peran admin

            // Arahkan ke halaman dashboard admin 
            header("Location: ../?page=d_admin.php"); // Halaman dashboard admin
            exit();
        } else {
            $_SESSION['alert'] = "danger | Password Salah untuk Admin";
        }
    } else {
        // Jika username tidak ditemukan di db_adm, periksa di db_cust (customer)
        $stmt_cust = $conn->prepare("SELECT id, pass FROM db_cust WHERE nama = ?");
        if ($stmt_cust) { // Pastikan query berhasil dipersiapkan
            $stmt_cust->bind_param("s", $username);
            $stmt_cust->execute();
            $result_cust = $stmt_cust->get_result();

            if ($result_cust->num_rows === 1) {
                // Username ditemukan di db_cust (customer)
                $row = $result_cust->fetch_assoc();

                // Verifikasi password untuk customer
                if (password_verify($password, $row['pass'])) {
                    // Login berhasil
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $row['id']; // Simpan ID customer
                    $_SESSION['role'] = 'user'; // Simpan peran user

                    // Arahkan ke halaman utama atau halaman user
                    header("Location: ../index.php"); // Halaman utama untuk user
                    exit();
                } else {
                    $_SESSION['alert'] = "danger | Password Salah untuk Customer";
                }
            } else {
                $_SESSION['alert'] = "warning | Username Tidak Ditemukan di Customer";
            }

            // Tutup statement customer
            $stmt_cust->close();
        } else {
            $_SESSION['alert'] = "danger | Terjadi Kesalahan dalam Query ke Database";
        }
    }

    // Tutup statement admin
    $stmt_admin->close();
    $conn->close();

    header("Location: ../login.php"); // Kembali ke halaman login jika gagal
    exit();
}
