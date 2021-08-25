<?php
include "credentials.php";

class DB
{


    private function conn()
    {

        try {

                $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".CHARSET;

                $pdo = new PDO($dsn, DB_USER, DB_PASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $pdo;


            } catch (PDOException $e) {

                echo "An error with connection : " . $e->getMessage();

                return false;

            }

    }




    public  function queryFetchAll($query, $params = array())
    {

        $stmt = $this->conn()->prepare($query);

        $stmt->execute($params);

        $data = $stmt->fetchAll();

        return $data;

    }


    public  function queryFetch($query, $params = array())
    {

        $stmt = $this->conn()->prepare($query);

        $stmt->execute($params);

        $data = $stmt->fetch();

        return $data;

    }


    public function queryStore($query, $params = array())
    {

        $stmt = $this->conn()->prepare($query);

        $stmt->execute($params);

    }


    public function getAllFromOneTable($table)
    {

        $query = "SELECT * FROM $table";

        $stmt = $this->conn()->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchAll();

        return $data;

    }

}