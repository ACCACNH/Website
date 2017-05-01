<?php

require_once('dbconfig.php');

class FORUM
{

	private $conn;
	
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

	public function showCategory($cid)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id=:cid");
			$stmt->execute(array(':cid'=>$cid));
			$catRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 0){
				echo 'This category does not exist.';
			
			}else{
				while($stmt = $catRow)
				{
					echo '<h2>Topics in /' . $catRow['cat_name'] . '/ category</h2>';
				}
			}
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

	public function showTopic($cid)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT topic_id, topic_subject, topic_date, topic_cat FROM topics WHERE topic_cat=:cid");
			$stmt->execute(array(':cid'=>$cid));
			$topRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 0){
				echo 'This category does not exist.';
			
			}else{

				echo '<table border="1">
						<tr>
							<th>Topic</th>
							<th>Created at</th>
						</tr>';

				while($stmt = $topRow)
				{
					echo '<tr>';
                        echo '<td class="leftpart">';
                        echo '<h3><a href="topic.php?id=' . $topRow['topic_id'] . '">' . $topRow['topic_subject'] . '</a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                        echo date('d-m-Y', strtotime($topRow['topic_date']));
                        echo '</td>';
                    echo '</tr>';
				}
			}
			catch(PDOException $e)
			{
			echo $e->getMessage();
			}
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
		try
		{
			$stmt = $this->conn->prepare("SELECT 
											posts.post_topic,
											posts.post_content,
											posts.post_date,
											posts.post_by,
											users.user_id,
											users.user_name
										  FROM posts LEFT JOIN users ON posts.post_by = users.user_id WHERE posts.post_topic = :tid");

			$stmt->execute(array(':tid'=>$tid));
			$postRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 0){
				echo 'There are no posts in this topic yet.';
			}else{

				echo '<table border="1">
						<tr>
							<th>Posted by</th>
							<th>Content</th>
						</tr>';

				while($stmt = $postRow)
                {               
                    echo '<tr>';
                        echo '<td class="leftpart_posts">';
                        echo $postRow['user_name'];
                        echo '<br>';
                        echo $postRow['post_date'];
                        echo '</td>';
                        echo '<td class="rightpart_posts">';
                        echo $postRow['post_content']; 
                        echo '</td>';
                    echo '</tr>';
                }
			}
			catch(PDOException $e)
			{
			echo $e->getMessage();
			}
		}
	}
}