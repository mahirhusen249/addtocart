<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}

include 'header.php';
include 'conn.php';

 if (isset($_POST['checkout'])) {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $total_price = 0;
        $user_id = $_SESSION['user_id'];
        $ord_id = 'AK' . rand(100000, 999999);

        
        foreach ($_SESSION['cart'] as $product) {
            $total_price += $product['product_price'];
        }

         $sql_total_price = "INSERT INTO order_tbl (total_amount, user_id, order_id) VALUES ('$total_price', '$user_id', '$ord_id')";
        $result_total_price = mysqli_query($conn, $sql_total_price);
        $order_id = mysqli_insert_id($conn);

         foreach ($_SESSION['cart'] as $product) {
            $add_name = $product['product_name'];
            $add_price = $product['product_price'];
            $add_image = $product['product_image'];

            $sql_insert = "INSERT INTO add_tbl (add_name, add_price, add_image, order_id) 
                           VALUES ('$add_name', '$add_price', '$add_image', '$order_id')";
            $result_insert = mysqli_query($conn, $sql_insert);

            if ($result_insert) {
                echo "Product added to cart and inserted into the database successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        $cardnumber=$_POST['cardnumber'];    
        $cvvNumber=$_POST['cvvNumber'];  
        $username=$_POST['username'];         

        $sql_form="INSERT INTO `product_tbl` (`card_number`, `ccv_number`, `username`,order_id) VALUES ('$cardnumber', '$cvvNumber', '$username','$order_id')";  
        $result=mysqli_query($conn,$sql_form); 
        // print_r($result);exit;
        if($result){    
            echo"cart order successfully ";
        }else{    
            echo"error";
        }

        }

        // Insert total price into order_tbl
        if ($result_total_price) {
            echo "Total price added to the database successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    
                 $_SESSION['cart'] = [];
            
        // Clear cart after checkout (optional)
        // session_unset();
        // session_destroy();
    
}  


if (isset($_POST['remove'])) {
    $product_name_to_remove = $_POST['item']; 
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_name'] === $product_name_to_remove) {
             unset($_SESSION['cart'][$key]);
             $_SESSION['cart'] = array_values($_SESSION['cart']);
            
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Your Cart</h1>

        <?php if (!empty($_SESSION['cart'])): ?>
        <div class="row">
            <?php foreach ($_SESSION['cart'] as $row): ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $row['product_image']; ?>" height="140" width="100" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                        <p class="card-text">₹<?php echo $row['product_price']; ?></p>

                        <!-- Remove Button Form -->
                        <form action="" method="POST">
                            <input type="hidden" name="item" value="<?php echo $row['product_name']; ?>"> <!-- Send the product name -->
                            <button type="submit" class="btn btn-danger" name="remove">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p>Your cart is empty.</p>
        <?php endif; ?>      
       

         
<form action="" method="post">
    <button type="button" class="btn btn-danger mt-4" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
</form>

<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Checkout Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
 
        <form action="" method="post" id="checkoutForm">
          <div class="mb-3">
            <label for="field1" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="field1" name="cardnumber" placeholder="Enter card number" required maxlength="16" minlength="16" pattern="\d{16}" title="Card number must be 16 digits" oninput="validateCardNumber()" />
            <div id="cardNumberError" class="text-danger" style="display:none;">Card number must be exactly 16 digits.</div>
          </div>
          <div class="mb-3">
            <label for="field2" class="form-label">CVV Number</label>
            <input type="text" class="form-control" id="field2" name="cvvNumber" placeholder="Enter CVV number" required maxlength="3" minlength="3" pattern="\d{3}" title="CVV number must be 3 digits" oninput="validateCVVNumber()" />
            <div id="cvvError" class="text-danger" style="display:none;">CVV number must be exactly 3 digits.</div>
          </div>
          <div class="mb-3">
            <label for="field3" class="form-label">Username</label>
            <input type="text" class="form-control" id="field3" name="username" placeholder="Enter username" required />
            <div id="usernameError" class="text-danger" style="display:none;">Username cannot be empty.</div>
          </div>
          <button type="submit" name="checkout" class="btn btn-danger">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
// Function to validate card number
function validateCardNumber() {
    var cardNumber = document.getElementById('field1').value;
    var cardError = document.getElementById('cardNumberError');
    if (cardNumber.length !== 16 || !/^\d{16}$/.test(cardNumber)) {
        cardError.style.display = 'block';
    } else {
        cardError.style.display = 'none';
    }
}

// Function to validate CVV number
function validateCVVNumber() {
    var cvvNumber = document.getElementById('field2').value;
    var cvvError = document.getElementById('cvvError');
    if (cvvNumber.length !== 3 || !/^\d{3}$/.test(cvvNumber)) {
        cvvError.style.display = 'block';
    } else {
        cvvError.style.display = 'none';
    }
}

// Function to validate username
function validateUsername() {
    var username = document.getElementById('field3').value;
    var usernameError = document.getElementById('usernameError');
    if (username.trim() === "") {
        usernameError.style.display = 'block';
    } else {
        usernameError.style.display = 'none';
    }
}

// Add event listeners to validate inputs on input change
document.getElementById('field1').addEventListener('input', validateCardNumber);
document.getElementById('field2').addEventListener('input', validateCVVNumber);
document.getElementById('field3').addEventListener('input', validateUsername);

// Form submit event listener to prevent submission if any field is invalid
document.getElementById('checkoutForm').addEventListener('submit', function(event) {
    var cardNumberValid = document.getElementById('cardNumberError').style.display === 'none';
    var cvvValid = document.getElementById('cvvError').style.display === 'none';
    var usernameValid = document.getElementById('usernameError').style.display === 'none' && document.getElementById('field3').value.trim() !== "";
    
    if (!cardNumberValid || !cvvValid || !usernameValid) {
        event.preventDefault(); // Prevent form submission if any field is invalid
        alert('Please fill in the form correctly.');
    }
});
</script>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    </div>  
    <!-- <form action="" method="post">
            <button type="submit" name="checkout" class="btn btn-danger mt-4">Checkout</button>
        </form>  -->
</body>
</html>      

