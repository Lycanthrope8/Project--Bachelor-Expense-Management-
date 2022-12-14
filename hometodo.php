<?php
include('config.php');
include('login.php');
$username=$_SESSION['username'];
$home_id=$_SESSION['home_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <h1><a href="home.php">Personal</a></h1>
        <h1><a href="house.php">Home</a></h1>
        <h3><a href="hometodo.php">Home TODO</a></h3>
    </head>

    <body>
        <!-- <?php require_once 'processhometodo.php'; ?> -->
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
        $result = $con->query("SELECT * FROM hometodo WHERE home_id=$home_id AND completed=0 ORDER BY htodo_id DESC");
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
                            <td> <?php echo $row['htodo_id']; ?> </td>
                            <td> <?php echo $row['descr']; ?> </td>
                            <td> <?php echo $row['ds']; ?> </td>
                            <td> <?php echo $row['ts']; ?> </td>
                            <td>
                                <a href="processhometodo.php?done=<?php echo $row['htodo_id']; ?>"
                                    >Done</a>
                                <?php if($row['user_id']===$user_id){?>
                                <a href="hometodo.php?edit=<?php echo $row['htodo_id']; ?>"
                                    >Edit</a>
                                <a href="processhometodo.php?delete=<?php echo $row['htodo_id']; ?>"
                                    >Delete</a>    
                                <?php }?>     
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
    <form action="processhometodo.php" method="POST">
            <div class="container">
                <input type="hidden" name="htodo_id" value="<?php echo $htodo_id ?>">
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
        
        $result = $con->query("SELECT * FROM hometodo WHERE home_id=$home_id AND completed=1 ORDER BY htodo_id DESC");
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
                            <td> <?php echo $row['htodo_id']; ?> </td>
                            <td> <?php echo $row['descr']; ?> </td>
                            <td> <?php echo $row['ds']; ?> </td>
                            <td> <?php echo $row['ts']; ?> </td>
                            <td>
                                <a href="processhometodo.php?delete=<?php echo $row['htodo_id']; ?>"
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