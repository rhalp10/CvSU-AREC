﻿ <?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Dashboard";
    $username = $_SESSION['login_user'];
    $user_img = "../assets/images/user.png";
    $user_email = "mail@gmail.com";
    $script_for_specific_page = "index";
    if(isset($_SESSION['login_level']) )
    {      
     $login_level = $_SESSION['login_level'];
       
         
    }


    if (empty($_REQUEST['page'])) {
        $page = "";
    }
    else{
        $page = $_REQUEST['page'];
    }
?>
<!DOCTYPE html>
<html>
 <?php
    include("dash-head.php");
    ?>
<body class="theme-green ">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <?php 
        include('dash-topnav.php');
    ?>
    <section>
        <?php 
        include("dash-sidenav-left.php");
        ?>

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            </ol>

            <?php
            $sql = "SELECT * FROM `user_accounts` WHERE level_ID = 1";
            $result = mysqli_query($conn, $sql);
            $researcher_count = mysqli_num_rows($result) ;
            $sql = "SELECT * FROM `user_accounts` WHERE level_ID = 2";
            $result = mysqli_query($conn, $sql);
            $admin_count = mysqli_num_rows($result) ;
            $sql = "SELECT * FROM `locations` WHERE location_status = 1";
            $result = mysqli_query($conn, $sql);
            $biogas_count = mysqli_num_rows($result) ;
             ?>
           
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 

                <div class="col-sm-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">RESEARCHER</div>
                      <div class="panel-body">
                        <h3><?php echo $researcher_count?></h3>
                      </div>
                    </div>
                </div>
                <div class="col-sm-4">
                     
                    <div class="panel panel-default">
                      <div class="panel-heading">ADMIN</div>
                      <div class="panel-body">
                        <h3><?php echo $admin_count?></h3>
                      </div>
                    </div>
                </div>
                <div class="col-sm-4">
                     
                    <div class="panel panel-default">
                      <div class="panel-heading">BIOGAS</div>
                      <div class="panel-body">
                        <h3><?php echo $biogas_count?></h3>
                      </div>
                    </div>
                </div>
               </div>
           </div>
        </div>
    </section>

    <?php 
        include("dash-js.php");
    ?>
</body>

</html>
