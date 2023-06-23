<?php

@include 'database.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $message[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $message[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         $message[] = 'Registered Successfully!';
         header('location:login.php');
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
   <title>Register Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="registration.css">

</head>
<body style="background-color: #eee">
   
   <div class="form-container">

      <form action="" method="post">
         <h3>register now</h3>
         <?php
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
            };
         };
         ?>
         <input type="text" name="name" required placeholder="Name">
         <input type="email" name="email" required placeholder="Email">
         <input type="password" name="password" required placeholder="Password">
         <input type="password" name="cpassword" required placeholder="Confirm Password">
         <select name="user_type">
            <option value="user">USER</option>
            <option value="admin">ADMIN</option>
         </select>
         <input type="submit" name="submit" value="register now" class="form-btn">
         <p>Already Have An Account? <a href="login.php">Login now</a></p>
      </form>

   </div>

</body>
</html>