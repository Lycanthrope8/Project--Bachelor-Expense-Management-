<?php     
include('config.php');
$username = $_POST['username'];  
$pass = $_POST['pass'];  

if (isset($_POST['username']) && isset($_POST['pass'])){
    if (empty($username)) {    
    header("Location: index.php?error=Email address is required");
    }else if(empty($pass)){
    header("Location: index.php?error=Password is required");
    }else{
            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $pass = stripcslashes($pass);  
            $username = mysqli_real_escape_string($con, $username);  
            $pass = mysqli_real_escape_string($con, $pass);  
        
            $sql = "SELECT username,pass FROM users where username = '$username' and pass = '$pass'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            
            if($count == 1){  
                echo "<h1><center> Login successful </center></h1>";
                header("Location: home.php");
            }else{  
                echo "<h1> Login failed. Invalid username or pass.</h1>";  
                header("Location: index.php");
                }
        }
}
?>


// <?php
// session_start(); 
// include "conn.php";

// if (isset($_POST['email']) && isset($_POST['pass'])) {

//     function validate($data){

//        $data = trim($data);

//        $data = stripslashes($data);

//        $data = htmlspecialchars($data);

//        return $data;

//     }

//     $email = validate($_POST['email']);

//     $pass = validate($_POST['pass']);

//     if (empty($email)) {

//         header("Location: index.php?error=Email address is required");

//         exit();

//     }else if(empty($pass)){

//         header("Location: index.php?error=Password is required");

//         exit();

//     }else{

//         $sql = "SELECT email , pass FROM users WHERE email='$email' AND pass='$pass'";

//         $result = $con->query($sql);

//         if ($result->num_rows===1) {

//             $row = mysqli_fetch_assoc($result);

//             if ($row['email'] === $email && $row['pass'] === $pass) {

//                 echo "Logged in!";

//                 $_SESSION['email'] = $row['email'];

//                 $_SESSION['pass'] = $row['pass'];

//                 header("Location: home.php");

//                 exit();

//             }else{

//                 header("Location: index.php?error=1.Incorrect User name or pass");

//                 exit();

//             }

//         }else{

//             header("Location: index.php?error=2.Incorrect User name or pass");

//             exit();

//         }

//     }

// }else{

//     header("Location: index.php");

//     exit();
// }
// ?>