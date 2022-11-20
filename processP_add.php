<?php
include('config.php');
include('login.php');
$username=$_SESSION['username'];
$user_pexpenses=$username.'_Pexpenses';



if (isset($_POST['addPexpense'])){
    $descr = $_POST["description"];
    $amount = $_POST["amount"];

    $addsql = "INSERT INTO users_pexpenses (descr,amount,ds,dt) VALUES(?,?,?,?)";
    $stmtadd = $con->prepare($addsql);     // ???????????????????????
    $result = $stmtadd->execute([$descr,$amount,getdate(),getdate()]);   // ???????????????????????
            
    header("Location: home.php?=Succesfully Added") ;
            }else{
                echo "couldnt add" ; 
            }

?>
