<?php
session_start();
require_once 'database/db-con.php';
require_once 'utility/convert-time-ago.php';
?>

<?php

if (isset($_GET['blog_link'])) {
    $blog_link = $_GET['blog_link'];
} else {
?>
    <script>
        window.location.href = "<?php echo $very_global_absolute_url; ?>";
    </script>
    <?php
}



//get blog id from blog link from blog table
$sql = "SELECT * FROM blog WHERE unique_link = '$blog_link'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$blog_id = $row['id'];


$query1 = "SELECT * FROM `blog` WHERE `id` = $blog_id";
$run_query1 = mysqli_query($con, $query1);
if ($run_query1) {
    $data1 = mysqli_fetch_assoc($run_query1);
    $blog_title = $data1['blog_title'];
    $blog_body = $data1['blog_body'];
    //decode htmlspecialchars
    $blog_body = htmlspecialchars_decode($blog_body);
    $blog_category_id = $data1['category_id'];
    $thumbnail_img = $data1['thumbnail_img'];
    $author_id = $data1['added_by'];
    $publish_date = $data1['publish_date'];
    $publish_date_format = date('d/m/Y', $publish_date);
    $comment = $data1['comment'];
    $likes = $data1['likes'];
    $view = $data1['view'];
    $keywords = $data1['keywords'];

    $number_of_views_needs_to_add = $view + 1;

    //insert view with increment
    $query2 = "UPDATE `blog` SET `view` = $number_of_views_needs_to_add WHERE `id` = $blog_id";
    $run_query2 = mysqli_query($con, $query2);



    $query2 = "SELECT * FROM `category_list` WHERE `id` = $blog_category_id";
    $run_query2 = mysqli_query($con, $query2);
    if ($run_query2) {
        $data2 = mysqli_fetch_assoc($run_query2);
        $category_name = $data2['name'];
        $category_unique_link = $data2['unique_link'];
    }

    $query3 = "SELECT * FROM `users` WHERE `id` = $author_id";
    $run_query3 = mysqli_query($con, $query3);
    if ($run_query3) {
        $data3 = mysqli_fetch_assoc($run_query3);
        $author_name = $data3['name'];
    }
}

$r = 0;

