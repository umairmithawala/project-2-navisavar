<?php
session_start();
require_once 'database/db-con.php';
?>

<?php

if (isset($_GET['category_link'])) {
    $category_link = $_GET['category_link'];
} else {
?>
    <script>
        window.location.href = "<?php echo $very_global_absolute_url; ?>";
    </script>
<?php
}
?>
<?php

if (isset($_GET['page'])) {
    $page_no = $_GET['page'];
} else {
    $page_no = 1;
}
$post_per_page = 5;
$offset = $post_per_page * ($page_no - 1);

?>
<?php


//get category id from category_list link from blog table
$sql = "SELECT * FROM category_list WHERE unique_link = '$category_link'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$category_blog_page_category_id = $row['id'];
$category_name = $row['name'];




?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blogs from <?php echo $category_name; ?></title>
    <meta name="referrer" content="always" />
    <meta name="robots" content="all" />
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />

    <meta name="title" content="Blogs from <?php echo $category_name; ?>">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="https://anzarkhan.com">


    <meta property="fb:app_id" content="1168702680615201" />
    <meta property="og:title" content="Blogs from <?php echo $category_name; ?>" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="https://navisavar.com/category/<?php echo $category_link; ?>" />
    <meta property="og:image" content="<?php echo $very_global_absolute_url; ?>assets/imgs/logo/navisavar-logo.png" />
    <meta property="og:description" content="">


    <!--Twitter-->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@NaviSavar" />
    <meta name="twitter:title" content="Blogs from <?php echo $category_name; ?>" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="<?php echo $very_global_absolute_url; ?>assets/imgs/logo/navisavar-logo.png" />
    <meta name="twitter:url" content="https://navisavar.com/category/<?php echo $category_link; ?>" />
    <!--End Twitter card tag -->


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $very_global_absolute_url; ?>assets/imgs/favicon/favicon.png">
    <!-- NewsViral CSS  -->
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/widgets.css">
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/color.css">
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/responsive.css">
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

        <!-- Main Header -->
        <?php
        require_once 'elements/header.php'
        ?>
        <!-- Main Wrap Start -->
        <main class="position-relative">
            <div class="archive-header text-center mb-50">
                <div class="container">
                    <h2>
                        <span class="text-dark widget-title mb-0">From
                            <span>
                                <?php
                                echo $category_name;
                                ?>
                            </span>
                        </span>
                        <?php

                        ?>


                        <span class="post-count">
                            <?php


                            $query_get_blog_number = "SELECT * FROM `blog` WHERE `category_id` = $category_blog_page_category_id AND `is_deleted` = 0 ";
                            $result_get_blog_number = mysqli_query($con, $query_get_blog_number);
                            $blog_number = mysqli_num_rows($result_get_blog_number);
                            echo $blog_number;

                            ?>
                            articles
                        </span>
                    </h2>
                    <div class="breadcrumb">
                        <!-- <span class="no-arrow"><i class="fas fa-map-marker-alt mr-5"></i>You are here : </span> -->
                        <a href="<?php echo $very_global_absolute_url; ?>" rel="nofollow">
                            <p style="display: inline-block !important;">Home</p>
                        </a>
                        <i class="fas fa-chevron-right"></i>
                        Category
                        <i class="fas fa-chevron-right"></i>
                        <a href="<?php echo $very_global_absolute_url; ?>category/<?php echo $category_link; ?>" rel="nofollow">
                            <p style="display: inline-block !important;"><?php echo $category_name; ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row post-module-1 mb-50">
                    <?php
                    $query2 = "SELECT * FROM `blog` WHERE `category_id` = $category_blog_page_category_id ORDER BY publish_date DESC LIMIT $offset, $post_per_page";
                    $run_query2 = mysqli_query($con, $query2);
                    if ($run_query2 == true) {
                        while ($data2 = mysqli_fetch_assoc($run_query2)) {
                            $blog_id = $data2['id'];
                            $unique_link = $data2['unique_link'];
                            $blog_title = $data2['blog_title'];
                            $thumbnail_img = $data2['thumbnail_img'];
                            $view = $data2['view'];
                            $comment = $data2['comment'];
                            $total_likes = $data2['likes'];
                            $category_id = $data2['category_id'];

                            $query3 = "SELECT * FROM `category_list` WHERE `id` = $category_blog_page_category_id";
                            $run_query3 = mysqli_query($con, $query3);
                            $data3 = mysqli_fetch_assoc($run_query3);


                    ?>
                            <article class="col-lg-3 col-md-6 col-sm-12 mb-30">
                                <div class="post-thumb position-relative p-10 bg-white border-radius-10">
                                    <div class="thumb-overlay img-hover-slide border-radius-15 position-relative" style="background-image: url(<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $thumbnail_img; ?>);">
                                        <a class="img-link" href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"></a>
                                        <div class="post-content-overlay">
                                            <div class="entry-meta meta-0 font-small mb-15">
                                                <a href="<?php echo $very_global_absolute_url; ?>category/<?php echo $data3['unique_link']; ?>"><span class="post-cat bg-success color-white"><?php echo $data3['name']; ?></span></a>
                                            </div>
                                            <h5 class="post-title">
                                                <a class="color-white" href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link; ?>"><?php echo $blog_title; ?></a>
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

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                    <?php
                        }
                    }
                    ?>
                </div>
                <?php

                //get total number of pages
                $query_get_total_pages = "SELECT * FROM `blog` WHERE `category_id` = $category_blog_page_category_id ORDER BY publish_date DESC";
                $run_query_get_total_pages = mysqli_query($con, $query_get_total_pages);
                $total_pages = mysqli_num_rows($run_query_get_total_pages);
                $total_pages = ceil($total_pages / $post_per_page);

                //get previous page number  
                $previous_page = $page_no - 1;
                if ($previous_page == 0) {
                    $previous_page = 1;
                }
                //get next page number
                $next_page = $page_no + 1;
                if ($next_page > $total_pages) {
                    $next_page = $total_pages;
                }


                ?>
                  <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="pagination-area mb-30">
                            <nav aria-label="Page navigation example text-center">
                                <ul class="pagination d-flex justify-content-center">
                                    <li class="page-item"><a class="page-link" href="<?php echo $very_global_absolute_url; ?>category/<?php echo $category_link; ?>/<?php echo $previous_page; ?>"><i class="fas fa-arrow-left"></i></a></li>
                                    
                                    <?php

                                    if ($total_pages <= 3) {

                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $page_no) {
                                                echo '<li class="page-item active"><a class="page-link" href="'.$very_global_absolute_url.'category/'.$category_link.'/' . $i . '">' . $i . '</a></li>';
                                            } else {
                                                echo '<li class="page-item"><a class="page-link" href="'.$very_global_absolute_url.'category/'.$category_link.'/' . $i . '">' . $i . '</a></li>';
                                            }
                                        }
                                    } else {
                                        if ($page_no == 1) {
                                            echo '<li class="page-item active"><a class="page-link" href="'.$very_global_absolute_url.'category/'.$category_link.'/1">1</a></li>';
                                        } else {
                                            echo '<li class="page-item"><a class="page-link" href="'.$very_global_absolute_url.'category/'.$category_link.'/1">1</a></li>';
                                        }
                                        if ($page_no == 1 || $page_no == $total_pages) {

                                            echo '<li class="page-item">...</li>';
                                        } else {
                                            echo '<li class="page-item">...</li>';
                                            echo '<li class="page-item active"><a class="page-link" href="'.$very_global_absolute_url.'category/'.$category_link.'/' . $page_no . '">' . $page_no . '</a></li>';

                                            echo '<li class="page-item">...</li>';
                                        }
                                        if ($page_no == $total_pages) {
                                            echo '<li class="page-item active"><a class="page-link" href="'.$very_global_absolute_url.'category/'.$category_link.'/' . $total_pages . '">' . $total_pages . '</a></li>';
                                        } else {
                                            echo '<li class="page-item"><a class="page-link" href="'.$very_global_absolute_url.'category/'.$category_link.'/' . $total_pages . '">' . $total_pages . '</a></li>';
                                        }
                                    }


                                    ?>
                                    <li class="page-item"><a class="page-link" href="<?php echo $very_global_absolute_url; ?>category/<?php echo $category_link; ?>/<?php echo $next_page; ?>"><i class="fas fa-arrow-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

            </div>
        </main>
        <!-- Footer Start-->
        <?php require_once 'elements/footer.php'; ?>
    </div> <!-- Main Wrap End-->
    <div class="dark-mark"></div>
    <!-- Vendor JS-->
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
    <script src="<?php echo $very_global_absolute_url; ?>assets/js/main.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/12af21ff9f.js"></script>
</body>

</html>