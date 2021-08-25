<?php


class Contact extends DB
{

    protected $table = "contact";

    public $id;
    public $createdAT;
    public $user_id;
    public $user_id_to;


    public function getRequestContact()
    {

        $query = "SELECT *, pc.id as pendingID, u.id as userID FROM users u
                  INNER JOIN pending_contact pc  ON u.id = pc.user_id_from
                  INNER JOIN countries c ON u.counrty_id = c.id
                  WHERE pc.status = false 
                  AND pc.user_id_to ='".$this->id."'";

        return $this->queryFetchAll($query);

    }


    public function getCountRequest()
    {

        $query = "SELECT user_id_to  FROM pending_contact
                  WHERE user_id_to = '". $this->id."' ";

        return $this->queryFetchAll($query);

    }


    public function declineRequest()
    {

        $query = "DELETE FROM pending_contact WHERE id = '".$this->id."'";

        return $this->queryStore($query);

    }



    public function getAllContacts()
    {

        $query ="SELECT *, u.id as userID, c.created_at as createdAT
                 FROM users u
                 INNER JOIN countries ct ON ct.id = u.counrty_id
                 INNER JOIN contacts c ON u.id = c.user_id OR u.id = c.user_id_to
                 WHERE u.id != '".$this->id."'
                 AND (c.user_id = '".$this->id."'
                 OR c.user_id_to = '".$this->id."')";


        return $this->queryFetchAll($query);

    }


    public function addContact()
    {

        $query = "INSERT INTO contacts(`created_at`, `user_id`, `user_id_to`)
                  VALUES('". $this->createdAT."', '". $this->user_id."' , '". $this->user_id_to."')";

        return $this->queryStore($query);

    }


    public function kickContact()
    {

        $query = "DELETE FROM contacts 
                  WHERE user_id_to ='".$this->user_id_to."'
                  AND user_id = '".$this->id ."'
                  OR (user_id_to = '".$this->id ."'
                  AND user_id ='".$this->user_id_to."') ";

       return $this->queryStore($query);

    }
}