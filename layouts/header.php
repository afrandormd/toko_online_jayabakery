<?php
session_start();
include 'koneksi/koneksi.php';
if (isset($_SESSION['kd_cs'])) {

	$kode_cs = $_SESSION['kd_cs'];
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Jaya Bakery</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- SweetAlert CSS -->
	<!-- <link href="../plugins/sweetalert2.min.css" rel="stylesheet"> -->
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> -->

</head>

<!-- <body style="background-color: #ffe8ae;"> -->

<body style="background-color: white;">
	<!-- SweetAlert JS -->
	<!-- <script src="../plugins/sweetalert2.all.min.js"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

	<div class="container-fluid">
		<div class="row top" style="background-color: #611319;">
			<center>
				<div class="col-md-4" style="padding: 3px;">
					<span> <i class="glyphicon glyphicon-earphone"></i> +6287804616097</span>
				</div>


				<div class="col-md-4" style="padding: 3px;">
					<span><i class="glyphicon glyphicon-envelope"></i> jayabakery@gmail.com</span>
				</div>


				<div class="col-md-4" style="padding: 3px;">
					<span>Jaya Bakery</span>
				</div>
			</center>
		</div>
	</div>

	<!-- <nav class="navbar navbar-default" style="padding: 5px; background-color: #611319;"> -->
	<nav class="navbar navbar-default" style="padding: 5px; background-color: #dcc68b;">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"
					style="color: #611319; font-weight: bold; font-size: 25px;"><strong>Jaya
						Bakery</strong></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="produk.php">Produk</a></li>
					<li><a href="manual.php">Manual Aplikasi</a></li>
					<li><a href="status_pesanan.php">Status Pesanan</a></li>
					<li><a href="about.php">Tentang Kami</a></li>
					<?php
					if (isset($_SESSION['kd_cs'])) {
						$kode_cs = $_SESSION['kd_cs'];
						$cek = mysqli_query($conn, "SELECT kode_produk from keranjang where kode_customer = '$kode_cs' ");
						$value = mysqli_num_rows($cek);

						?>
						<li><a href="keranjang.php"><i class="glyphicon glyphicon-shopping-cart"></i> <b>[ <?= $value ?>
									]</b></a></li>

						<?php
					} else {
						echo "
						<li><a href='keranjang.php'><i class='glyphicon glyphicon-shopping-cart'></i> [0]</a></li>

						";
					}
					if (!isset($_SESSION['user'])) {
						?>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Akun <span
									class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="user_login.php">login</a></li>
								<li><a href="register.php">Register</a></li>
							</ul>
						</li>
						<?php
					} else {
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?= $_SESSION['user']; ?>
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="proses/logout.php">Log Out</a></li>
							</ul>
						</li>

						<?php
					}
					?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>