<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';
$topic_id=$_GET['id'];
$forum->showPost($topic_id); 
include 'footer.php';
?>