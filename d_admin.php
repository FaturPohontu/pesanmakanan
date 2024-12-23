<?php
session_start();

// Cek apakah user sudah login dan merupakan admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Jika bukan admin, arahkan ke login
    exit();
}

// Include koneksi database
include "proses/koneksi.php";

// Ambil semua pesanan dari database
$query = "SELECT t.id_trx, b.nama AS barang, t.jumlah, t.total, t.tanggal, c.nama AS customer
          FROM transaksi t
          JOIN tb_barang b ON t.barang = b.id_brg
          JOIN db_cust c ON t.customer = c.id
          ORDER BY t.tanggal DESC";
$result = mysqli_query($conn, $query);

// Cek apakah ada pesanan
if (mysqli_num_rows($result) > 0):
?>

    <div class="container mt-5">
        <h1 class="text-center text-success">Dashboard Admin - Daftar Pesanan</h1>

        <!-- Tabel Pesanan -->
        <table class="table table-bordered mt-4">
            <thead class="table-primary">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Nama Customer</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id_trx']; ?></td>
                        <td><?php echo $row['barang']; ?></td>
                        <td><?php echo $row['jumlah']; ?></td>
                        <td>Rp<?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['customer']; ?></td>
                        <td>
                            <?php echo $row['status'] == 'pending' ? '<span class="text-warning">Pending</span>' : '<span class="text-success">Completed</span>'; ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'pending'): ?>
                                <a href="proses/proses_terima_pesanan.php?id=<?php echo $row['id_trx']; ?>" class="btn btn-success btn-sm">Terima</a>
                            <?php else: ?>
                                <span class="text-muted">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php
else:
    echo "<div class='alert alert-info text-center'>Tidak ada pesanan saat ini.</div>";
endif;

mysqli_close($conn);
?>
