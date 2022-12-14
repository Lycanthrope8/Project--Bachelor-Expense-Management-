<?php
include('config.php');
include('login.php');
$username=$_SESSION['username'];
$home_id=$_SESSION['home_id'];
?>

<?php
    //Checking if the user has any house or not

    $result = $con->query("SELECT home_id FROM users WHERE username='$username'");
    $row = $result->fetch_array();
    $home_id=$row['home_id'];
    // var_dump($home_id); // vardump is used to print null


    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    // if the homeid is null then redirect to homeindex page where anyone can join or create a house
    if(is_null($home_id)){
        header("Location: homeindex.php");
    }


    // Saving all home members names in an array///////
    $sql = "SELECT username FROM users WHERE home_id=$home_id";
    $r = mysqli_query($con,$sql);
    $home_members = [];
    while ($array = mysqli_fetch_array($r)) {
        if ($username!=$array['username']){
        $home_members[] = $array['username'];
        }
    }
    $_SESSION['home_members']=$home_members;   

    pre_r($home_members);
?>


<!DOCTYPE html>
<html>
    <head>
        <h1><a href="home.php">Personal</a></h1>
        <h1><a href="house.php">Home</a></h1>
        <h3><a href="hometodo.php">Home TODO</a></h3>
    </head>

    <body>
        <!-- <?php require_once 'processhome.php'; ?> -->
        <!-- Session message. Div is for design purpose -->
        <?php if(isset($_SESSION['message'])):?>
        <div> 
            <?php echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif; ?>
        <!-- Query to show whole data table -->
        <?php
        $result = $con->query("SELECT HExpenseID,username,descr,amount,category,ds,ts FROM homeexpenses WHERE home_id=$home_id ORDER BY HExpenseID DESC");
        if($result->num_rows > 0){
            ?>
            <div>
                <!--Creating data table-->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th colspan='2'>Action</th>
                        </tr>
                    </thead>
                    <!--Loop to see the fetched data table-->

                    <?php
                        while ($row = $result->fetch_assoc()):
                    ?>
                                             
                        <tr>
                            <td> <?php echo $row['HExpenseID']; ?> </td>
                            <td> <?php echo $row['username']; ?> </td>
                            <td> <?php echo $row['descr']; ?> </td>
                            <td> <?php echo $row['amount']; ?> </td>
                            <td> <?php echo $row['category']; ?> </td>
                            <td> <?php echo $row['ds']; ?> </td>
                            <td> <?php echo $row['ts']; ?> </td>
                            <?php if($row['username']===$username){?>
                                <td>
                                    <a href="house.php?edit=<?php echo $row['HExpenseID']; ?>"
                                        >Edit</a>
                                    <a href="processhome.php?delete=<?php echo $row['HExpenseID']; ?>"
                                        >Delete</a>
                                </td>
                            <?php } ?>
                        </tr>
                    
                            
                    <!--Ending the Loop-->
                    <?php endwhile;?>
                </table>
            </div>
        <?php }else{
        echo "<h3>No Expense Added Yet</h3>";
        }?>

        
        <?php
             $total = $con->query("SELECT SUM(amount) as totalamount FROM homeexpenses WHERE home_id=$home_id");
             $totalamount = $total->fetch_assoc();
        ?>
        <h3>Total Spent: <?php echo $totalamount['totalamount'] ?></h3>
        
        <?php
        //function to print fetched array
        // function pre_r($array){
        //     echo '<pre>';
        //     print_r($array);
        //     echo '</pre>';
        // }
        ?>



        <!--ADD Amount Form -->
        <form action="processhome.php" method="POST">
            <div class="container">
                <input type="hidden" name="HExpenseID" value="<?php echo $HExpenseID ?>">
                <label>Description</label>
                <input type="text" name="descr" 
                        value="<?php echo $descr; ?>" placeholder="Description" required>
                <label>Amount</label>
                <input type="number" name="amount" 
                        value="<?php echo $amount; ?>" placeholder="Amount" required/>
                <label>Category</label>
                    <select name="category">
                        <option value="Food">Food</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Housing">Housing</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Others">Others</option>
                    </select>
                <?php 
                if ($update == true):
                ?>
                    <button type="submit" name="update">Update</button>
                <?php else: ?>
                    <button type="submit" name="add">ADD</button>
                <?php endif; ?>
            </div>
        </form>
    </body>
</html>
