<?php
include 'layouts/header.php';
?>

<!-- PRODUK TERBARU -->
<div class="container">
	<h2 style="width: 100%; border-bottom: 4px solid #611319"><b>Semua Produk Kami</b></h2>

	<div class="row">
		<?php
		// Konfigurasi pagination
		$results_per_page = 6;
		$result = mysqli_query($conn, "SELECT * FROM produk");
		$number_of_results = mysqli_num_rows($result);

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
		$sql = "SELECT * FROM produk LIMIT $this_page_first_result, $results_per_page";
		$result = mysqli_query($conn, $sql);

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
			echo '<li><a href="produk.php?page=' . $page . '">' . $page . '</a></li>';
		} ?>
	</ul>

</div>

<?php
include 'layouts/footer.php';
?>