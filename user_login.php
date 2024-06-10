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
						<b style="color: white;">Login</b>
					</h4>
				</div>
			</a>
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<form action="proses/login.php" method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">Username</label>
							<input type="text" class="form-control w-100" id="exampleInputEmail1" placeholder="Username"
								name="username">
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control w-100" id="exampleInputPassword1"
								placeholder="Password" name="pass">
						</div>
						<button type="submit" class="btn btn-success">Login</button>
						<a href="register.php" class="" style="float: right;">Belum punya akun?</a>
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