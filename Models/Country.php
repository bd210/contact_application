<?php


class Country extends DB
{

    protected $table = "countries";
    public $id;



    public function getAllCountries()
    {

        return $this->getAllFromOneTable($this->table);

    }



    public  function getOneCountry()
    {

        $query = "SELECT * FROM countries 
                  WHERE id = '".$this->id."' ";

        return $this->queryFetch($query);

    }



}