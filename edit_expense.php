<?php
include('config.php');
include('login.php');
$username=$_SESSION['username'];
$user_pexpenses=$username.'_Pexpenses';
$_SESSION['PexpenseID']=$_GET['PexpenseID'];
$PexpenseID=$_SESSION['PexpenseID'];
// echo $PexpenseID;


$editsql = "Select descr,amount FROM $user_pexpenses where PexpenseID=$PexpenseID";
$result = mysqli_query($con, $editsql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


$prv_descr=$row['descr'];
$prv_amount=$row['amount'];

if (isset($_POST['editexpense'])){
    $descr = $_POST["description"];
    $amount = $_POST["amount"];

        
    $edit = "UPDATE TABLE $user_pexpenses SET descr=$descr,amount=$amount WHERE PexpenseID=$PexpenseID";
    $stmtadd = $con->prepare($edit);     // ???????????????????????
    $result = $stmtadd->execute();
    header("Location: home.php") ;
}
?>

<!DOCTYPE html>
<html>
    <head>
    <strong>Edit Expense</strong>

    <form action="edit_expense.php" method="POST">
        <div class="container">
            <textarea rows="3" name="description" placeholder="Description" required> <?=$prv_descr?> </textarea>
            <input type="number" name="amount" placeholder="Amount" value="<?=$prv_amount?>" required/>
            <!-- <a href="edit_expense.php?PexpenseID=<?=$PexpenseID?>"> 
              <input type="submit" id="editexpense" value="DONE"> </a> -->
            <input type="hidden" name="PexpenseID" value="<? $PexpenseID ?>" />
            <input type="submit" id="editexpense" name="editexpense" value="DONE" >
        </div>
    </form>

    </head>
</html>

