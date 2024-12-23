<?php
if (!isset($_SESSION)) {
    session_start();
}

include("proses/koneksi.php");

if ($conn) {
    $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
    $query = "
        SELECT 
            t.id_trx, 
            b.nama AS barang, 
            t.jumlah, 
            t.total, 
            t.tanggal 
        FROM transaksi t
        JOIN tb_barang b ON t.barang = b.id_brg
        WHERE t.customer = '$user_id'
        ORDER BY t.tanggal DESC";
    $result = mysqli_query($conn, $query);
} else {
    die("Koneksi Database Gagal");
}
?>

<div class="container mt-5">
    <h1 class="text-center text-success">Riwayat Transaksi</h1>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="text-center"><?php echo $row['id_trx']; ?></td>
                        <td><?php echo $row['barang']; ?></td>
                        <td class="text-center"><?php echo $row['jumlah']; ?></td>
                        <td class="text-end">Rp<?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                        <td class="text-center"><?php echo $row['tanggal']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>