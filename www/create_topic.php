<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';

$forum->create_topic();
 
include 'footer.php';
?>