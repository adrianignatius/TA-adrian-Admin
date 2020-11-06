<!DOCTYPE html>
<html lang="en">
<head>
	<title>Halaman Login Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script
		src="https://code.jquery.com/jquery-3.5.1.min.js"
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="optimum/bootstrap/dist/css/bootstrap.min.css">
	<script src="optimum/bootstrap/dist/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="<?php echo base_url('auth/login') ?>" method="POST" class="login100-form validate-form">
				<img src="images/applogo.png" style="display:block;margin:auto;" />
					<span class="login100-form-title p-t-20 p-b-43">
						Halaman Admin
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" name="username" type="text">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" name="password" type="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
                    </div>
                    
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
						
						<?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <h5 class="text-danger p-t-15"><?php echo $msg?></h2>
            <?php endif ?>
					</div>
				</form>
				<div class="login100-more" style="background-image: url('images/background.jpg');">
				</div>
			</div>
		</div>
	</div>

	<script src="js/main.js"></script>

</body>
</html>