<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';
if (!isset($_SESSION['user_level']))
{
    echo 'Sorry, you have to be <a href="login.php">signed in</a> to create a topic.';
}
else if($_SESSION['user_level'] == 1)
{
   if ($_SERVER['REQUEST_METHOD']!='POST')
    {
        //pre-submit
          echo '
                <div id="main" style="max-width: 100% !important;">
                    <div id="news">
                        <h2 class="heading" style="font-size:40px;margin-left:5%;">Create category</h2>
                        <div style="clear: both"><br></div>
                            <div class="content-fluid" style="z-index: -1;">
                                <div class="col-lg-9 col-md-10 col-sm-12 ">
                                    <div class="regui" style="z-index: -1;">
                                            <div class="regcontainer" >

                                    <form action="" method="post" id="login-form" >
                                        <div class="form-group">
                                            Category name: <input type="text" name="cat_name" id="key" class="form-control" placeholder="Write category name" required />
                                        </div>
                                        <div class="form-group">
                                            Category description: <textarea name="cat_description" class="form-control" placeholder="Write category discription" style="max-width:100%; min-height:150px;" required/></textarea><br>

                                            <input type="submit" id="btn-login" class="btn-login" style="margin-right: 10%" value="Add category"/>
                                            
                                        </div>
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
        $result=$forum->addCategory($_POST['cat_name'],$_POST['cat_description']);
        if(!$result)
        {
            //Error
            echo '<h2 class="text" style="font-size:20px; margin-top:18%; margin-left:5%;">There was a problem</h2>';
        }
        else
        {
            echo '<h2 class="text" style="font-size:20px; margin-top:18%; margin-left:5%;">New category successfully added.</h2>';
        }
    }
}
else
{
   echo '<h2 class="text" style="font-size:20px; margin-top:18%; margin-left:5%;">You dont have admin rights</h2>'; 
}
 
include 'footer.php';
?>