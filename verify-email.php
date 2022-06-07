<?php
session_start();
require_once 'database/db-con.php';
?>
<?php

    $verification_link = $_GET['verification_link'];
    //get integer from verification link string 

    preg_match_all('!\d+!',$verification_link,$matches);
     $verification_link = implode(' ',$matches[0]);
     $email_verification_user_id = preg_replace("/\s+/", "", $verification_link);
    


     $query1 = "UPDATE `users` SET `is_verified`= 1 WHERE `id` = $email_verification_user_id";
     $run_query1 = mysqli_query($con,$query1);
     if ($run_query1) {
        ?>
        <script>
            alert ('Your Email Verified Successfully');
        </script>
        <?php
     }


?>