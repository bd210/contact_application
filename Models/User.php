<?php


class User extends DB
{
    protected $table = "users";

    public $keyWord;

    public $id;
    public $email;
    public $pass;
    public $token;
    public $expires;
    public $selector;

    public $username;
    public $organization;
    public $number;
    public $notes;
    public $src;
    public $countryID;
    public $updatedAT;
    public $ban;
    public $bannedFrom;
    public $v_key;




    public function login()
    {

        $query = "SELECT u.*,r.role_name,verified FROM users u 
                  INNER JOIN roles r ON u.role_id = r.id
                  WHERE (`email` ='".$this->email."' 
                  AND `password` = '".$this->pass ."')
                  AND `verified` = 1";

        return $this->queryFetch($query);

    }



    public function getVerificationKey()
    {

        $query = "SELECT v_key,verified FROM users WHERE verified = 0 AND v_key = '". $this->v_key."' ";

        return $this->queryFetch($query);

    }


    public function setVerifacionkey()
    {

        $query = "UPDATE users SET verified = 1 WHERE v_key = '". $this->v_key ."'";

        return $this->queryStore($query);

    }



    public function getPwdUser()
    {

        $query = "SELECT password FROM users WHERE email = '".$this->email ."'";

        return $this->queryFetch($query);

    }


    public function insertUsers($params = array())
    {

        $query = "INSERT INTO users(`user_name`, `organization`, `number`, `email`, `password`, `notes`, `src`, `alt`, `counrty_id`,`role_id`,`verified`,`v_key`)
                  VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ";

        return $this->queryStore($query, $params);

    }


    public function searchUsers()
    {

        $query = "SELECT *, users.id as userID FROM users 
                  INNER JOIN countries  ON counrty_id = countries.id  
                  WHERE users.id NOT IN ('".$this->id ."')                 
                  AND (`number` LIKE '%".$this->keyWord."%'
                  OR `email` LIKE '%".$this->keyWord."%'
                  OR `user_name` LIKE '%".$this->keyWord."%') " ;

        return $this->queryFetchAll($query);

    }


    public function sendRequestUsers($params = array())
    {

        $query = "INSERT INTO pending_contact(`user_id_from`,`user_id_to`,`status`)
                  VALUES(?,?,?)";

        return $this->queryStore($query,$params);

    }


    public function viewProfile()
    {

        $query = "SELECT *, u.id as userID, c.id as countryID,banned_from as bannedFrom FROM users u 
                  INNER JOIN roles r ON u.role_id = r.id
                  INNER JOIN countries c ON c.id = u.counrty_id
                  WHERE u.id = '". $this->id."'";

        return $this->queryFetch($query);

    }


    public function getMyData()
    {

        $query = "SELECT *, u.id as userID, c.id as countryID FROM users u 
                  INNER JOIN countries c ON c.id = u.counrty_id
                  WHERE u.id = '". $this->id."'";

        return $this->queryFetch($query);

    }


    public function getUserForBan()
    {

        $query = "SELECT * FROM users WHERE id = '".$this->id."'";

        return $this->queryFetch($query);

    }


    public function banUser()
    {

        $query = "UPDATE users SET 
                  `ban` = '".$this->ban."',
                  `banned_from` = '".$this->bannedFrom."'
                  WHERE id ='".$this->id."'";

        return $this->queryStore($query);

    }


    public function unbanUser()
    {

        $query = "UPDATE users SET 
                  `ban` = null,
                  `banned_from` = null 
                  WHERE id ='".$this->id."'";

        return $this->queryStore($query);

    }


    public function updateMyProfile()
    {

        $query = "UPDATE users SET
                    `user_name` = '".$this->username ."',
                    `organization` = '".$this->organization ."',
                    `number` = '".$this->number  ."',
                    `email` = '".$this->email ."',
                    `notes` = '".$this->notes ."',
                    `src` = '".$this->src ."',
                    `alt` = 'user picture',
                    `counrty_id` = '".$this->countryID ."',
                    `updated_at` = '".$this->updatedAT ."'
                  WHERE id = '". $this->id ."'";

        return $this->queryStore($query);

    }


    public function getUsersControl()
    {

      $query = "SELECT u.id as userID,user_name , 
                (SELECT count(m.user_from)  FROM messages m WHERE u.id = m.user_from) as userFrom,
                (SELECT count(m.user_to)  FROM messages m WHERE u.id = m.user_to) as userTo
                FROM users u 
               ";
      return $this->queryFetchAll($query);


    }


    public function updatePassword()
    {

        $query = "UPDATE users
                  SET `password` = '". $this->pass."'
                  WHERE id = '". $this->id."'";

        return $this->queryStore($query);

    }


    public function getUsersForCache()
    {

        $query = "SELECT * FROM users u
                  INNER JOIN countries c ON c.id = u.counrty_id 
                  INNER JOIN roles r ON r.id = u.role_id";

        return $this->queryFetchAll($query);

    }


    //RESET PASSWORD
    public function deleteResetPwd($email)
    {

        $query = "DELETE FROM reset_pwd WHERE `email`='".$email."'";

        return $this->queryStore($query);


    }


    public function insertResetPwd()
    {

        $query = "INSERT INTO reset_pwd (`email`, `selector`, `token`, `expires`) 
                  VALUES('".$this->email."', '".$this->selector."','".$this->token."','".$this->expires."')";

        return $this->queryStore($query);


    }


    public function selectResetPwd()
    {

        $query = "SELECT * FROM reset_pwd WHERE selector='".$this->selector."' 
                  AND expires >= '".$this->expires."'";

        return $this->queryFetch($query);

    }


    public function selectUsersResetPwd($tokenEmail)
    {

        $query = "SELECT * FROM users WHERE `email` = '".$tokenEmail."' ";

        return $this->queryFetch($query);

    }


    public function updateUsersResetPwd($pass, $email)
    {

        $query = "UPDATE users SET `password` ='".$pass."' 
                  WHERE `email`='".$email."'";

        return  $this->queryStore($query);


    }
}