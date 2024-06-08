<?php
include 'layouts/header.php';
?>

<head>
	<style>
		.carousel-inner {
			text-align: center;
		}

		.carousel-inner .item img {
			max-width: 100%;
			max-height: 500px;
			margin: 0 auto;
			border-radius: 20px;
		}

		.responsive-map-container {
			position: relative;
			width: 100%;
			padding-bottom: 56.25%;
			/* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
			height: 0;
			overflow: hidden;
		}

		.responsive-map-container iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border: 0;
		}
	</style>
</head>
<!-- Banner Carousel -->
<div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="image/home/tokodepan.jpeg" alt="Slide 1">
			</div>
			<div class="item">
				<img src="image/home/tokojabek.jpeg" alt="Slide 2">
			</div>
		</div>


		<!-- Left and right controls
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a> -->
	</div>
</div>
<!-- end banner carousel -->

<div class="container" style="padding-bottom: 300px;">
	<h2 style=" width: 100%; text-align: center;"><b>Tentang Kami</b></h2>
	<p class="text-justify">Usaha ini dimulai oleh Siyono bersama istrinya pada tahun 1996. Mereka memilih untuk
		menjalankan usaha ini karena sang
		istri memiliki keahlian di bidang ini. Nama jaya bakery sendiri sendiri diambil diambil dari nama anak mereka.
		mereka. Jaya bakery awalnya awalnya hanyalah sebuah industry roti hanyalah sebuah industry roti rumahan yang
		menjual rumahan yang menjual produknya dengan menitipkan produknya dengan menitipkan ke warung-warung yang ada
		di bandarlampung. Setelah menekuni usaha tersebut selama 7 tahun merek memberanikan diri selama 7 tahun merek
		memberanikan diri untuk membuk untuk membuka outlet pertama di rumah a outlet pertama di rumah sakit abdoel
		moeluk. Usaha ini terus berkembang hingga sekarang ,jaya bakery sendiri sudah memiliki 15 cabang dan memiliki 9
		mitra di seluruh wilayah provinsi seluruh wilayah provinsi lampung dan pada bulan depan akan membuka cabang yang
		ke 16 di jalan pangeran antasari.</p>
	<h2 align="center"><b>Alamat Jaya Bakery</b></h2>
	<br>
	<div class="container">
		<div class="row gap-3">
			<div class="col-lg-12 col-md-6 col-12">
				<div class="responsive-map-container">
					<iframe
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127115.60611374663!2d105.1718639625!3d-5.361512099999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db38a3282303%3A0x8491b62d67bc221!2sJaya%20Bakery!5e0!3m2!1sen!2sid!4v1703750124449!5m2!1sen!2sid"
						allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</div>

</div>




<?php
include 'layouts/footer.php';
?>