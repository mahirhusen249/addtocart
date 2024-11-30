<?php  
include 'conn.php';    
include 'header.php';
?>


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
    <center>
        <table border="2" style="width: 600px;">
            <tr>
                <td class="ml-3">
    
                    <div class="conatiner">
                        <?php
                         $order_id = $_GET['order_id'];
                            $sql = "SELECT p.card_number, p.ccv_number, p.username, o.total_amount, o.order_date,o.order_id as order_number
                                    FROM product_tbl p   JOIN order_tbl o ON p.order_id = o.id where p.order_id =$order_id";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            // print_r($sql);exit;
                        ?>
                        <div class="row">
                            <div class="col-lg-6"> 
                                <h2 class="text-primary">BILL TO</h2>  
                                <hr>
                                <strong>Card Number:</strong><?php echo $row['card_number'] ?>  <br>
                                <strong>CVV Number:</strong><?php echo $row['ccv_number'] ?>  <br>
                                <strong>User name:</strong><?php echo $row['username'] ?>  <br>
                            </div>
                            <div class="col-lg-6"> 
                                <h2 class="text-primary">Ship TO</h2>   
                                <hr> 
                                <strong>Order Date:</strong><?php echo $row['order_date'] ?>  <br>
                                <strong>Order Number:</strong><?php echo $row['order_number'] ?>  <br>
                            </div>
                        </div>  
                    </div>
                    </div>  
                    <table class="table mydatatable" border="1">
                                <thead>
                                    <tr> 
                                        <th>add_name</th>
                                        <th>Quantity</th>  
                                        <th>add_price</th> 
                                        <th>total_amount</th>  
                                    </tr>
                                </thead>
                                <tbody>
                    <?php              
                    
                     
                    // $quantity_sql = "SELECT * FROM `add_tbl` WHERE order_id = ".$row['id'];  
                                 
                    // $quantity_result = mysqli_query($conn, $quantity_sql);
                    // $quantity_row = mysqli_num_rows($quantity_result);
                        
                    // $sql="SELECT card_number,ccv_number,username,add_name,add_price FROM `product_tbl`";  
                    // $sql="SELECT p.card_number, p.ccv_number, p.username, a.add_name, a.add_price FROM product_tbl p JOIN add_tbl a ON p.id = a.order_id";  
                    
                    //$sql="SELECT p.card_number, p.ccv_number, p.username, a.add_name, a.add_price, o.total_amount, o.order_date FROM product_tbl p JOIN add_tbl a ON p.id = a.order_id JOIN order_tbl o ON p.id = o.id";  
                    $total_amount=0;
                    
                    $sql = "SELECT * FROM `add_tbl` WHERE order_id = ".$order_id;  
                    // $sql = "SELECT p.card_number, p.ccv_number, p.username, a.add_name, a.add_price, o.total_amount, o.order_date, a.order_id 
                    //   FROM product_tbl p  JOIN add_tbl a ON p.id = a.order_id   JOIN order_tbl o ON a.id = o.id";
                    
                    $result = mysqli_query($conn, $sql);     
                            
                    if (mysqli_num_rows($result) > 0) {  
                        while ($row = mysqli_fetch_assoc($result)) {   
                            $total_amount += $row['add_price']; 
                           
                    ?>   
                    
                        <td><?php echo $row['add_name']; ?></td>   
                        <td>1</td>  
                        <td><?php echo $row['add_price']?></td> 
                        <td><?php echo $row['add_price']?></td> 
                    
                                    </tr>    
                     
                     <?php   
                        }  
                    }
                    
                    
                    ?>
                    
                    <tr>
                        <td colspan="3" style="text-align:right;">Total Amount</td>
                        <td><?php echo $total_amount ?> </td>
                    </tr>
                    </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>
 </body>
</html>



