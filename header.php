<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Final Fantasy forum</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/main_page.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div id="wrapper" >
		<div id="content" >
			<header>
				<div id="logo">
					<a href="index.php" title="Home">
						<img src="img/logo3.png" title="logo" alt="logo">
						<span>Final Fantasy</span>
					</a>		
				</div>
				<div id="about">
					<a href="" title="More about advertising">Ads</a>
					<a href="" title="Write a message">Contacts</a>
				</div>
				<div id="reg_auth">
                    <?php
                    if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
                    {
                        echo '	<div id="about"> 
		                      		Hello ,' . $_SESSION['user_name'] . ' 
		                      	</div>

		                      		<a href="signout.php" >
										<div class="btn"style="float:right;">Sign out</div>
									</a>

		                      	';
                    }
                    else{
                        echo '
						<a href="login.php">
							<div class="btn">Log in</div>
						</a>
						<a href="register.php">
							<div class="btn">Register</div>
						</a>';
                    }?>
				</div>
			</header>

		<nav style=" z-index: 9 !important;">
			<div id="menuShow"><i class="fa fa-bars" aria-hidden="true"></i></div>
			<div id="hideMenu">

				<a href="index.php" >Home</a>
                <a href="create_cat.php">Create category</a>
                <a href ="create_topic.php">Create topic</a>
			</div>

		    	 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4" style="float: right">
					<div class="input-group" >
				    	<input type="text" class="form-control" placeholder="Search for..." style="border-radius: 30px 0px 0px 30px;">
				    		<span class="input-group-btn">
				        		<button class="btn btn-default" type="button" class="search" style="border-radius: 0px 30px 30px 0px; margin-top: 0px;"><i class="fa fa-search" aria-hidden="true"></i></button>
				    		</span>
				    	</div><!-- /input-group -->
				 	</div><!-- /.col-lg-6 -->


		    <div id="mobileMenu" style="margin-left: 10%; ">
		    	        			<style>
			 a{  
                                    font-family: "Suez One", serif;
                                    font-size: 18px;
                                    color: black;
                                    text-decoration: none;
                                    transition: all.6s ease;
                                    -ms-transition: all.6s ease;
                                    -o-transition: all.6s ease;
                                    -moz-transition: all.6s ease;
                                    -webkit-transition: all.6s ease;
                                }

                                a:hover {
                                    color: rgba(150,150,150,1);;
                                    text-decoration: none;
                                    transition: all.6s ease;
                                    -ms-transition: all.6s ease;
                                    -o-transition: all.6s ease;
                                    -moz-transition: all.6s ease;
                                    -webkit-transition: all.6s ease;
                                }
			</style>
		    	<a href="index.php" >Home</a><br>
                <a href="create_cat.php">Create category</a>
                <br>
                <a href ="create_topic.php">Create topic</a>  
                <!--v melkoj versi(mobila) create cat i create topic na odnoj stroke -->
			    <hr>
			    <a href="About.html">Login    /</a>
			    <a href="Register.php">Register</a>
		    </div>
		</nav>

		<div id="main" >
            <div id="news">


