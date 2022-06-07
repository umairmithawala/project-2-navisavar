<?php
require_once 'database/db-con.php';

?>

<?php
if (isset($_POST['login_submit'])) {

    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    $query3 = "SELECT * FROM `users` WHERE `email` = '$login_email' AND `password` = '$login_password'";
    $run_query3 = mysqli_query($con, $query3);
    $no_of_rows = mysqli_num_rows($run_query3);
    if ($run_query3 == TRUE && $no_of_rows > 0) {
        $data = mysqli_fetch_assoc($run_query3);
        $_SESSION['user_id_session'] = $data['id'];
?>
    <?php
    } else {
    ?>
        <script>
            alert('Email or password may wrong');
        </script>
<?php
    }
}

?>

<?php

if (isset($_POST['signup_submit'])) {

    $name_signup = $_POST['name_signup'];
    $email_signup = $_POST['email_signup'];
    $password_signup = $_POST['password_signup'];
    $timestamp = time();

    //check if email already exist
    $query6 = "SELECT * FROM `users` WHERE `email` = '$email_signup'";
    $run_query6 = mysqli_query($con, $query6);
    if ($run_query6 == TRUE && mysqli_num_rows($run_query6) > 0) {
        echo '<script>alert("Email already exist")</script>';
    } else {


        $query2 = "INSERT INTO `users`(`id`, `user_role`, `name`, `email`, `password`, 
        `timestamp`) VALUES (Null,2,'$name_signup',
       '$email_signup','$password_signup','$timestamp')";
        $run_query2 = mysqli_query($con, $query2);
        if ($run_query2) {
            //get last insert id
            $last_id = mysqli_insert_id($con);
            $_SESSION['user_id_session'] = $last_id;
?>
            <script>
                alert('Signup Successful!');
            </script>
<?php
        }
    }
}

?>
<style>
    .btn-theme-color {
        background-color: #3981C2;
    }

    .btn-theme-color:hover {
        background-color: #F58634;
    }
