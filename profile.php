<?php
session_start();
require_once 'database/db-con.php';
?>
<?php



if (isset($_SESSION['user_id_session'])) {

  //get user id from session variable
  $user_session_id = $_SESSION['user_id_session'];
} else {

?>
  <script>
    window.location.href = "<?php echo $very_global_absolute_url; ?>";
  </script>
  <?php

}

if (isset($_POST['verify_email'])) {

  //get email from users table 
  $get_email = "SELECT * FROM users WHERE id = '$user_session_id'";
  $get_email_result = mysqli_query($con, $get_email);
  $get_email_row = mysqli_fetch_array($get_email_result);
  $user_email = $get_email_row['email'];

  //concat user id with five random character ahead of it and five behind it
  $random_string = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
  $random_string_2 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

  $verification_link = $random_string . $user_session_id . $random_string_2;

  $verification_link = 'https://navisavar.com/verify-email.php?verification_link=' . $verification_link;

  // Multiple recipients
  $to = $user_email; // note the comma
  // Subject
  $subject = 'Verify your email of Navi savar account';

  // Message
  $message = '<!DOCTYPE html>
        <html lang="en">
          <head>
            
            <link
              rel="icon"
              href="http://laravel.pixelstrap.com/xolo/assets/images/favicon.png"
              type="image/x-icon"
            />
            <link
              rel="shortcut icon"
              href="http://laravel.pixelstrap.com/xolo/assets/images/favicon.png"
              type="image/x-icon"
            />
            <title>THS Mining</title>
            <link
              href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900"
              rel="stylesheet"
            />
            <link
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet"
            />
            <link
              href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet"
            />
            <style type="text/css">
              body {
                width: 650px;
                font-family: work-Sans, sans-serif;
                background-color: #f6f7fb;
                display: block;
              }
              a {
                text-decoration: none;
              }
              span {
                font-size: 14px;
              }
              p {
                font-size: 13px;
                line-height: 1.7;
                letter-spacing: 0.7px;
                margin-top: 0;
              }
              .text-center {
                text-align: center;
              }
            </style>
          </head>
          <body style="margin: 30px auto">
            <table style="width: 100%">
              <tbody>
                <tr>
                  <td>
                    <table style="background-color: #f6f7fb; width: 100%">
                      <tbody>
                        <tr>
                          <td>
                            <table
                              style="width: 650px; margin: 0 auto; margin-bottom: 30px; margin-top:30px;"
                            >
                              <tbody>
                                <tr>
                                  <td>
                                    <img
                                      src="http://navisavar.com/assets/imgs/logo/navisavar-logo.png"
                                      alt=""
                                    />
                                  </td>
                                  <td style="text-align: right; color: #999">
                                    
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table
                              style="
                                width: 650px;
                                margin: 0 auto;
                                background-color: #fff;
                                border-radius: 8px;
                              "
                            >
                              <tbody>
                                <tr>
                                  <td style="padding: 30px">
                                    <p>Hi There,</p>
                                    <p>
                                        Thank you for joining Navi savar. 
                                      </p>
                                      <p>
                                        Please confirm your email address by clicking on the button below or use this link ' . $verification_link . ' withing 48 hours. 
                                      </p>
                                    <a
                                      href="' . $verification_link . '"
                                      style="
                                        padding: 10px;
                                        background-color: #3452ff;
                                        color: #fff;
                                        display: inline-block;
                                        border-radius: 4px;
                                        margin-bottom: 18px;
                                      "
                                      >Verify Email
                                    </a>
                                    <p>
                                     Once confirmed, this email will be uniquely associated with your Navi savar account.
                                    </p>
                                    <p style="margin-bottom: 0">
                                      Good luck! Hope it works.
                                    </p>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table
                              style="width: 650px; margin: 0 auto; margin-top: 30px"
                            >
                              <tbody>
                                <tr style="text-align: center">
                                  <td>
                                    <p style="color: #999; margin-bottom: 0">
                                      
                                    </p>
                                    <p style="color: #999; margin-bottom: 0">
                                      Dont Like These Emails?<a
                                        href="#"
                                        style="color: #3452ff"
                                        > Unsubscribe</a
                                      >
                                    </p>
                                    
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </body>
        </html>
        ';

  // To send HTML mail, the Content-type header must be set
  $headers[] = 'MIME-Version: 1.0';
  $headers[] = 'Content-type: text/html; charset=iso-8859-1';

  // Additional headers
  $headers[] = 'From: Navi savar Official <no-reply@navisavar.com>';

  // Mail it
  if (mail($to, $subject, $message, implode("\r\n", $headers))) {
  ?>
    <script>
      alert('Verification link has been sent to your email address.');
    </script>
<?php
  };

  // mail logic ends

}

