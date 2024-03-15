<?php
@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   // Email validation
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Invalid email format';
   }

   // Proceed with login if no email validation errors
   if (!isset($error)) {
      $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
      $result = mysqli_query($conn, $select);

      if(mysqli_num_rows($result) > 0){
         $row = mysqli_fetch_array($result);

         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:indexphp.php');
         } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:index.php');
         }
      } else {
         $error[] = 'Incorrect email or password!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link href="login_style.css"  rel="stylesheet" />
  
</head>
<body>
   <div class="container">
      <div class="logoimg">
         <img src="assets/Logo 14-02-02.png" alt="logo" style="height: 100px; width: 100px;">
      </div>
      <div class="form-container">
         <form action="" method="post">
            <h3>Login Now</h3  >
            <?php
               // Check if $error is set and not empty
               if (isset($error) && !empty($error)) {
                  foreach ($error as $err) {
                     echo '<span class="error-msg">' . $err . '</span>';
                  }
               }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <a href="index.php">
               <button type="submit" name="submit" class="form-btn">Login Now</button>
            </a>
            <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
         </form>
      </div>
   </div>

</body>
</html>
