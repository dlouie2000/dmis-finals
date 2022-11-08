<!DOCTYPE html>
<html>
	<head>
		<title>DMIS | Sign In</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="<?php echo base_url(); ?>application/views/HeaderNFooter/style.css">
		<script src="https://kit.fontawesome.com/32c4a45da3.js" crossorigin="anonymous"></script>
	</head>
	
	<body>
		<div class="limiter">
			<div class="container-login">
				<div class="wrap-login">
					<div class="login-pic">
							<img src="https://i.imgur.com/VhgHwd1.png" alt="IMG">
					</div>

					<form class="login-form" action="<?php echo site_url('Login/auth'); ?>" method="POST">
						<!-- Validation Error Code -->
						<?php if (validation_errors()){   
							echo '<div class="alert alert-danger container">
							'.validation_errors().'
							</div>'; 
						}
						?>

						<!-- Success Notification Code -->
						<?php if($this->session->flashdata('success')){ ?>
							<div class="alert alert-success" > 
								<?php  echo $this->session->flashdata('success'); $this->session->unset_userdata ( 'success' );?>
							</div>
						<?php } ?>

						<!-- Error Notification Code -->
						<?php if ($this->session->flashdata('error')){ ?>
							<div class="alert alert-danger" > 
								<?php  echo $this->session->flashdata('error'); $this->session->unset_userdata ( 'error' );?>
							</div>
						<?php } ?>
						<span class="login-form-title">
							Login to DMIS
						</span>

						<div class="wrap-input" data-validate="Valid username is required">
							<input class="input" type="text" name="mainusername" placeholder="Username">
							<span class="symbol-input">
								<i class="fa-solid fa-user"></i>
							</span>
						</div>

						<div class="wrap-input" data-validate="Valid password is required">
							<input class="input" type="password" name="mainpassword" placeholder="Password">
							<span class="symbol-input">
								<i class="fa-solid fa-lock"></i>
							</span>
						</div>

						<div class="container-login-form-btn" type="submit">
							<button class="login-form-btn">
								Login
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="https://kit.fontawesome.com/0a3cb2abd3.js" crossorigin="anonymous"></script>

	</body>

</html>