//update user name
if (isset($_POST['submit_user_details'])) {

  $update_user_name = $_POST['update_user_name'];
  $update_user_name = htmlspecialchars($update_user_name, ENT_QUOTES, "UTF-8");
  // $update_user_email = $_POST['update_user_email'];

  $query2 = "UPDATE `users` SET `name`='$update_user_name' WHERE `id` = '$user_session_id'";
  $result2 = mysqli_query($con, $query2);
}




//update user password
//check current_password from database valid or not
$query4 = "SELECT * FROM `users` WHERE `id` = '$user_session_id'";
$run_query4 = mysqli_query($con, $query4);
$data4 = mysqli_fetch_assoc($run_query4);
$current_password_database = $data4['password'];

if (isset($_POST['submit_user_password'])) {

  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  if ($current_password == $current_password_database) {
    if ($new_password == $confirm_password) {
      $query3 = "UPDATE `users` SET `password`='$new_password' WHERE `id` = '$user_session_id'";
      $result3 = mysqli_query($con, $query3);
    } else {
      echo "<script>alert('New password and confirm password not match')</script>";
    }
  } else {
    echo "<script>alert('Current password not match')</script>";
  }
}




//update user image
if (isset($_POST['submit_user_image'])) {

  if ($_FILES['update_user_image']['name'] != '') {
    $user_img_new_name = $_FILES['update_user_image']['name']; // Get the Uploaded file Name.

    $user_img_extension = pathinfo($user_img_new_name, PATHINFO_EXTENSION); //Get the Extension of uploded file


    $valid_extensions = array("png", "jpg", "jpeg", "gif");

    if (in_array($user_img_extension, $valid_extensions)) { // check if upload file is a valid image file.
      $timestamp = time();

      $new_name_one = "user_img" . $timestamp . "naisavar" . rand() . "." . $user_img_extension;


      $path_one = "admin/uploads/user-img/" . $new_name_one;


      move_uploaded_file($_FILES['update_user_image']['tmp_name'], $path_one);

      $user_img_name =  $new_name_one;
    }
  }


  $query5 = "UPDATE `users` SET `user_img`='$user_img_name' WHERE `id` = '$user_session_id'";
  $run_query5 = mysqli_query($con, $query5);
}


//fetch all data from users table
$query1 = "SELECT * FROM `users` WHERE `id` = '$user_session_id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_assoc($result1);
$user_name = $row1['name'];
$user_email = $row1['email'];
$user_img = $row1['user_img'];
$password = $row1['password'];
$is_verified = $row1['is_verified'];




