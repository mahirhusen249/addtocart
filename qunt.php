<?php
include 'conn.php';    
include 'header.php';    

 if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

     $sql = "SELECT add_name, add_price, add_image FROM `add_tbl` WHERE order_id = '$order_id'";   
         
    $result = mysqli_query($conn, $sql);     
?>

<h1>Your Cart</h1>

<div class="row">
    <?php
     if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $row['add_image']; ?>" height="140" width="100" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['add_name']; ?></h5>
                        <p class="card-text">₹<?php echo $row['add_price']; ?></p>
                     </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No items in your cart.</p>";
    }
    ?>
</div>

<?php
} else {
    echo "No order selected";
}
?>
