<?php

require_once 'connection.php';

class Messages {

    private $id;
    private $sender_id;
    private $reciver_id;
    private $textMessage;
    private $readed;

    public function __construct() {
        $this->id = -1;
        $this->sender_id = '';
        $this->reciver_id = '';
        $this->textMessage = '';
        $this->readed = 1;
    }

    static public function loadSendedMessages(mysqli $conn, $sender_id) {
        $allSendedMessages = [];
        $sql = "SELECT * FROM Messages WHERE sender_id= $sender_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sendedMessage = new Messages();
                $sendedMessage->id = $row['id'];
                $sendedMessage->setSenderId($row['sender_id']);
                $sendedMessage->setReciverId($row['reciver_id']);
                $sendedMessage->setMessageText($row['text_message']);
                $sendedMessage->notReaded($row['is_read']);
                $allSendedMessages[] = $sendedMessage;
            }
        }
        return $allSendedMessages;
    }

    static public function loadRecivedMessages(mysqli $conn, $reciver_id) {
        $allRecivedMessages = [];
        $sql = "SELECT * FROM Messages WHERE reciver_id= $reciver_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recivedMessage = new Messages();
                $recivedMessage->id = $row['id'];
                $recivedMessage->setSenderId(($row['sender_id']));
                $recivedMessage->setReciverId($row['reciver_id']);
                $recivedMessage->setMessageText($row['text_message']);
                $recivedMessage->notReaded($row['is_read']);
                $allRecivedMessages[] = $recivedMessage;
            }
        }
        return $allRecivedMessages;
    }

    public function showMessages(mysqli $conn) {

        echo "Message id: " . $this->getId() . "<br>";
        echo "Message text: " . $this->getMessageText() . "<br>";
//        echo "Readed: ".$this->getReaded()."<br>";
        echo "Who send: " . $this->getSenderId() . "<br>";
        echo "<br>";
    }

    public function createMessage(mysqli $conn) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Messages (sender_id, reciver_id, text_message, is_read)
                    VALUES ({$this->sender_id},{$this->reciver_id},'{$this->textMessage}', {$this->readed})";
            $result = $conn->query($sql);
            if ($result != false) {
                $this->id = $conn->insert_id;
                return true;
            }
            return false;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->sender_id;
    }

    public function setSenderId($sender_id) {
        $this->sender_id = $sender_id;
    }

    public function getReciverId() {
        return $this->reciver_id;
    }

    public function setReciverId($reciver_id) {
        $this->reciver_id = $reciver_id;
    }

    public function getMessageText() {
        return $this->textMessage;
    }

    public function setMessageText($textMessage) {
        $this->textMessage = $textMessage;
    }

    public function setReaded() {
        $this->readed = 0;
    }

    public function setNotReaded() {
        $this->readed = 1;
    }

    public function getReaded() {
        return $this->readed;
    }

}
