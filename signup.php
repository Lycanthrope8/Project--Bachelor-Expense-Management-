<!-- LINK : https://www.youtube.com/watch?v=00Thb3oPJ74&list=PLS1QulWo1RIZc4GM_E04HCPEd_xpcaQgg&index=35-->

<?php
include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
    </head>  
<body>
    <div>
        <?php
        if (isset($_POST['register'])){           // register came from input type submit
            $firstname = $_POST['firstname'];     // $attributeName = $_POST['input_name']
            $middlename = $_POST['middlename'];   // Sending Data to the Users table
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            
            $sql = "INSERT INTO users (firstname,middlename,lastname,email,phone,username,pass) VALUES(?,?,?,?,?,?,?)";
            $stmtinsert = $con->prepare($sql);     // ???????????????????????
            $result = $stmtinsert->execute([$firstname,$middlename,$lastname,$email,$phone,$username,$pass]);   // ???????????????????????
            
            //echo $firstname ." ". $middlename ." ". $lastname . " " . $email . " " . $phone . " " . $pass; 
            
            if ($result){
                $User_Pexpenses=$username.'_Pexpenses';
                $User_Hexpenses=$username.'_Hexpenses';
                $User_Owed=$username.'_Owed';
                $User_Debt=$username.'_Debt';

                ///Creating data table for Personal Expenses
                $create = "CREATE TABLE $User_Pexpenses (PersonID int, LastName varchar(255), FirstName varchar(255))";
                $create = $con->prepare($create);
                $create->execute();
                ///Creating data table for Home Expenses
                $create = "CREATE TABLE $User_Hexpenses (PersonID int, LastName varchar(255), FirstName varchar(255))";
                $create = $con->prepare($create);
                $create->execute();
                ///Creating data table for Owed Money
                $create = "CREATE TABLE $User_Owed (PersonID int, LastName varchar(255), FirstName varchar(255))";
                $create = $con->prepare($create);
                $create->execute();
                ///Creating data table for Debt Money
                $create = "CREATE TABLE $User_Debt (PersonID int, LastName varchar(255), FirstName varchar(255))";
                $create = $con->prepare($create);
                $create->execute();
                header("Location: index.php?=Account created successfully") ;
            }else{
                echo "Couldn't Create The Account. Please Try again later." ; 
            }

        }
        ?>
    </div>
    <div>
        <form action="signup.php" method="POST">
            <div class="container">
                <h1>Registration</h1>
                <p>Fill up the form with correct values</p>

                <!-- For First Name-->
                <label for="firstname"><b>First Name</b></label>
                <input type="text" name="firstname" required>

                <!-- For Middle Name-->
                <label for="middlename"><b>Middle Name</b></label>
                <input type="text" name="middlename">

                <!-- For Last Name-->
                <label for="lastname"><b>Last Name</b></label>
                <input type="text" name="lastname" required>

                <!-- For Email-->
                <label for="email"><b>Email-Address</b></label>
                <input type="email" name="email" required>

                <!-- For Phone number-->
                <label for="phone"><b>Phone Number</b></label>
                <input type="text" name="phone" required>

                <!-- For User Name-->
                <label for="username"><b>User Name</b></label>
                <input type="text" name="username" required>

                <!-- For Password-->
                <label for="pass"><b>pass</b></label>
                <input class="form-control" type="password" name="pass" required>

                <input type="submit" id="register" name="register" value="Sign Up">
            </div>
        </form>
    </div>
</body>
</html>