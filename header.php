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
                <a href="logout.php" class="text-danger text-decoration-none pe-2"><i class="bi bi-box-arrow-right"></i><i class="bi bi-box-arrow-right"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg></i>Logout |</a>

                <a href="view.php" class="text-danger text-decoration-none pe-2"><i class="fa-solid fa-cart-shopping"></i></i>cart(<?php echo $count ?>) |</a>   
                <a href="mystore.php" class="text-danger text-decoration-none pe-2"><i class="bi bi-box-arrow-right "></i><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
  <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
</svg></i>Myoders |</a>

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