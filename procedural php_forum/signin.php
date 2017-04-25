<?php
//signin.php
include 'connect.php';
include 'header.php';
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
            Username: <input type="text" name="user_name"/>
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
            //no errors save the data
            $username=mysqli_real_escape_string($link,$_POST['user_name']);
            $password = hash("sha256", ($_POST['user_pass']));

            $sql="SELECT
                user_id,
                user_name,
                user_level
                FROM 
                    users 
                WHERE 
                    user_name='$username'
                and 
                    user_pass='$password'";
            $result=mysqli_query($link,$sql);
            if(!$result)
            {
                //Error
                echo 'There was an error while singing in. Try again later.'; 
                echo mysqli_error($link);//debug
            }
            else
            {
                /*Query succesfull
                1.Corresponding entry data and mysql data (log in)
                2.The username or pass was incorrect
                */
                $row_cnt = mysqli_num_rows($result);
                if($row_cnt==0)
                {
                    echo 'Wrong username/password , please try again.';
                }
                else
                {
                    //$SESSION TRUE (signed in (true)
                    $_SESSION['signed_in']=true;
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $_SESSION['user_id']    =$row['user_id'];
                        $_SESSION['user_name']  =$row['user_name'];
                        $_SESSION['user_level'] =$row['user_level'];
                    }
                    $username='';
                    $password='';
                    echo 'Welcome, '. $_SESSION['user_name'] . ' <a href="index.php">Proceed to the forum overview</a>.';
                }
            }
        }
    }
}

include 'footer.php';
?>