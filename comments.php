<?php
require_once './src/User.php';
require_once './src/Tweet.php';
require_once 'src/connection.php';
session_start();

$tweet = $_GET['tweet_id'];
if($_SERVER['REQUEST_METHOD']=== "POST"){
    if(isset($_POST['submit'])){
        $currdate = date("Y-m-d");
        $newUser = ($_SESSION['user']);
        $userId = $newUser->getId();
        $newComment = new Comments();
        $newComment->setUserId($userId);
        $newComment->setCommentText($_POST['commentValue']);
        $newComment->setTweetId($_GET['tweet_id']);
        $newComment->getCreationDate();
        $newComment->createComment($conn);
        echo "Comment succesfully added!";
    }  
}

?>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
    <a href="logout.php">Logout</a>
    <a href="index.php">Home</a>
    <a href="index.php">My profile</a>

    <?php
    echo "<br>";
    echo "<h2>All comments for this tweet:</h2>";
    
    $allComments = Comments::loadAllComments($conn, $tweet);
//    var_dump($allComments);
    if(count($allComments)===0){
        echo "No comments for this tweet";
    } else {
        foreach($allComments as $comment){
            echo $comment->showComment($conn);
        }
    }
?>
    <form action="#" method="POST">
        <fieldset>
            <legend>Add comment for this tweet:</legend>
            <input type="text" name="commentValue" id="commentText">
            <input type="submit" value="Add new comment" name="submit">
        </fieldset>
    </form>
    </body>
</html>
    


