<?php
@include 'database.php';

session_start();

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:admin.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:products.php');

        }
        
    }else{
        $error[] = 'incorrect email or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Login Form</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head> 

    <body style="background-color: #fff">
        <div class="box">
            <form action="login.php" method="post">
                <div class="avatar">
                    <img src="image/avatar.png" alt="">
                </div>
                <h2 class="text-center">Login Now</h2>
                <?php
                if(isset($error)){
                    foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
                ?>   
                <div class="form-group">
                    <input type="email" class="form-control" name="email" required placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                </div>        
                <div class="form-group">
                    <button type="submit" name="submit" value="login now" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </div>
                <div class="bottom-action clearfix">
                    <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                    <a href="#" class="float-right">Forgot Password?</a>
                </div>
            </form>
            <p class="text-center small" style="color: #7a7a7a">Don't have an account? <a href="registration.php">Sign up here!</a></p>
        </div>
    </body>

</html>