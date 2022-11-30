<?php


include('config.php');
include('login.php');
$username=$_SESSION['username'];
$user_id=$_SESSION['user_id'];
$home_id=$_SESSION['home_id'];
$homename=$_SESSION['homename'];
$HExpenseID=0;
$update=false;
$descr = '';
$amount = '';
$category = '';

if(isset($_POST['add'])){
    $descr = $_POST['descr'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];

    


    // $con->query("INSERT INTO $user_pexpenses (descr,amount,ds,ts) VALUES($descr,$amount,getdate(),getdate())");
    $addsql = "INSERT INTO homeexpenses (home_id,user_id,username,descr,amount,category,ds,ts) VALUES(?,?,?,?,?,?,?,?)";
    $stmtadd = $con->prepare($addsql);     // ???????????????????????
    $result = $stmtadd->execute([$home_id,$user_id,$username,$descr,$amount,$category,getdate(),gettimeofday()]); 
    
    $_SESSION['message'] = "Record Has Been Saved";
    $_SESSION['msg_type'] = "Success";
    header("Location: house.php?=Succesfully Added");
}

if(isset($_GET['delete'])){
    $HExpenseID = $_GET['delete'];

    $con->query("DELETE FROM homeexpenses where HExpenseID=$HExpenseID");

    $_SESSION['message'] = "Record Has Been Deleted";
    $_SESSION['msg_type'] = "Danger";
    header("Location: house.php?=Succesfully Deleted");
}

if(isset($_GET['edit'])){
    
    $HExpenseID = $_GET['edit'];
    $result = $con->query("SELECT descr,amount,category FROM homeexpenses WHERE HExpenseID=$HExpenseID");
    $update=true;
    $row = $result->fetch_array();
    $descr = $row['descr'];
    $amount = $row['amount'];
    $category = $row['category'];
    // if (count($result)==1){
    //     $row = $result->fetch_array();
    //     $descr = $row['descr'];
    //     $amount = $row['amount'];
    // }

}

if (isset($_POST['update'])){
    $HExpenseID = $_POST['HExpenseID'];
    $descr = $_POST['descr'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];

    $result = $con->query("UPDATE homeexpenses SET descr='$descr',amount=$amount, category='$category' WHERE HExpenseID=$HExpenseID");
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = 'warning';
    header("Location: house.php?=Successfully Updated");
}
?>
