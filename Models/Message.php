<?php


class Message extends DB
{

    public $id;
    public $createdAT;
    public $updatedAT;
    public $content;
    public $seen;
    public $userFrom;
    public $userTo;




    public function getMessages()
    {
        $query = "SELECT *, m.created_at as createdAT, u.id as userID, m.id as messageID, m.updated_at as updatedAT FROM messages m
                  INNER JOIN users u ON u.id = m.user_from 
                  INNER JOIN roles r ON u.role_id = r.id
                  WHERE (m.user_from = '".$this->userFrom ."'
                  OR m.user_to = '".$this->userFrom ."')
                  AND (m.user_to = '".$this->userTo."'
                  OR m.user_from = '".$this->userTo."')
                  ORDER BY m.created_at";

        return $this->queryFetchAll($query);
    }


    public function typeWith()
    {
        $query = "SELECT user_name,u.id as withID FROM users u
                  LEFT JOIN messages m ON u.id = m.user_to
                  WHERE u.id = '".$this->userTo."'";

        return $this->queryFetch($query);
    }


    public function sendMessage()
    {
        $query = "INSERT INTO messages(`created_at`, `content`,`seen`, `user_from`, `user_to`)
                  VALUES('".$this->createdAT ."','".$this->content ."','".$this->seen ."','".$this->userFrom ."','".$this->userTo ."')";

        return $this->queryStore($query);
    }


    public function deleteMessage()
    {
        $query = "DELETE FROM messages 
                  WHERE id= '".$this->id."' 
                  AND user_from ='".$this->userFrom."'";

        return $this->queryStore($query);
    }


    public function getOne()
    {

        $query = "SELECT * FROM messages
                  WHERE id = '".$this->id."' ";

        return $this->queryFetch($query);

    }


    public function updateMessage()
    {

        $query = "UPDATE messages SET
                 `updated_at` = '".$this->updatedAT."',
                 `content` = '".$this->content."'
                  WHERE id = '". $this->id ."'";

        return $this->queryStore($query);

    }


}