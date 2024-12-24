<?php
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Jika bukan admin, arahkan ke login
    exit();
}

// Include koneksi database
include "proses/koneksi.php";

// Ambil semua pesanan dari database
$query = "SELECT t.id_trx, b.nama AS barang, t.jumlah, t.total, t.tanggal, t.status, c.nama AS customer
          FROM transaksi t
          JOIN tb_barang b ON t.barang = b.id_brg
          JOIN db_cust c ON t.customer = c.id
          ORDER BY t.tanggal DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}

// Cek apakah ada parameter 'message' di URL
if (isset($_GET['message'])) {
    $message = $_GET['message'];

    // Tentukan pesan yang akan ditampilkan berdasarkan nilai 'message'
    $alert = '';
    switch ($message) {
        case 'success':
            $alert = "<div class='alert alert-success'>Transaksi berhasil diperbarui!</div>";
            break;
        case 'error':
            $alert = "<div class='alert alert-danger'>Terjadi kesalahan saat memperbarui transaksi.</div>";
            break;
        case 'invalid_request':
            $alert = "<div class='alert alert-warning'>Permintaan tidak valid!</div>";
            break;
    }

    // Tampilkan pesan jika ada
    echo $alert;
}

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
                        <td><?php echo htmlspecialchars($row['id_trx']); ?></td>
                        <td><?php echo htmlspecialchars($row['barang']); ?></td>
                        <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                        <td>Rp<?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer']); ?></td>
                        <td>
                            <?php
                            // Mapping status ke teks dan kelas CSS
                            $statusMap = [
                                'pending' => ['text' => 'Pending', 'class' => 'text-warning'],
                                'diterima' => ['text' => 'Diterima', 'class' => 'text-primary'],
                                'diantar' => ['text' => 'Diantar', 'class' => 'text-info'],
                                'selesai' => ['text' => 'Selesai', 'class' => 'text-success'],
                            ];
                            $status = $row['status'];
                            $statusText = $statusMap[$status]['text'] ?? 'Unknown';
                            $statusClass = $statusMap[$status]['class'] ?? 'text-danger';
                            ?>
                            <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'pending'): ?>
                                <a href="proses/proses_terima_pesanan.php?id=<?php echo urlencode($row['id_trx']); ?>" class="btn btn-success btn-sm">Terima</a>
                            <?php elseif ($row['status'] == 'diterima'): ?>
                                <a href="proses/proses_antar.php?id=<?php echo urlencode($row['id_trx']); ?>" class="btn btn-primary btn-sm">Antar</a>
                            <?php elseif ($row['status'] == 'diantar'): ?>
                                <a href="proses/proses_selesai.php?id=<?php echo urlencode($row['id_trx']); ?>" class="btn btn-secondary btn-sm">Selesai</a>
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

// Tutup koneksi
mysqli_close($conn);
?>