<?php
require_once('class.forum.php');
$forum = new forum();

if (isset($_GET['id']) && $_GET['id']){
	$cat_id=$_GET['id'];
}else{
	$cat_id=0;
}

include 'header.php';
$forum->showCategory($cat_id);
include 'footer.php';
?>