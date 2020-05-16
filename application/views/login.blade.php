<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Halaman Login</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/') ?>/bootstrap-4.4.1-dist/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/') ?>/font-awesome-4.7.0/css/font-awesome.min.css">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/components.css">
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="login-brand">
							<img width="200" src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="100" class="shadow-light">
						</div>

						<div class="card card-primary">
							<div class="card-header"><h4>Login</h4></div>

							<div class="card-body">
								<form method="POST" action="<?= base_url('login/proses') ?>" class="needs-validation" novalidate="">
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
								</div>

								<div class="form-group">
									<label for="password" class="control-label">Password</label>
									<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
									Login
									</button>
								</div>
								</form>
								
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
</html>
