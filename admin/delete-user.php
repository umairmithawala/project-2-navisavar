<?php
session_start();
require_once '../database/db-con.php';
?>

<?php

if (isset($_SESSION['user_session_var'])) {

    if (isset($_GET['id'])) {

        $user_id = $_GET['id'];
        $delete_val = 1;

        $query = "UPDATE `users` SET `is_banned`= '$delete_val' WHERE `id` = $user_id";
        $run_query = mysqli_query($con, $query);
        if ($run_query) {
            header('location:manage-user.php');
        }
    } else {
?>
        <script>
            window.location = manage - user.php;
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