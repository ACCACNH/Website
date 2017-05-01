<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);	
	
	if($uname=="")	{
		$error[] = "Provide username!";	
	}
	else if($umail=="")	{
		$error[] = "Provide e-mail!";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid e-mail address!';
	}
	else if($upass=="")	{
		$error[] = "Provide password!";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters!";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_name']==$uname){
				$error[] = "sorry username already taken !";
			}
			else if($row['user_email']==$umail){
				$error[] = "sorry email id already taken !";
			}
			else
			{
				if($user->register($uname,$umail,$upass)){
					$user->redirect('sign-up.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}
?>
<body>
	<form method="post" class="form-signin">
		<?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
		?>
            
        <div class="form-group">
			<input type="text" class="form-control" name="txt_uname" placeholder="Username" value="<?php if(isset($error)){echo $uname;}?>"/>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="txt_umail" placeholder="E-mail" value="<?php if(isset($error)){echo $umail;}?>"/>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="txt_upass" placeholder="Password"/>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="btn-signup">SIGN UP</button>
		</div>
		Have an account? <a href="index.php">Sign In</a>
    </form>
</body>