<?php
session_start(); 
if(!isset($_SESSION['email'])){    
	header('location:login.php');   
}
include 'header.php';     
include 'conn.php';     

if (isset($_SESSION['user_id'])) {   
    $user_id = $_SESSION['user_id'];   

     $sql = "SELECT * FROM `order_tbl` WHERE user_id = '$user_id'";  
    $result = mysqli_query($conn, $sql);    

    if ($result) {
        //  $quantity_sql = "SELECT a.order_id as ord_id,SUM(a.order_id) AS total_quantity 
        //                  FROM `add_tbl` a
        //                  WHERE a.order_id IN (SELECT o.id FROM `order_tbl` o WHERE o.id = a.order_id)";
                         
        // $quantity_result = mysqli_query($conn, $quantity_sql);
        // $quantity_row = mysqli_fetch_assoc($quantity_result);
        // $total_quantity = $quantity_row['total_quantity'] ? $quantity_row['total_quantity'] : 0;   

        ?>
        <table class="table mydatatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Order Date</th> 
                    <th>Quantity</th>   
                    <th>view your cart</th>   
                    <th>Invoice</th>  
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php    
                $total_amount = 0; 
                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                     $quantity_sql = "SELECT * FROM `add_tbl` WHERE order_id = ".$row['id'];  
                    //  print_r($row['id']);exit;
                         
        $quantity_result = mysqli_query($conn, $quantity_sql);
        $quantity_row = mysqli_num_rows($quantity_result);
                        $total_amount += $row['total_amount']; 
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['order_id']?></td>   
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['total_amount']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>  
                            <td><?php echo $quantity_row; ?></td> 
                            <td>    
 <form action=""method="POST">
    <div class="col-lg-1">
        <div class="form-group" style="margin-left:100%">
            <a href="qunt.php?order_id=<?php echo $row['id']; ?>" class="btn btn-primary mt-3"name="view">ViewCart</a> 

        </div>
    </div>  
    <!-- <a href="qunt.php?order_id" class="btn btn-primary mt-1"name="view">Invoice</a> -->

    </form> 

</td>  
<td>    
    <a href="invoice.php?order_id=<?php echo $row['id']; ?>" class="btn btn-warning mt-3"name=" ">Invoice</a>
    
</td>   
<td>
<a href="mystore.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-danger">Delete</a> 
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
if(isset($_GET['delete'])){   
    $id=$_GET['delete']; 
    $sql = "DELETE FROM order_tbl WHERE id = $id"; 
    $result=mysqli_query($conn,$sql);
    echo "<script>window.location.href = ' mystore.php';</script>";
 

}



 ?>
