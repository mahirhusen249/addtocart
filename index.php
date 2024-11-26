<?php
session_start();
if(!isset($_SESSION['email'])){    
	header('location:login.php');   
}
include 'header.php';
include 'conn.php';     

// $order_id = 'AK'.rand(100000,999999);

// print_r($order_id);exit;
?>

<form action="" method="POST" enctype="multipart/form-data"> 
    <div class="container">
        <div class="row mb-2">
            <label for="formFile" class="col-sm-1 col-form-label">File Upload</label>
            <div class="col-sm-">
                <input class="form-control" type="file" name="image" required>
                <div class="text-danger" id="fileError"></div>    
                <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>
            </div>
        </div>
    </div>
</form> 

<?php
if(isset($_POST['submit'])){
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $image = $_FILES['image'];
        $image_loc = $image['tmp_name'];
        $image_name = $image['name'];
        $image_des = "addimage/" . $image_name;
        
        if(move_uploaded_file($image_loc, $image_des)){
            $sql = "INSERT INTO cart_tbl (product_image) VALUES ('$image_des')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "Inserted successfully";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    }
}        


 $sql = "SELECT * FROM cart_tbl";   
$result = mysqli_query($conn, $sql);  

?>

<table class="table mydatatable">
<thead>
    <!-- Table Headers (Optional) -->
</thead>
<tbody>
    <div class="row">
    <?php     
    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result)){ 
            ?>
            <div class="col-md-6 col-lg-4 m-auto mb-3">  
                <div class="card card m-auto" style="width:18rem;"> 
                    <img class="card-img-top m-auto" src="<?php echo $row['product_image']; ?>" height="180" width="170" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['product_name'];?></h5>
                        <p class="card-text">₹<?php echo $row['product_price'];?></p>  
                        <form action=" " method="POST"> 
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-primary" name="addtocart">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
    }    
    

 if (isset($_POST['addtocart'])) {
    $product_id = $_POST['product_id'];

     $sql = "SELECT * FROM cart_tbl WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);

     while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['cart'][] = $row;   
    }
}

      



?>
    </div>
</tbody>
</table> 
