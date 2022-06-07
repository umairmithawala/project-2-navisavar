<?php
session_start();
require_once '../database/db-con.php';
?>

<?php

if (isset($_SESSION['user_session_var'])) {

    if (isset($_GET['id'])) {

        $cate_id = $_GET['id'];
        $delete_val = 1;

        $query = "UPDATE `category_list` SET `is_deleted`= '$delete_val' WHERE `id` = $cate_id";
        $run_query = mysqli_query($con, $query);
        if ($run_query) {
            header('location:categories.php');
        }
    } else {
?>
        <script>
            window.location = categories.php;
        </script>
    <?php
    }
} else {
    ?>
    <script>
        window.location = "login.php";
    </script>
<?php
}



?>