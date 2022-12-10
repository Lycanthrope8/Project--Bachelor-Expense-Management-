
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
        <h3><?php echo $username; ?></h3>
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
        
        <!-- User Surplus Details -->
        
        <?php
        $surplus = "SELECT debt_id,debtor,creditor,amount,paid,partial_pay FROM userdebtsurplus WHERE creditor='$username'";
        $surplusresult = $con->query($surplus);
        if($surplusresult->num_rows > 0){
            echo "<h3>Surplus</h3>";
            while($row=$surplusresult->fetch_assoc()){
                $debt_id=$row['debt_id'];
                $statement="";
                if($row['amount']!=0){
                    if($row['paid']==1){
                        $statement="  (Did ".$row['debtor']." Paid You TK ".$row['amount']."?) "; 
                        echo "<b>".$row['debtor']."</b>"." : ".$row['amount'].$statement;
                        ?>
                        <form action="debtprocess.php" method="POST">
                            <input type="hidden" id="debt_id" name="debt_id" value="<?php echo $debt_id; ?>">
                            <button type="submit" name="fullyes">YES</button>
                            <button type="submit" name="fullno">NO</button>
                        </form>
                    <?php
                    }
                    elseif($row['partial_pay']!=NULL){
                        $partial_pay=$row['partial_pay'];
                        $statement=" (Did ".$row['debtor']." Paid You TK ".$row['partial_pay']."?) ";
                        echo "<b>".$row['debtor']."</b>"." : ".$row['amount'].$statement;
                        ?>
                        <form action="debtprocess.php" method="POST">
                            <input type="hidden" id="debt_id" name="debt_id" value="<?php echo $debt_id; ?>">
                            <input type="hidden" id="partial_pay" name="partial_pay" value="<?php echo $partial_pay; ?>">
                            <button type="submit" name="partialyes">YES</button>
                            <button type="submit" name="partialno">NO</button>
                        </form>
                        <?php
                    }
                    else{
                        echo "<b>".$row['debtor']."</b>"." : ".$row['amount'].$statement."<br>";
                    }
                }
            }
        }else{
            echo "<h3>No Surpluses</h3>";
        }
        ?>

        <!-- End of Surplus Details -->

        <!-- User Debt Details -->

        <?php
        $debt = "SELECT debt_id,debtor,creditor,amount,paid,partial_pay FROM userdebtsurplus WHERE debtor='$username'";
        $debtresult = $con->query($debt);
        if($debtresult->num_rows > 0){
            echo "<h3>Debts</h3>";
            while($row=$debtresult->fetch_assoc()){
                if($row['amount']!=0){
                    $debt_id=$row['debt_id'];
                    $statement="";
                    if($row['paid']==1){
                        $statement= " (Full Pay TK ".$row['amount']." Pending Confirmation)";
                        echo "<b>".$row['creditor']."</b>"." : ".$row['amount'].$statement;
                        }
                    elseif($row['partial_pay']!=NULL){
                        $statement= " (Partial Pay TK ". $row['partial_pay']." Pending Confirmation)";
                        echo "<b>".$row['creditor']."</b>"." : ".$row['amount'].$statement;
                        }
                    else{
                        echo "<b>".$row['creditor']."</b>"." : ".$row['amount'];
                        ?>  
                        <form action="debtprocess.php" method='POST'>
                            <input type="hidden" id="debt_id" name="debt_id" value="<?php echo $debt_id; ?>">
                            <input type="number" name="partial">
                            <button type="submit" name="partialpay">Pay</button>
                            <button type="submit" name="fullpay"> Full Pay</button>
                        </form>

                    <?php
                    }
                }
            }
        }else{
            echo "<h3>No Debts</h3>";
        }
        ?>
        <!-- End of Debt Details  -->


        <!-- Query to show whole data table of expenses -->
        <?php
        $result = $con->query("SELECT UExpenseID,HExpenseID,descr,amount,category,ds,ts FROM userexpenses WHERE user_id=$user_id ORDER BY UExpenseID DESC");
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
                                <?php if($row['HExpenseID']==NULL){?>
                                <a href="home.php?edit=<?php echo $row['UExpenseID']; ?>"
                                    >Edit</a>
                                <a href="process.php?delete=<?php echo $row['UExpenseID']; ?>"
                                    >Delete</a>    
                                <?php } ?>    
                                
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