if (isset($_POST['submit_comment'])) {


    if (isset($_SESSION['user_id_session'])) {

        $user_session_id = $_SESSION['user_id_session'];
        $comment = $_POST['comment'];
        $timestamp = time();


        $query15 = "INSERT INTO `comment`(`id`, `blog_id`, `user_id`, 
    `comment`, `is_deleted`, `timestamp`) VALUES 
    (NULL,'$blog_id',$user_session_id,'$comment',0,$timestamp)";
        $run_query15 = mysqli_query($con, $query15);
        if ($run_query15) {
        }
    } else {
        $r = 1;
    }
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $blog_title; ?> - નવી સવાર </title>
    <meta name="referrer" content="always" />
    <meta name="robots" content="all" />
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />

    <meta name="title" content="<?php echo $blog_title; ?>  - નવી સવાર">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="https://anzarkhan.com">


    <meta property="fb:app_id" content="1168702680615201" />
    <meta property="og:title" content="<?php echo $blog_title; ?>  - નવી સવાર" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="https://navisavar.com/" />
    <meta property="og:image" content="<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $thumbnail_img; ?>" />
    <meta property="og:description" content="">


    <!--Twitter-->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@NaviSavar" />
    <meta name="twitter:title" content="<?php echo $blog_title; ?>  - નવી સવાર" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $thumbnail_img; ?>" />
    <meta name="twitter:url" content="https://navisavar.com" />
    <!--End Twitter card tag -->


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $very_global_absolute_url; ?>assets/imgs/favicon/favicon.png">
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/widgets.css">
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/color.css">
    <link rel="stylesheet" href="<?php echo $very_global_absolute_url; ?>assets/css/responsive.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    </link>
    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
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
        <!-- Main Header -->
        <?php require_once 'elements/header.php'; ?>

        <?php

        if (isset($_SESSION['user_id_session'])) {
            $user_id_session = $_SESSION['user_id_session'];
        }
        ?>

        <!-- Main Wrap Start -->
        <main class="position-relative">
            <div class="container">
                <div class="entry-header entry-header-3 mb-50 mt-50 text-center text-white">
                   
                        <!-- <div class="position-midded">
                            <div class="entry-meta meta-0 font-small mb-30">
                                <a href="<?php echo $very_global_absolute_url; ?>/category/<?php echo $category_unique_link; ?>">
                                    <span class="post-cat bg-warning color-white"><?php echo $category_name; ?></span>
                                </a>
                            </div>
                            <h1 class="post-title mb-30 text-white">
                                <?php echo $blog_title; ?>
                            </h1>
                            <div class="entry-meta meta-1 font-x-small color-grey text-uppercase text-white">
                                <span class="post-by text-white">By <a class="text-white"> <?php echo $author_name; ?> </a></span>
                                <span class="post-on text-white"><?php echo $publish_date_format; ?></span>
                                <?php

                                //calculate how much time to read blog according to $blog_body length
                                $blog_body_length = strlen($blog_body);
                                $blog_body_length_min = $blog_body_length / 200;
                                $blog_body_length_min = ceil($blog_body_length_min);


                                ?>
                                <span class="time-reading text-white"><?php echo $blog_body_length_min; ?> mins read</span>
                                <p class="font-x-small mt-10 text-white">
                                    <span class="hit-count"><i class="fas fa-eye mr-5"></i>
                                        <?php if ($view > 1000) {
                                            $result_view = floor($view / 1000) . 'K';
                                        } else if ($view > 100000) {
                                            $result_view = floor($view / 100000) . 'M';
                                        } else if ($view > 10000000) {
                                            $result_view = floor($view / 10000000) . 'B';
                                        } else {
                                            $result_view = $view;
                                        }
                                        echo $result_view; ?>
                                        Views
                                    </span>
                                    <span class="hit-count"><i class="fas fa-heart mr-5"></i>
                                        <?php if ($likes > 1000) {
                                            $result_likes = floor($likes / 1000) . 'K';
                                        } else if ($likes > 100000) {
                                            $result_likes = floor($likes / 100000) . 'M';
                                        } else if ($likes > 10000000) {
                                            $result_likes = floor($likes / 10000000) . 'B';
                                        } else {
                                            $result_likes = $likes;
                                        }
                                        echo $result_likes; ?>
                                        Likes
                                    </span>
                                    <span class="hit-count"><i class="fas fa-comment mr-5"></i>
                                        <?php if ($comment > 1000) {
                                            $result_comment = floor($comment / 1000) . 'K';
                                        } else if ($comment > 100000) {
                                            $result_comment = floor($comment / 100000) . 'M';
                                        } else if ($comment > 10000000) {
                                            $result_comment = floor($comment / 10000000) . 'B';
                                        } else {
                                            $result_comment = $comment;
                                        }
                                        echo $result_comment; ?>
                                        Comments
                                    </span>

                                </p>
                            </div>
                        </div> -->
                </div>
                <!--end entry header-->
                <div class="row mb-50">
                    <div class="col-lg-2 d-none d-lg-block"></div>
                    <div class="col-lg-8 col-md-12">
                        <div class="single-social-share single-sidebar-share mt-30">

                            <ul>
                                <li><a class="social-icon facebook-icon text-xs-center" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>&title=<?php echo $blog_title; ?>"><i class="fab fa-facebook"></i></a></li>
                                <li><a class="social-icon twitter-icon text-xs-center" target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>"><i class="fab fa-twitter"></i></a></li>
                                <li><a style="color: #25D366;" class="social-icon pinterest-icon text-xs-center" target="_blank" href="whatsapp://send?text=<?php echo $blog_title; ?>.Visit <?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a class="social-icon linkedin-icon text-xs-center" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>"><i class="fab fa-linkedin"></i></a></li>
                                <!-- <li><a style="color:#C5221F;" class="social-icon email-icon text-xs-center" target="_blank" href="#"><i class="fas fa-at"></i></a></li> -->
                            </ul>
                        </div>
                        <!-- blog body -->
                        <div class="entry-meta meta-0 font-small mb-30">
                                <a href="<?php echo $very_global_absolute_url; ?>/category/<?php echo $category_unique_link; ?>">
                                    <span class="post-cat bg-warning text-white"><?php echo $category_name; ?></span>
                                </a>
                            </div>
                            <h1 class="post-title mb-30 ">
                                <?php echo $blog_title; ?>
                            </h1>
                            <div class="entry-meta meta-1 font-x-small color-grey text-uppercase ">
                                <span class="post-by ">By <a class=""> <?php echo $author_name; ?> </a></span>
                                <span class="post-on"><?php echo $publish_date_format; ?></span>
                                <?php

                                //calculate how much time to read blog according to $blog_body length
                                $blog_body_length = strlen($blog_body);
                                $blog_body_length_min = $blog_body_length / 200;
                                $blog_body_length_min = ceil($blog_body_length_min);


                                ?>
                                <span class="time-reading"><?php echo $blog_body_length_min; ?> mins read</span>
                                <p class="font-x-small mt-10">
                                    <span class="hit-count"><i class="fas fa-eye mr-5"></i>
                                        <?php if ($view > 1000) {
                                            $result_view = floor($view / 1000) . 'K';
                                        } else if ($view > 100000) {
                                            $result_view = floor($view / 100000) . 'M';
                                        } else if ($view > 10000000) {
                                            $result_view = floor($view / 10000000) . 'B';
                                        } else {
                                            $result_view = $view;
                                        }
                                        echo $result_view; ?>
                                        Views
                                    </span>
                                    <span class="hit-count"><i class="fas fa-heart mr-5"></i>
                                        <?php if ($likes > 1000) {
                                            $result_likes = floor($likes / 1000) . 'K';
                                        } else if ($likes > 100000) {
                                            $result_likes = floor($likes / 100000) . 'M';
                                        } else if ($likes > 10000000) {
                                            $result_likes = floor($likes / 10000000) . 'B';
                                        } else {
                                            $result_likes = $likes;
                                        }
                                        echo $result_likes; ?>
                                        Likes
                                    </span>
                                    <span class="hit-count"><i class="fas fa-comment mr-5"></i>
                                        <?php if ($comment > 1000) {
                                            $result_comment = floor($comment / 1000) . 'K';
                                        } else if ($comment > 100000) {
                                            $result_comment = floor($comment / 100000) . 'M';
                                        } else if ($comment > 10000000) {
                                            $result_comment = floor($comment / 10000000) . 'B';
                                        } else {
                                            $result_comment = $comment;
                                        }
                                        echo $result_comment; ?>
                                        Comments
                                    </span>

                                </p>
                            </div>
                        <div class="entry-main-content" id="entry_main_content" style="background-color: #fff; padding: 30px;">
                        <div class="thumb-overlay img-hover-slide border-radius-5 position-relative mb-50" style="height: 600px; background-image: url(<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $thumbnail_img; ?>)">
                                    </div>    
                        <?php echo $blog_body; ?>
                        </div>
                        <!-- like and dislike box -->
                        <div class="card pb-0 mt-50 border-0 rounded" style="background-color: #F58634;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="pt-10" style="color: #fff;font-weight: 600;letter-spacing: 1px;">
