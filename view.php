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

        // Insert order into order_tbl
        $sql_total_price = "INSERT INTO order_tbl (total_amount, user_id, order_id) VALUES ('$total_price', '$user_id', '$ord_id')";
        $result_total_price = mysqli_query($conn, $sql_total_price);
        $order_id = mysqli_insert_id($conn);

        // Insert each product into add_tbl
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

        // Insert total price into order_tbl
        if ($result_total_price) {
            echo "Total price added to the database successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    
                // Clear cart after checkout
                $_SESSION['cart'] = array();
            
        // Clear cart after checkout (optional)
        // session_unset();
        // session_destroy();
    }
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

        <!-- Checkout button -->
        <form action="" method="post">
            <button type="submit" name="checkout" class="btn btn-danger mt-4">Checkout</button>
        </form>
    </div>
</body>
</html>
