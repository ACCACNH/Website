<?php
//http://www.tutorialspoint.com/mysql/mysql-transactions.htm 
//create_topic.php
include 'connect.php';
include 'header.php';
 
echo '<h2>Create a topic</h2>';
if($_SESSION['signed_in'] == false)
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}
else
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {   
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysqli_query($link,$sql);
         
        if(!$result)
        {
            //query failed
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['user_level'] == 1)//user_level 1= admin
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
         
                echo '<form method="post" action="">
                    Subject: <input type="text" name="topic_subject" />
                    Category:'; 
                 
                echo '<select name="topic_cat">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>'; 
                     
                echo 'Message: <textarea name="post_content" /></textarea>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    }
    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($link,$query);
         
        if(!$result)
        {
            //query failed, quit
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
     
            //the form has been posted, so save it
            //insert the topic into the topics table first, then we'll save the post into the posts table
            $topic_subject=mysqli_real_escape_string($link,$_POST['topic_subject']);
            $topic_cat=mysqli_real_escape_string($link,$_POST['topic_cat']);
            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . $topic_subject . "',
                               NOW(),
                               " . $topic_cat . ",
                               " . $_SESSION['user_id'] . "
                               )";
                      
            $result = mysqli_query($link,$sql);
            if(!$result)
            {
                //error
                echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
                $sql = "ROLLBACK;";
                $result = mysqli_query($link,$sql);
            }
            else
            {
                //first query functional , start second query, (posts query)
                //retrieve the id of the freshly created topic for usage in the posts query
                $topicid = mysqli_insert_id($link);
                 
                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . mysqli_real_escape_string($link,$_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysqli_query($link,$sql);
                 
                if(!$result)
                {
                    //error
                    echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($link);
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($link,$sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($link,$sql);
                     
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                }
            }
        }
    }
}
 
include 'footer.php';
?>