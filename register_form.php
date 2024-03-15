<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->

   <style>
      body {
         margin: 0;
         padding: 0;
         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
         background-color: #7335b7;
      }

      .form-container {
         width: 400px; /* Adjust width as needed */
         background-color: #fff;
         padding: 20px;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .form-container h3 {
         text-align: center;
         margin-top: 0;
      }

      .error-msg {
         color: red;
         display: block;
         margin-bottom: 10px;
      }

      .form-container input[type="text"],
      .form-container input[type="email"],
      .form-container input[type="password"],
      .form-container select {
         width: 100%;
         padding: 10px;
         margin-bottom: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         box-sizing: border-box;
         font-size: 16px;
      }

      .form-btn {
         background-color: #7335b7;
         color: #fff;
         border: none;
         cursor: pointer;
         width: 100%;
         padding: 10px;
         border-radius: 5px;
         font-size: 16px;
      }

      .form-btn:hover {
         background-color: #0056b3;
      }

      p {
         text-align: center;
         margin-top: 10px;
      }
      .logoimg {
   display: block;
   
  margin-left:150px;
}

   </style>
</head>
<body>

<div class="form-container">
<div class="logoimg">
         <img src="assets/Logo 14-02-02.png" alt="logo" style="height: 100px; width: 100px;">
      </div>
   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>
