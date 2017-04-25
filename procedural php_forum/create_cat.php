<?php
//create_cat.php
include 'connect.php';
include 'header.php';
if($_SESSION['user_level'] == 1)
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
        $cat_name=mysqli_real_escape_string($link,$_POST['cat_name']);
        $cat_description=mysqli_real_escape_string($link,$_POST['cat_description']);
        $sql="INSERT INTO categories(cat_name, cat_description)
            VALUES ('" . $cat_name. "',
                    '" .$cat_description."'
                    )";
        $result=mysqli_query($link,$sql);
        if(!$result)
        {
            //Error
            echo 'Error' . mysqli_error($link);
        }
        else
        {
            $cat_name='';
            $cat_description='';
            echo 'New category successfully added.';
        }
    }
}
else
{
   echo "You don't have admin right's"; 
}

include 'footer.php';
?>