<?php
include 'layouts/header.php';
?>
<!-- login form -->
<div class="container" style="padding-bottom: 250px; max-width: 50%;">
	<div class="panel-group" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
		<div class="panel panel-default">
			<a data-toggle="#" data-parent="#accordion" href="#" style="color:#000;">
				<div class="panel-heading" style="background-color: #611319;">
					<h4 class="panel-title text-center">
						<b style="color: white;">Register</b>
					</h4>
				</div>
			</a>
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<form action="proses/register.php" method="POST">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Nama</label>
									<input type="text" class="form-control" id="exampleInputPassword1"
										placeholder="Nama" name="nama" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Email</label>
									<input type="email" class="form-control" id="exampleInputPassword1"
										placeholder="Email" name="email" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">username</label>
									<input type="text" class="form-control" id="exampleInputPassword1"
										placeholder="Username" name="username" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">No Telp</label>
									<input type="text" class="form-control" id="exampleInputPassword1" placeholder="+62"
										name="telp" required>
								</div>
							</div>

						</div>


						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1"
										placeholder="Password" name="password" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Konfirmasi Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1"
										placeholder="Konfirmasi Password" name="konfirmasi" required>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-success">Register</button>
						<a href="user_login.php" class="" style="float: right;">Sudah punya akun?</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end login form -->

<?php
include 'layouts/footer.php';
?>