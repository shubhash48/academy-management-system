
<?php
                            $username = $_SESSION['username'];
$query = "SELECT image FROM student WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    $userInfo = mysqli_fetch_assoc($result);

    // Display user information
     $imagefile=$userInfo['image'] ;
    

 
} 
?>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php" style="color:white; font-size: 50px;"> Rainbow Academy</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <div class="user-img-div text-center">
                    <img src="../img/<?php echo $imagefile; ?>" class="img-circle" style="width: 40px; height: 40px;" />
                        <h5 style="color: white;"><?php echo $_SESSION['username'];?></h5>
                        
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /. NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <!-- ... Your sidebar menu items ... -->
                    <li>
                      
                    <div class="user-img-div text-center">
                            <img src="logo.png" class="img" />
                            <h5 style="color:white;">
                        </div>

                    </li>


                    <li>
                        <a class="<?php if($page=='dashboard'){ echo 'active-menu';}?>" href="dashboard.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
					
					 <li>
                        <a class="<?php if($page=='studentdetails'){ echo 'active-menu';}?>" href="details.php"><i class="fa fa-user "></i>My details</a>
                    </li>

                    <li>
                        <a class="<?php if($page=='fees'){ echo 'active-menu';}?>" href="fees.php"><i class="fa fa-money "></i>My Fee</a>
                    </li>

                    
                    
					
					
					<li>
                        <a class="<?php if($page=='setting'){ echo 'active-menu';}?>" href="setting.php"><i class="fa fa-cogs "></i>Account Setting</a>
                    </li>

                   
					
					 <li>
                        <a href="logout.php"><i class="fa fa-power-off "></i>Logout</a>
                    </li>
					
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->

        <!-- Rest of your content here -->

    </div>
</body>


