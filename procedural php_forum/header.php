<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>PHP-MySQL forum</title>
    <link rel="stylesheet" href="style.css">
 </head>
    
<body>
<h1>Shrek & CO solutions</h1>
    <div id="wrapper">
        <div id="menu">
            <a class="item" href="/forum/index.php">Home</a> -
            <a class="item" href="/forum/create_topic.php">Create a topic</a> -
            <a class="item" href="/forum/create_cat.php">Create a category</a>

            <div id="userbar">
                <div id="userbar">
                    <?php
                    if($_SESSION['signed_in'])
                    {
                        echo 'Hello ,' . $_SESSION['user_name'] . '  <a href="signout.php">Sign out</a>';
                    }
                    else
                    {
                        echo '<a href="signin.php">Sign in</a> or <a href="signup.php">create an account</a>.';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="content">