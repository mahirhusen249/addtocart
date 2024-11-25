<?php
session_start();
include 'header.php';
include 'conn.php';  

if (isset($_POST['checkout'])) {
    session_unset();  
    session_destroy();
    header('Location: index.php'); 
    exit();  
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
                    <img class="card-img-top" src="<?php echo $row['product_image']; ?>"height="140"width="100" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                        <p class="card-text">₹<?php echo $row['product_price']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p>Your cart is empty.</p>
        <?php endif; ?>
        <?php
 
?>

        <!-- Checkout button that triggers session destruction -->
        <form action="" method="post">
            <button type="submit" name="checkout" class="btn btn-danger">Checkout</button>
        </form>
    </div>
</body>
</html>  
<?php
