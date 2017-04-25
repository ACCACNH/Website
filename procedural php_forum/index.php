<?php
include 'connect.php';
include 'header.php';
 
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories";
 
$result = mysqli_query($link,$sql);
 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later :< .';
}
else
{
    //$row_cnt = mysqli_num_rows($result);
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>'; 
             
        while($row = mysqli_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                            echo '<a href="topic.php?id=">Topic subject</a> ';//MAX mysqli_insert_id  (http://php.net/manual/en/mysqli.insert-id.php)
            /*echo '<a href="topic.php?id=">Topic subject</a> NADO WTOB POSLEDNIJ TOPIC OTOBROZHALSJA 
            echo '<a href="topic.php?id=' .     $row['topic_id'] . '">' . $row['topic_subject'] . '</a>';
                        echo '</td>';
            MOZEW POSMOTRETJ WTO TAKOJE AJAX JQUERY WTOB 
            
            */
                echo '</td>';
            echo '</tr>';
        }
    }
}
 
include 'footer.php';
?>