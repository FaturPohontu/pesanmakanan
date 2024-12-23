<?php
if (!isset($_SESSION)) {
    session_start();
}

include("proses/koneksi.php");
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    if ($conn) {
        $query = "SELECT * FROM  tb_barang WHERE id_brg = $id_barang";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $barang = mysqli_fetch_assoc($result);
        } else {
            die("Barang Tidak Ditemukan");
        }
    } else {
        die("Koneksi Database Gagal");
    }
} else {
    die("ID barang tidak berikan");
}
?>

<div class="container mt-5 p-4 shadow-lg rounded bg-light">
    <h1 class="text-center text-success mb-4"><?php echo $barang['nama']; ?></h1>
    <div class="row">
        <div class="col-md-6">
            <img src="assets/img/<?php echo $barang['gambar']; ?>" alt="<?php echo $barang['nama']; ?>" class="img-thumbnail rounded">
        </div>
        <div class="col-md-6">
            <h2 class="text-primary mb-3">Harga: Rp<?php echo number_format($barang['harga'], 0, ',', '.'); ?></h2>
            <p class="text-secondary"><?php echo $barang['Deskripsi']; ?></p>
            <form action="proses/proses_checkout.php" method="POST" class="mt-4">
                <input type="hidden" name="id_barang" value="<?php echo $barang['id_brg']; ?>">
                <input type="hidden" name="nama" value="<?php echo $barang['nama']; ?>">
                <input type="hidden" name="harga" value="<?php echo $barang['harga']; ?>">
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" min="1" required>
                </div>
                <button type="submit" class="btn btn-success w-100 py-2">Beli Sekarang</button>
            </form>
        </div>
    </div>
</div>