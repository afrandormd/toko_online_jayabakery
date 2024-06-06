<?php
include 'layouts/header.php';
?>
<style>
	.carousel-indicators {
		bottom: -30px;
		/* Position the indicators below the slider */
	}

	.carousel-indicators li {
		border-color: #000;
		/* Dot color */
	}

	.carousel-indicators .active {
		background-color: #000;
		/* Active dot color */
	}

	.testimonial-item {
		text-align: center;
		padding: 20px;
		background-color: #f8f8f8;
		border: 1px solid #ddd;
		border-radius: 10px;
		margin: 15px auto;
		max-width: 600px;
	}

	.testimonial-item p {
		font-size: 18px;
		font-style: italic;
	}

	.testimonial-item h4 {
		margin-top: 15px;
		font-size: 16px;
		font-weight: bold;
	}
</style>
<!-- style -->
<!-- Banner Carousel -->
<div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="image/home/1.png" alt="Slide 1">
			</div>

			<div class="item">
				<img src="image/home/2.png" alt="Slide 2">
			</div>

			<div class="item">
				<img src="image/home/3.png" alt="Slide 3">
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<!-- end banner carousel -->
<!-- PRODUK TERBARU -->
<div class="container">
	<h4 class="text-center"
		style="font-family: arial; padding-top: 10px; padding-bottom: 10px; font-style: italic; line-height: 29px; border-top: 2px solid #611319; border-bottom: 2px solid #611319; margin-top: 20px;">
		<b>CV Jaya Bakery</b> adalah perusahaan yang bergerak pada bidang industri pengolahan pangan khususnya roti dan
		kue.
		Perusahaan ini didirikan oleh bapak Siyono yang dahulu merupakan karyawan Roman Bakery. Beliau merintis usaha
		ini pada bulan Agustus 1997 yang dahulu dikenal dengan nama “Roti Kampas”. Pada awalnya bapak Siyono menjual
		roti dengan cara door to door atau dari rumah ke rumah. Dengan berjalannya waktu usaha ini terus berkembang
		hingga pada tahun 2003 mendapat merek dagang <i>“Jaya Bakery”</i>.
	</h4>

	<h2 style=" width: 100%; border-bottom: 4px solid #611319; margin-top: 80px; color: #611319;" class="text-center">
		<b>Showcase Produk Kami</b>
	</h2>

	<div class="row">
		<?php
		$result = mysqli_query($conn, "SELECT * FROM produk LIMIT 6");
		while ($row = mysqli_fetch_assoc($result)) {
			?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail"
					style="background-color: #ffe8ae; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: none; border-radius: 10px;">
					<img src="image/produk/<?= $row['image']; ?>">
					<div class="caption text-center">
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
											class="glyphicon glyphicon-shopping-cart"></i> </a>
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
	<!-- testimoni section -->
	<div class="container">
		<h2 class="text-center" style="color: #611319; border-bottom: 4px solid #611319;"><b>Testimoni</b></h2>
		<div id="testimonialCarousel" class="carousel slide" data-ride="carousel"
			style="background-color: #ffe8ae; border-radius: 20px">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#testimonialCarousel" data-slide-to="1"></li>
				<li data-target="#testimonialCarousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<div class="testimonial-item"
						style="background-color: #611319; border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); color: white;">
						<p>"Layanan yang luar biasa! Saya sangat puas dengan kualitas produk dan layanan yang
							diberikan."</p>
						<h4>- Afrando Sharein Ramadhan</h4>
					</div>
				</div>

				<div class="item">
					<div class="testimonial-item"
						style="background-color: #611319; border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); color: white;">
						<p>"Pengalaman berbelanja yang sangat menyenangkan. Sangat direkomendasikan!"</p>
						<h4>- Tias Haikal Mulyana</h4>
					</div>
				</div>

				<div class="item">
					<div class="testimonial-item"
						style="background-color: #611319; border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); color: white;">
						<p>"Produk berkualitas tinggi dan layanan pelanggan yang sangat membantu."</p>
						<h4>- Nurhidayat</h4>
					</div>
				</div>
			</div>
			<!-- Left and right controls
			<a class="left carousel-control" href="#testimonialCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#testimonialCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a> -->
		</div>
	</div>
	<!-- end testimoni -->
</div>
<br>
<br>
<br>
<br>
<?php
include 'layouts/footer.php';
?>