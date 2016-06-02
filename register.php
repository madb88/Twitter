<?php
session_start();
require_once 'src/User.php';
require_once 'src/connection.php';

if(isset($_SESSION['loggedUserId'])){
    header("Location: index.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = strlen(trim($_POST['email'])) > 0? trim($_POST['email']): null;
    $password = strlen(trim($_POST['password'])) > 0? trim($_POST['password']): null;
    $retypedPassword = strlen(trim($_POST['retypedPassword'])) > 0? trim($_POST['retypedPassword']): null;
    $fullName = strlen(trim($_POST['fullName'])) > 0? trim($_POST['fullName']): null;

    $user = User::getUserByEmail($conn, $email);
    
    if($email && $password && $retypedPassword && $fullName && $password == $retypedPassword && !$user){
        $newUser = new User();
        $newUser->setEmail($email);
        $newUser->setPassword($password, $retypedPassword);
        $newUser->setFullName($fullName);
        $newUser->activate();
        if($newUser->saveToDB($conn)){
            echo 'Registration successfull <br />';
            header("Location: index.php");

        } else {
            echo 'Error durning the registration <br />';
        }
    } else {
        if(!$email){
            echo 'Incorrect email <br />';
        }
        if(!$password){
            echo 'Incorrect password <br />';
        }
        if(!$retypedPassword || $retypedPassword != $password){
            echo 'Incorrect retyped password <br />';
        }
        if(!$fullName){
            echo 'Incorrect full name <br />';
        }
        if($user){
            echo 'User email exists <br />';
        }
    }
}

?>

<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                    <div class="col-md-4" style="margin:5% 5% 5% 1%">
                        <h2>Registration</h2>
                        <div class="form-group">
                        <form method="POST">
                        
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" />
                        <br>
                        <label for="fullName">Full name:</label>
                        <input type="text" name="fullName" class="form-control" placeholder="Full Name"/>
                        <br>
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                        <br>
                        <label for="retypedPassword">Retyped password:</label>
                        <input type="password" name="retypedPassword" class="form-control" placeholder="Retype password" />
                        <br>
                        
                        <input type="submit" value="Register" class="btn btn-success btn-lg btn-block"/>
                        <a href="login.php" style="text-align: center">Back to main page</a>
                        </form>
                        </div>
                    </div>
            </div>
           </div>
    </div>
    </body>
</html>

