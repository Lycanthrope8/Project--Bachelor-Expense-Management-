<?php


include('config.php');
include('login.php');
$username=$_SESSION['username'];
$user_pexpenses=$username.'_Pexpenses';
$PexpenseID=0;
$update=false;
$descr = '';
$amount = '';

if(isset($_POST['add'])){
    $descr = $_POST['descr'];
    $amount = $_POST['amount'];

    


    // $con->query("INSERT INTO $user_pexpenses (descr,amount,ds,ts) VALUES($descr,$amount,getdate(),getdate())");
    $addsql = "INSERT INTO $user_pexpenses (descr,amount,ds,ts) VALUES(?,?,?,?)";
    $stmtadd = $con->prepare($addsql);     // ???????????????????????
    $result = $stmtadd->execute([$descr,$amount,getdate(),gettimeofday()]); 
    
    $_SESSION['message'] = "Record Has Been Saved";
    $_SESSION['msg_type'] = "Success";
    header("Location: home.php?=Succesfully Added");
}

if(isset($_GET['delete'])){
    $PexpenseID = $_GET['delete'];

    $con->query("DELETE FROM $user_pexpenses where PexpenseID=$PexpenseID");

    $_SESSION['message'] = "Record Has Been Deleted";
    $_SESSION['msg_type'] = "Danger";
    header("Location: home.php?=Succesfully Deleted");
}

if(isset($_GET['edit'])){
    
    $PexpenseID = $_GET['edit'];
    $result = $con->query("SELECT * FROM $user_pexpenses WHERE PexpenseID=$PexpenseID");
    $update=true;
    $row = $result->fetch_array();
    $descr = $row['descr'];
    $amount = $row['amount'];
    // if (count($result)==1){
    //     $row = $result->fetch_array();
    //     $descr = $row['descr'];
    //     $amount = $row['amount'];
    // }

}

if (isset($_POST['update'])){
    $PexpenseID = $_POST['PexpenseID'];
    $descr = $_POST['descr'];
    $amount = $_POST['amount'];

    $result = $con->query("UPDATE $user_pexpenses SET descr='$descr',amount=$amount WHERE PexpenseID=$PexpenseID");
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = 'warning';
    header("Location: home.php?=Successfully Updated");
}
?>

