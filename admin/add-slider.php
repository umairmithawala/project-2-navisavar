<?php
   session_start();
   require_once '../database/db-con.php';
   ?>

<?php


   if (isset($_POST['add_slider'])){
      $slide_one_dropdown = $_POST['slide_one_dropdown'];
      $slide_two_dropdown = $_POST['slide_two_dropdown'];
      $slide_three_dropdown = $_POST['slide_three_dropdown'];
      $slide_four_dropdown = $_POST['slide_four_dropdown'];


      //setting zero to all is_slider field
      $sql = "UPDATE `blog` SET `is_slider` = '0'";
      $result = mysqli_query($con, $sql);


      $query1 = "UPDATE `blog` SET `is_slider`= 1 WHERE `id` = $slide_one_dropdown;";
      $query2 = "UPDATE `blog` SET `is_slider`= 1 WHERE `id` = $slide_two_dropdown;";
      $query3 = "UPDATE `blog` SET `is_slider`= 1 WHERE `id` = $slide_three_dropdown;";
      $query4 = "UPDATE `blog` SET `is_slider`= 1 WHERE `id` = $slide_four_dropdown;";

      $result1 = mysqli_query($con, $query1);
      $result2 = mysqli_query($con, $query2);
      $result3 = mysqli_query($con, $query3);
      $result4 = mysqli_query($con, $query4);
   }

?>

