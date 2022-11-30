
<?php

include('config.php');
include('login.php');

$username=$_SESSION['username'];
$user_id=$_SESSION['user_id'];
$home_id=$_SESSION['home_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <h1><a href="house.php">Home</a></h1>
        <h1><a href="home.php">Personal</a></h1>
    </head>

    <body>
        <!-- <?php require_once 'process.php'; ?> -->
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
        $result = $con->query("SELECT UExpenseID,descr,amount,category,ds,ts FROM userexpenses WHERE user_id=$user_id ORDER BY UExpenseID DESC");
            ?>
            <div>
                <!--Creating data table-->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <td> <?php echo $row['UExpenseID']; ?> </td>
                            <td> <?php echo $row['descr']; ?> </td>
                            <td> <?php echo $row['amount']; ?> </td>
                            <td> <?php echo $row['category']; ?> </td>
                            <td> <?php echo $row['ds']; ?> </td>
                            <td> <?php echo $row['ts']; ?> </td>
                            <td>
                                <a href="home.php?edit=<?php echo $row['UExpenseID']; ?>"
                                    >Edit</a>
                                <a href="process.php?delete=<?php echo $row['UExpenseID']; ?>"
                                    >Delete</a>
                            </td>
                        </tr>
                    
                            
                    <!--Ending the Loop-->
                    <?php endwhile;?>
                </table>
            </div>

        
        <?php
        //function to print fetched array
        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>



        <!--ADD Amount Form -->
        <form action="process.php" method="POST">
            <div class="container">
                <input type="hidden" name="UExpenseID" value="<?php echo $UExpenseID ?>">
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