<?php
session_start();
require_once '../database/db-con.php';
?>

<?php

if (!empty($_GET['blog_id'])) {
  $blog_id = $_GET['blog_id'];

  // $sql = "DELETE FROM enquiry WHERE id=$getid";
  $sql = "UPDATE `blog` SET `is_deleted`= 1 WHERE `id` = $blog_id";
  $run_sql = mysqli_query($con, $sql);
  if ($run_sql) {
?>
    <script>
      window.location = "blog-list.php";
    </script>
  <?php
  }
} else {
  // echo "Error deleting record: " . $con->error;
  ?>
  <script>
    window.history.back();
  </script>
<?php
  header('location:blog-list.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KYC Rejected</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <script>
    if (a_delete == 1) {
      swal({
        title: "Deleted",
        text: "Blog Deleted",
        icon: "warning",
        button: "Done",
      });
      setTimeout(function() {
        window.history.back();
        window.location = "blog-list.php";
      }, 2000);
    } else {
      window.history.back();
      window.location = "blog-list.php";
    }
  </script>
</body>

</html>