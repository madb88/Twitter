<?php

require_once './src/User.php';
require_once './src/Tweet.php';
require_once 'src/connection.php';
session_start();

$tweet = $_GET['tweet_id'];

if($_SERVER['REQUEST_METHOD']== "GET"){
    if(isset($_GET['tweet_id']) ){
        $id = $_GET['tweet_id'];
        $conn->query("DELETE FROM Tweet WHERE id='$id'");
        header("Location: index.php");
  
    } else {
       
        echo "Error";
        
    }
}



