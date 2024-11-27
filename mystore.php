<?php
session_start();
include 'header.php';     
include 'conn.php';     

//  session_start();  

 if (isset($_SESSION['user_id'])) {   
    $user_id = $_SESSION['user_id'];   
  
     $sql= "SELECT * FROM `order_tbl` WHERE user_id = '$user_id'";  
    $result = mysqli_query($conn, $sql);    


     if ($result) {  
        ?>

        <table class="table mydatatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Order Date</th> 
                    <!-- <th>Quntity</th> -->
                </tr>
            </thead>
            <tbody>
                <?php    
                $total_amount = 0;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total_amount += $row['total_amount'];
                    //     $quantity_sql = "SELECT SUM(id) AS total_quantity FROM `order_tbl` WHERE order_id = '$order_id' ";  
                    //    $quantity_result = mysqli_query($conn, $quantity_sql);
                    //    $quantity_row = mysqli_fetch_assoc($quantity_result);
                    //    $total_quantity = $quantity_row['total_quantity'] ? $quantity_row['total_quantity'] : 0; // If no quantity, set it to 0
               
                      ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['total_amount']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>    
                            <!-- <td><?php echo $row?></td>     -->
                            <td></td>
                            <td>
                            <!-- <div class="col-lg-1">
    <div class="form-group" style="margin-left:100%">
         <input type="submit" name="view" class="btn btn-primary" value="View Details">
    </div> -->
</div>  
</td>
                        </tr>
                        <?php
                    }
                } else {
                     echo "<tr><td colspan='5'>No orders found for this user.</td></tr>";
                }
                ?>
            </tbody>
        </table>


        <?php
    } else {
         echo "Error fetching orders: " . mysqli_error($conn);
    }
} else {
     echo "<p>You need to be logged in to view your orders.</p>";
}
?>


