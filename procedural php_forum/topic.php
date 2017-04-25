<?php
//topic.php
include 'connect.php';
include 'header.php';
 
//select the category based on $_GET['id']
$topic_id=mysqli_real_escape_string($link,$_GET['id']);
 $sql = "SELECT
            topic_id,
            topic_subject
        FROM
            topics
       WHERE
            topic_id = '" . $topic_id . "' ";
 
$result = mysqli_query($link,$sql);
echo $topic_cat; 
if(!$result)
{
    echo 'The topic could not be displayed, please try again later.' . mysqli_error($link);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {
        //display category data
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<div><h2>Posts in /' .$row['topic_subject']. '/ category</h2>';
        }
     
        //do a query for the topics
        $sql = "SELECT
                posts.post_topic,
                posts.post_content,
                posts.post_date,
                posts.post_by,
                users.user_id,
                users.user_name
                FROM
                posts
                LEFT JOIN
                users
                ON
                posts.post_by = users.user_id
            WHERE
                posts.post_topic =  '" . $topic_id . "' ";
            
        $result = mysqli_query($link,$sql);
         
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no posts in this topic yet.';
            }
            else
            {
                //prepare the table
                echo '
                    <table border="1">
                      <tr>
                        <th>Posted by</th>
                        <th>Content</th>
                      </tr>'; 
                     
                while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart_posts">';
                        echo $row['user_name'];
                        echo '<br>';
                        echo $row['post_date'];
                        echo '</td>';
                        echo '<td class="rightpart_posts">';
                        echo $row['post_content']; 
                        echo '</td>';
                    echo '</tr>';
                }
             echo '<div id="reply"> 
                    <br>
                    <h3>Reply: </h3>
             <form method="post" action="reply.php?id=' . $topic_id . '">
            <textarea name="reply-content"></textarea><br>
            <input type="submit" value="Submit reply" />
            </form>
            </div>'; 
            }
        }
    }
}


include'footer.php';
?>