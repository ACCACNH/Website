<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';
$cat_id=$_GET['id'];
$forum->showCategory($cat_id); 
include 'footer.php';
?>