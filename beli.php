<?php 
include ("proses/koneksi.php");
if (isset($_GET['id'])){
        $id_barang = $_GET['id'];
        
        if ($conn) {
        $query = "SELECT * FROM  tb_barang WHERE id = $id_barang";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
                $barang = mysqli_fetch_assoc($result);
        } else {
                die ("Barang Tidak Ditemukan");
        } 

        } else {
                die("Koneksi Database Gagal");
        }  
} else {
        die ("ID barang tidak berikan");
}
?>

<div class="container mt-5">
        <h1 class="text-center"><?php echo $barang['nama']; ?></h1>
        <div class="row">
                <div class="col-md-6">
                        <img src="assets/img/<?php echo $barang['gambar'];?>" alt="<?php echo $barang['nama']; ?>" class ="img-thumbnail">
                </div>
                <div class="col-md-6">
                        <h2>Harga: Rp<?php echo number_format($barang['harga'], 0, ',', '.'); ?></h2>
                        <p><?php echo $barang['Deskripsi']?></p>
                        <form action="" method="POST">
                                <input type="hidden" name="id_barang" value="<?php echo $barang['id'];?>">
                                <input type="hidden" name="nama" value="<?php echo $barang['nama'];?>">
                                <input type="hidden" name="harga" value="<?php echo $barang['harga'];?>">
                                <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" id="jumlah" name="jumlah" clas="form-control" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Beli Sekarang</button>
                        </form>
                </div>
        </div>
</div>