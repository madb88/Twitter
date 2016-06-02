<?php
session_start();
require_once 'src/connection.php';
require_once 'src/User.php';


if($_SERVER['REQUEST_METHOD']== "POST"){
    $email = strlen(trim($_POST['email'])) ? trim($_POST['email']):null;
    $password = strlen(trim($_POST['password'])) ? trim($_POST['password']):null;
    if (empty($email) || empty($password)) {
        echo "You have to write something!";       
    } else {
        $newUser = new User();
        $userLogin = $newUser->login($conn, $email, $password);
        if ($userLogin === true) {
            
            header("Location: index.php");

        } else {
            
            echo "Bad data";
        }
    }
}
?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                    <div class="col-md-4" style="margin-top:10%">
                        <h2>Sign in</h2>
                        <form method="POST">
                            <label>Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" />
                            </div>    
                            <br />
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password"/>
                            </div>
                            <br />
                            <input type="submit" class="btn btn-success btn-lg btn-block" value="Login" />
                            <a href="register.php" class="btn btn-info btn-lg btn-block">Register</a>
                        </form> 
                    </div>
            </div>
        </div>
</body>
</html>





