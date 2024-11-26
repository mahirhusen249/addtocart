<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>   
    <?php      
    // session_start();
    $count=0;  
    if(isset($_SESSION['cart'])){   
        $count=count($_SESSION['cart']);
    }
    
    ?>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid font-monospace">
            <a class="navbar-brand pb-2"> </a>
            <div class="d-flex">
                <a href="index.php" class="text-danger text-decoration-none pe-2"><i class="fa-solid fa-house"></i>Home |</a>
                <a href="logout.php" class="text-danger text-decoration-none pe-2"><i class="bi bi-box-arrow-right"></i>Logout |</a>

                <a href="view.php" class="text-danger text-decoration-none pe-2"><i class="fa-solid fa-cart-shopping"></i></i>cart(<?php echo $count ?>) |</a>
                <span class="text-danger pe-2"> 
                    
                    <i class="fa-solid fa-user"></i>hello, 
                    
                    <?php  
                    
                    ?>
                    <!-- <a href="" class="text-warning text-decoration-none pe-2"><i class="fa-solid fa-right-to-bracket"></i>Login |</a> -->
                    <!-- <a href="../.php" class="text-warning text-decoration-none pe-2">Admin</a> -->

                </span>
            </div>
        </div>
    </nav>
    </div>

    <!-- <div class="bg-danger sticky-top font-monospace">
        <ul class="list-unstyled d-flex justify-content-center">
            <li><a href="laptop.php" class="text-decoration-none text-white fw-bold fs-4 px-5">LAPTOPS</a></li>
            <li><a href="mobile.php" class="text-decoration-none text-white fw-bold fs-4 px-5">MOBILES</a></li>
            <li><a href="bag.php" class="text-decoration-none text-white fw-bold fs-4 px-5">BAGS</a></li>
        </ul>
    </div> -->



</body>

</html>