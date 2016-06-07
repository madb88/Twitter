<?php
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Messages.php';
require_once 'src/connection.php';

session_start();

$user = $_GET['user_id'];
if($_SERVER['REQUEST_METHOD']=== "POST"){
    if(isset($_POST['submit'])){
        
        $newUser = ($_SESSION['user']);
        $userId = $newUser->getId();
        if($user == $userId){
            echo 'You cant send message to yourself';
            return false;
        }
        $newMessage = new Messages();
        $newMessage->setSenderId($userId);
        $newMessage->setReciverId($user);
        $newMessage->setMessageText($_POST['messageValue']);
        $newMessage->createMessage($conn);
        echo "Message has been send!";
    }  
}

?>
<html>
    <body>
    <a href="index.php">Home</a>
    <form action="#" method="POST">
        <fieldset>
            <legend>Send message to this user:</legend>
            <input type="text" name="messageValue" id="messageText">
            <input type="submit" value="Send message" name="submit">
        </fieldset>
    </form>
    </body>
</html>
    