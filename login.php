<?php
//signin.php
include 'header.php';
require_once("class.user.php");
$login = new USER();
echo ' <h3>Sign in</h3>';

//loged in check
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="signout.php">sign out </a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD']!='POST')
    {
        /*form not posted , display form
        post will cause the form to post on the same page*/
        echo '<form method="post" action="">
            Username or email: <input type="text" name="user_name"/>
            Password:<input type="password" name="user_pass">
            <input type="submit" value="Sign in"/>
            </form>';
    }
    else
    {
        /*
        1.  Check the data
        2.  Refill the wrong fields (if necessary)
        3.  Varify the data and return the correct response
        */ 
        $errors=array(); //error array
        if(!isset($_POST['user_name']))
        {
            $errors[]='The username field is empty.';
        }
        
        if(!isset($_POST['user_pass']))
        {
            $errors[]='The password field is empty';
        }
        
        if(!empty($errors))//check for error array contents
        {
            echo 'Incorrect input, try again';
            echo '<ul>';
            foreach($errors as $key=>$value)
            {
                echo '<li>'. $value . '</li>';
            }
            echo '<ul>';
        }
        else
        {
            $uname = strip_tags($_POST['user_name']);
            $umail = strip_tags($_POST['user_name']);
            $upass = strip_tags($_POST['user_pass']);
            //no errors save the data
            $result=$login->doLogin($uname,$umail,$upass);
            if(!$result)
            {
                echo 'There was an error while singing in.'; 
            }
            else
            {
                echo 'Welcome, '. $_SESSION['user_name'] . ' <a href="index.php">Proceed to the forum overview</a>.';
            }
        }
    }
}


include 'footer.php';
?>