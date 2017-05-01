<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong!";
	}	
}
?>
<body>
    <form class="form-signin" method="post" id="login-form">
        <?php
			if(isset($error))
			{
				echo $error;
			}
		?>
    
    <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or e-mail" required/>
    </div>
    
    <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Password"/>
    </div>

    <div class="form-group">
        <button type="submit" name="btn-login" class="btn btn-default">SIGN IN</button>
    </div>
        Don't have account yet? <a href="sign-up.php">Sign Up!</a>
    </form>
</body>