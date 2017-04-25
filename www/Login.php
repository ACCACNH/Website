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
	<div id="wrapper">
		<div id="content" style="width: 100% !important">
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
						<a href="Login.php">
							<div class="btn">Log in</div>
						</a>
						<a href="Register.php">
							<div class="btn">Register</div>
						</a>
				</div>
			</header>

		<nav  style="z-index: 1;">
			<div id="menuShow"><i class="fa fa-bars" aria-hidden="true"></i></div>
			<div id="hideMenu">
				<a href="index.php" >Home</a>
		        <a href="News.html">Site rules</a>
	            <a href="Gallery.html">Gallery</a>
			    <a href="Videos.html">Videos</a>
			    <a href="About.html">About</a>
			</div>

		    	 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4" style="float: right">
					<div class="input-group" >
				    	<input type="text" class="form-control" placeholder="Search for..." style="border-radius: 30px 0px 0px 30px;">
				    		<span class="input-group-btn">
				        		<button class="btn btn-default" type="button" class="search" style="border-radius: 0px 30px 30px 0px; margin-top: 0px;"><i class="fa fa-search" aria-hidden="true"></i></button>
				    		</span>
				    	</div><!-- /input-group -->
				 	</div><!-- /.col-lg-6 -->


		    <div id="mobileMenu" style="margin-left: 10%;">
		    	<a href="index.php" >Home</a><br>
		        <a href="News.html">Site rules</a><br>
	            <a href="Gallery.html">Gallery</a><br>
			    <a href="Videos.html">Videos</a><br>
			    <a href="About.html">About</a>
			    <hr>
			    <a href="About.html">Login</a>
			    <a href="About.html">Register</a>
		    </div>
		</nav>

		<div id="main" style="max-width: 90% !important;">
			<div id="news" style="">
				<h2 class="heading">FF News</h2>
				<div style="clear: both"><br></div>

					<div class="content-fluid" style="z-index: -1;">
						<div class="col-lg-9 col-md-9
						 col-sm-11 ">
							<div class="regui" style="z-index: -1;">


					<h2 class="heading">Чтобы войти на сайт используйте ваш email и пароль, которые были указаны при регистрации на сайт</h2>
					<br>
					<h2 class="heading">To enter the site use your email and password, which were specified during registration on the site</h2>

						<div id="login">



						                <h1>Log in with your email account</h1>
						                    <form role="form" action="javascript:;" method="post" id="login-form" autocomplete="off">
						                        <div class="form-group">
						                            <label for="email" class="sr-only">Email</label>
						                            <input type="text" name="Nickname" id="email" class="form-control" placeholder="Nickname">
						                        </div>
						                        <div class="form-group">
						                            <label for="key" class="sr-only">Password</label>
						                            <input type="password" name="key" id="key" class="form-control" placeholder="Password">
						                        </div>
						                        <div class="checkbox">
						                            <span class="character-checkbox" onclick="showPassword()"></span>
						                            <span class="label">Show password</span>
						                        </div>
						                        <input type="submit" id="btn-login" class="btn-login" value="Log in" style="margin-right: 10%">

						                    </form>
						                    <a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal">Forgot your password?</a>
						                    <hr>

						</div>

						<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">×</span>
											<span class="sr-only">Close</span>
										</button>
										<h4 class="modal-title">Recovery password</h4>
									</div>
									<div class="modal-body">
										<p>Type your email account</p>
										<input type="email" name="recovery-email" id="recovery-email" class="form-control" autocomplete="off">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-custom">Recovery</button>
									</div>
								</div> <!-- /.modal-content -->
							</div> <!-- /.modal-dialog -->
						</div> <!-- /.modal -->



								</div>
							</div>
						</div>


			</div>
		</div>
		<aside>
			<div class="Videos">
				<h2 class="heading">Videos</h2>
				<div style="clear: both"><br></div>

				<?php
					for ($i= 0; $i <4; $i++)
						echo '
							<div class="course">

									<div class="col-lg-9 col-md-10 col-sm-10 col-xs-10" style="z-index:-1;">
									<div class="embed-responsive embed-responsive-16by9" id="videos" >
		    							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/z-uHE8BWjOQ" style="height:100%" ></iframe>
									</div>
									<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
									</div>

							</div>';
				?>
				<a href="">
					<div class="btn">
						Show more videos
					</div>
				</a>
			</div>
			<div style="clear: both"><br></div>
			<div id="one_course">
				<h2 class="heading">Your ad here</h2>
				<div style="clear: both"><br></div>
				<img src="https://images.alphacoders.com/724/724313.jpg" alt="Test" title="Test">
			</div>
		</aside>
		<div style="clear: both"><br></div>

		</div>



		<footer style="	width: 100% !important;">
			<div id="site_name">
				<span>Final Fantasy</span>
			</div>

			<div id="footer_menu">

				<a href="">Advertisments</a>
				<a href="">About site</a>
				<a href="">Terms of use</a>
			</div>
			<div id="rights">
				<a href="">All rights reserved &copy; <?=date ('Y')?></a>
			</div>
			<div id="social">
				<a href="" title="VK"><i class="fa fa-vk" aria-hidden="true"></i></a>
				<a href="" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				<a href="" title="Google+"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
				<a href="" title="Youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
			</div>
		</footer>

	</div>

<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
    	$('#menuShow').click (function () {
    		if ($('#mobileMenu').is(':visible')) 
    			$('#mobileMenu').hide ();
    		else
    			$('#mobileMenu').show ();
    	});

    	$(document).scroll (function () {
    		if ($(document).width () > 785) {
	    		if ($(document).scrollTop () > $('header').height () + 10)
	    			$('nav').addClass ('fixed');
	    		else
	    			$('nav').removeClass ('fixed');
    		}
    	});

    	window.onresize = function (event) {
    		$('#mobileMenu').hide ();
    	};



    </script>

    <script >
    	function showPassword() {
    
    var key_attr = $('#key').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#key').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#key').attr('type', 'password');
        
    }
    
}
    </script>
</body>
</html>