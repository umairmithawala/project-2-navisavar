<?php
session_start();
require_once '../database/db-con.php';
?>
<?php
$alert_sucess = 0;
$alert_failed = 0;
$alert_message = "";

if (isset($_POST['submit'])) {
   $title = $_POST['title'];
   $title = htmlspecialchars($title, ENT_QUOTES, "UTF-8");
   $blog_content = $_POST['blog-content'];
   $blog_content = htmlspecialchars($blog_content, ENT_QUOTES, "UTF-8");
   $publish_date = $_POST['publish-date'];
   $publish_date = htmlspecialchars($publish_date, ENT_QUOTES, "UTF-8");
   $publish_date_timestamp = strtotime($publish_date);
   $blog_keyword = $_POST['blog-keyword'];
   $blog_keyword = htmlspecialchars($blog_keyword, ENT_QUOTES, "UTF-8");
   $category = $_POST['category'];
   $unique_title_link = $_POST['unique_title_link'];
   $added_by_user_id = $_SESSION['user_session_var'];

   // echo $unique_title_link;
   $timestamp = time();
   //remove all special characters from business name
   $unique_id = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['unique_title_link']);


   //remove all hyphens from unique id
   $unique_id = str_replace('-', ' ', $unique_id);

   //replace multiple space into single space
   $unique_id = preg_replace('/[\s$@_*]+/', '-', $unique_id);

   //remove hyphens from start and end of unique id
   $unique_id = trim($unique_id, '-');

   //add random six characters to unique id in the end
   $unique_id = $unique_id . '-' . substr(md5(uniqid(rand(), true)), 0, 2);


   //convert all characters to lower case
   $unique_id = strtolower($unique_id);
   $query3 = "SELECT * FROM `blog` WHERE `unique_link` = '$unique_id'";
   $run_query3 = mysqli_query($con, $query3);
   $count_rows = mysqli_num_rows($run_query3);

   if ($count_rows == 0) {


      $thumbnail_img_new_name = $_FILES['thumbnail-img']['name']; // Get the Uploaded file Name.

      $thumbnail_img_extension = pathinfo($thumbnail_img_new_name, PATHINFO_EXTENSION); //Get the Extension of uploded file


      $valid_extensions = array("png", "jpg", "jpeg", "gif", "PNG", "JPG", "JPEG", "GIF"); //Extensions which are allowed

      if (in_array($thumbnail_img_extension, $valid_extensions)) { // check if upload file is a valid image file.
         $timestamp = time();

         $new_name_one = "thumbnail_img" . $timestamp . "akc" . rand() . "." . $thumbnail_img_extension;


         $path_one = "uploads/thumbnail-img/" . $new_name_one;


         move_uploaded_file($_FILES['thumbnail-img']['tmp_name'], $path_one);

         $thumbnail_img_name =  $new_name_one;
      }

      $query1 = "INSERT INTO `blog`(`id`,`blog_title`,`thumbnail_img`,`blog_body`, `publish_date`, `keywords`, `unique_link`, `category_id`,`added_by`,`timestamp`) VALUES (NULL,'$title','$thumbnail_img_name','$blog_content','$publish_date_timestamp','$blog_keyword','$unique_id ',$category,$added_by_user_id,'$timestamp')";
      $run_query1 = mysqli_query($con, $query1);
      if ($run_query1) {
         $alert_sucess = 1;
         $alert_message = "Blog Added Successfully";
      }
   } else {
?>
      <script>
         alert("Blog Link Already Exists");
      </script>
<?php
   }
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
   <title>Add Blog - Dashboard</title>
   <!-- Vendors Style-->
   <link rel="stylesheet" href="assets/css/vendors_css.css">
   <!-- Style-->
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/skin_color.css">
   <!-- richtext editor stylesheet -->
   <link rel="stylesheet" href="assets/richtexteditor/rte_theme_default.css" />
   <!-- end -->
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

      .center-btn {
         text-align: center;
      }
   </style>
   <!-- END -->
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
   <div class="wrapper">
      <div id="loader"></div>
      <!-- header section -->
      <?php require_once 'elements/header.php'; ?>
      <!-- End -->
      <!-- sidebar menu section -->
      <?php require_once 'elements/sidebar.php'; ?>
      <!-- End -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <div class="container">
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-xl-12">
                     <h2 class="my-20 text-dark">Add Blog</h2>
                  </div>
                  <div class="col-xl-12 col-12">
                     <div class="alert alert-dismissible fade show" style="display:none;" id="alert_one" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="box overflow-h">
                        <form method="POST" enctype="multipart/form-data">
                           <div class="box-body pt-50 pb-50">
                              <div class="form-group row">
                                 <label class="col-form-label col-md-2">Blog Title</label>
                                 <div class="col-md-10">
                                    <input class="form-control" type="text" name="title" placeholder="Type title here" required>
                                 </div>
                              </div>
                              <div class="form-group row pt-30">
                                 <label class="col-form-label col-md-2">Unique Link</label>
                                 <div class="col-md-10">
                                    <input class="form-control" type="text" name="unique_title_link" placeholder="Type unique link here" required>
                                    <small>Please enter unique link e.g. blog-title-one</small>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col">
                                    <div class="form-group row pt-30">
                                       <label class="col-form-label col-md-4">Thumbnail Image</label>
                                       <div class="col-md-8">
                                          <input class="form-control" type="file" name="thumbnail-img" required>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col">
                                    <div class="form-group row pt-30">
                                       <label class="col-form-label col-md-4">Blog Category</label>
                                       <div class="col-md-8">
                                          <select class="form-control" name="category" id="" required>
                                             <?php
                                             $query2 = "SELECT * FROM `category_list`";
                                             $run_query2 = mysqli_query($con, $query2);
                                             if ($run_query2) {
                                                while ($data2 = mysqli_fetch_assoc($run_query2)) {
                                             ?>
                                                   <option value="<?php echo $data2['id']; ?>"> <?php echo $data2['name']; ?> </option>
                                             <?php
                                                }
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row pt-30">
                                 <label class="col-form-label col-md-2">Add Content</label>
                                 <div class="col-md-10">
                                    <textarea id="inp_editor1" name="blog-content"></textarea>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col">
                                    <div class="form-group row pt-30">
                                       <label class="col-form-label col-md-4">Publish Date</label>
                                       <div class="col-md-8">
                                          <input class="form-control" type="date" name="publish-date" required>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col">
                                    <div class="form-group row pt-30">
                                       <label class="col-form-label col-md-2">Keywords</label>
                                       <div class="col-md-10">
                                          <div class="tags-default">
                                             <input name="blog-keyword" type="text" value="" data-role="tagsinput" placeholder="add keywords" style="display: none;" required>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row pt-30 center-btn">
                                 <div class="col-md-12">
                                    <div class="tags-default">
                                       <input type="text" id="editContent" name="editContent" style="display:none">
                                       <input type="submit" value="Add Blog" name="submit" class="btn btn-primary mt-5" onclick="getDivContent()">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
      </div>
      <?php require_once 'elements/footer.php' ?>
   </div>
   <!-- ./wrapper -->
   <!-- Vendor JS -->
   <script src="assets/js/vendors.min.js"></script>
   <!-- Power BI Admin App -->
   <script src="assets/js/template.js"></script>
   <script src="assets/js/demo.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
   <!-- <script type="text/javascript" src="assets/js/plugins/froala_editor.min.js"></script> -->
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
   <script src="assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
   <!-- richtext editor js -->
   <script type="text/javascript" src="assets/richtexteditor/rte.js"></script>
   <script type="text/javascript" src='assets/richtexteditor/plugins/all_plugins.js'></script>
   <script>
      // richtext editor
      var editor1 = new RichTextEditor("#inp_editor1");
   </script>
   <script>
      function getDivContent() {

         var editDivContent = document.getElementsByClassName("fr-view")[0].innerText;
         console.log(editDivContent);

         var t = document.getElementById("editContent").value = editDivContent;

         var p = document.getElementById("editContent");
         console.log(p);

      }
   </script>
   <script>
      new FroalaEditor('#edit', {
         // Set the file upload URL.
         imageUploadURL: 'upload_image.php',

         imageUploadParams: {
            id: 'my_editor'
         }
      })
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
   <!-- END -->
</body>

</html>