<?php
include('config.php');
include('login.php');
$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create Home</title>

        <!-- <link rel="stylesheet" type="text/css" href="assets/style.css"> -->
    </head>  
<body>
    <div>
        <?php
        ///Creating home for the user
        if (isset($_POST['create'])){           // create came from input type submit
            $owner = $_POST['owner'];     // $attributeName = $_POST['input_name']
            $homename = $_POST['homename'];   
            $securitycode = $_POST['securitycode'];
            $address = $_POST['address'];
            
            $sql = "INSERT INTO homes (owner,homename,address,securitycode) VALUES(?,?,?,?)";
            $stmtinsert = $con->prepare($sql);     // ???????????????????????
            $result = $stmtinsert->execute([$owner,$homename,$address,$securitycode]);   // ???????????????????????
            
        ///Saving home_id in users data table to access their home db 
            $result = $con->query("SELECT * FROM homes WHERE homename='$homename'");
            $row = $result->fetch_assoc();
            $home_id=$row['home_id'];
            $addhome = $con->query("UPDATE users SET home_id=$home_id WHERE username='$username'");
            $_SESSION['home_id']=$home_id;
            header("Location: house.php");

        }
        ?>



    </div>
    <div>
        <form action="createhome.php" method="POST">
            <div class="container">
                <h1>Create Home</h1>
                <p>Fill up the form with correct values</p>

                <!-- For Home Owner-->
                <div class="form-group fn">
                    <label class="form-label" for="owner">Owner Name</label>
                    <input class="form-input" type="text" name="owner" required>
                </div>
                

                <!-- For Home Name (Unique)-->
                <div class="form-group">
                    <label class="form-label" for="homename">Home Name (Unique)</label>
                    <input class="form-input" type="text" name="homename" required>
                </div>
                

                

                <!-- For Address-->
                <div class="form-group">
                    <label class="form-label" for="address"> Address</label>
                    <input class="form-input" type="text" name="address" required>
                </div>

                <!-- For Security code-->
                <div class="form-group">
                    <label class="form-label" for="securitycode">Security Code</label>
                    <input class="form-input" type="password" name="securitycode" required>
                </div>
                
                <!-- For security code confirmation-->
                <div class="form-group">
                    <label class="form-label" for="confirmsecuritycode">Confirm Security Code</label>
                    <input class="form-input" type="password" name="confirmsecuritycode" required>
                </div>
                <input class="form-submit" type="submit" id="create" name="create" value="Create">
            </div>
        </form>
    </div>
</body>
</html>