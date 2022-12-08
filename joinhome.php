
<?php   

include('config.php');
include('login.php');
$username=$_SESSION['username'];

if (isset($_POST['homename']) && isset($_POST['securitycode'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $homename = validate($_POST['homename']);

    $securitycode = validate($_POST['securitycode']);

    if (empty($homename)) {

        header("Location: joinhome.php?error=Home Name is required");

        exit();

    }else if(empty($securitycode)){

        header("Location: joinhome.php?error=Security Code is required");

        exit();

    }else{
        
        ///Checking if the home exist or not
        $sql = "SELECT home_id,homename,securitycode FROM homes where homename = '$homename' and securitycode = '$securitycode'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $home_id=$row['home_id'];

        if($count === 1){  
            echo "<h1><center> Succesfully Joined Home </center></h1>";
            $_SESSION['homename']=$homename;
            $_SESSION['home_id']=$home_id;
            
            ///Saving home_id in users data table to access their home db 
            $result = $con->query("SELECT * FROM homes WHERE homename='$homename'");
            $row = $result->fetch_assoc();
            $home_id=$row['home_id'];
            $addhome = $con->query("UPDATE users SET home_id=$home_id WHERE username='$username'");
            
            /// Increasing member count by 1 after every joining
            $memberadd= $con->query("UPDATE homes SET member_count=member_count+1 WHERE home_id=$home_id");

            header("Location: house.php");
            exit();
        }else{  
            echo "<h1> Login failed. Invalid homename or securitycode.</h1>";  
            header("Location: index.php?error=Invalid homename or password");
            exit();
                }
        }
}
?>

<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <form action="joinhome.php" method="POST">

        <h2>Join Home</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>Home Name</label>

        <input type="text" name="homename" placeholder="homename"><br>

        <label>Security Code</label>

        <input type="pass" name="securitycode" placeholder="Security Code"><br> 

        <button type="submit">Join</button>
        <button type="submit"><a href="createhome.php">Create Home</a></button>

     </form>

</body>

</html>