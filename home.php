<?php
include('config.php');
include('login.php');

$username=$_SESSION['username'];
$user_pexpenses=$username.'_Pexpenses';


$sql = "select * from $user_pexpenses order by PexpenseID desc";
$recent_expenses = mysqli_query($con, $sql); 
?>



<!DOCTYPE html>
<html  >
    <strong>Add Expense</strong>
    <form action="home.php" method="POST">
        <div class="container">
            <textarea rows="3" name="description" placeholder="Description"></textarea>
            <input type="number" name="amount" placeholder="Amount"/>
            <input type="submit" id="addPexpense" name="addPexpense" value="ADD">
        </div>
    </form>

    <?php
    if (isset($_POST['addPexpense'])){
        $descr = $_POST["description"];
        $amount = $_POST["amount"];
    
            
        $addsql = "INSERT INTO $user_pexpenses (descr,amount,ds,ts) VALUES(?,?,?,?)";
        $stmtadd = $con->prepare($addsql);     // ???????????????????????
        $result = $stmtadd->execute([$descr,$amount,getdate(),gettimeofday()]);   // ???????????????????????
            
        header("Location: home.php?=Succesfully Added") ;
    }
    ?>    
 

    <strong>MY RECENT EXPENSES</strong>
		    <?php
		    if(!empty($recent_expenses)){
			?><table class="table table-bordered table-striped table-condensed">
			    <thead>
				<tr>
				    <th>ID</th>
				    <th>Description</th>
				    <th>Amount</th>
				    <th>Date</th>
                    <th>Time</th>
				    <!-- <th>Edit</th>
				    <th>Delete</th> -->
				</tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach($recent_expenses as $recent_expense){
				?><tr>
				    <td><?=$recent_expense['PexpenseID']?></td>
				    <td><?=$recent_expense['descr']?></td>
				    <td><?=$recent_expense['amount']?></td>
				    <!-- <td><?=$recent_expense['category_name']?></td> -->
                    <td><?=$recent_expense['DS']?></td>
                    <td><?=$recent_expense['TS']?></td>
				    <!-- <td><?=date('Y-m-d H:i:s', strtotime($recent_expense['DS']))?></td> For both time and date in a single column-->
				    <!-- <td><a href="add_edit_expense.php?expense_id=<?=$recent_expense['PexpenseID']?>" class="btn btn-sm btn-primary">Edit</a></td>
				    <td><a onclick="return confirm('Are you sure you want to delete this expense?')" href="delete_exepense.php?expense=<?=$recent_expense['id']?>" class="btn btn-sm btn-primary">Delete</a></td> -->
				</tr><?php
			    }
			    ?>
			    </tbody>
			</table><?php
		    }else{
			?><h4>No expenses added yet</h4><?php
		    }
		    ?>
		    
		</div>
		<a href="add_edit_expense.php" class="btn btn-primary">Add Expense</a>
	    </div>
	</section>
    </body>
</html>