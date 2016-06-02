<?php
require_once './src/User.php';
require_once './src/Tweet.php';
require_once 'src/connection.php';
session_start();

if($_SERVER['REQUEST_METHOD']=== "POST"){
    if(isset($_POST['submit'])){

        $newUser = ($_SESSION['user']);
        $newTweet = new Tweet();
        $newTweet->setUserId($newUser->getId());
        $newTweet->setText($_POST['tweetValue']);
        $newTweet->createTweet($conn);
              
        echo "Tweet succesfully added!";
    }  
}
?>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
    
    <a href="logout.php">Logout</a>
    <a href="home.php">All Tweets</a>
    <a href="index.php">My tweets</a>
    <?php
    echo "<br>";
    echo "<h2>Wszystkie tweety uzytkownika:</h2>";
    
    //Wyswietlanie tweetow    

    $user = ($_SESSION['user']);
        
    $allTweets = Tweet::loadAllTweets($conn,$user->getId());
        foreach($allTweets as $tweet){
            $tweet->showTweet($conn);
            

        }
    echo "You wrote: ".count($allTweets)." tweets";    
    ?>
    <form action="#" method="POST">
        <fieldset>
        <legend>New Tweet Form:</legend>
        
        <input type="text" name="tweetValue" id="tweetText">
        
        <input type="submit" value="Add new tweet" name="submit">
        </fieldset>
    </form>
    </body>
</html>
    


