<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/login.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card h-50 shadow-sm mt-4" >
            <div class="card-body">
                <h4 class="mb-3">Login</h4>
                <?php
        if (isset($_SESSION['alert'])) {
            // Pisahkan tipe alert dan pesan
            list($alertType, $message) = explode('|', $_SESSION['alert']);
            echo "
                <div class='alert alert-$alertType alert-dismissible fade show' role='alert' style='margin-top: 20px;'>
                    $message
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            unset($_SESSION['alert']); // Hapus alert setelah ditampilkan
        }
        ?>
                <form action="proses/proses_login.php" method="POST">
                    <!-- Nama Input -->
                    <div class="mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <div class="invalid-feedback">Harap isi Nama Anda</div>
                    </div>
                    <!-- Password Input -->
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="invalid-feedback">Harap Isi Password</div>
                    </div>
                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <div class="text-center mt-3">
                    <span>Belum punya Akun ?<a href="register.php">Register</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>