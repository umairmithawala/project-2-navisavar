<?php
session_start();
require_once 'database/db-con.php';
require_once 'utility/convert-time-ago.php';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>નવી સવાર</title>
   <meta name="referrer" content="always" />
   <meta name="robots" content="all" />
   <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />

   <meta name="title" content="નવી સવાર">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="https://anzarkhan.com">


   <meta property="fb:app_id" content="1168702680615201" />
   <meta property="og:title" content="નવી સવાર" />
   <meta property="og:type" content="Website" />
   <meta property="og:url" content="https://navisavar.com/" />
   <meta property="og:image" content="<?php echo $very_global_absolute_url; ?>assets/imgs/logo/navisavar-logo.png" />
   <meta property="og:description" content="">


   <!--Twitter-->
   <meta name="twitter:card" content="summary" />
   <meta name="twitter:site" content="@NaviSavar" />
   <meta name="twitter:title" content="નવી સવાર" />
   <meta name="twitter:description" content="" />
   <meta name="twitter:image" content="<?php echo $very_global_absolute_url; ?>assets/imgs/logo/navisavar-logo.png" />
   <meta name="twitter:url" content="https://navisavar.com" />
   <!--End Twitter card tag -->


   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="canonical" href="https://navisavar.com" />

   <link rel="shortcut icon" type="image/x-icon" href="<?php echo $very_global_absolute_url; ?>assets/imgs/favicon/favicon.png">
   <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/style.css">
   <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/widgets.css">
   <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/color.css">
   <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/responsive.css">
   <!-- <link rel="stylesheet" href="assets/css/all.css"> -->
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
   <!-- Preloader Start -->
   <div id="preloader-active">
         <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
               <div class="text-center">
                  <img class="jump mb-50" src="<?php echo $very_global_absolute_url; ?>assets/imgs/logo/navisavar-logo.png" alt="">
                  <h6>Now Loading</h6>
                  <!-- <div class="loader">
                     <div class="bar bar1"></div>
                     <div class="bar bar2"></div>
                     <div class="bar bar3"></div>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
   <div class="main-wrap">
      <!--Offcanvas sidebar-->
      <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
         <button class="off-canvas-close"><i class="ti-close"></i></button>

      </aside>
      <!-- HEADER SECTION -->
      <?php require_once 'elements/header.php'; ?>
      <!-- END -->
      <!-- Main Wrap Start -->
      <main class="position-relative">
         <div class="swiper hero_slider mb-50">
            <div class="swiper-wrapper">

               <?php
               $query1 = "SELECT * FROM `blog` WHERE `is_slider` = 1 AND `is_deleted` = 0 ORDER BY `id` DESC LIMIT 5";
               $run_query1 = mysqli_query($con, $query1);
               while ($data = mysqli_fetch_assoc($run_query1)) {
                  $view = $data['view'];
                  $total_likes = $data['likes'];;
                  $comment = $data['comment'];
                  $publish_date = $data['publish_date'];
                  $unique_link = $data['unique_link'];
                  $added_by = $data['added_by'];

                  $query8 = "SELECT * FROM `users` WHERE `id` = $added_by";
                  $run_query8 = mysqli_query($con, $query8);
                  if ($run_query8) {
                     $data8 = mysqli_fetch_assoc($run_query8);
                     $added_by_name = $data8['name'];
                  } else {
                     $added_by_name = "Unknown";
                  }
               ?>
                  <div class="swiper-slide">
                     <div class="slider-single bg-white p-10 border-radius-15">
                        <div class="img-hover-scale border-radius-10">
                           <a href="blog/<?php echo $unique_link; ?>">
                              <!-- <img class="border-radius-10" src="<?php echo $very_global_absolute_url; ?>assets/imgs/news-1.jpg" alt="post-slider" > -->
                              <div class="border-radius-10" style="height:400px; background-color: #663259; background-position: bottom right ; 
                                 background-size: cover;
                                 background-repeat: no-repeat; background-image: url('<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data['thumbnail_img']; ?>')">
                              </div>
                           </a>
                        </div>
                        <h6 class="post-title pr-5 pl-1 mb-10 mt-15 text-limit-2-row">
                           <a href="blog/<?php echo $unique_link; ?>"><?php echo $data['blog_title']; ?></a>
                        </h6>
                        <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase pl-5 pb-15">

                           <span class="post-by">By <a><?php echo $added_by_name; ?></a></span>
                           <span class="post-on">
                              <?php echo timeAgo($data['publish_date']); ?>
                           </span>
                        </div>
                        <div class="entry-meta meta-1 font-x-small color-grey float-right text-uppercase pb-15">
                           <span><span class="mr-5"><i class="fa fa-eye" aria-hidden="true"></i></span>
                              <?php
                              if ($view > 1000) {
                                 $result_view = floor($view / 1000) . 'K';
                              } else if ($view > 100000) {
                                 $result_view = floor($view / 100000) . 'M';
                              } else if ($view > 10000000) {
                                 $result_view = floor($view / 10000000) . 'B';
                              } else {
                                 $result_view = $view;
                              }
                              echo $result_view;
                              ?>
                           </span><span class="ml-30"><span class="mr-10 text-muted"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                              <?php
                              if ($total_likes > 1000) {
                                 $result_total_share = floor($total_likes / 1000) . 'K';
                              } else if ($total_likes > 100000) {
                                 $result_total_share = floor($total_likes / 100000) . 'M';
                              } else if ($total_likes > 10000000) {
                                 $result_total_share = floor($total_likes / 10000000) . 'B';
                              } else {
                                 $result_total_share = $total_likes;
                              }
                              echo $result_total_share;
                              ?>
                           </span>
                           <span class="ml-30"><span class="mr-10 text-muted"><i class="fa fa-comment" aria-hidden="true"></i></span>
                              <?php
                              if ($comment > 1000) {
                                 $result_comment = floor($comment / 1000) . 'K';
                              } else if ($comment > 100000) {
                                 $result_comment = floor($comment / 100000) . 'M';
                              } else if ($comment > 10000000) {
                                 $result_comment = floor($comment / 10000000) . 'B';
                              } else {
                                 $result_comment = $comment;
                              }
                              echo $result_comment;
                              ?>
                           </span>
                        </div>
                     </div>
                  </div>
               <?php
               }
               ?>

            </div>
            <!-- <div class="swiper-pagination"></div> -->
         </div>
         <div class="post-carausel-1-items mt-50 mb-50">
            <?php

            //get highest likes count blog post from database 
            $query2 = "SELECT * FROM `blog` ORDER BY `likes` DESC LIMIT 10";
            $run_query2 = mysqli_query($con, $query2);
            while ($data = mysqli_fetch_assoc($run_query2)) {
               $blog_id = $data['id'];
               $unique_link = $data['unique_link'];
            ?>
               <div class="col">
                  <div class="slider-single bg-white p-10 border-radius-15">
                     <div class="img-hover-scale border-radius-10">
                        <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>">
                           <!-- <img class="border-radius-10" src="<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data['thumbnail_img']; ?>" alt="post-slider"> -->
                           <div class="border-radius-10" style="background-image: url('<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data['thumbnail_img']; ?>'); background-repeat: no-repeat;
                                                      background-size: cover; height:150px;">
                                             </div>
                        </a>
                     </div>
                     <h6 class="post-title pr-5 pl-5 mb-10 mt-15 text-limit-2-row">
                        <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"><?php echo $data['blog_title']; ?></a>
                     </h6>
                     <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase pl-5 pb-15">
                        <span class="post-on"> <?php echo timeAgo($data['publish_date']); ?> </span>
                     </div>
                  </div>
               </div>
            <?php
            }
            ?>

         </div>
         <div class="container">
            <!--Content-->
            <div class="row">
               <!-- sidebar-left -->
               <div class="col-lg-2 col-md-3 primary-sidebar sticky-sidebar sidebar-left order-2 order-md-1">
                  <!-- Widget Weather -->
                  <div class="sidebar-widget widget-weather border-radius-10 bg-white mb-30">
                     <div class="d-flex">
                        <div class="font-medium">
                           <p class="text-center"><strong><?php echo date('l'); ?></strong></p>
                           <h2><?php echo date('d'); ?></h2>
                           <p class="text-center"><strong><?php echo date('F'); ?></strong></p>
                        </div>
                        <div class="font-medium ml-10 pt-20">
                           <div id="datetime" class="d-inline-block">
                              <ul>
                                 <?php

                                 // $city_name = 'ahmedabad';
                                 $api_key = '49bb0223b27c044e2c69d79cd79f73f9';

                                 // $api_url = 'https://api.openweathermap.org/data/2.5/weather=?'.$city_name.'&apiid='.$api_key;
                                 $api_url_ahmd = 'https://api.openweathermap.org/data/2.5/weather?lat=23.033863&lon=72.585022&appid=49bb0223b27c044e2c69d79cd79f73f9';
                                 $weather_data = json_decode(file_get_contents($api_url_ahmd), true);
                                 $temprature = $weather_data['main']['temp'];
                                 $temprature_in_celcius_ahmd = round($temprature - 273.15);

                                 //for surat city
                                 $api_url_surat = 'https://api.openweathermap.org/data/2.5/weather?lat=21.1702&lon=72.8311&appid=49bb0223b27c044e2c69d79cd79f73f9';
                                 $weather_data = json_decode(file_get_contents($api_url_surat), true);
                                 $temprature = $weather_data['main']['temp'];
                                 $temprature_in_celcius_surat = round($temprature - 273.15);

                                 //for Vadodra city
                                 $api_url_vadodra = 'https://api.openweathermap.org/data/2.5/weather?lat=22.3072&lon=72.8311&appid=49bb0223b27c044e2c69d79cd79f73f9';
                                 $weather_data = json_decode(file_get_contents($api_url_vadodra), true);
                                 $temprature = $weather_data['main']['temp'];
                                 $temprature_in_celcius_vododra = round($temprature - 273.15);
                                 ?>
                                 <li>
                                    <span class="font-small">
                                       <a class="text-primary" href="#">Ahmedabad</a><br>
                                       <i class="mr-5"></i><?php echo "{$temprature_in_celcius_ahmd}°C"; ?>
                                    </span>
                                    <p>Sunny</p>
                                 </li>
                                 <li>
                                    <span class="font-small">
                                       <a class="text-primary" href="#">Surat</a><br>
                                       <i class="mr-5"></i><?php echo "{$temprature_in_celcius_surat}°C"; ?>
                                    </span>
                                    <p>Sunny</p>
                                 </li>
                                 <li>
                                    <span class="font-small">
                                       <a class="text-primary" href="#">Vadodra</a><br>
                                       <i class="mr-5"></i><?php echo "{$temprature_in_celcius_vododra}°C"; ?>
                                    </span>
                                    <p>Sunny</p>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Widget Categories -->
                  <div class="sidebar-widget widget_categories border-radius-10 bg-white mb-30">
                     <div class="widget-header position-relative mb-15">
                        <h5 class="widget-title"><strong>Categories</strong></h5>
                     </div>
                     <ul class="font-small text-muted">
                        <?php
                        $query3 = "SELECT * FROM `category_list` limit 5";
                        $run_query3 = mysqli_query($con, $query3);
                        while ($data3 = mysqli_fetch_assoc($run_query3)) {
                           $category_id = $data3['id'];
                           $unique_link = $data3['unique_link'];
                        ?>
                           <li class="cat-item cat-item-2"><a href="<?php echo $very_global_absolute_url; ?>category/<?php echo $unique_link ?>">
                                 <p> <?php echo $data3['name']; ?></p>
                              </a></li>
                        <?php
                        }
                        ?>
                     </ul>
                  </div>
               </div>
               <!-- main content -->
               <div class="col-lg-10 col-md-9 order-1 order-md-2">
                  <div class="row">
                     <?php
                     //get latest blog with publish date
                     $sql = "SELECT * FROM blog WHERE `is_deleted` = 0 ORDER BY publish_date DESC LIMIT 1";
                     $result = mysqli_query($con, $sql);
                     if (mysqli_num_rows($result) > 0) {
                        while ($data2 = mysqli_fetch_assoc($result)) {
                           $category_id = $data2['category_id'];
                           $view = $data2['view'];
                           $total_likes = $data2['likes'];;
                           $comment = $data2['comment'];
                           $blog_id = $data2['id'];
                           $unique_link = $data2['unique_link'];

                           $query13 = "SELECT * FROM `category_list` WHERE `id` = $category_id";
                           $run_query13 = mysqli_query($con, $query13);
                           $data13 = mysqli_fetch_assoc($run_query13);
                     ?>
                           <div class="col-lg-8 col-md-12">
                              <div class="latest-post mb-50">
                                 <div class="widget-header position-relative mb-30">
                                    <div class="row">
                                       <div class="col-7">
                                          <h4 class="widget-title mb-0">તાજેતરની <span>પોસ્ટ</span></h4>
                                       </div>
                                       <div class="col-5 text-right">
                                          <h6 class="font-medium pr-15">
                                             <a class="text-muted font-small" href="<?php echo $very_global_absolute_url; ?>recent-blogs">વધુ જોવો</a>
                                          </h6>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="loop-list-style-1">
                                    <article class="first-post p-10 background-white border-radius-10 mb-30 wow fadeIn animated">
                                       <div class="img-hover-slide border-radius-15 mb-30 position-relative overflow-hidden">
                                          <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>">
                                             <div class="border-radius-15" style="background-image: url('<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data2['thumbnail_img']; ?>'); background-repeat: no-repeat;
                                                      background-size: cover; height:400px;">
                                             </div>
                                          </a>
                                       </div>
                                       <div class="pr-10 pl-10">
                                          <div class="entry-meta mb-30">
                                             <a class="entry-meta meta-0"><span class="post-in background2 text-primary font-x-small"><?php echo $data13['name']; ?></span></a>
                                             <div class="float-right font-small">
                                                <span><span class="mr-10 text-muted"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                   <?php
                                                   if ($view > 1000) {
                                                      $result_view = floor($view / 1000) . 'K';
                                                   } else if ($view > 100000) {
                                                      $result_view = floor($view / 100000) . 'M';
                                                   } else if ($view > 10000000) {
                                                      $result_view = floor($view / 10000000) . 'B';
                                                   } else {
                                                      $result_view = $view;
                                                   }
                                                   echo $result_view;
                                                   ?>
                                                </span>
                                                <span class="ml-30"><span class="mr-10 text-muted"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                                                   <?php
                                                   if ($total_likes > 1000) {
                                                      $result_total_share = floor($total_likes / 1000) . 'K';
                                                   } else if ($total_likes > 100000) {
                                                      $result_total_share = floor($total_likes / 100000) . 'M';
                                                   } else if ($total_likes > 10000000) {
                                                      $result_total_share = floor($total_likes / 10000000) . 'B';
                                                   } else {
                                                      $result_total_share = $total_likes;
                                                   }
                                                   echo $result_total_share;
                                                   ?>
                                                </span>
                                                <span class="ml-30"><span class="mr-10 text-muted"><i class="fa fa-comment" aria-hidden="true"></i></span>
                                                   <?php
                                                   if ($comment > 1000) {
                                                      $result_comment = floor($comment / 1000) . 'K';
                                                   } else if ($comment > 100000) {
                                                      $result_comment = floor($comment / 100000) . 'M';
                                                   } else if ($comment > 10000000) {
                                                      $result_comment = floor($comment / 10000000) . 'B';
                                                   } else {
                                                      $result_comment = $comment;
                                                   }
                                                   echo $result_comment;
                                                   ?>
                                                </span>

                                             </div>
                                          </div>
                                          <h4 class="post-title mb-20">
                                             <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"><?php echo $data2['blog_title']; ?></a>
                                          </h4>
                                          <div class="mb-20 overflow-hidden">
                                             <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                                <span class="post-on"><?php echo timeAgo($data2['publish_date']); ?></span>
                                             </div>
                                             <div class="float-right">
                                                <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>" class="read-more"><span class="mr-10"><i class="fa fa-thumbtack" aria-hidden="true"></i></span>ટોચની વાર્તા</a>
                                             </div>
                                          </div>
                                       </div>
                                    </article>

                              <?php
                           }
                        }
                              ?>
                              <?php
                              $query4 = "SELECT * FROM `blog` WHERE `is_deleted` = 0 ORDER BY publish_date DESC LIMIT 1,3";
                              $run_query4 = mysqli_query($con, $query4);
                              if ($run_query4) {
                                 while ($data4 = mysqli_fetch_assoc($run_query4)) {
                                    $blog_id = $data4['id'];
                                    $unique_link = $data4['unique_link'];
                                    $category_id = $data4['category_id'];
                                    $view = $data4['view'];
                                    $comment = $data4['comment'];
                                    $total_likes = $data4['likes'];
                                    $added_by = $data4['added_by'];


                                    $get_author_query = "SELECT * FROM `users` WHERE `id` = '$added_by'";
                                    $run_author_query = mysqli_query($con, $get_author_query);
                                    $data13 = mysqli_fetch_assoc($run_author_query);
                                    $added_by_name = $data13['name'];

                              ?>
                                    <article class="p-10 background-white border-radius-10 mb-10 wow fadeIn animated">
                                       <div class="d-flex">
                                          <div class="post-thumb d-flex mr-15 border-radius-15 img-hover-scale">
                                             <a class="color-white" href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>">
                                                <div class="border-radius-15" style="background-image: url('<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data4['thumbnail_img']; ?>'); background-repeat: no-repeat;
                                                      background-size: cover; height:200px; width:300px;">
                                                </div>
                                                <!-- ̥<img class="border-radius-15" src="<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data4['thumbnail_img']; ?>" alt=""> -->
                                             </a>
                                          </div>
                                          <div class="post-content media-body">
                                             <div class="entry-meta mb-15 mt-10">
                                                <?php
                                                $query13 = "SELECT * FROM `category_list` WHERE `id` = $category_id";
                                                $run_query13 = mysqli_query($con, $query13);
                                                $data13 = mysqli_fetch_assoc($run_query13);


                                                ?>
                                                <a class="entry-meta meta-2" href="<?php echo $very_global_absolute_url; ?>category/<?php echo $data13['unique_link']; ?>"><span class="post-in text-danger font-x-small">
                                                      <?php echo $data13['name']; ?>
                                                   </span></a>
                                             </div>
                                             <h5 class="post-title mb-15 text-limit-2-row">
                                                <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"><?php echo $data4['blog_title']; ?></a>
                                             </h5>
                                             <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                                <span class="post-by">By <a><?php echo $added_by_name; ?></a></span>
                                                <span class="post-on"><?php echo timeAgo($data4['publish_date']); ?></span>
                                             </div><br>
                                             <div class="font-x-small color-grey text-uppercase mt-5">
                                                <span><span class="mr-5"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                   <?php
                                                   if ($view > 1000) {
                                                      $result_view = floor($view / 1000) . 'K';
                                                   } else if ($view > 100000) {
                                                      $result_view = floor($view / 100000) . 'M';
                                                   } else if ($view > 10000000) {
                                                      $result_view = floor($view / 10000000) . 'B';
                                                   } else {
                                                      $result_view = $view;
                                                   }
                                                   echo $result_view;
                                                   ?>
                                                </span>
                                                <span class="ml-15"><span class="mr-5 text-muted"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                                                   <?php if ($total_likes > 1000) {
                                                      $result_total_share = floor($total_likes / 1000) . 'K';
                                                   } else if ($total_likes > 100000) {
                                                      $result_total_share = floor($total_likes / 100000) . 'M';
                                                   } else if ($total_likes > 10000000) {
                                                      $result_total_share = floor($total_likes / 10000000) . 'B';
                                                   } else {
                                                      $result_total_share = $total_likes;
                                                   }
                                                   echo $result_total_share;
                                                   ?>
                                                </span>
                                                <span class="ml-15"><span class="mr-5 text-muted"><i class="fa fa-comment" aria-hidden="true"></i></span>
                                                   <?php
                                                   if ($comment > 1000) {
                                                      $result_comment = floor($comment / 1000) . 'K';
                                                   } else if ($comment > 100000) {
                                                      $result_comment = floor($comment / 100000) . 'M';
                                                   } else if ($comment > 10000000) {
                                                      $result_comment = floor($comment / 10000000) . 'B';
                                                   } else {
                                                      $result_comment = $comment;
                                                   }
                                                   echo $result_comment;
                                                   ?>
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                    </article>
                              <?php
                                 }
                              }
                              ?>
                              <div class="col-12 mb-50">
                                 <h6 class="font-medium pr-15 text-center">
                                    <a class="read-more" href="<?php echo $very_global_absolute_url; ?>recent-blogs">વધુ જોવો<span class="ml-10"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a>
                                 </h6>
                              </div>
                              <!--Videos-->
                              <div class="sidebar-widget">
                                 <div class="widget-header position-relative mb-20">
                                    <div class="row">
                                       <div class="col-7">
                                          <h5 class="widget-title mb-0">Top

                                             <?php
                                             $query_get_category_unique_link = "SELECT * FROM `category_list` WHERE `id` = 1";
                                             $run_query_get_category_unique_link = mysqli_query($con, $query_get_category_unique_link);
                                             if ($run_query_get_category_unique_link) {
                                                $data15 = mysqli_fetch_assoc($run_query_get_category_unique_link);
                                                $category_unique_link = $data15['unique_link'];
                                             }
                                             ?>

                                             <span>
                                                <?php
                                                $query_get_category_title = "SELECT * FROM `category_list` WHERE `id` = 1";
                                                $run_query_get_category_title = mysqli_query($con, $query_get_category_title);
                                                if ($run_query_get_category_title) {
                                                   $data10 = mysqli_fetch_assoc($run_query_get_category_title);
                                                   echo $data10['name'];
                                                }
                                                ?> </span>
                                          </h5>
                                       </div>
                                       <div class="col-5 text-right">
                                          <h6 class="font-medium pr-15">
                                             <a class="text-muted font-small" href="<?php echo $very_global_absolute_url; ?>category/<?php echo $category_unique_link; ?>">View more</a>
                                          </h6>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="block-tab-item post-module-1 post-module-4">
                                    <div class="row">
                                       <?php
                                       $query5 = "SELECT * FROM `blog` WHERE `category_id` = 1 ORDER BY publish_date DESC LIMIT 4";
                                       $run_query5 = mysqli_query($con, $query5);
                                       if ($run_query5 == true) {
                                          while ($data5 = mysqli_fetch_assoc($run_query5)) {
                                             $blog_id = $data5['id'];
                                             $unique_link = $data5['unique_link'];
                                             $view = $data5['view'];
                                             $comment = $data5['comment'];
                                             $total_likes = $data5['likes'];;
                                       ?>

                                             <div class="slider-single col-md-6 mb-30">
                                                <div class="img-hover-scale border-radius-10">
                                                   <!-- <span class="top-right-icon background10"><i class="mdi mdi-share"></i></span> -->
                                                   <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>">
                                                      <div class="border-radius-10" style="background-image: url('<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data5['thumbnail_img']; ?>'); background-repeat: no-repeat;
                                                      background-size: cover; height:200px;">
                                                      </div>̥
                                                   </a>
                                                </div>
                                                <h5 class="post-title pr-5 pl-5 mb-10 text-limit-2-row">
                                                   <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"><?php echo $data5['blog_title']; ?></a>
                                                </h5>
                                                <div class="entry-meta meta-1 font-x-small mt-10 pr-5 pl-5 text-muted">
                                                   <span><span class="mr-5"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                      <?php
                                                      if ($view > 1000) {
                                                         $result_view = floor($view / 1000) . 'K';
                                                      } else if ($view > 100000) {
                                                         $result_view = floor($view / 100000) . 'M';
                                                      } else if ($view > 10000000) {
                                                         $result_view = floor($view / 10000000) . 'B';
                                                      } else {
                                                         $result_view = $view;
                                                      }
                                                      echo $result_view;
                                                      ?>
                                                   </span>
                                                   <span class="ml-15"><span class="mr-5 text-muted"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                                                      <?php
                                                      if ($total_likes > 1000) {
                                                         $result_total_share = floor($total_likes / 1000) . 'K';
                                                      } else if ($total_likes > 100000) {
                                                         $result_total_share = floor($total_likes / 100000) . 'M';
                                                      } else if ($total_likes > 10000000) {
                                                         $result_total_share = floor($total_likes / 10000000) . 'B';
                                                      } else {
                                                         $result_total_share = $total_likes;
                                                      }
                                                      echo $result_total_share;
                                                      ?>
                                                   </span>
                                                   <span class="ml-15"><span class="mr-5 text-muted"><i class="fa fa-comment" aria-hidden="true"></i></span>
                                                      <?php
                                                      if ($comment > 1000) {
                                                         $result_comment = floor($comment / 1000) . 'K';
                                                      } else if ($comment > 100000) {
                                                         $result_comment = floor($comment / 100000) . 'M';
                                                      } else if ($comment > 10000000) {
                                                         $result_comment = floor($comment / 10000000) . 'B';
                                                      } else {
                                                         $result_comment = $comment;
                                                      }
                                                      echo $result_comment;
                                                      ?>
                                                   </span>


                                                </div>
                                             </div>
                                       <?php
                                          }
                                       }
                                       ?>
                                    </div>
                                 </div>
                              </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-12 sidebar-right">
                              <!--Post aside style 1-->
                              <div class="sidebar-widget mb-30">
                                 <div class="widget-header position-relative mb-30">
                                    <div class="row">
                                       <div class="col-7">
                                          <h4 class="widget-title mb-0">ચૂકશો <span>નહીં</span></h4>
                                       </div>
                                       <!-- <div class="col-5 text-right">
                                          <h6 class="font-medium pr-15">
                                             <a class="text-muted font-small" href="#">View all</a>
                                          </h6>
                                       </div> -->
                                    </div>
                                 </div>
                                 <div class="sidebar-widget p-20 border-radius-15 bg-white widget-latest-comments wow fadeIn animated">
                                    <div class="widget-header mb-30">
                                       <h5 class="widget-title">છેલ્લી <span>ટિપ્પણી</span></h5>
                                    </div>
                                    <div class="post-block-list post-module-6">
                                       <?php
                                       $query11 = "SELECT * FROM `comment` LIMIT 4";
                                       $run_query11 = mysqli_query($con, $query11);
                                       if ($run_query11) {
                                          while ($data11 = mysqli_fetch_assoc($run_query11)) {
                                             $comment = $data11['comment'];
                                             $user_id = $data11['user_id'];
                                             $comment_timestamp = $data11['timestamp'];

                                             $query12 = "SELECT * FROM `users` WHERE `id` = $user_id";
                                             $run_query12 = mysqli_query($con, $query12);
                                             if ($run_query12) {
                                                while ($data12 = mysqli_fetch_assoc($run_query12)) {
                                                   $user_name = $data12['name'];
                                                   $user_img = $data12['user_img'];
                                                }
                                             }

                                       ?>
                                             <div class="last-comment mb-20 d-flex wow fadeIn animated">
                                                <span class="item-count vertical-align">
                                                   <a class="red-tooltip author-avatar" data-toggle="tooltip" data-placement="top" title="">
                                                      <img src="<?php echo $very_global_absolute_url; ?>admin/uploads/user-img/<?php echo $user_img; ?>" alt="">
                                                   </a>
                                                </span>
                                                <div class="alith_post_title_small">
                                                   <p class="font-medium mb-10"><a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"><?php echo $comment; ?></a></p>
                                                   <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase mb-10">
                                                      <span class="post-by">By <a><?php echo $user_name; ?></a></span>
                                                      <span class="post-on"><?php echo timeAgo($comment_timestamp); ?></span>
                                                   </div>
                                                </div>
                                             </div>
                                       <?php
                                          }
                                       }
                                       ?>

                                    </div>
                                 </div>
                              </div>

                              <!--Post aside style 2-->
                              <div class="sidebar-widget mb-30">
                                 <div class="widget-header mb-30">
                                    <h5 class="widget-title">ટોચના <span>વલણમાં</span></h5>
                                 </div>
                                 <?php
                                 //get trending post from database
                                 $query9 = "SELECT * FROM `blog` ORDER BY `view` DESC LIMIT 4";
                                 $run_query9 = mysqli_query($con, $query9);
                                 if ($run_query9) {

                                    while ($data9 = mysqli_fetch_assoc($run_query9)) {
                                       $author_id = $data9['added_by'];
                                       $unique_link = $data9['unique_link'];

                                       $query14 = "SELECT * FROM `users` WHERE `id` = $author_id";
                                       $run_query14 = mysqli_query($con, $query14);
                                       // $run_query14 = mysqli_query($con, $query14);
                                       if ($run_query14) {
                                          $data14 = mysqli_fetch_assoc($run_query14);
                                          $author_name_top_trending_section = $data14['name'];
                                       }
                                 ?>
                                       <div class="post-aside-style-2">
                                          <ul class="list-post">
                                             <li class="mb-30 wow fadeIn animated">
                                                <div class="d-flex">
                                                   <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                                      <a class="color-white" href="blog/<?php echo $unique_link; ?>">
                                                         <div style="background-image: url('<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data9['thumbnail_img']; ?>'); background-repeat: no-repeat;
                                                      background-size: cover; height:60px; width:80px;">
                                                         </div>
                                                      </a>
                                                   </div>
                                                   <div class="post-content media-body">
                                                      <h6 class="post-title mb-10 text-limit-2-row"><a href="blog/<?php echo $unique_link; ?>"><?php echo $data9['blog_title']; ?></a></h6>
                                                      <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                                         <span class="post-by">By <a><?php echo $author_name_top_trending_section; ?></a></span>
                                                         <span class="post-on">4m ago</span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </li>
                                          </ul>
                                       </div>
                                 <?php
                                    }
                                 }
                                 ?>

                              </div>
                              <!--Newsletter-->
                              <div class="sidebar-widget widget_newsletter border-radius-10 p-20 bg-white mb-30">
                                 <div class="widget-header widget-header-style-1 position-relative mb-15">
                                    <h5 class="widget-title">Newsletter</h5>
                                 </div>
                                 <div class="newsletter">
                                    <p class="font-medium">Be register and get latest updates from our blogs</p>
                                    <form target="_blank" action="#" method="get" class="subscribe_form relative mail_part">
                                       <div class="form-newsletter-cover">
                                          <div class="form-newsletter position-relative">
                                             <input type="email" name="EMAIL" placeholder="Put your email here" required="">
                                             <button type="submit">
                                                <i class="fas fa-email"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                  </div>
                  <div class="row mb-50 mt-15">
                     <div class="col-md-12">
                        <div class="widget-header position-relative mb-30">
                           <h4 class="widget-title mb-0">From<span class="ml-5">
                                 <?php
                                 $query_get_category_title = "SELECT * FROM `category_list` WHERE `id` = 2";
                                 $run_query_get_category_title = mysqli_query($con, $query_get_category_title);
                                 if ($run_query_get_category_title) {
                                    $data10 = mysqli_fetch_assoc($run_query_get_category_title);
                                    echo $data10['name'];
                                 }
                                 ?>
                              </span></h4>
                        </div>
                        <div class="post-carausel-2 post-module-1 row">
                           <?php
                           $query6 = "SELECT * FROM `blog` WHERE `category_id` = 2";
                           $run_query6 = mysqli_query($con, $query6);
                           while ($data6 = mysqli_fetch_assoc($run_query6)) {
                              $blog_id = $data6['id'];
                              $unique_link = $data6['unique_link'];
                              $view = $data6['view'];
                              $comment = $data6['comment'];
                           ?>
                              <div class="col">
                                 <div class="post-thumb position-relative">
                                    <div class="thumb-overlay img-hover-slide border-radius-15 position-relative" style="background-image: url(<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data6['thumbnail_img']; ?>)">
                                       <a class="img-link" href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"></a>
                                       <div class="post-content-overlay">
                                          <h5 class="post-title">
                                             <a class="color-white" href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"><?php echo $data6['blog_title']; ?></a>
                                          </h5>
                                          <div class="entry-meta meta-1 font-x-small mt-10 pr-5 pl-5 text-muted">
                                             <span><span class="mr-5"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                <?php
                                                if ($view > 1000) {
                                                   $result_view = floor($view / 1000) . 'K';
                                                } else if ($view > 100000) {
                                                   $result_view = floor($view / 100000) . 'M';
                                                } else if ($view > 10000000) {
                                                   $result_view = floor($view / 10000000) . 'B';
                                                } else {
                                                   $result_view = $view;
                                                }
                                                echo $result_view;
                                                ?>
                                             </span>
                                             <span><span class="mr-5"><i class="fa fa-comment" aria-hidden="true"></i></span>
                                                <?php
                                                if ($comment > 1000) {
                                                   $result_comment = floor($comment / 1000) . 'K';
                                                } else if ($comment > 100000) {
                                                   $result_comment = floor($comment / 100000) . 'M';
                                                } else if ($comment > 10000000) {
                                                   $result_comment = floor($comment / 10000000) . 'B';
                                                } else {
                                                   $result_comment = $comment;
                                                }
                                                echo $result_comment;
                                                ?>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           <?php
                           }
                           ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <!-- Footer Start-->
      <?php require_once 'elements/footer.php'; ?>
   </div>
   <!-- fontawesome -->
   <!-- Main Wrap End-->
   <div class="dark-mark"></div>
   <!-- Vendor JS-->
   <script src="https://kit.fontawesome.com/12af21ff9f.js" crossorigin="anonymous"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/modernizr-3.6.0.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery-3.6.0.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/popper.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/bootstrap.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.slicknav.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/owl.carousel.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/slick.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/wow.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/animated.headline.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.magnific-popup.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.ticker.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.vticker-min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.scrollUp.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.nice-select.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.sticky.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/perfect-scrollbar.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/waypoints.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.counterup.min.js"></script>
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/jquery.theia.sticky.js"></script>
   <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
   <!-- NewsViral JS -->
   <script src="<?php echo $very_global_absolute_url; ?>assets/js/main.js"></script>
   <!-- Slick Slider JS -->
   <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
   <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="<?php echo $very_global_absolute_url; ?>assets/js/vendor/slick.min.js"></script>
   <script type="text/javascript" src="https://kit.fontawesome.com/12af21ff9f.js"></script>
   <!-- Swiper JS -->
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   <!-- Initialize Swiper -->
   <script>
      var swiper = new Swiper(".hero_slider", {
         slidesPerView: 1.5,
         spaceBetween: 30,
         loop: true,
         centeredSlides: true,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });
   </script>
</body>

</html>