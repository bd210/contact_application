<?php


class Favorite extends DB
{
    protected $table = "user_favorites";

    public $id;
    public $user_to;
    public $user_from;
    public $createdAT;





    public function getAllFavorites()
    {

        $query =   "SELECT *, u.id as userID, uf.user_id_2 as userID2 
                    FROM users u 
                    INNER JOIN countries ct ON u.counrty_id = ct.id
                    INNER JOIN user_favorites uf ON u.id = uf.user_id_2
                    WHERE uf.user_id_1 = '".$this->id ."'";

        return $this->queryFetchAll($query);

    }


    public function addFavorite()
    {

        $query = "INSERT INTO user_favorites(`created_at`,`user_id_1`, `user_id_2`)
                  VALUES ('". $this->createdAT ."','".$this->user_from."', '".$this->user_to ."')  " ;

        return $this->queryStore($query);

    }


    public function kickFavorite()
    {

        $query = "DELETE FROM user_favorites
                  WHERE user_id_2 = '".$this->id." ' ";

        return $this->queryStore($query);

    }
}