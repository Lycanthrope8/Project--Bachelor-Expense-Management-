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
        <h3><a href="todo.php">TODO</a></h3>
    </head>
    <body>
        <!-- <?php require_once 'processtodo.php'; ?> -->

        <!-- Session message. Div is for design purpose -->
        <?php if(isset($_SESSION['message'])):?>
        <div> 
            <?php echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif; ?>

        <!-- Query to show whole data table of expenses -->
        <?php
        
        $result = $con->query("SELECT * FROM usertodo WHERE user_id=$user_id AND completed=0 ORDER BY todo_id DESC");
        if($result->num_rows > 0){
            ?>
            <div>
                <!--Creating data table-->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
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
                            <td> <?php echo $row['todo_id']; ?> </td>
                            <td> <?php echo $row['descr']; ?> </td>
                            <td> <?php echo $row['ds']; ?> </td>
                            <td> <?php echo $row['ts']; ?> </td>
                            <td>
                                <a href="processtodo.php?done=<?php echo $row['todo_id']; ?>"
                                    >Done</a>
                                <a href="todo.php?edit=<?php echo $row['todo_id']; ?>"
                                    >Edit</a>
                                <a href="processtodo.php?delete=<?php echo $row['todo_id']; ?>"
                                    >Delete</a>         
                            </td>
                        </tr>
                    
                            
                    <!--Ending the Loop-->
                    <?php endwhile;?>
                </table>
            </div>
        <?php }else{
           echo "<h3>No tasks Remaining</h3>";
        } ?>
        
    
    <!--ADD todo Form -->
    <form action="processtodo.php" method="POST">
            <div class="container">
                <input type="hidden" name="todo_id" value="<?php echo $todo_id ?>">
                <label>Description</label>
                <input type="text" name="descr" 
                        value="<?php echo $descr; ?>" placeholder="Description" required>
                <label> DATE </label>
                <input type="date" name="date" required>
                <label> TIME </label>
                <input type="time" name="time" required>
                <?php 
                if ($update == true):
                ?>
                    <button type="submit" name="update">Update</button>
                <?php else: ?>
                    <button type="submit" name="add">ADD</button>
                <?php endif; ?>
            </div>
    </form>

    <h3>Completed</h3>
    
    <?php
        
        $result = $con->query("SELECT * FROM usertodo WHERE user_id=$user_id AND completed=1 ORDER BY todo_id DESC");
        if($result->num_rows > 0){
            ?>
            <div>
                <!--Creating data table-->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
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
                            <td> <?php echo $row['todo_id']; ?> </td>
                            <td> <?php echo $row['descr']; ?> </td>
                            <td> <?php echo $row['ds']; ?> </td>
                            <td> <?php echo $row['ts']; ?> </td>
                            <td>
                                <a href="processtodo.php?delete=<?php echo $row['todo_id']; ?>"
                                    >Delete</a>         
                            </td>
                        </tr>
                    
                            
                    <!--Ending the Loop-->
                    <?php endwhile;?>
                </table>
            </div>
        <?php }else{
           echo " <h3> No task Completed</h3>";
        } ?>





    </body>

</html>