<?php


   //get four latest blog id from blog table where `is_slider` = 1
   $sql = "SELECT * FROM `blog` WHERE `is_slider` = 1 ORDER BY `id` DESC LIMIT 1";
   $result = mysqli_query($con, $sql);
   $data = mysqli_fetch_assoc($result);
   //get number of rows from blog table
   $num_row = mysqli_num_rows($result); 
   
   if ($num_row > 0){

   

   $slide_one_id = $data['id'];
   } else {
      $slide_one_id = 0;
   }
   
   $sql = "SELECT * FROM `blog` WHERE `is_slider` = 1 ORDER BY `id` DESC LIMIT 1,1";
   $result = mysqli_query($con, $sql);
   $data = mysqli_fetch_assoc($result);
   //get number of rows from blog table
   $num_row = mysqli_num_rows($result); 
   
   if ($num_row > 0){

   

   $slide_two_id = $data['id'];
   } else {
      $slide_two_id = 0;
   }
   

   $sql = "SELECT * FROM `blog` WHERE `is_slider` = 1 ORDER BY `id` DESC LIMIT 2,1";
   $result = mysqli_query($con, $sql);
   $data = mysqli_fetch_assoc($result);
   //get number of rows from blog table
   $num_row = mysqli_num_rows($result); 
   
   if ($num_row > 0){

   

   $slide_three_id = $data['id'];
   } else {
      $slide_three_id = 0;
   }
   $sql = "SELECT * FROM `blog` WHERE `is_slider` = 1 ORDER BY `id` DESC LIMIT 3,1";
   $result = mysqli_query($con, $sql);
   $data = mysqli_fetch_assoc($result);
   //get number of rows from blog table
   $num_row = mysqli_num_rows($result); 
   
   if ($num_row > 0){

   

   $slide_four_id = $data['id'];
   } else {
      $slide_four_id = 0;
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
      <title>Add Slider - Dashboard</title>
      <!-- Vendors Style-->
      <link rel="stylesheet" href="assets/css/vendors_css.css">
      <!-- Style-->  
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/skin_color.css">
      <!--editor stylesheet -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/plugins/froala_editor.css">
      <link rel="stylesheet" href="assets/css/plugins/froala_style.css">
      <link rel="stylesheet" href="assets/css/plugins/code_view.css">
      <link rel="stylesheet" href="assets/css/plugins/colors.css">
      <link rel="stylesheet" href="assets/css/plugins/emoticons.css">
      <link rel="stylesheet" href="assets/css/plugins/image_manager.css">
      <link rel="stylesheet" href="assets/css/plugins/image.css">
      <link rel="stylesheet" href="assets/css/plugins/line_breaker.css">
      <link rel="stylesheet" href="assets/css/plugins/table.css">
      <link rel="stylesheet" href="assets/css/plugins/char_counter.css">
      <link rel="stylesheet" href="assets/css/plugins/video.css">
      <link rel="stylesheet" href="assets/css/plugins/fullscreen.css">
      <link rel="stylesheet" href="assets/css/plugins/file.css">
      <link rel="stylesheet" href="assets/css/plugins/quick_insert.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
      <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
      <style>
         div#editor {
         width: 100%;
         margin: auto;
         text-align: left;
         }
         .ss {
         background-color: red;
         }
         .center-btn{
         text-align:center;
         }
      </style>
      <!-- END -->
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
                        <h2 class="my-20 text-dark">Slider</h2>
                     </div>
                     <div class="col-xl-12 col-12">
                        <div class="box overflow-h">
                           <form method="POST" enctype="multipart/form-data">
                              <div class="box-body pt-50 pb-50">
                                 <div class="form-group row pt-30 center-btn">
                                    <div class="col-md-3">
                                       <select class="form-control" name="slide_one_dropdown" id="" required="">
                                          <option> Slider 1 </option>
                                          <?php 
                                             $query1 = "SELECT * FROM `blog`";
                                             $run_query1 = mysqli_query($con,$query1);
                                             if ($run_query1){
                                                while ($data = mysqli_fetch_assoc($run_query1)){
                                                   
                                                   ?>
                                          <option value="<?php echo $data['id'];?>" 
                                          <?php 
                                          if ($slide_one_id==$data['id']){
                                             echo 'selected';
                                             }
                                             ?>> <?php echo $data['blog_title']; ?> </option>
                                          <?php
                                             }
                                             }
                                             ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3">
                                       <select class="form-control" name="slide_two_dropdown" id="" required="">
                                          <option> Slider 2 </option>
                                          <?php 
                                             $query1 = "SELECT * FROM `blog`";
                                             $run_query1 = mysqli_query($con,$query1);
                                             if ($run_query1){
                                                while ($data = mysqli_fetch_assoc($run_query1)){
                                                   
                                                   ?>
                                          <option value="<?php echo $data['id'];?> " <?php 
                                          if ($slide_two_id==$data['id']){
                                             echo 'selected';
                                             }
                                             ?>> <?php echo $data['blog_title'];?> </option>
                                          <?php
                                             }
                                             }
                                             ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3">
                                       <select class="form-control" name="slide_three_dropdown" id="" required="">
                                          <option> Slider 3 </option>
                                          <?php 
                                             $query1 = "SELECT * FROM `blog`";
                                             $run_query1 = mysqli_query($con,$query1);
                                             if ($run_query1){
                                                while ($data = mysqli_fetch_assoc($run_query1)){
                                                   
                                                   ?>
                                          <option value="<?php echo $data['id'];?>" <?php 
                                          if ($slide_three_id==$data['id']){
                                             echo 'selected';
                                             }
                                             ?>> <?php echo $data['blog_title']; ?> </option>
                                          <?php
                                             }
                                             }
                                             ?>
                                       </select>
                                    </div>
                                    <div class="col-md-3">
                                       <select class="form-control" name="slide_four_dropdown" id="" required="">
                                          <option> Slider 4 </option>
                                          <?php 
                                             $query1 = "SELECT * FROM `blog`";
                                             $run_query1 = mysqli_query($con,$query1);
                                             if ($run_query1){
                                                while ($data = mysqli_fetch_assoc($run_query1)){
                                                   
                                                   ?>
                                          <option value="<?php echo $data['id'];?>" <?php 
                                          if ($slide_four_id==$data['id']){
                                             echo 'selected';
                                             }
                                             ?>> <?php echo $data['blog_title']; ?> </option>
                                          <?php
                                             }
                                             }
                                             ?>
                                       </select>
                                    </div>
                                    <div class="col-md-12" style="margin-top:50px;">
                                       <div class="tags-default">
                                          <input type="text" id="editContent" name="editContent" style="display:none">
                                          <input type="submit" value="Save Changes" name="add_slider" class="btn btn-primary mt-5">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-12">
                        <h2 class="my-20 text-dark">Slider List </h2>
                     </div>
                     <?php
                        //get all blog col
                        $query = "SELECT * FROM `blog` WHERE `is_slider` = 1";  
                        $run_query = mysqli_query($con, $query);  
                        if (mysqli_num_rows($run_query) > 0) {
                           while ($row = mysqli_fetch_array($run_query)) {
                              $blog_id = $row['id'];
                              $blog_title = $row['blog_title'];
                              $thumbnail_img = $row['thumbnail_img'];
                              $category_id = $row['category_id'];

                                   //get category name from category_list table
                                    $query2 = "SELECT * FROM `category_list` WHERE `id` = $category_id";
                                    $run_query2 = mysqli_query($con, $query2);
                                    $row2 = mysqli_fetch_array($run_query2);
                                    $category_name = $row2['name']; 
                              ?>
                     <div class="col-xl-6 col-6 mt-30">
                           <div class="box">
                              <div style="background-image: url('assets/uploads/<?php echo $thumbnail_img; ?>'); background-repeat: no-repeat;
                                 background-size: cover; height:200px;">
                              </div>
                              <!-- <img class="card-img-top img-responsive" src="" alt="Card image cap"> -->
                              <div class="box-body">
                                 <div class="row text-center">
                                    <div class="col-md-12">
                                       <h4 class="box-title"><?php echo $blog_title ?></h4>
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
                                    </div>
                                 </div>
                              </div>
                              <!-- /.box-body -->
                           </div>
                     </div>
                     <?php
                        }
                        } else {
                           echo "No Slider Availbale";
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
      <!-- Vendor JS -->
      <script src="assets/js/vendors.min.js"></script>
      <!-- Power BI Admin App -->
      <script src="assets/js/template.js"></script>
      <script src="assets/js/demo.js"></script>
      <!-- code editor -->
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js"></script>
      <script type="text/javascript"
         src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
      <script type="text/javascript"
         src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/froala_editor.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/align.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/char_counter.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/code_beautifier.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/code_view.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/colors.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/draggable.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/emoticons.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/entities.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/file.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/font_size.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/font_family.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/fullscreen.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/image.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/image_manager.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/line_breaker.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/inline_style.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/link.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/lists.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/paragraph_format.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/paragraph_style.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/quick_insert.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/quote.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/table.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/save.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/url.min.js"></script>
      <script type="text/javascript" src="assets/js/plugins/video.min.js"></script>
      <!-- <script type="text/javascript" src="assets/js/pages/advanced-form-element.js"></script> -->
      <script src="assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
      <script>
         //hide unhide update image div and upload image div
         function changethumbnailState(){
         
             $('#edit-blog-img-div').css('display','none');
             $('#edit-blog-input-div').css('display','block');
         }
         
      </script>
      <!-- END -->
   </body>
</html>