<?php
include 'layouts/header.php';
include 'koneksi/koneksi.php'; // Ganti dengan koneksi database Anda jika berbeda

// Mengecek apakah sesi sudah aktif sebelumnya
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Mendapatkan kode_customer dari sesi
if (!isset($_SESSION['kd_cs'])) {
    header("Location: user_login.php");
    exit;
}

$kode_customer = $_SESSION['kd_cs'];
?>

<div class="container">
    <h2 style=" width: 100%; color: #611319"><i class="glyphicon glyphicon-shopping-cart"></i><b> Status Pesanan</b>
    </h2>
    <br>
    <h5 class="bg-success" style="padding: 7px; width: 100%; font-weight: bold;">
        <marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi
        </marquee>
    </h5>
    <a href="status_pesanan.php" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i>
        Reload</a>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Invoice</th>
                <th scope="col">Kode Customer</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT DISTINCT invoice, kode_customer, status, kode_produk, qty, tanggal, terima, tolak, cek FROM produksi WHERE kode_customer='$kode_customer' GROUP BY invoice");
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $inv = $row['invoice'];

                // Validasi apakah pesanan sudah dibayar atau belum
                $show_button = ($row['terima'] != 1 && $row['tolak'] != 1);

                ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['invoice']; ?></td>
                    <td><?= $row['kode_customer']; ?></td>
                    <!-- Menggunakan 'kode_customer' untuk mendapatkan nilai dari sesi -->
                    <td>
                        <?php if ($row['terima'] == 1) { ?>
                            <span style="color: green; font-weight: bold;">Pesanan Diterima (Siap Kirim)</span>
                        <?php } elseif ($row['tolak'] == 1) { ?>
                            <span style="color: red; font-weight: bold;">Pesanan Ditolak</span>
                        <?php } else { ?>
                            <span style="color: orange; font-weight: bold;"><?= $row['status']; ?></span>
                        <?php } ?>
                    </td>
                    <td><?= $row['tanggal'] ?></td>
                    <td>
                        <!-- <a href="" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Detail Pesanan</a> -->
                        <!-- Menampilkan tombol Cek Pembayaran hanya pada data yang belum dibayar -->
                        <?php if ($show_button) { ?>
                            <a href="checkout-process.php?kd_cs=<?= $row['kode_customer']; ?>" class="btn btn-success"><i
                                    class="glyphicon glyphicon-eye-open"></i> Cek Pembayaran</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include 'layouts/footer.php'; ?>