<?php
include('config.php');
include('login.php');
$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <head>
        <h1>You have not joined any home yet</h1>
        <h2>
            <a href="joinhome.php">Join Home</a>
        </h2>
        <h2>
            <a href="createhome.php">Create Home</a>
        </h2>
    </head>
</html>