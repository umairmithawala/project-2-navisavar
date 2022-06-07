<?php
session_start();
require_once '../database/db-con.php';
?>
<?php
$alert_msg = 0;
if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$email = htmlspecialchars($email, ENT_QUOTES, "UTF-8");

	$password = $_POST['password'];
	$password = htmlspecialchars($password, ENT_QUOTES, "UTF-8");



	$query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' AND `user_role` = 1";
	$run_fetch = mysqli_query($con, $query);
	$noofrow  = mysqli_num_rows($run_fetch);
	if ($noofrow > 0 && $run_fetch == TRUE) {
		$data = mysqli_fetch_assoc($run_fetch);
		$_SESSION['user_session_var'] = $data['id'];
?>
		<script>
			window.location = "index.php";
		</script>
	<?php

	} else {
	?>
		<script>
			alert('Email or password may wrong');
		</script>
<?php
		$alert_msg = "Email or password may wrong";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from powerbi-admin-template.multipurposethemes.com/bs4/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Apr 2022 18:36:50 GMT -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

	<link rel="icon" href="<?php echo $very_global_absolute_url; ?>assets/imgs/favicon/favicon.png">

	<title>Power BI Admin - Log in </title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="assets/css/vendors_css.css">

	<!-- Style-->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/skin_color.css">

</head>

<body class="hold-transition theme-primary bg-img">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Let's Get Started</h2>
								<p class="mb-0">Sign in to continue to Navisavar.</p>
							</div>
							<div class="p-40">
								<form method="post">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input type="text" class="form-control pl-15 bg-transparent" placeholder="Username" name="email">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input type="password" class="form-control pl-15 bg-transparent" placeholder="Password" name="password">
										</div>
									</div>
									<div class="row">
										<!-- /.col -->
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-danger mt-10" name="login">SIGN IN</button>
										</div>
										<!-- /.col -->
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="assets/js/vendors.min.js"></script>
	<script src="assets/icons/feather-icons/feather.min.js"></script>

</body>

<!-- Mirrored from powerbi-admin-template.multipurposethemes.com/bs4/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Apr 2022 18:36:50 GMT -->

</html>
<script>
	var alert_msg = "<?php echo $alert_msg; ?>";
	console.log(alert_msg);
	if (alert_msg != 0) {
		document.getElementById("alert_one").style.display = "-webkit-box";
		document.getElementById("alert_msg_id").innerHTML = alert_msg;
	}
</script>