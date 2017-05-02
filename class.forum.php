<?php

require_once('dbconfig.php');

class FORUM
{

	public $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
    
    public function reply()
    {
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
                //a real user posted a real reply
                $stmt = $this->conn->prepare("INSERT INTO 
                            posts(post_content,
                                  post_topic,
                                  post_by) 
                        VALUES (:rcontent, 
                                :id,
                                :uid)");

                $stmt->bindparam(":rcontent", $_POST['reply-content']);
                $stmt->bindparam(":id", $_GET['id']);
                $stmt->bindparam(":uid", $_SESSION['user_id']);

                $result = $stmt->execute();

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
    }
    
	public function addCategory($cname, $cdesc)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO categories(cat_name,cat_description) VALUES(:cname, :cdesc)");
												  
			$stmt->bindparam(":cname", $cname);
			$stmt->bindparam(":cdesc", $cdesc);

			$stmt->execute();
			
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

    	public function showAll()
        {
            $stmt = $this->conn->prepare("SELECT cat_id, cat_name, cat_description FROM categories");
            $result=$stmt->execute();
            if(!$result)
            {
                echo 'The categories could not be displayed, please try again later.';
            }
            else
            {

                if($stmt->rowCount() == 0)
                {
                    echo 'No categories defined yet.';
                }
                else
                {
                    //prepare the table
                    echo '<table>';
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    { 
                        echo '<tr>';
                        echo '<th>
                                <a href="category.php?id=' .$row['cat_id']. '">' .$row['cat_name']. '</a> - ' .$row['cat_description'].'
                              </th>';
                    }
                    echo '</table>';
                }
            }
        }
    
        
	public function showCategory($cid)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id=:cid");
            $result = $stmt->execute(array(':cid'=>$cid));
            if(!$result)
            {
                echo 'The category could not be displayed, please try again later.';
            }
            else
            {
                if($stmt->rowCount() == 0)
                {
                    echo 'This category does not exist.';
                }
                else
                {

                    //do a query for the topics
                    $sql = "SELECT  
                                topic_id,
                                topic_subject,
                                topic_date,
                                topic_cat
                            FROM
                                topics
                            WHERE
                                topic_cat ='".$cid."'  ";
                    $stmt = $this->conn->prepare("SELECT topic_id, topic_subject, topic_cat FROM topics WHERE topic_cat =:cid");

                    $result = $stmt->execute(array(':cid'=>$cid)); 

                    if(!$result)
                    {
                        echo 'The topics could not be displayed, please try again later.';
                    }
                    else
                    {
                        if($stmt->rowCount() == 0)
                        {
                            echo 'There are no topics in this category yet.';
                        }
                        else
                        {

                            //prepare the table
                            echo '<table>
                                  <tr>
                                    <th>Topic</th>
                                  </tr>'; 

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                            {               
                                echo '<tr>
                                        <td>
                                            <a href="topic.php?id=' .$row['topic_id']. '">' .$row['topic_subject']. '</a>
                                        </td>
                                      </tr>';
                            }

                            echo '</table>';
                        }
                    }
                }
            }
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
    public function create_topic(){
        echo '<h2>Create a topic</h2>';
        if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
        {
            //the user is signed in
            if($_SERVER['REQUEST_METHOD'] != 'POST')
            {   
                //the form hasn't been posted yet, display it
                //retrieve the categories from the database for use in the dropdown
                $stmt = $this->conn->prepare("SELECT
                    cat_id,
                    cat_name,
                    cat_description
                    FROM
                    categories");
                                                  
                 
                $result =$stmt->execute();

                if(!$result)
                {
                    //query failed
                    echo 'Error while selecting from database. Please try again later.';
                }
                else
                {
                    if($stmt->rowCount() == 0)
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
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
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
                $result =$this->runQuery($query);

                if(!$result)
                {
                    //query failed, quit
                    echo 'An error occured while creating your topic. Please try again later.';
                }
                else
                {

                    //the form has been posted, so save it
                    //insert the topic into the topics table first, then we'll save the post into the posts table
                    $result =$this->addTopic($_POST['topic_subject'],$_POST['topic_cat'],$_SESSION['user_id']);
                    if(!$result)
                    {
                        //error
                        echo 'An error occured while inserting your data. Please try again later.';
                        $sql = "ROLLBACK;";
                        $result =$this-> runQuery($sql);
                    }
                    else
                    {
                        //first query functional , start second query, (posts query)
                        //retrieve the id of the freshly created topic for usage in the posts query

                        $result =$this-> addPost($_POST['post_content'], $this->conn->lastInsertId(), $_SESSION['user_id']);

                        if(!$result)
                        {
                            //error
                            echo 'An error occured while inserting your post. Please try again later.';
                            $sql = "ROLLBACK;";
                            $result = $this->runQuery($sql);
                        }
                        else
                        {
                            $sql = "COMMIT;";
                            $result =$this-> runQuery($sql);

                            echo 'You have successfully created <a href="topic.php?id='. $this->conn->lastInsertId() . '">your new topic</a>.';
                        }
                    }
                }
            }
        }
        else
        {
        //the user is not signed in
        echo 'Sorry, you have to be <a href="login.php">signed in</a> to create a topic.';
}
        
    }
    public function selectCategories(){
        try
		{
			$stmt = $this->conn->prepare("SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories");
												  
			$stmt->execute();
			
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
    
	public function addTopic($tsubject, $tcategory, $uid)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO topics(topic_subject, topic_cat, topic_by) VALUES (:tsub, :tcat, :uid)");
												  
			$stmt->bindparam(":tsub", $tsubject);
			$stmt->bindparam(":tcat", $tcategory);
			$stmt->bindparam(":uid", $uid);

			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}



	public function addPost($pcontent, $ptopic, $uid)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO posts(post_content, post_topic, post_by) VALUES (:pcontent, :ptopic, :uid)");
												  
			$stmt->bindparam(":pcontent", $pcontent);
			$stmt->bindparam(":ptopic", $ptopic);
			$stmt->bindparam(":uid", $uid);

			$stmt->execute();
			
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

public function showPost($tid)
	{
        $stmt = $this->conn->prepare("SELECT topic_id,
                                            topic_subject
                                    FROM
                                        topics
                                    WHERE 
                                    topic_id = :tid"
                                    );



        $result = $stmt->execute(array(':tid'=>$tid));
        if(!$result)
        {
            echo 'The topic could not be displayed, please try again later.' ;
        }
        else
        {
            if($stmt->rowCount() == 0)
            {
                echo 'This topic does not exist.';
            }
            else
            {
                //display category data
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<h2">Posts in ' .$row['topic_subject']. ' category</h2>';
                }

                //do a query for the topics
                $stmt = $this->conn->prepare("SELECT 
                                        posts.post_topic,
                                        posts.post_content,
                                        posts.post_date,
                                        posts.post_by,
                                        users.user_id,
                                        users.user_name
                                        FROM posts LEFT JOIN users ON posts.post_by = users.user_id WHERE posts.post_topic = :tid");

                $result = $stmt->execute(array(':tid'=>$tid));

                if(!$result)
                {
                    echo 'The posts could not be displayed, please try again later.';
                }
                else
                {
                    if($stmt->rowCount() == 0)
                    {
                        echo 'There are no posts in this topic yet.';
                    }
                    else
                    {
                        //prepare the table
                        echo '<table>';

                        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                        {               
                            echo '<tr>
                                <th>Username: ' .$row['user_name'].'</th>
                                </tr>
                                <tr>
                                <th>' .$row['post_content']. ' ' .$row['post_date']. '</th>
                                </tr>';
                        }

                        echo '</table>';

                     echo '<div id="reply"> 
                            <h4>Reply:</h4>
                                <form method="post" action="reply.php?id=' . $tid . '">
                                    <textarea name="reply-content"></textarea>
                                    <input type="submit" value="Submit reply"/>
                                </form>
                           </div>'; 
                    }
                }
            }
        }
	}
}