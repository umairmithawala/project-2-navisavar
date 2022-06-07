<?php
session_start();
require_once '../database/db-con.php';
?>
<?php

if (isset($_SESSION['user_session_var'])) {

   if (isset($_POST['add_user'])) {

      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $user_role = $_POST['user_role'];
      $timestamp = time();

      if ($_FILES['user_img']['name'] != '') {
         $user_img_new_name = $_FILES['user_img']['name']; // Get the Uploaded file Name.

         $user_img_extension = pathinfo($user_img_new_name, PATHINFO_EXTENSION); //Get the Extension of uploded file


         $valid_extensions = array("png", "jpg", "jpeg", "gif");

         if (in_array($user_img_extension, $valid_extensions)) { // check if upload file is a valid image file.
            $timestamp = time();

            $new_name_one = "user_img" . $timestamp . "naisavar" . rand() . "." . $user_img_extension;


            $path_one = "uploads/user-img/" . $new_name_one;


            move_uploaded_file($_FILES['user_img']['tmp_name'], $path_one);

            $user_img_name =  $new_name_one;
         }
      }

      $query1 = "INSERT INTO `users`(`id`, `user_role`, `name`, `email`, `password`,`user_img`,
      `timestamp`) VALUES (NULL,$user_role,'$name','$email','$password','$user_img_name',$timestamp)";
      $run_query1 = mysqli_query($con, $query1);
      if ($run_query1) {
      } else {
      }
   }

   //update user details
   if (isset($_POST['user-detail-update'])) {

      $user_role_update = $_POST['user-role-update'];
      $user_name_update = $_POST['user-name-update'];
      $user_email_update = $_POST['user-email-update'];
      $user_password_update = $_POST['user-password-update'];
      $user_id_update = $_POST['user-id-update'];

      $query3 = "UPDATE `users` SET `user_role`= $user_role_update, `name`='$user_name_update',`email`='$user_email_update',
      `password`='$user_password_update' WHERE `id` = $user_id_update";
      $run_query3 = mysqli_query($con, $query3);
      if ($run_query3) {
      }
   }
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
   <title>Manage Users - Dashboard</title>
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
      <?php
      require 'elements/header.php';
      ?>
      <!-- End -->
      <!-- sidebar menu section -->
      <?php
      require 'elements/sidebar.php';
      ?>
      <!-- End -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <div class="container">
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-xl-12">
                     <h2 class="my-20 text-dark">Manage Users</h2>
                  </div>
                  <div class="col-xl-8 col-12">
                     <div class="col-xl-12 col-6">
                        <div class="box overflow-h">
                           <div class="box-header with-border">
                              <h4 class="box-title">User List</h4>
                           </div>
                           <div class="box-body pb-0">
                              <div class="table-responsive">
                                 <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>User Name</th>
                                          <th>User Email</th>
                                          <th>Password</th>
                                          <th>User Role</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       //get data from database
                                       $index = 0;
                                       $query2 = "SELECT * FROM `users` where `is_banned` = 0";
                                       $run_query2 = mysqli_query($con, $query2);
                                       if ($run_query2) {
                                          while ($data = mysqli_fetch_assoc($run_query2)) {
                                             $user_id = $data['id'];
                                             $user_name = $data['name'];
                                             $user_email = $data['email'];
                                             $user_password = $data['password'];
                                             $user_role = $data['user_role'];
                                             $index++;
                                       ?>
                                             <tr>
                                                <td><?php echo $index; ?></td>
                                                <td class="user-name"> <?php echo $user_name; ?> </td>
                                                <td class="user-email"> <?php echo $user_email; ?> </td>
                                                <td class="user-password"> <?php echo $user_password; ?> </td>
                                                <td> <?php
                                                      if ($user_role == 1) {
                                                         echo 'Admin';
                                                      } else if ($user_role == 2) {
                                                         echo 'Student';
                                                      }
                                                      ?> </td>
                                                <td>
                                                   <p class="user-id" style="display:none;"><?php echo $user_id; ?></p> <a class="edit-btn" href="" data-toggle="modal" data-target="#modal-center"><i class="fa-solid fa-pen"></i></a> | <a href="delete-user.php?id=<?php echo $user_id; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                             </tr>
                                       <?php
                                          }
                                       }
                                       ?>
                                       </tfoot>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-12">
                     <div class="col-xl-12 col-6">
                        <div class="box overflow-h">
                           <div class="box-header with-border">
                              <h4 class="box-title">Add User Here</h4>
                           </div>
                           <form method="POST" enctype="multipart/form-data">
                              <div class="box-body pb-30">
                                 <div class="form-group">
                                    <label>User Name *</label>
                                    <input class="form-control" type="text" placeholder="name" name="name">
                                 </div>
                                 <div class="form-group">
                                    <label>User Email *</label>
                                    <input class="form-control" type="text" placeholder="email" name="email">
                                 </div>
                                 <div class="form-group">
                                    <label>Password *</label>
                                    <input class="form-control" type="text" placeholder="password" name="password">
                                 </div>
                                 <div class="form-group">
                                    <label>User Role *</label>
                                    <select class="form-control" name="user_role">
                                       <option value="2">STUDENT</option>
                                       <option value="1">ADMIN</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label>Upload Image *</label>
                                    <input type="file" class="form-control" name="user_img">
                                 </div>
                              </div>
                              <div class="box-footer">
                                 <button type="submit" class="btn btn-rounded btn-success pull-right mb-20" style="width:100%;" name="add_user">ADD</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
      </div>
      <!-- /.content-wrapper -->
      <?php require_once 'elements/footer.php'; ?>

   </div>
   <!--Add User Modal -->
   <div class="modal center-modal fade" id="modal-center" tabindex="-1" style="display: block; padding-right: 17px;" aria-modal="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Edit User</h5>
               <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <form method="POST">
               <div class="modal-body">
                  <div class="form-group">
                     <label>User Name *</label>
                     <input class="form-control user-name-modal" type="text" placeholder="name" name="user-name-update">
                     <input class="form-control user-id-modal" type="text" style="display:none;" name="user-id-update">
                  </div>
                  <div class="form-group">
                     <label>User Email *</label>
                     <input class="form-control user-email-modal" type="text" placeholder="email" name="user-email-update">
                  </div>
                  <div class="form-group">
                     <label>Password *</label>
                     <input class="form-control user-password-modal" type="text" placeholder="password" name="user-password-update">
                  </div>
                  <div class="form-group">
                     <label>User Role *</label>
                     <select class="form-control" name="user-role-update">
                        <option value="2">STUDENT</option>
                        <option value="1">ADMIN</option>
                     </select>
                  </div>
               </div>
               <div class="modal-footer modal-footer-uniform">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary float-right" name="user-detail-update">Save changes</button>
               </div>
            </form>
         </div>
      </div>
   </div>
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
</body>
<!-- Mirrored from powerbi-admin-template.multipurposethemes.com/bs4/main/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Apr 2022 18:12:49 GMT -->

</html>