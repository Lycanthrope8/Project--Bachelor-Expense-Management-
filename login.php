 <?php
session_start(); 
include "config.php";

if (isset($_POST['username']) && isset($_POST['pass'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $username = validate($_POST['username']);

    $pass = validate($_POST['pass']);

    if (empty($username)) {

        header("Location: index.php?error=Email address is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT username,pass FROM users WHERE username = '$username' and pass = '$pass'";  
        $result = mysqli_query($con, $sql);  
          
        $count = mysqli_num_rows($result);

        if ($count==1) {

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($row['username'] === $username && $row['pass'] === $pass) {

                echo "Logged in!";

                $_SESSION['username'] = $row['username'];

                $_SESSION['pass'] = $row['pass'];

                header("Location: home.php");

            }else{

                header("Location: index.php?error=1.Incorrect User name or pass");

                exit();

            }

        }else{

            header("Location: index.php?error=2.Incorrect User name or pass");

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();
}
?>