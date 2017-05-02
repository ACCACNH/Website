<?php
include 'header.php';
session_destroy();
session_unset();
unset($_SESSION["signed_in"]);
$_SESSION = array();
echo '	<h1 class="heading" style="font-size:40px;">Logout</h1>

		<div id="main" style="max-width: 90% !important; margin-top:10%;">
            <div id="news" style="">
                <div style="clear: both"><br></div>
                    <div class="content-fluid" style="z-index: 0; position:relative;">
                        <div class="col-lg-9 col-md-9 col-sm-11 " style="z-index: 0; position:relative;">
                            <div class="regui"style="z-index: 0; position:relative;">
                           		<h1 class="text" margin-top: 20%; style="font-size:18px">
                                You have successfully logged out
                                <a href="index.php"> home</a>.
                            	</h1>

                        </div>
                    </div>
                </div>
            </div>
        </div>





';
include 'footer.php';
?>