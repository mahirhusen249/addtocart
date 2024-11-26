<?php      
    session_start();     
 include 'conn.php';   

 if(isset($_SESSION['email'])){    
	header('location:index.php');   
}
//   if(isset($_SESSION['email'])){    
//    header('location:../index.php');   
//   } 
  
   
  if (isset($_POST['submit'])) {
   $email=$_POST['email'];   
   $password=$_POST['password'];   
    
$sql="SELECT * FROM `user_tbl` where email='$email' AND password='$password'";    
$result=mysqli_query($conn,$sql);  
$data=mysqli_num_rows($result);
$result2= mysqli_fetch_assoc($result);
if( $data > 0){   


   $_SESSION['email']=$email;
   $_SESSION['user_id']=$result2['id'];
   $_SESSION['password']=$password;  
   header('location:index.php');
}
else{   
   echo'something worng';
}

}  
  
  ?>
 
 
 
 
 <!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Form Design | CodeLab</title>
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
         login Form
         </div>
         <form action="#" method="post"> 
            <div class="field">
               <input type="email" name="email"required>
               <label>Email Address</label>
            </div>
             
            <div class="field">
               <input type="password" name="password" required>
               <label>Password</label>
            </div>    
            <div class="field">
               <input type="submit"  name="submit">
            </div> 
            <div class="signup-link">
               Not a member? <a href="register.php">Signup now</a>
            </div>
            </form>
      </div>
   </body>
</html>