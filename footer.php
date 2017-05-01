</div>
</div>
		<aside>
			<div class="Videos" >
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
			<div id="one_course" >
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

</body>
</html>