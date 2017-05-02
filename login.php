<?php
//signin.php
include 'header.php';
require_once("class.user.php");
$login = new USER();
echo ' <h1 class="heading" style="font-size:40px;">Sign in</h1>';

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
        echo '       
            <div id="main" style="max-width: 90% !important; margin-top:10%;">
                <div id="news" style="">
                
                <div style="clear: both"><br></div>
                    <div class="content-fluid" style="z-index: 0; position:relative;">
                        <div class="col-lg-9 col-md-9 col-sm-11 " style="z-index: 0; position:relative;">
                            <div class="regui"style="z-index: 0; position:relative;">

            <h2 class="text" style="font-size:18px;">Чтобы войти на сайт используйте ваш email и пароль, которые были указаны при регистрации на сайт</h2>
            <br>
            <h2 class="text" style="font-size:18px;">To enter the site use your email and password, which were specified during registration on the site</h2>


            <div id="login">
                <h1>Log in</h1>
                    <form action="" method="post" id="login-form" >
                        <div class="form-group">
                            <input type="text" name="user_name" id="email" class="form-control" placeholder="Username or Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_pass" id="key" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit" id="btn-login" class="btn-login" value="Sign in" style="margin-right: 10%">

                    </form>
                <hr>
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
                echo '
                    <div id="main" style="max-width: 90% !important; margin-top:10%;">
                        <div id="news" style="">
                            <div style="clear: both"><br></div>
                                <div class="content-fluid" style="z-index: 0; position:relative;">
                                    <div class="col-lg-9 col-md-9 col-sm-11 " style="z-index: 0; position:relative;">
                                            <div class="regui"style="z-index: 0; position:relative;">
                                                <h1 class="text" margin-top: 20%; style="font-size:18px">
                                                    Welcome, '. $_SESSION['user_name'] . '<br> <a href="index.php">Proceed to the forum overview</a>.
                                                    </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }
    }
}



include 'footer.php';
?>

