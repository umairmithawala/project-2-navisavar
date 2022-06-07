<?php
session_start();
require_once '../database/db-con.php';
?>
<?php
if (isset($_SESSION['user_session_var'])) {
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
   <title>List all blogs - Dashboard</title>
   <!-- Vendors Style-->
   <link rel="stylesheet" href="assets/css/vendors_css.css">
   <!-- Style-->
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/skin_color.css">
   <!-- Font awesome css -->
   <link rel="stylesheet" href="assets/css/all.min.css">
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
                  <div class="col-xl-12">
                     <h2 class="my-20 text-dark">Blog List</h2>
                  </div>
                  <?php
                  //get all blog col
                  $query = "SELECT * FROM `blog` WHERE `is_deleted` = 0";
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

                        //get length of blog title
                        $blog_title_length = strlen($blog_title);
                        if ($blog_title_length > 100) {
                           $blog_title = substr($blog_title, 0, 100) . '...';
                        } else {
                           //add white space till 100
                           $blog_title = $blog_title . str_repeat("&nbsp;", 100 - $blog_title_length);
                        }



                        $blog_title = substr($blog_title, 0, 100);


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
            </section>
            <!-- /.content -->
         </div>
      </div>
      <!-- /.content-wrapper -->
      <?php require_once 'elements/footer.php'; ?>
   </div>

   <!-- ./wrapper -->
   <!-- Sweat alert CDN -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- Vendor JS -->
   <script src="assets/js/vendors.min.js"></script>
   <script src="assets/icons/feather-icons/feather.min.js"></script>
   <script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
   <!-- Power BI Admin App -->
   <script src="assets/js/template.js"></script>
   <script src="assets/js/demo.js"></script>
   <script src="assets/js/pages/dashboard4.js"></script>
   <script src="assets/js/pages/data-table.js"></script>
   <script src="assets/vendor_components/datatable/datatables.min.js"></script>
   <script>
      //get proper data in modal
      $(document).ready(function() {
         $('.edit-btn').click(function(e) {
            e.preventDefault();

            // get data from table
            var $user_name = $(this).closest('tr').find('.user-name').text();
            var $user_email = $(this).closest('tr').find('.user-email').text();
            var $user_password = $(this).closest('tr').find('.user-password').text();
            var $user_id = $(this).closest('tr').find('.user-id').text();

            // input data into modal
            $('.user-name-modal').val($user_name);
            $('.user-email-modal').val($user_email);
            $('.user-password-modal').val($user_password);
            $('.user-id-modal').val($user_id);
         });
      });
   </script>

   <script>
      function prepareDelete(blog_id) {
         swal({
               title: "Are you sure?",
               text: "Once deleted, you will not be able to recover this imaginary file!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
            })
            .then((willDelete) => {
               if (willDelete) {
                  window.location = 'blog-delete.php?blog_id=' + blog_id;
               } else {
                  // swal("Your imaginary file is safe!");
               }
            });
      }
   </script>
</body>
<!-- Mirrored from powerbi-admin-template.multipurposethemes.com/bs4/main/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Apr 2022 18:12:49 GMT -->

</html>