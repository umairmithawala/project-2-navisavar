<?php
session_start();
require_once '../database/db-con.php';
?>

<?php 

    //check user session variable is set or not
    if(isset($_SESSION['user_id_session'])){

        $user_id = $_SESSION['user_id_session'];

        //get blog id from url
        if (isset($_GET['blog_id'])){

            $blog_id = $_GET['blog_id'];
            $user_id = $_SESSION['user_id_session'];

            //check blog_id and user_id is already liked or not
            $query1 = "SELECT * FROM `dislike` WHERE `user_id` = '$user_id' AND `blog_id` = '$blog_id'";
            $run_query1 = mysqli_query($con, $query1);
            $row = mysqli_num_rows($run_query1);
            
            if($row > 0){
                ?>
                <script>
                    window.history.back();
                </script>
                <?php
            } else {

                //delete entry form dislike table
                $query2 = "DELETE FROM `like` WHERE `user_id` = '$user_id' AND `blog_id` = '$blog_id'";
                $run_query2 = mysqli_query($con, $query2);

                //insert blog_id and user_id into like table
                $query2 = "INSERT INTO `dislike`(`id`, `user_id`, `blog_id`) VALUES (NULL,'$user_id','$blog_id')";
                $run_query2 = mysqli_query($con, $query2);
                if ($run_query2){
                    ?>
                    <script>
                        window.history.back();
                    </script>
                    <?php
                }

            }
            
        
        }

    }else{
        ?>
                    <script>
                        window.history.back();
                    </script>
                    <?php
    }



?>