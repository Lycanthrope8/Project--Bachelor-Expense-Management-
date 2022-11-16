<?php
include('config.php');
include('login.php');

$username=$_SESSION['username'];
echo "Welcome ", $username;

?>

<!DOCTYPE html>
<html>
    <body>
        <H1>Connect Hoya gese!!!</H1>

        <h1>Personal Expenses</h1>
        <table>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Spended On</th>
                <th>Amount</th>
            </tr>
        </table>

        <?php
        // $sql="SELECT DS,TS,descr,ammount FROM $User_Pexpenses";
        // $result= $con-> query(sql);
        // echo "HELLO"
        ?>
    </body>
</html>