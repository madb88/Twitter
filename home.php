<?php
require_once './src/User.php';
require_once './src/Tweet.php';
require_once 'src/connection.php';
session_start();

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
    echo "<h2>Wszystkie tweety:</h2>";
    
    //Wyswietlanie wszystkich tweetow    

    $allTweets3 = Tweet::loadAllTweetsFromDb($conn);
        foreach($allTweets3 as $tweet){
            $tweet->showAllTweet($conn);
        }
    echo "At the moment there is : ".count($allTweets3)." tweets in DB";    
    ?>
</html>
    


