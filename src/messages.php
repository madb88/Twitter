<?php

class Messages{
    private $id;
    private $user_id;
    private $message_id;
    private $text;
    private $readed;
    
    public function __construct() {
        $this->id = -1;
        $this->user_id = '';
        $this->message_id = '';
        $this->text = '';
        $this->readed = 1;
    }
    
    public function saveMessagesToDB(mysqli $conn){
        if($this->id == -1){
            $sql = "INSERT INTO Messages (message, readed)
                    VALUES ('{$this->message}', {$this->active})";
            if($conn->query($sql)){
                $this->id = $conn->insert_id;
                return true;
            } else {
                return false;
            }       
        } 
    }
    
    static public function loadMessagesFromDb(mysqli $conn){
            $allMessages = [];
            $sql = "SELECT * FROM User_Messages WHERE user_id={$this->id}";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    $userTweet = new Tweet();
                    $userTweet->id = $row['id'];
                    $userTweet->setUserId($row['user_id']);
                    $userTweet->setText($row['text']);
                    $allTweets2[] = $userTweet;
                }
            }   
            return $allTweets2;
        }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public function setUserId($userId){
        $this->user_id = $userId;
    }
    
    public function getMessageId(){
        return $this->message_id;
    }
    
    public function setMessageId($messageId){
        $this->message_id = $messageId;
    }
    
    public function getMessageText(){
        return $this->text;
    }
    
    public function setMessageText($messageText){
        $this->text = $messageText;
    }
    
    public function readed(){
        $this->readed = 0;
    }
    
    public function notReaded(){
        $this->readed = 1;
    }
    
    public function getReaded(){
        return $this->readed;
    }
    
}

