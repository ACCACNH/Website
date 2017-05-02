<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';
if (!isset($_SESSION['user_level']))
{
   echo "You need to be logged in to use this feature!";
}
else if($_SESSION['user_level'] == 1)
{
   if ($_SERVER['REQUEST_METHOD']!='POST')
    {
        //pre-submit
          echo '<form method="post" action="">
            Category name: <input type="text" name="cat_name" required />
            Category description: <textarea name="cat_description" required/></textarea><br>
            <input type="submit" value="Add category"/>
         </form>';
    }
    else
    {
        $result=$forum->addCategory($_POST['cat_name'],$_POST['cat_description']);
        if(!$result)
        {
            //Error
            echo 'There was a problem';
        }
        else
        {
            echo 'New category successfully added.';
        }
    }
}
else
{
    echo "You don't have admin right's!";
}
 
include 'footer.php';
?>