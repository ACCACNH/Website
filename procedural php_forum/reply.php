<?php
//reply.php
include 'connect.php';
include'header.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //someone is calling the file directly, which we don't want
    echo 'This file cannot be called directly.';
}
else
{
    //check for sign in status
    if(!$_SESSION['signed_in'])
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
        /*a real user posted a real reply
        http://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php 
        GDE USER PISHET I ETI DANNIE OTPRAVLJAJUTSJA V MYSQL TAM MOZNO INJECTNUTJ V MYSQL KOMMANDU 
        DOPUSTIM $_POST['reply-content'] CEL ZAPIWET (') I IZZA OPOSTROFA VVOD BUDET SLOMAN TAK KAK V
        "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                !!!!!!!VALUES ('" . (') . "', I SLOMAET VVOD , POETOMU TUDA MOZNO I ZAPISATJ POLNOCENNIJE MYSQL KOMMANDI VRODE DROP DB USERS;
        */
        $sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "', 
                        NOW(),
                        " . mysqli_real_escape_string($link,$_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = mysqli_query($link,$sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        }
    }
}
 
include 'footer.php';
?>