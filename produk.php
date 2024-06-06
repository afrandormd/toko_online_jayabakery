<?php
include 'layouts/header.php';

// Sambungan ke database dan fungsi lainnya

// Tentukan kata kunci pencarian jika ada
$search_keyword = "";
if (isset($_GET['search'])) {
	$search_keyword = $_GET['search'];
}

// Konfigurasi pagination
$results_per_page = 6;
$sql_count = "SELECT COUNT(*) AS total FROM produk";
if (!empty($search_keyword)) {
	$sql_count .= " WHERE nama LIKE '%$search_keyword%'";
}
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$number_of_results = $row_count['total'];

// Hitung jumlah halaman
$number_of_pages = ceil($number_of_results / $results_per_page);

// Tentukan halaman saat ini
if (!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}

// Tentukan batas awal dan akhir data
$this_page_first_result = ($page - 1) * $results_per_page;

// Ambil data untuk halaman ini
$sql = "SELECT * FROM produk";
if (!empty($search_keyword)) {
	$sql .= " WHERE nama LIKE '%$search_keyword%'";
}
$sql .= " LIMIT $this_page_first_result, $results_per_page";
$result = mysqli_query($conn, $sql);

?>

<div class="container">

	<!-- FORM PENCARIAN -->
	<div class="row">
		<div class="col-md-8">
			<h2 style="width: 100%;"><b>Semua Produk Kami</b></h2>
		</div>
		<div class="col-md-4" style="margin: 20px 0px">
			<form action="produk.php" method="GET">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Cari produk..." name="search">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit"><i
								class="glyphicon glyphicon-search"></i></button>
					</span>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<?php
		while ($row = mysqli_fetch_assoc($result)) {
			?>
			<div class="col-sm-6 col-md-4 text-center">
				<div class="thumbnail"
					style="background-color: #fde3a0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: none; border-radius: 10px;">
					<img src="image/produk/<?= $row['image']; ?>">
					<div class="caption">
						<h3><b><?= $row['nama']; ?></b></h3>
						<h4>Rp.<?= number_format($row['harga']); ?></h4>
						<div class="row">
							<div class="col-md-6">
								<a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>"
									class="btn btn-warning btn-block"><i class="glyphicon glyphicon-eye-open"></i>
									Detail</a>
							</div>
							<!-- Tombol belanja -->
							<?php if (isset($_SESSION['kd_cs'])) { ?>
								<div class="col-md-6">
									<a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1"
										class="btn btn-success btn-block" role="button"><i
											class="glyphicon glyphicon-shopping-cart"></i> </a>
								</div>
								<?php
							} else {
								?>
								<div class="col-md-6">
									<a href="keranjang.php" class="btn btn-success btn-block" role="button"><i
											class="glyphicon glyphicon-shopping-cart"></i></a>
								</div>

								<?php
							}
							?>
							<!-- PHP lainnya -->
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>

	<!-- Pagination -->
	<ul class="pagination">
		<?php for ($page = 1; $page <= $number_of_pages; $page++) {
			echo '<li><a href="produk.php?page=' . $page . '&search=' . $search_keyword . '">' . $page . '</a></li>';
		} ?>
	</ul>
</div>

<?php
include 'layouts/footer.php';
?>