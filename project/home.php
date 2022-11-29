
<?php

include('config.php');
include('login.php');

$username=$_SESSION['username'];
$user_pexpenses=$username.'_Pexpenses';
?>

<!DOCTYPE html>
<html>
    <head>

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
        $result = $con->query("SELECT * FROM $user_pexpenses ORDER BY PexpenseID DESC");
            ?>
            <div>
                <!--Creating data table-->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Amount</th>
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
                            <td> <?php echo $row['PexpenseID']; ?> </td>
                            <td> <?php echo $row['descr']; ?> </td>
                            <td> <?php echo $row['amount']; ?> </td>
                            <td> <?php echo $row['DS']; ?> </td>
                            <td> <?php echo $row['TS']; ?> </td>
                            <td>
                                <a href="home.php?edit=<?php echo $row['PexpenseID']; ?>"
                                    >Edit</a>
                                <a href="process.php?delete=<?php echo $row['PexpenseID']; ?>"
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
                <input type="hidden" name="PexpenseID" value="<?php echo $PexpenseID ?>">
                <label>Description</label>
                <input type="text" name="descr" 
                        value="<?php echo $descr; ?>" placeholder="Description" required>
                <label>Amount</label>
                <input type="number" name="amount" 
                        value="<?php echo $amount; ?>" placeholder="Amount" required/>
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