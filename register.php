<?php
//signup.php
include 'header.php';
require_once('class.user.php');
$user = new USER();
 
echo '<h3>Sign up</h3>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*form not posted , display form
    post will cause the form to post on the same page*/
    echo '<form method="post" action="">
        Username: <input type="text" name="user_name" /><br>
        Password: <input type="password" name="user_pass"><br>
        Password again: <input type="password" name="user_pass_check"><br>
        E-mail: <input type="email" name="user_email"><br>
        <input type="submit" value="register" />
     </form>';
}
else
{
     /*  1.  Check the data
        2.  Rewrite wrong fields (if necessary)
        3.  Save the data 
    */
    $errors = array(); //error array for output
     //USERNAME CHECK
    if(isset($_POST['user_name']))
    {
        //the user name exists
        if(!ctype_alnum($_POST['user_name']))
        //ctype_alnum — Check for alphanumeric character(s)
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }
     //----------------------------------------------------------
     //PASSWORD CHECK
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
    }
    //----------------------------------------------------------
    //Error check and display 
    if(!empty($errors)) //if there are errors , output the error array
    {
        echo 'Incorrect input , please try again';
        echo '<ul>';
        foreach($errors as $key => $value) //display all errors
        {
            echo '<li>' . $value . '</li>'; // error list 
        }
        echo '</ul>';
    }
    else
    {
        $uname = strip_tags($_POST['user_name']);
        $umail = strip_tags($_POST['user_email']);
        $upass = strip_tags($_POST['user_pass']);
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
                $result=$user->register($uname,$umail,$upass);
				if(!$result)
                {
                    //error
                    echo 'Something went wrong while registering. Please try again later.';
                }
            else
            {
                echo 'Successfully registered. You can now <a href="login.php">sign in</a> and start posting';
            }
        }
    }
}
 
include 'footer.php';
?>