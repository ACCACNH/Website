<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';
$forum->showAll(); 
include 'footer.php';
?>