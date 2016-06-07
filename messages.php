<?php
require_once './src/User.php';
require_once './src/Tweet.php';
require_once 'src/connection.php';
require_once './src/Messages.php';

session_start();

$newUser = ($_SESSION['user']);
$userId = $newUser->getId();

?>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
    <a href="logout.php">Logout</a>
    <a href="index.php">Home</a>

    <?php
    echo "<br>";
    echo "<h2>Messagess sended to you:</h2>";
    
    $allRecivedMessages = Messages::loadRecivedMessages($conn, $userId);
    
    if(count($allRecivedMessages)===0){
        echo "No messagess for you";
    } else {
        foreach($allRecivedMessages as $message){
            echo $message->showMessages($conn);
        }
    }
     
    echo "<br>";
    echo "<h2>Messagess you send:</h2>";
    
    $allSendedMessages = Messages::loadSendedMessages($conn, $userId);
    
    if(count($allRecivedMessages)=== 0){
        echo "You didn't send any messagess";
    } else {
        foreach($allSendedMessages as $message){
            echo $message->showMessages($conn);
            
        }
    }
?>
    </body>
</html>