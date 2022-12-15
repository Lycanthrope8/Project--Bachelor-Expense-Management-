
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
        <h3>Welcome, <?php echo $username; ?>!</h3>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h1><a href="house.php">Home</a></h1>
                </div>
                <div class="col-sm-4">
                    <h1><a href="home.php">Personal</a></h1>
                </div>
                <div class="col-sm-4">
                    <h1><a href="todo.php">To Do</a></h1>
                </div>
            </div>
        </div>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/home/home.css">
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
        $debt = "SELECT debt_id,debtor,creditor,descr,amount,paid,partial_pay FROM userdebtsurplus WHERE debtor='$username'";
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
                        echo "<b>".$row['creditor']."</b>"." : ".$row['amount']." (".$row['descr']." )";
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
        if($result->num_rows > 0){
            ?>
            <div class="container">
                <!--Creating data table-->
                <div class="row">
                <table class="infotable col-sm-12">
                </div>
                    <thead>
                        <tr>
                            <th class="tab-head">ID</th>
                            <th class="tab-head">Description</th>
                            <th class="tab-head">Amount</th>
                            <th class="tab-head">Category</th>
                            <th class="tab-head">Date</th>
                            <th class="tab-head">Time</th>
                            <th class="tab-head" colspan='2'>Action</th>
                        </tr>
                    </thead>
                    <!--Loop to see the fetched data table-->

                    <?php
                        while ($row = $result->fetch_assoc()):
                    ?>
                                             
                        <tr>
                            <td class="tab-items"> <?php echo $row['UExpenseID']; ?> </td>
                            <td class="tab-items"> <?php echo $row['descr']; ?> </td>
                            <td class="tab-items"> <?php echo $row['amount']; ?> </td>
                            <td class="tab-items"> <?php echo $row['category']; ?> </td>
                            <td class="tab-items"> <?php echo $row['ds']; ?> </td>
                            <td class="tab-items"> <?php echo $row['ts']; ?> </td>
                            <td class="tab-items">
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
        <?php }else{
            echo "<h3>No Expense Added Yet</h3>";
        }?>
        
        <?php
             $total = $con->query("SELECT SUM(amount) as totalamount FROM userexpenses WHERE user_id=$user_id");
             $totalamount = $total->fetch_assoc();
        ?>
        <h3>Total Spent: <?php echo $totalamount['totalamount'] ?></h3>

        
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
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input class="form-input" type="text" name="descr" value="<?php echo $descr ?>" required>
                            <label class="form-label" for="descr">Description</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input class="form-input" type="number" name="amount" value="<?php echo $amount; ?>" required>
                            <label class="form-label" for="amount">Amount</label>
                        </div>
                    </div>
                    <!-- <div class="col-sm-2">
                        <div class="form-group">
                            <input class="form-input" type="text" name="category" value="<?php echo $category; ?>" required>
                            <label class="form-label" for="category">Category</label>
                        </div>
                    </div> -->
                    <div class="col-sm-4">
                        <div class="dropdown form-group">
                            <!-- <label class="form-label" for="category">Category</label> -->
                            <input type="text" class="textBox form-input" name="category" readonly>
                            <label class="form-label" for="category">Category</label>
                            <!-- <select name="category">
                                <option value="Food">Food</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Housing">Housing</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Others">Others</option>
                            </select> -->
                            <div class="option">
                                <div onclick="show('Food')">Food</div>
                                <div onclick="show('Transportation')">Transportation</div>
                                <div onclick="show('Housing')">Housing</div>
                                <div onclick="show('Entertainment')">Entertainment</div>
                                <div onclick="show('Others')">Others</div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    if ($update == true):
                    ?>
                    <div class="col-sm-2">
                        <button class="button update-btn" type="submit" name="update">Update</button>
                    </div>
                    <?php else: ?>
                    <div class="col-sm-2">
                        <button class="button add-btn" type="submit" name="add">ADD</button>
                    </div>
                    <?php endif; ?>
                </div>
                
                
                <div class="row">    
                    
                    
                </div>
            </div>
        </form>
        <script>
            function show(anything){
                document.querySelector('.textBox').value=anything;
            }
            let dropdown=document.querySelector('.dropdown');
            dropdown.onclick=function(){
                dropdown.classList.toggle('active');
            }

        </script>
    </body>
</html>