</style>
<!-- Main Header -->
<header class="main-header header-style-2 mb-40">
    <div class="header-bottom header-sticky background-white text-center">
        <div class="scroll-progress gradient-bg-1"></div>
        <div class="mobile_menu d-lg-none d-block"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <div class="header-logo d-none d-lg-block">
                        <a href="<?php echo $very_global_absolute_url; ?>">
                            <img class="logo-img d-inline" src="<?php echo $very_global_absolute_url; ?>assets/imgs/logo/navisavar-logo.png" alt="">
                        </a>
                    </div>
                    <div class="logo-tablet d-md-inline d-lg-none d-none">
                        <a href="<?php echo $very_global_absolute_url; ?>">
                            <img class="logo-img d-inline" src="<?php echo $very_global_absolute_url; ?>assets/imgs/logo/navisavar-logo.png" alt="">
                        </a>
                    </div>
                    <div class="logo-mobile d-block d-md-none">
                        <a href="<?php echo $very_global_absolute_url; ?>">
                            <img class="logo-img d-inline" src="<?php echo $very_global_absolute_url; ?>assets/imgs/favicon/favicon.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 main-header-navigation">
                    <!-- Main-menu -->
                    <!-- Mobile menu -->
                    <div class="main-nav text-left float-md-right">
                        <ul class="mobi-menu d-none menu-3-columns" id="navigation">
                            <?php
                            //get all categories
                            $query1 = "SELECT * FROM `category_list` limit 5";
                            $run_query1 = mysqli_query($con, $query1);
                            $num_of_categories  = mysqli_num_rows($run_query1);
                            if ($run_query1) {
                                while ($data = mysqli_fetch_assoc($run_query1)) {
                                    $category_id = $data['id'];
                                    $unique_link = $data['unique_link'];

                            ?>
                                    <li><a href="<?php echo $very_global_absolute_url; ?>category/<?php echo $unique_link ?>"><?php echo $data['name']; ?></a></li>

                            <?php
                                }
                            }

                            ?>
                            <li> <a href="<?php echo $very_global_absolute_url; ?>contact">સંપર્ક</a> </li>
                            <li> <a href="<?php echo $very_global_absolute_url; ?>about">વિશે</a> </li>
                            <?php

                            if (!isset($_SESSION['user_id_session'])) {
                                $num_of_rows_session = 3;
                            ?>
                                <li> <a class="btn btn-danger btn-theme-color mt-10 btn-sm" id="login_btn" style="min-width:auto !important;" data-toggle="modal" data-target="#exampleModal"> login </a> </li>
                            <?php
                            } else {
                                $num_of_rows_session = 4;
                            ?>
                                <li> <a href="<?php echo $very_global_absolute_url; ?>profile"> Profile </a> </li>
                                <li> <a href="<?php echo $very_global_absolute_url; ?>logout"> Logout </a> </li>
                            <?php
                            }
                            ?>

                            <?php

                            for ($i = 1; $i < $num_of_categories - $num_of_rows_session; $i++) {

                            ?>
                                <li> <a href=""> &nbsp; </a> </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <nav>
                            <ul class="main-menu d-none d-lg-inline">
                                <li class="mega-menu-item">
                                    <a href="#">
                                        <span class="mr-15"><?php

                                                            $query5 = "SELECT * FROM `category_list` limit 5";
                                                            $run_query5 = mysqli_query($con, $query5);
                                                            $data = mysqli_fetch_assoc($run_query5);
                                                            echo $data['name'];

                                                            ?></span><i class="fas fa-caret-down"></i>
                                    </a>
                                    <div class="sub-mega-menu sub-menu-list text-muted font-small">

                                        <ul>
                                            <?php
                                            //get all categories
                                            $query1 = "SELECT * FROM `category_list` limit 5";
                                            $run_query1 = mysqli_query($con, $query1);
                                            if ($run_query1) {
                                                while ($data = mysqli_fetch_assoc($run_query1)) {
                                                    $category_id = $data['id'];
                                                    $unique_link = $data['unique_link'];
                                            ?>
                                                    <li><a href="<?php echo $very_global_absolute_url; ?>category/<?php echo $unique_link ?>"><?php echo $data['name']; ?></a></li>

                                            <?php
                                                }
                                            }

                                            ?>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?php echo $very_global_absolute_url; ?>about"><span class="mr-15">

                                        </span>અમારા વિશે</a>
                                </li>
                                <li><a href="<?php echo $very_global_absolute_url; ?>contact"><span class="mr-15">

                                        </span>સંપર્ક</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3">
                    <?php
                    if (!isset($_SESSION['user_id_session'])) {
                    ?>
                        <div class="d-none d-lg-block" style="float:right;">
                            <button type="button" class="btn btn-danger btn-theme-color" id="login_btn" style="min-width:auto !important; padding: 20px 20px !important;" data-toggle="modal" data-target="#exampleModal">
                                Login
                            </button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="d-none d-lg-block" style="float:right;">
                            <ul class="main-menu d-none d-lg-inline" style="min-width:200px;">
                                <li class="mega-menu-item" id="user_profile_btn" style="min-width: 100px !important;">
                                    <?php
                                    //get name of user from users table
                                    $user_id = $_SESSION['user_id_session'];
                                    $query4 = "SELECT * FROM `users` WHERE `id` = '$user_id' AND `is_banned` = '0'";
                                    $run_query4 = mysqli_query($con, $query4);
                                    if ($run_query4) {
                                        $data = mysqli_fetch_assoc($run_query4);
                                        $name = $data['name'];
                                    } else {
                                        $name = 'User';
                                    }

                                    // echo $name;
                                    ?>
                                    <a href="#">
                                        <?php

                                        //name only 7 characters
                                        if (strlen($name) > 6) {
                                            $name = substr($name, 0, 6) . '...';
                                        }

                                        echo $name;
                                        ?>

                                    </a>

                                    <div class="sub-mega-menu sub-menu-list text-muted font-small" style="right: 0px; padding:0px 30px!important;">

                                        <ul>
                                            <a href="<?php echo $very_global_absolute_url; ?>profile">
                                                <li>Profile</li>
                                            </a>
                                            <a href="<?php echo $very_global_absolute_url; ?>logout">
                                                <li>Logout</li>
                                            </a>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>


<!--Login Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="post-title pr-5 pl-5 mb-10 mt-15 text-limit-2-row text-center " id="exampleModalLabel">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="login_email">
                    </div>
                    <div class="form-group">
                        <label for="" class="widget-title" style="font-weight:500 !important" ;>Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="login_password">
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="exampleCheck1" style="float: right; font-size :13px;"> <a href="">Forgot Password?</a></label>
                    </div>

                </div>
                <div class="modal-footer text-center mt-20" style="display:block !important;">
                    <button type="submit" class="btn btn-primary widget-title" name="login_submit">Login</button>
                    <p class="mt-15" style="font-size: 13px;">Don't have Account? <span><a href="" data-toggle="modal" data-target="#signupModal" data-dismiss="modal" aria-label="Close" style="color: #3981C2 !important;">Create Account</a></span></p>
                </div>
            </form>
        </div>
    </div>
</div>
<div>

</div>

<!-- signup modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="post-title pr-5 pl-5 mb-10 mt-15 text-limit-2-row text-center " id="exampleModalLabel">Signup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name_signup">
                    </div>
                    <div class="form-group">
                        <label class="widget-title" for="exampleInputEmail1" style="font-weight:500 !important;">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email_signup">
                    </div>
                    <div class="form-group">
                        <label for="" class="widget-title" style="font-weight:500 !important" ;>Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password_signup">
                    </div>
                </div>
                <div class="modal-footer text-center" style="display:block !important;">
                    <button type="submit" class="btn btn-primary widget-title" name="signup_submit">Signup</button><br>
                    <small>Already have an Account? <a href="" data-toggle="modal" data-target="#exampleModal" data-dismiss="modal"><span style="color:#3981C2">Login</span></a></small>
                </div>
            </form>
        </div>
    </div>
</div>