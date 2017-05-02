<?php
//signup.php
include 'header.php';
require_once('class.user.php');
$user = new USER();
 
echo '<h1 class="heading" style="font-size:46px;">Sign up</h1>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*form not posted , display form
    post will cause the form to post on the same page*/
    echo '

            <div id="main" style="max-width: 100% !important;margin-top:10%;">
            <div id="news">
                <div style="clear: both"><br></div>
                    <div class="content-fluid" style="z-index: -1;">
                        <div class="col-lg-9 col-md-10 col-sm-12 ">
                            <div class="regui" style="z-index: -1;">
                                    <div class="regcontainer" >
                                        <form id="contact" action="" method="post" style="margin: 5%;z-index: 1;">
                                            <p class="h3">Registration form</p>
                                            <p class="h4">Dont contact us for custom quote</p>
                                            <fieldset>
                                                <input placeholder="Username" type="text" tabindex="1" name="user_name" required autofocus>
                                            </fieldset>
                                            <fieldset>
                                                <input id="password" placeholder="Password" type="password" name="user_pass" tabindex="2" required>
                                            </fieldset>
                                            <fieldset>
                                                <input id="confirm_password" placeholder="Confirm Password" type="password" name="user_pass_check" tabindex="3" required>
                                            </fieldset>
                                            <fieldset>
                                                <input placeholder="Your Email Address" type="email" name="user_email" tabindex="4" required>
                                            </fieldset>
                                            <fieldset>
                                              <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" class="pure-button pure-button-primary">Submit</button>
                                            </fieldset>
                                        </form>
                                    </div>
                            </div>    
                        </div>
                    </div>

            </div>
        </div>


     ';
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