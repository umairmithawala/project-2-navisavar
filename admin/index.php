<?php
session_start();
require_once '../database/db-con.php';
?>

<?php
if (isset($_SESSION['user_session_var'])) {

	$user_id = $_SESSION['user_session_var'];
} else {
?>
	<script>
		window.location = "login.php";
	</script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="<?php echo $very_global_absolute_url; ?>assets/imgs/favicon/favicon.png">

	<title>Admin - Dashboard</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="assets/css/vendors_css.css">
	<!-- Style-->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/skin_color.css">

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

	<div class="wrapper">
		<div id="loader"></div>

		<!-- header section -->
		<?php require 'elements/header.php'; ?>
		<!-- End -->

		<!-- sidebar menu section -->
		<?php require 'elements/sidebar.php';  ?>
		<!-- End -->


		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="container">
				<!-- Main content -->
				<section class="content">
					<div class="row">

					<?php 
					// SELECT `id`, `blog_title`, `thumbnail_img`, `blog_body`, `publish_date`, `keywords`, `unique_link`, `dislike`, `is_deleted`, `added_by`, `category_id`, `is_slider`, `likes`, `view`, `comment`, `sharing`, `timestamp` FROM `blog` WHERE 1
					


					//get total likes from all blog posts
					$sql = "SELECT SUM(likes) AS total_likes FROM blog WHERE is_deleted = 0";
					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_assoc($result);
					$total_likes = $row['total_likes'];

					//get total views from all blog posts
					$sql = "SELECT SUM(view) AS total_views FROM blog WHERE is_deleted = 0";
					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_assoc($result);
					$total_views = $row['total_views'];


					//get total comments from all blog posts
					$sql = "SELECT SUM(comment) AS total_comments FROM blog WHERE is_deleted = 0";
					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_assoc($result);
					$total_comments = $row['total_comments'];

					//device all total_likes, total_views, total_comments by 30 to get daily likes, views, comments
					$total_likes_daily = ceil($total_likes / 30);
					$total_views_daily = ceil($total_views / 30);
					$total_comments_daily = ceil($total_comments / 30);


					?>



						<div class="col-xl-4">
							<a href="#" class="box">
								<div class="box-body">
									<div class="d-flex justify-content-between align-items-center">
										<div>
											<div class="text-dark font-weight-700 h2 mb-2 mt-5"><?php echo $total_views_daily; ?></div>
											<div class="font-size-16">Views Today</div>
										</div>
										<div class="bg-warning-light rounded-circle h-80 w-80 text-center l-h-100">
											<span class="text-warning font-size-40 icon-Binocular"></span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4">
							<a href="#" class="box">
								<div class="box-body">
									<div class="d-flex justify-content-between align-items-center">
										<div>
											<div class="text-dark font-weight-700 h2 mb-2 mt-5"><?php echo $total_likes_daily; ?></div>
											<div class="font-size-16">Likes Today</div>
										</div>
										<div class="bg-danger-light rounded-circle h-80 w-80 text-center l-h-100">
											<span class="text-danger font-size-40 icon-Arrow-to-up"><span class="path1"></span><span class="path2"></span></span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4">
							<a href="#" class="box">
								<div class="box-body">
									<div class="d-flex justify-content-between align-items-center">
										<div>
											<div class="text-dark font-weight-700 h2 mb-2 mt-5"><?php echo $total_comments_daily; ?></div>
											<div class="font-size-16">Comments Today</div>
										</div>
										<div class="bg-success-light rounded-circle h-80 w-80 text-center l-h-100">
											<span class="text-success font-size-40 icon-Chat2"></span>
										</div>
									</div>
								</div>
							</a>
						</div>


						<div class="col-xl-4">
							<a href="#" class="box">
								<div class="box-body">
									<div class="d-flex justify-content-between align-items-center">
										<div>
											<div class="text-dark font-weight-700 h2 mb-2 mt-5"><?php echo $total_views; ?></div>
											<div class="font-size-16">Views This Month</div>
										</div>
										<div class="bg-warning-light rounded-circle h-80 w-80 text-center l-h-100">
											<span class="text-warning font-size-40 icon-Binocular"></span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4">
							<a href="#" class="box">
								<div class="box-body">
									<div class="d-flex justify-content-between align-items-center">
										<div>
											<div class="text-dark font-weight-700 h2 mb-2 mt-5"><?php echo $total_likes; ?></div>
											<div class="font-size-16">Likes This Month</div>
										</div>
										<div class="bg-danger-light rounded-circle h-80 w-80 text-center l-h-100">
											<span class="text-danger font-size-40 icon-Arrow-to-up"><span class="path1"></span><span class="path2"></span></span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-4">
							<a href="#" class="box">
								<div class="box-body">
									<div class="d-flex justify-content-between align-items-center">
										<div>
											<div class="text-dark font-weight-700 h2 mb-2 mt-5"><?php echo $total_comments; ?></div>
											<div class="font-size-16">Comments This Month</div>
										</div>
										<div class="bg-success-light rounded-circle h-80 w-80 text-center l-h-100">
											<span class="text-success font-size-40 icon-Chat2"></span>
										</div>
									</div>
								</div>
							</a>
						</div>

						<div class="col-xl-12">
							<div class="row">
								<div class="col-12">
									<h2 class="my-20 text-dark">Top Trending</h2>
								</div>
							</div>
							<div class="row">

								<?php
								//get all blog col
								$query = "SELECT * FROM `blog` WHERE `is_deleted` = 0 ORDER BY `view` DESC LIMIT 3";
								$run_query = mysqli_query($con, $query);
								if (mysqli_num_rows($run_query) > 0) {
									while ($row = mysqli_fetch_array($run_query)) {
										$blog_id = $row['id'];
										$blog_title = $row['blog_title'];
										$thumbnail_img = $row['thumbnail_img'];
										$category_id = $row['category_id'];
										$blog_unique_link = $row['unique_link'];

										$blog_views = $row['view'];
										$blog_likes = $row['likes'];
										$blog_comments = $row['comment'];

										//convert views,likes and comments into k,m and b
										if ($blog_views > 10000000) {
											$blog_views = floor($blog_views / 10000000) . 'B';
										} else if ($blog_views > 1000000) {
											$blog_views = floor($blog_views / 1000000) . 'M';
										} else if ($blog_views > 1000) {
											$blog_views = floor($blog_views / 1000) . 'K';
										}

										if ($blog_likes > 10000000) {
											$blog_likes = floor($blog_likes / 10000000) . 'B';
										} else if ($blog_likes > 1000000) {
											$blog_likes = floor($blog_likes / 1000000) . 'M';
										} else if ($blog_likes > 1000) {
											$blog_likes = floor($blog_likes / 1000) . 'K';
										}

										if ($blog_comments > 10000000) {
											$blog_comments = floor($blog_comments / 10000000) . 'B';
										} else if ($blog_comments > 1000000) {
											$blog_comments = floor($blog_comments / 1000000) . 'M';
										} else if ($blog_comments > 1000) {
											$blog_comments = floor($blog_comments / 1000) . 'K';
										}


										//get category name from category_list table
										$query2 = "SELECT * FROM `category_list` WHERE `id` = $category_id";
										$run_query2 = mysqli_query($con, $query2);
										$row2 = mysqli_fetch_array($run_query2);
										$category_name = $row2['name'];
								?>
										<div class="col-xl-4 col-6">

											<div class="box">
												<a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $blog_unique_link; ?>" target="_blank">
													<div style="background-image: url('uploads/thumbnail-img/<?php echo $thumbnail_img; ?>'); background-repeat: no-repeat;
                                 background-size: cover; height:200px;">
													</div>
												</a>

												<div class="box-body">
													<div class="row text-center">
														<div class="col-md-12">
															<a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $blog_unique_link; ?>" target="_blank">
																<h4 class="box-title"><?php echo $blog_title ?></h4>
															</a>
														</div>
														<div class="col-md-12">
															<div class="row">
																<div class="col">
																	<label style="float:left;"> <?php echo $category_name; ?> </label>


																</div>
																<div class="col">
																	<div style="float:right">
																		<a href="blog-edit.php?id=<?php echo $blog_id; ?>" class="btn btn-success btn-sm" style="margin-right:20px;"><i class="fa-solid fa-pen"></i></a>
																		<a href="#" class="btn btn-danger btn-sm" onclick="prepareDelete(<?php echo $blog_id; ?>)"><i class="fa-solid fa-trash-can"></i></a>
																	</div>
																</div>
															</div>
															<div class="row mt-3">
																<div class="col">
																	<label class="mr-3" for=""><i class="fas fa-eye"></i> <?php echo $blog_views; ?></label>
																	<label class="mr-3" for=""><i class="fas fa-thumbs-up"></i> <?php echo $blog_likes; ?></label>
																	<label class="mr-3" for=""><i class="fas fa-comment"></i> <?php echo $blog_comments; ?></label>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- /.box-body -->
											</div>

										</div>
								<?php
									}
								}
								?>

							</div>

						</div>


						<div class="col-xl-12">
							<div class="row">
								<div class="col-12">
									<h2 class="my-20 text-dark">Recently Added</h2>
								</div>
							</div>
							<div class="row">

								<?php
								//get all blog col
								$query = "SELECT * FROM `blog` WHERE `is_deleted` = 0 ORDER BY `publish_date` DESC LIMIT 3";
								$run_query = mysqli_query($con, $query);
								if (mysqli_num_rows($run_query) > 0) {
									while ($row = mysqli_fetch_array($run_query)) {
										$blog_id = $row['id'];
										$blog_title = $row['blog_title'];
										$thumbnail_img = $row['thumbnail_img'];
										$category_id = $row['category_id'];
										$blog_unique_link = $row['unique_link'];

										$blog_views = $row['view'];
										$blog_likes = $row['likes'];
										$blog_comments = $row['comment'];

										//convert views,likes and comments into k,m and b
										if ($blog_views > 10000000) {
											$blog_views = floor($blog_views / 10000000) . 'B';
										} else if ($blog_views > 1000000) {
											$blog_views = floor($blog_views / 1000000) . 'M';
										} else if ($blog_views > 1000) {
											$blog_views = floor($blog_views / 1000) . 'K';
										}

										if ($blog_likes > 10000000) {
											$blog_likes = floor($blog_likes / 10000000) . 'B';
										} else if ($blog_likes > 1000000) {
											$blog_likes = floor($blog_likes / 1000000) . 'M';
										} else if ($blog_likes > 1000) {
											$blog_likes = floor($blog_likes / 1000) . 'K';
										}

										if ($blog_comments > 10000000) {
											$blog_comments = floor($blog_comments / 10000000) . 'B';
										} else if ($blog_comments > 1000000) {
											$blog_comments = floor($blog_comments / 1000000) . 'M';
										} else if ($blog_comments > 1000) {
											$blog_comments = floor($blog_comments / 1000) . 'K';
										}


										//get category name from category_list table
										$query2 = "SELECT * FROM `category_list` WHERE `id` = $category_id";
										$run_query2 = mysqli_query($con, $query2);
										$row2 = mysqli_fetch_array($run_query2);
										$category_name = $row2['name'];
								?>
										<div class="col-xl-4 col-6">

											<div class="box">
												<a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $blog_unique_link; ?>" target="_blank">
													<div style="background-image: url('uploads/thumbnail-img/<?php echo $thumbnail_img; ?>'); background-repeat: no-repeat;
                                 background-size: cover; height:200px;">
													</div>
												</a>

												<div class="box-body">
													<div class="row text-center">
														<div class="col-md-12">
															<a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $blog_unique_link; ?>" target="_blank">
																<h4 class="box-title"><?php echo $blog_title ?></h4>
															</a>
														</div>
														<div class="col-md-12">
															<div class="row">
																<div class="col">
																	<label style="float:left;"> <?php echo $category_name; ?> </label>


																</div>
																<div class="col">
																	<div style="float:right">
																		<a href="blog-edit.php?id=<?php echo $blog_id; ?>" class="btn btn-success btn-sm" style="margin-right:20px;"><i class="fa-solid fa-pen"></i></a>
																		<a href="#" class="btn btn-danger btn-sm" onclick="prepareDelete(<?php echo $blog_id; ?>)"><i class="fa-solid fa-trash-can"></i></a>
																	</div>
																</div>
															</div>
															<div class="row mt-3">
																<div class="col">
																	<label class="mr-3" for=""><i class="fas fa-eye"></i> <?php echo $blog_views; ?></label>
																	<label class="mr-3" for=""><i class="fas fa-thumbs-up"></i> <?php echo $blog_likes; ?></label>
																	<label class="mr-3" for=""><i class="fas fa-comment"></i> <?php echo $blog_comments; ?></label>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- /.box-body -->
											</div>

										</div>
								<?php
									}
								}
								?>

							</div>

						</div>


					
						<div class="col-12">
							<div class="box">
								<div class="box-header">
									<h4 class="box-title align-items-start flex-column">
										New Users
										<?php
										//count total users 
										$query_user = "SELECT * FROM `users` ORDER BY `id` DESC";
										$run_query_user = mysqli_query($con, $query_user);
										$total_users = mysqli_num_rows($run_query_user);

										?>
										<small class="subtitle">More than <?php echo $total_users; ?>+ members</small>
									</h4>
											<span style="float:right;">
											<a href="manage-user.php">
									View All
									</a>
									</span>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table class="table no-border">
											<thead>
												<tr class="text-uppercase bg-lightest">
													<th style="min-width: 250px"><span class="text-dark">User Name</span></th>
													<th style="min-width: 100px"><span class="text-fade">Email</span></th>
													<th style="min-width: 100px"><span class="text-fade">Password</span></th>
													<th style="min-width: 150px"><span class="text-fade">Verified</span></th>
													<th style="min-width: 130px"><span class="text-fade">Date</span></th>
													
												</tr>
											</thead>
											<tbody>
												<?php 

												$query_user = "SELECT * FROM `users` ORDER BY `id` DESC LIMIT 10";
												$result_user = mysqli_query($con, $query_user);
												if (mysqli_num_rows($result_user) > 0) {
													while ($row_user = mysqli_fetch_assoc($result_user)) {
														$user_id = $row_user['id'];
														$user_name = $row_user['name'];
														$user_email = $row_user['email'];
														$user_password = $row_user['password'];
														$user_img = $row_user['user_img'];
														$user_date = $row_user['timestamp'];
														$is_verified = $row_user['is_verified'];
														?>
														

												
												<tr>
													<td class="pl-0 py-8">
														<div class="d-flex align-items-center">
															<div class="flex-shrink-0 mr-20">
																<div class="bg-img h-50 w-50" style="background-image: url(<?php echo $very_global_absolute_url; ?>admin/uploads/user-img/<?php echo $user_img; ?>)"></div>
															</div>

															<div>
																<a href="#" class="text-dark font-weight-600 hover-primary mb-1 font-size-16"><?php echo $user_name; ?></a>
																
															</div>
														</div>
													</td>
													<td>
														
														<span class="text-dark font-weight-600 d-block font-size-16">
															<?php 
															echo $user_email;
															?>
														</span>
													</td>
													<td>
														<span class="text-fade font-weight-600 d-block font-size-16">
															<?php echo $user_password;  ?>
														</span>
														
													</td>
													
												
													<td>
														<?php 
														if ($is_verified == 1) {
															?>
															<span class="badge badge-primary-light badge-lg">Verified</span>
															<?php
														}else{
															?>
															<span class="badge badge-danger-light badge-lg">Not Verified</span>
															<?php
														}
														?>
														
													</td>
													<td class="text-right">
													<span class="text-fade font-weight-600 d-block font-size-16">
															<?php 
															// echo $user_date; 
															//convert user date into human readable date
															$user_date_converted = date("d-m-Y", strtotime($user_date));
															echo $user_date_converted;
															 ?>
														</span>
													</td>
												</tr>
												<?php
													}}

												?>
											
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- /.content -->
			</div>
		</div>
		<!-- /.content-wrapper -->
		<?php require_once 'elements/footer.php' ?>

		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- ./wrapper -->

	<!-- Vendor JS -->
	<script src="assets/js/vendors.min.js"></script>
	<script src="assets/icons/feather-icons/feather.min.js"></script>

	<script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>

	<!-- Power BI Admin App -->
	<script src="assets/js/template.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/pages/dashboard4.js"></script>

</body>



</html>