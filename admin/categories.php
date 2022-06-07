<?php
session_start();
require_once '../database/db-con.php';
?>

<?php

$alert_sucess = 0;
$alert_failed = 0;
$alert_message = "";


if (isset($_SESSION['user_session_var'])) {

   $user_id = $_SESSION['user_session_var'];

   if (isset($_POST['add_cate'])) {

      $cate_name = $_POST['name'];
      $category_unique_link = $_POST['category_unique_link'];

      //remove all special characters from business name
      $add_category_unique_link_new = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['category_unique_link']);


      //remove all hyphens from unique id
      $add_category_unique_link_new = str_replace('-', ' ', $add_category_unique_link_new);

      //replace multiple space into single space
      $add_category_unique_link_new = preg_replace('/[\s$@_*]+/', '-', $add_category_unique_link_new);

      //remove hyphens from start and end of unique id
      $add_category_unique_link_new = trim($add_category_unique_link_new, '-');

      //add random six characters to unique id in the end
      $add_category_unique_link_new = $add_category_unique_link_new . '-' . substr(md5(uniqid(rand(), true)), 0, 2);

      //convert all characters to lower case
      $add_category_unique_link_new = strtolower($add_category_unique_link_new);

      $query1 = "INSERT INTO `category_list`(`id`, `name`, `unique_link`) VALUES (NULL,'$cate_name','$add_category_unique_link_new')";
      $run_query1 = mysqli_query($con, $query1);
      if ($run_query1) {
      }
   }

   //category update
   if (isset($_POST['cate-update'])) {

      $update_cate_name = $_POST['name-update'];
      $update_cate_id = $_POST['id-update'];
      $unique_link_update = $_POST['unique_link_update'];


      //check unique_link_update check in database 
      $query_check_unique_link_update = "SELECT * FROM `category_list` WHERE `unique_link` = '$unique_link_update'";
      $run_query_check_unique_link_update = mysqli_query($con, $query_check_unique_link_update);
      $count_unique_link_update = mysqli_num_rows($run_query_check_unique_link_update);
      //get category id from category_list table

      if ($count_unique_link_update > 0) {
         echo 'we are in if';
         $row_get_cate_id = mysqli_fetch_array($run_query_check_unique_link_update);
         $matched_category_id = $row_get_cate_id['id'];
         echo $matched_category_id;
         if ($matched_category_id == $update_cate_id) {

            $query3 = "UPDATE `category_list` SET `name`='$update_cate_name',`unique_link`='$unique_link_update' WHERE `id` = $update_cate_id";
            $run_query3 = mysqli_query($con, $query3);
            if ($run_query3) {
            }
         } else {
            $alert_failed = 1;
            $alert_message = "Category Failed to Update";
         }
      } else {

         //remove all special characters from business name
         $add_category_unique_link_new = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['category_unique_link']);


         //remove all hyphens from unique id
         $add_category_unique_link_new = str_replace('-', ' ', $add_category_unique_link_new);

         //replace multiple space into single space
         $add_category_unique_link_new = preg_replace('/[\s$@_*]+/', '-', $add_category_unique_link_new);

         //remove hyphens from start and end of unique id
         $add_category_unique_link_new = trim($add_category_unique_link_new, '-');

         //add random six characters to unique id in the end
         $add_category_unique_link_new = $add_category_unique_link_new . '-' . substr(md5(uniqid(rand(), true)), 0, 2);

         //convert all characters to lower case
         $add_category_unique_link_new = strtolower($add_category_unique_link_new);

         echo 'we are in else';
         $query3 = "UPDATE `category_list` SET `name`='$update_cate_name',`unique_link`='$unique_link_update' WHERE `id` = $update_cate_id";
         $run_query3 = mysqli_query($con, $query3);
         if ($run_query3) {
            $alert_sucess = 1;
            $alert_message = "Blog Updated Successfully";
         }
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
   <title>All Categories - Dashboard</title>
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
               <div class="alert alert-dismissible fade show" style="display:none;" id="alert_one" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="row">
                  <div class="col-xl-12">
                     <h2 class="my-20 text-dark">Categories</h2>
                  </div>
                  <div class="col-xl-8 col-12">
                     <div class="col-xl-12 col-6">
                        <div class="box overflow-h">
                           <div class="box-header with-border">
                              <h4 class="box-title">Categories List</h4>
                           </div>
                           <div class="box-body pb-0">
                              <div class="table-responsive">
                                 <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       //get data from database
                                       $index = 0;
                                       $query2 = "SELECT * FROM `category_list` where `is_deleted` = 0";
                                       $run_query2 = mysqli_query($con, $query2);
                                       if ($run_query2) {
                                          while ($data = mysqli_fetch_assoc($run_query2)) {
                                             $cate_id = $data['id'];
                                             $cate_name = $data['name'];
                                             $index++;
                                       ?>

                                             <tr>
                                                <td><?php echo $index; ?></td>
                                                <td><?php echo $cate_name; ?></td>
                                                <td>
                                                   <p class="categorie-name" style="display:none;"><?php echo $cate_name; ?></p>
                                                   <p class="categorie-id" style="display:none;"><?php echo $cate_id; ?></p><a href="" class="edit-btn" data-toggle="modal" data-target="#modal-center" onclick="prepareCateModal('<?php echo $data['unique_link']; ?>','<?php echo $data['id']; ?>','<?php echo $data['name']; ?>');"><i class="fa-solid fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp; <a href="delete-cate.php?id=<?php echo $cate_id; ?>"><i class="fa-solid fa-trash-can"></i></a>
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
                              <h4 class="box-title">Add Categorie Here</h4>
                           </div>
                           <form method="POST">
                              <div class="box-body pb-30">
                                 <div class="form-group">
                                    <label>Categorie Name *</label>
                                    <input class="form-control" type="text" placeholder="categorie" name="name">
                                 </div>
                                 <div class="form-group">
                                    <label>Categorie Unique Link *</label>
                                    <input class="form-control" type="text" placeholder="unique link" name="category_unique_link">
                                    <small>Please enter unique link e.g. categories-title-one</small>
                                 </div>
                              </div>
                              <div class="box-footer">
                                 <button type="submit" class="btn btn-rounded btn-success pull-right mb-20" style="width:100%;" name="add_cate">ADD</button>
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


   <!--Edit categories Modal -->
   <div class="modal center-modal fade" id="modal-center" tabindex="-1" style="display: block; padding-right: 17px;" aria-modal="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Edit Category</h5>
               <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <form method="POST">
               <div class="modal-body">
                  <input type="hidden" id="update_category_id">
                  <div class="form-group">
                     <label>Categorie Name *</label>
                     <input class="form-control categorie-id-modal" type="text" name="id-update" style="display:none;">
                     <input class="form-control categorie-name-modal" type="text" name="name-update">
                  </div>
                  <div class="form-group">
                     <label>Categorie Unique Link *</label>
                     <input class="form-control" id="update_unique_link_input" type="text" name="unique_link_update">
                  </div>
               </div>
               <div class="modal-footer modal-footer-uniform">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary float-right" name="cate-update">Save changes</button>
               </div>
            </form>
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

            //get data
            var $stud_id = $(this).closest('tr').find('.categorie-name').text();
            console.log($stud_id);
            $('.categorie-name-modal').val($stud_id);

            //get proper id of categorie
            var $categorie_id = $(this).closest('tr').find('.categorie-id').text();
            $('.categorie-id-modal').val($categorie_id);
         });
      });
   </script>

   <script>
      //get unique link from database to store in input value in modal
      function prepareCateModal(unique_link, category_id, category_name) {

         console.log(unique_link);
         console.log(category_id);
         console.log(category_name);


         $('#update_unique_link_input').val(unique_link);
         $('#update_category_id').val(category_id);

      }
   </script>


   <script>
      var alert_sucess = '<?php echo $alert_sucess; ?>';
      var alert_failed = '<?php echo $alert_failed; ?>';
      var alert_message = '<?php echo $alert_message; ?>';


      //chnage #alert_one according to variable alert_sucess
      if (alert_sucess == 1 || alert_failed == 1) {
         console.log("alert_sucess = " + alert_sucess);

         $('#alert_one').css('display', 'block');
         //add aler-success or alert-danger class 
         if (alert_sucess == 1) {
            console.log("alert_sucess = " + alert_sucess);
            $('#alert_one').addClass('alert-success');
            //add message
            $('#alert_one').html(alert_message);

         } else if (alert_failed == 1) {
            console.log("alert_failed = " + alert_failed);
            $('#alert_one').addClass('alert-danger');
            // add message
            $('#alert_one').html(alert_message);

         }

      } else {
         console.log('we are in else');
         $('#alert_one').css('display', 'none');
      }
   </script>

</body>

</html>