<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <form action="login.php" method="POST">

        <h2>LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>E-Mail</label>

        <input type="email" name="email" placeholder="E-mail Address"><br>

        <label>Password</label>

        <input type="pass" name="pass" placeholder="Password"><br> 

        <button type="submit">Login</button>
        <button type="submit"><a href="signup.php">Sign Up</a></button>

     </form>

</body>

</html>