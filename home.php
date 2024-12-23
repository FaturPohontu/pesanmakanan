<?php
// Jika pengguna belum login, redirect ke register.php
if (!isset($_SESSION['username'])) {
    $_SESSION['alert'] = "warning | Anda harus mendaftar atau login terlebih dahulu.";
    header('Location: register.php');
    exit();
}
?>

<div class="text-center">
    <h1>Selamat Memesan</h1>
    <p>Rasakan kenikmatan dalam setiap suapan dengan rice bowl spesial kami!
        Dihadirkan dengan pilihan topping lezat yang menggugah selera, rice bowl
        kami dibuat dengan bahan-bahan segar dan berkualitas.</p>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <!-- Card Barang 1 -->
    <div class="col shadow-sm">
        <a href="index.php?page=beli.php&id=1" class="text-decoration-none">
            <div class="card h-100">
                <img src="assets/img/rb.jpeg" class="card-img-top" alt="Rice Bowl Ayam">
                <div class="card-body">
                    <h5 class="card-title">Rice Bowl Mie Nuget </h5>
                    <p class="card-text">Nikmati rice bowl dengan topping ayam spesial.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Card Barang 2 -->
    <div class="col shadow-sm">
        <a href="index.php?page=beli.php&id=2" class="text-decoration-none">
            <div class="card h-100">
                <img src="assets/img/rbb.jpeg" class="card-img-top" alt="Rice Bowl Sapi">
                <div class="card-body">
                    <h5 class="card-title">Rice Bowl Ayam Kecap</h5>
                    <p class="card-text">Nikmati rice bowl dengan topping daging sapi lezat.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Card Barang 3 -->
    <div class="col shadow-sm">
        <a href="index.php?page=beli.php&id=3" class="text-decoration-none">
            <div class="card h-100">
                <img src="assets/img/rb.jpeg" class="card-img-top" alt="Rice Bowl Telur">
                <div class="card-body">
                    <h5 class="card-title">Rice Bowl Mie Telur</h5>
                    <p class="card-text">Rice bowl sederhana dengan topping telur nikmat.</p>
                </div>
            </div>
        </a>
    </div>
</div>
<br>
<?php if (isset($_SESSION['username'])): ?>
    <a href="index.php?page=riwayat.php" class="btn btn-info d-flex justify-content-center">Lihat Riwayat Transaksi</a>
<?php endif; ?>
<br>
