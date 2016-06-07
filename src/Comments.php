<?php
require_once 'connection.php';
require_once 'User.php';
require_once 'Comments.php';

class Comments{
    private $id;
    private $user_id;
    private $tweet_id;
    private $creation_date;
    private $text;
    
    static public function loadAllComments(mysqli $conn, $tweet_id){
        $sql = "SELECT * FROM Comments WHERE tweet_id={$tweet_id}";
        $allComments = [];
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $currdate = date("Y-m-d");
                $tweetComment = new Comments();
                $tweetComment->id = $row['id'];
                $tweetComment->setUserId($row['user_id']);
                $tweetComment->setTweetId($row['tweet_id']);
                $tweetComment->setCommentText($row['text']);
                $tweetComment->setCreationDate($currdate);
                $allComments[] = $tweetComment;           
            }
            
        }
        return $allComments;
    }
    
    public function loadCommentsFromDB(mysqli $conn, $id){
        $sql = "SELECT * FROM Comments WHERE id= $id";
        $result = $conn->query($sql);
        
        if($result->num_rows == 1){
            $rowComment = $result->fetch_assoc();
            $this->id = $rowComment['id'];
            $this->user_id = $rowComment['user_id'];
            $this->tweet_id = $rowComment['tweet_id'];
            $this->creation_date = $rowComment['creation_date'];
            $this->text = $rowComment['text'];
            return true;
        }
        return false;
    }
    
    public function createComment(mysqli $conn){
        if(!is_numeric($this->user_id)|| !strlen($this->text)>0){
            return false;
        } 
        $currdate = date("Y-m-d");
        $sql = "INSERT INTO Comments (text, creation_date, tweet_id, user_id) VALUES 
                ('{$this->text}','$currdate','{$this->tweet_id}','{$this->getUserId()}')";
                $result = $conn->query($sql);
                if($result != false){
                    $this->id = $conn->insert_id;
                    return true;
                }          
                return false;
    }
        
    
    public function updateComment(){
        $sql = "UPDATE Comments SET text = '{$this->text}' WHERE id = {$this->getId()}";
        if($conn->query($sql)){
            return true;
        } else {
            return false;
        }
    }
    
    public function showComment(mysqli $conn){
        
        echo "Comment id: ".$this->getId()."<br>";
        echo "Comment text: ".$this->getCommentText()."<br>";
        echo "Author id: ".$this->getUserId()."<br>";
        echo "Tweet id: ".$this->getTweetId()."<br>";
//        echo "Creation date".$this->getCreationDate()."<br>";
        
        echo "<br>";
               
    }

    public function __construct() {
        $this->id = -1;
        $this->user_id = "";
        $this->comment_id = "";
//        $this->creation_date = "";
        $this->text = "";
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public function setUserId($user_id){
        $this->user_id = $user_id;
    }
    
    public function getTweetId(){
        return $this->tweet_id;
    }
    
    public function setTweetId($tweet_id){
        $this->tweet_id = $tweet_id;
    }
    
    public function getCreationDate(){
        return $this->creation_date;
    }
    
    public function setCreationDate($creation_date){
        $this->setCreationDate = $creation_date;
    }
    
    public function getCommentText(){
        return $this->text;
    }
    
    public function setCommentText($text){
        $this->text = $text;
    }
}

