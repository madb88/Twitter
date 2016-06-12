<?php

require_once 'connection.php';
require_once 'User.php';
require_once 'Comments.php';

class Tweet {

    public $id;
    public $user_id;
    public $text;

    public function __construct() {
        $this->id = -1;
        $this->user_id = "";
        $this->text = "";
    }

//******SETERY*********

    public function setUserId($user_id) {
        $this->user_id = is_numeric($user_id) ? $user_id : $this->user_id;
    }

    public function setText($text) {
        $this->text = is_string($text) ? $text : $this->text;
    }

//******GETY************
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getText() {
        return $this->text;
    }

    public function loadTweetsFromDb(mysqli $conn, $id) {

        $sql = "SELECT * FROM Tweet WHERE user_id = '$id'";
        $allTweets = [];
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $rowTweet = $result->fetch_assoc();
            $tweet = new Tweet();
            $tweet->id = $rowTweet['id'];
            $tweet->user_id = ($rowTweet['user_id']);
            $tweet->text = $rowTweet['text'];
            $_SESSION['tweet'] = $tweet;
        }
        return $result;
    }

    static public function loadAllTweetsFromDb(mysqli $conn) {
        $allTweets2 = [];
        $sql = "SELECT * FROM Tweet";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userTweet = new Tweet();
                $userTweet->id = $row['id'];
                $userTweet->setUserId($row['user_id']);
                $userTweet->setText($row['text']);
                $allTweets2[] = $userTweet;
            }
        }
        return $allTweets2;
    }

    public function createTweet(mysqli $conn) {
        if (!is_numeric($this->user_id) || !strlen($this->text) > 0 || !($this->user_id) > 0) {
            return false;
        }

        $sql = "INSERT INTO Tweet (text, user_id) VALUES ('{$this->text}', {$this->user_id})";
        $result = $conn->query($sql);
        if ($result != false) {
            return true;
        }
        return false;
    }

    public function updateTweet() {
        $sql = "UPDATE Tweet SET text = '{$this->text}' WHERE id = {$this->getId()}";
        if ($conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function showTweet() {

        echo "Tweet id: " . $this->getId() . "<br>";
        echo "Tweet text: " . $this->getText() . "<br>";
        echo "Author id: " . $this->getUserId() . "<br>";
        echo "<a href='comments.php?tweet_id={$this->id}'>Comments</a>" . "<br>";
        echo "<a href='delete.php?tweet_id={$this->id}'>Delete this tweet</a>" . "<br>";
        echo "<br>";
    }

    public function showAllTweet() {

        echo "Tweet id: " . $this->getId() . "<br>";
        echo "Tweet text: " . $this->getText() . "<br>";
        echo "Author id: " . $this->getUserId() . "<br>";
        echo "<a href='comments.php?tweet_id={$this->id}'>Comments</a>" . "<br>";
        echo "<a href='send_message.php?user_id={$this->getUserId()}'>Send messege to this user</a>" . "<br>";
        echo "<br>";
    }

    static public function loadAllTweets(mysqli $conn, $user_id) {
        $allTweets = [];
        $sql = "SELECT * FROM Tweet WHERE user_id={$user_id}";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userTweet = new Tweet();
                $userTweet->id = $row['id'];
                $userTweet->setUserId($row['user_id']);
                $userTweet->setText($row['text']);
                $allTweets[] = $userTweet;
            }
        }
        return $allTweets;
    }

    static public function loadAllComments(mysqli $conn) {
        $comments = Comments::loadAllComments($conn, $this->getTweetId());
        return $comments;
    }

}