તમને આ બ્લોગ કેવો લાગે છે?</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <?php
                                            if (isset($_SESSION['user_id_session'])) {

                                                //check blog_id and user_id  is already liked or not
                                                $query19 = "SELECT * FROM `like` WHERE `user_id` = '$user_id_session' AND `blog_id` = '$blog_id '";
                                                $run_query19 = mysqli_query($con, $query19);
                                                $row19 = mysqli_num_rows($run_query19);

                                                if ($row19 > 0) {

                                                    echo '<div class="col-md-6 single-social-share">
                                                <a href="' . $very_global_absolute_url . '/utility/blog-like.php?blog_id=' . $blog_id . '" class="mb-0"><i class="fas fa-thumbs-up"></i></a>
                                            </div>';
                                                } else {

                                                    echo '<div class="col-md-6 single-social-share">
                                                <a href="' . $very_global_absolute_url . '/utility/blog-like.php?blog_id=' . $blog_id . '" class="mb-0"><i class="far fa-thumbs-up"></i></a>
                                            </div>';
                                                }
                                            } else {
                                                echo '<div class="col-md-6 single-social-share">
                                            <a href="" data-toggle="modal" data-target="#exampleModal" class="mb-0"><i class="far fa-thumbs-up"></i></a>
                                        </div>';
                                            }
                                            ?>

                                            <?php
                                            if (isset($_SESSION['user_id_session'])) {
                                                //check blog_id and user_id  is already disliked or not
                                                $query20 = "SELECT * FROM `dislike` WHERE `user_id` = '$user_id_session' AND `blog_id` = '$blog_id '";
                                                $run_query20 = mysqli_query($con, $query20);
                                                $row20 = mysqli_num_rows($run_query20);

                                                if ($row20 > 0) {
                                                    echo '<div class="col-md-6 single-social-share">
                                                <a href="' . $very_global_absolute_url . '/utility/blog-dislike.php?blog_id=' . $blog_id . '" class="mb-0"><i class="fas fa-thumbs-down"></i></a>
                                            </div>';
                                                } else {
                                                    echo '<div class="col-md-6 single-social-share">
                                                <a href="' . $very_global_absolute_url . '/utility/blog-dislike.php?blog_id=' . $blog_id . '" class="mb-0"><i class="far fa-thumbs-down"></i></a>
                                            </div>';
                                                }
                                            } else {
                                                echo '<div class="col-md-6 single-social-share">
                                                <a data-toggle="modal" data-target="#exampleModal" href="" class="mb-0"><i class="far fa-thumbs-down"></i></a>
                                            </div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- like share comment view -->
                        <div class="entry-bottom mt-50 mb-30">
                            <div class="font-weight-500 entry-meta meta-1 font-x-small color-grey">
                                <span class="update-on"><i class="fas fa-upload mr-5"></i>
                                    <?php echo $publish_date_format; ?></span>

                                <span class="hit-count"><i class="fas fa-eye mr-5"></i>
                                    <?php if ($view > 1000) {
                                        $result_view = floor($view / 1000) . 'K';
                                    } else if ($view > 100000) {
                                        $result_view = floor($view / 100000) . 'M';
                                    } else if ($view > 10000000) {
                                        $result_view = floor($view / 10000000) . 'B';
                                    } else {
                                        $result_view = $view;
                                    }
                                    echo $result_view; ?>
                                    Views
                                </span>
                                <span class="hit-count"><i class="fas fa-heart mr-5"></i>
                                    <?php if ($likes > 1000) {
                                        $result_likes = floor($likes / 1000) . 'K';
                                    } else if ($likes > 100000) {
                                        $result_likes = floor($likes / 100000) . 'M';
                                    } else if ($likes > 10000000) {
                                        $result_likes = floor($likes / 10000000) . 'B';
                                    } else {
                                        $result_likes = $likes;
                                    }
                                    echo $result_likes; ?>
                                    likes
                                </span>
                                <span class="hit-count"><i class="fas fa-comment"></i>
                                    <?php if ($comment > 1000) {
                                        $result_comment = floor($comment / 1000) . 'K';
                                    } else if ($comment > 100000) {
                                        $result_comment = floor($comment / 100000) . 'M';
                                    } else if ($comment > 10000000) {
                                        $result_comment = floor($comment / 10000000) . 'B';
                                    } else {
                                        $result_comment = $comment;
                                    }
                                    echo $result_comment; ?>
                                    comments
                                </span>

                            </div>
                            <div class="overflow-hidden mt-30">
                                <div class="tags float-left text-muted mb-md-30">
                                    <span class="font-small mr-10"><i class="fa fa-tag mr-5"></i>Tags: </span>
                                    <?php
                                    $tags = explode(',', $keywords);
                                    foreach ($tags as $tag_result) {
                                    ?>
                                        <a rel="tag"><?php echo $tag_result; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="single-social-share float-right">
                                    <?php
                                    $query17 = "SELECT * FROM `blog`";
                                    $result17 = mysqli_query($con, $query17);
                                    $data17 = mysqli_fetch_assoc($result17);
                                    $social_media_blog_title = $data17['blog_title'];
                                    $social_media_blog_unique_link = $data17['unique_link'];


                                    ?>
                                    <ul class="d-inline-block list-inline">
                                        <li class="list-inline-item"><a class="social-icon facebook-icon text-xs-center" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>&title=<?php echo $blog_title; ?>"><i class="fab fa-facebook"></i></a></li>
                                        <li class="list-inline-item"><a class="social-icon twitter-icon text-xs-center" target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>"><i class="fab fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a style="color: #25D366;" class="social-icon pinterest-icon text-xs-center" target="_blank" href="whatsapp://send?text=<?php echo $blog_title; ?>.Visit <?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>"><i class="fab fa-whatsapp"></i></a></li>
                                        <li class="list-inline-item"><a class="social-icon linkedin-icon text-xs-center" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $very_global_absolute_url . 'blog/' . $blog_link; ?>"><i class="fab fa-linkedin"></i></a></li>
                                        <!-- <li><a style="color:#C5221F;" class="social-icon email-icon text-xs-center" target="_blank" href="#"><i class="fas fa-at"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--related posts-->
                        <div class="related-posts">
                            <h3 class="mb-30">Related posts</h3>
                            <div class="row">
                                <?php


                                $query4 = "SELECT * FROM `blog` WHERE `category_id` = $blog_category_id ORDER BY publish_date DESC LIMIT 3";
                                $run_query4 = mysqli_query($con, $query4);
                                if ($run_query4) {
                                    while ($data4 = mysqli_fetch_assoc($run_query4)) {
                                        $category_id_rel_blog = $data4['category_id'];
                                        $author_id_rel_blog = $data4['added_by'];
                                        $rel_blog_unique_link = $data4['unique_link'];
                                        $rel_publish_date = $data4['publish_date'];

                                        $query5 = "SELECT * FROM `category_list` WHERE `id` = $category_id_rel_blog";
                                        $run_query5 = mysqli_query($con, $query5);
                                        if ($run_query5) {
                                            $data5 = mysqli_fetch_assoc($run_query5);
                                        }

                                        $query6 = "SELECT * FROM `users` WHERE `id` = $author_id_rel_blog";
                                        $run_query6 = mysqli_query($con, $query6);
                                        if ($run_query6) {
                                            $data6 = mysqli_fetch_assoc($run_query6);
                                        }
                                ?>
                                        <article class="col-lg-4">
                                            <div class="background-white border-radius-10 p-10 mb-30">
                                                <div class="post-thumb d-flex mb-15 border-radius-15 img-hover-scale">
                                                    <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $rel_blog_unique_link; ?>">
                                                        <div class="border-radius-15" style="background-image: url(<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data4['thumbnail_img']; ?>); width:250px; height:150px; background-position: center; background-repeat: no-repeat;  background-size: cover;">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="pl-10 pr-10">
                                                    <div class="entry-meta mb-15 mt-10">
                                                        <a class="entry-meta meta-2" href="<?php echo $very_global_absolute_url; ?>category/<?php echo $data5['unique_link']; ?>"><span class="post-in text-primary font-x-small"><?php echo $data5['name']; ?></span></a>
                                                    </div>
                                                    <h5 class="post-title mb-15">
                                                        <a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $rel_blog_unique_link; ?>"><?php echo $data4['blog_title']; ?></a>
                                                    </h5>
                                                    <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase mb-10">
                                                        <span class="post-by">By <a><?php echo $data6['name']; ?></a></span>
                                                        <span class="post-on"><? echo timeAgo($rel_publish_date); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                <?php
                                    }
                                }

                                ?>
                            </div>
                        </div>
                        <!--Comments-->
                        <div class="comments-area">
                            <h3 class="mb-30">
                                <?php
                                $query16 = "SELECT * FROM `comment` WHERE `blog_id` = $blog_id AND `is_deleted` = 0";
                                $run_query16 = mysqli_query($con, $query16);
                                $num_of_rows = mysqli_num_rows($run_query16);
                                echo $num_of_rows;
                                ?>
                                Comments
                            </h3>
                            <?php

                            $query7 = "SELECT * FROM `comment` WHERE `blog_id` = $blog_id AND `is_deleted` = 0";
                            $run_query7 = mysqli_query($con, $query7);
                            $num_of_rows = mysqli_num_rows($run_query7);
                            if ($run_query7) {
                                while ($data7 = mysqli_fetch_assoc($run_query7)) {
                                    $user_id = $data7['user_id'];
                                    $comment = $data7['comment'];
                                    $add_comment_date = $data7['timestamp'];

                                    $query8 = "SELECT * FROM `users` WHERE `id` = $user_id";
                                    $run_query8 = mysqli_query($con, $query8);
                                    if ($run_query8) {
                                        $data8 = mysqli_fetch_assoc($run_query8);
                                        $blog_add_time = $data8['timestamp'];
                                        $blog_add_time_format = date('M d,Y', $blog_add_time);
                                        $comment_user_img = $data8['user_img'];
                                    }
                            ?>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                <img src="<?php echo $very_global_absolute_url; ?>admin/uploads/user-img/<?php echo $comment_user_img; ?>" alt="">
                                                </div>
                                                <div class="desc">
                                                    <p class="comment">
                                                        <?php echo $comment; ?>
                                                    </p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <h5>
                                                                <a><?php echo $data8['name']; ?></a>
                                                            </h5>
                                                            <p class="date"><?php echo $blog_add_time_format; ?> </p>
                                                        </div>
                                                        <!-- <div class="reply-btn">
                                                            <a href="#" class="btn-reply text-uppercase ml-20">reply</a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }

                            ?>

                        </div>
                        <!--leave reply-->
                        <div class="comment-form">
                            <h3 class="mb-30">Leave a Reply</h3>
                            <form class="form-contact comment_form" id="commentForm" method="POST">
                                <div class="row">
                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button button-contactForm" name="submit_comment">Post Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <!-- Footer Start-->
        <?php require_once 'elements/footer.php' ?>
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
    <!-- sweet alert CDN -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
 
    var r = <?php echo $r; ?>;

        if (r == 1) {
            swal("error", "You are not logged in", "error");
        }
    </script>
    <script>
        //get blog body paragraph
        
        var blog_body_content = document.getElementById('blog_body_content');

        //get all peragraphs
        var all_paragraphs = blog_body_content.getElementsByTagName('p');

        console.log(all_paragraphs.length);

        //set background color for all paragraphs none 
        for (var i = 0; i < all_paragraphs.length; i++) {
            all_paragraphs[i].style.backgroundColor = 'none';
            //get all spans
            var all_spans = all_paragraphs[i].getElementsByTagName('span');
            //set background color for all spans none
            for (var j = 0; j < all_spans.length; j++) {
                all_spans[j].style.backgroundColor = 'none';
                console.log(all_spans[j]);
            }

            
        }
    </script>
        <script>
        //get all span tag from id entry_main_content
        var span_tag = document.getElementById('entry_main_content').getElementsByTagName('span');
        //set width auto for all span tag
        for (var i = 0; i < span_tag.length; i++) {
            span_tag[i].style.width = 'auto';
            //height auto for all span tag
            span_tag[i].style.height = 'auto';
        }

        //get all img tag inside span tag if exist
        for (var i = 0; i < span_tag.length; i++) {
            var img_tag = document.getElementById('entry_main_content').getElementsByTagName('span')[i].getElementsByTagName('img');
            //set width auto for all img tag
            for (var j = 0; j < img_tag.length; j++) {
                img_tag[j].style.width = '100%';
                //height auto for all img tag
                img_tag[j].style.height = 'auto';
            }
        }
    </script>
</body>

</html>