<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';

if (isset($_GET['id']) && $_GET['id']){
	$topic_id=$_GET['id'];
}else{
	$topic_id=0;
}

$forum->showPost($topic_id); 
include 'footer.php';
?>