?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Navisavar - Profile</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="site.webmanifest">
  <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/favicon/favicon.png">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/widgets.css">
  <link rel="stylesheet" href="assets/css/color.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
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
    <!-- Main Header -->
    <?php require_once 'elements/header.php'; ?>
    <!-- Main Wrap Start -->
    <main class="position-relative">
      <div class="container">
        <div class="row mb-50">
          <div class="col-lg-2 d-none d-lg-block"></div>
          <!-- main content -->
          <div class="col-lg-8 col-md-12">
            <div class="author-bio border-radius-10 bg-white p-30 mb-50">
              <div class="author-image mb-30">
                <a data-toggle="modal" data-target="#imageChangeModal"><img src="<?php echo $very_global_absolute_url; ?>admin/uploads/user-img/<?php echo $user_img; ?>" alt="" class="avatar"></a>
              </div>
              <div class="author-info">
                <h3 style="display:inline-block;">
                  <span class="vcard author">
                    <span class="fn"><a title="Posts by Robert" rel="author">
                        <?php echo $user_name; ?>
                      </a>
                    </span>
                    <i style="font-size:20px; cursor:pointer;" class="fas fa-pen ml-5 text-primary" data-toggle="modal" data-target="#userNameChangeModal">
                    </i>
                  </span>
                </h3>
                <a data-toggle="modal" data-target="#userPasswordChangeModal" class="author-bio-link text-muted"><span class="mr-5 font-x-small">
                    <ion-icon name="person-add" role="img" class="md hydrated" aria-label="person add"></ion-icon>
                  </span>Change Password</a>

                <p class="mt-20"> <?php echo $user_email; ?>
                <form action="#" method="POST">
                  <button type="submit" name="verify_email" class="author-bio-link text-muted ml-10"><span class="mr-5 font-x-small">

                    </span><?php
                            if ($is_verified == 0) {
                              echo "Not Verified";
                            } else {
                              echo "Verified";
                            }
                            ?></button>
                </form></a>
                </p>


              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Footer Start-->
    <?php require_once 'elements/footer.php'; ?>
  </div> <!-- Main Wrap End-->
  <div class="dark-mark"></div>





  <!-- user image update modal -->
  <div class="modal fade" id="imageChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="post-title pr-5 pl-5 mb-10 mt-15 text-limit-2-row text-center " id="exampleModalLabel">Image Upload</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Upload Image*</label>
              <input type="file" class="form-control" name="update_user_image">
            </div>
          </div>
          <div class="modal-footer text-center" style="display:block !important;">
            <button type="submit" class="btn btn-primary widget-title" name="submit_user_image">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- user name update modal -->
  <div class="modal fade" id="userNameChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="post-title pr-5 pl-5 mb-10 mt-15 text-limit-2-row text-center " id="exampleModalLabel">Update</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name" name="update_user_name" value="<?php echo $user_name; ?>">
            </div>
            <!-- <div class="form-group">
                            <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" name="update_user_email" value="<?php echo $user_email; ?>">
                        </div> -->
          </div>
          <div class="modal-footer text-center" style="display:block !important;">
            <button type="submit" class="btn btn-primary widget-title" name="submit_user_details">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- user password update modal -->
  <div class="modal fade" id="userPasswordChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="post-title pr-5 pl-5 mb-10 mt-15 text-limit-2-row text-center " id="exampleModalLabel">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Current Password</label>
              <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="current_password">
            </div>
            <div class="form-group">
              <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">New Password</label>
              <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="new_password">
            </div>
            <div class="form-group">
              <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Confirm Password</label>
              <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="confirm_password">
            </div>
          </div>
          <div class="modal-footer text-center" style="display:block !important;">
            <button type="submit" class="btn btn-primary widget-title" name="submit_user_password">Change Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <!-- Vendor JS-->
  <script src="https://kit.fontawesome.com/12af21ff9f.js" crossorigin="anonymous"></script>
  <script src="./assets/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="./assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="./assets/js/vendor/popper.min.js"></script>
  <script src="./assets/js/vendor/bootstrap.min.js"></script>
  <script src="./assets/js/vendor/jquery.slicknav.js"></script>
  <script src="./assets/js/vendor/owl.carousel.min.js"></script>
  <script src="./assets/js/vendor/slick.min.js"></script>
  <script src="./assets/js/vendor/wow.min.js"></script>
  <script src="./assets/js/vendor/animated.headline.js"></script>
  <script src="./assets/js/vendor/jquery.magnific-popup.js"></script>
  <script src="./assets/js/vendor/jquery.ticker.js"></script>
  <script src="./assets/js/vendor/jquery.vticker-min.js"></script>
  <script src="./assets/js/vendor/jquery.scrollUp.min.js"></script>
  <script src="./assets/js/vendor/jquery.nice-select.min.js"></script>
  <script src="./assets/js/vendor/jquery.sticky.js"></script>
  <script src="./assets/js/vendor/perfect-scrollbar.js"></script>
  <script src="./assets/js/vendor/waypoints.min.js"></script>
  <script src="./assets/js/vendor/jquery.counterup.min.js"></script>
  <script src="./assets/js/vendor/jquery.theia.sticky.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  <!-- NewsViral JS -->
  <script src="./assets/js/main.js"></script>
  <!-- Slick Slider JS -->
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <script type="text/javascript" src="https://kit.fontawesome.com/12af21ff9f.js"></script>
  <!-- NewsViral JS -->
  <script src="./assets/js/main.js"></script>
</body>

</html>