<?php
include('config.php');
include('login.php');


$username=$_SESSION['username'];
$user_pexpenses=$username.'_Pexpenses';



// $_SESSION['PexpenseID'] = $_GET['PexpenseID'];
$PexpenseID=$_GET['PexpenseID'];

$dltsql = "DELETE FROM $user_pexpenses where PexpenseID=$PexpenseID";
$stmtadd = $con->prepare($dltsql);     // ???????????????????????
$result = $stmtadd->execute();
header("Location: home.php");


die;