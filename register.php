<?php     
include 'conn.php';    

session_start();
if(isset($_SESSION['email'])){    
	header('location:index.php');   
}

if(isset($_POST['Signup'])){     
  $name=$_POST['name']; 
//   $mobileno=$_POST['mobileno'];
  $email=$_POST['email'];
  $password=$_POST['password'];     
     
$sql = "INSERT INTO `user_tbl` (`name`, `email`, `password`) VALUES ('$name','$email', '$password')";   
 
  $result=mysqli_query($conn,$sql);     
  if($result){   
    echo"insert successfully";      

    header("location:login.php");
  }else{   
    echo"error";
  }
 
}


?> 
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Register Form</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="title">Signup </div>
        <form action="#" method="POST" id="registrationForm"> 
            <div class="field">
                <input type="text" name="name" id="name" required>
                <label>Name</label>
                <small class="error" id="nameError"></small>
            </div><br> 
            <!-- <div class="field">
                <input type="text" name="mobileno" id="mobilenumber" required onkeypress="valid_numbers(event);">
                <label>Mobile Number</label>
                <small class="error" id="mobileError"></small>
            </div><br> -->
            <div class="field">
                <input type="email" name="email"id="email" required>
                <label>Email Address</label>
                <small class="error" id="emailError"></small>
            </div><br>
            <div class="field">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
                <small class="error" id="passwordError"></small>
            </div> <br>
            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div><br>
                <div class="pass-link">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
            <div class="field">
                <input type="submit" name="Signup" value="Signup">
            </div>
            <div class="signup-link">
                <a href="login.php"name="login">Login now</a>
            </div>
        </form>
    </div> 
    <script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.error').forEach(el => el.innerText = '');

        // Name validation
        const name = document.getElementById('name').value.trim();
        const nameRegex = /^[a-zA-Z\s]+$/; // Only letters and spaces
        if (name === '') {
            document.getElementById('nameError').innerText = 'Please enter your name.';
            isValid = false;
        } else if (!nameRegex.test(name)) {
            document.getElementById('nameError').innerText = 'Name must contain only letters and spaces.';
            isValid = false;
        }

        // Mobile number validation
        // const mobilenumber = document.getElementById('mobilenumber').value.trim();
        // if (mobilenumber === '') {
        //     document.getElementById('mobileError').innerText = 'Please enter your mobile number.';
        //     isValid = false;
        // } else if (mobilenumber.length !== 10 || !/^\d+$/.test(mobilenumber)) { 
        //     document.getElementById('mobileError').innerText = 'Mobile number must be exactly 10 digits.';
        //     isValid = false;
        // }

//         function valid_numbers(e)
// {
//         var key=e.which || e.KeyCode;
//         if  ( key >=48 && key <= 57)
//          // to check whether pressed key is number or not 
//                 return true; 
//          else return false;
// }

        // Email validation
        const email = document.getElementById('email').value.trim();
        if (email === '') {
            document.getElementById('emailError').innerText = 'Please enter your email address.';
            isValid = false;
        } else if (!validateEmail(email)) {
            document.getElementById('emailError').innerText = 'Please enter a valid email address.';
            isValid = false;
        }

        // Password validation
        const password = document.getElementById('password').value.trim();
        if (password === '') {
            document.getElementById('passwordError').innerText = 'Please enter your password.';
            isValid = false;
        } else if (password.length < 6) {
            document.getElementById('passwordError').innerText = 'Password must be at least 6 characters long.';
            isValid = false;
        }

        // Checkbox validation
        // const checkbox = document.getElementById('remember-me');
        // if (!checkbox.checked) {
        //     alert('You must agree to the terms and conditions.');
        //     isValid = false;
        // }

        if (!isValid) {
            event.preventDefault(); // Stop form submission
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    </script>
</body>  
 
</script>
</html>
