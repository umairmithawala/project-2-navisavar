<?php
session_start();
require_once '../database/db-con.php';
?>

<?php


    $query1 = "SELECT * FROM `blog`";
    $run_query1 = mysqli_query($con,$query1);
    if ($run_query1) {
        while ($row = mysqli_fetch_array($run_query1)) {
            $blog_id = $row['id'];
            echo $blog_id."<br>";

            //count total likes from likes table
            $query2 = "SELECT * FROM `like` WHERE `blog_id` = $blog_id";
            $run_query2 = mysqli_query($con,$query2);

            if ($run_query2) {
                $total_likes = mysqli_num_rows($run_query2);
                echo 'total likes'.$total_likes."<br>";
            } else{
                $total_likes = 0;
            }

            //count total dislikes from dislikes table
            $query3 = "SELECT * FROM `dislike` WHERE `blog_id` = $blog_id";
            $run_query3 = mysqli_query($con,$query3);
            
            if ($run_query3) {
                $total_dislikes = mysqli_num_rows($run_query3);
                echo $total_dislikes."<br>";
            } else{
                $total_dislikes = 0;
            }



            //count total comments from comments table
            $query4 = "SELECT * FROM `comment` WHERE `blog_id` = $blog_id";
            $run_query4 = mysqli_query($con,$query4);
            
            if ($run_query4) {
                $total_comments = mysqli_num_rows($run_query4);
                echo $total_comments."<br>";
            } else{
                $total_comments = 0;
            }


            //update blog table with total likes, total dislikes and total comments
            $query5 = "UPDATE `blog` SET `likes` = $total_likes, `dislike` = $total_dislikes, `comment` = $total_comments WHERE `id` = $blog_id";
            $run_query5 = mysqli_query($con,$query5);
            if ($run_query5) {
                echo "Updated<br>";
            } else {
                echo "Not Updated<br>";
            }


            

        }
    }


?>