<?php


interface Observer
{

    public function add(Currency $currency);

}



class PriceSimulator implements Observer
{
    private $currecies;


    public function __construct()
    {
        $this->currecies = array();
    }


    public function add(Currency $currency)
    {
        array_push($this->currecies, $currency);
    }


    public function updatePrice()
    {
        foreach ($this->currecies as $currecy) {

            $currecy->update();
        }

    }

}



interface Currency
{

    public function update();

    public function getPrice();

}



class Pound implements Currency
{

    private $price;


    public function __construct($price)
    {
        $this->price = $price;
        echo "Pound original price : " . $price . "<br/>";
    }


    public function getPrice()
    {
        return rand(1, 100);
    }


    public function update()
    {
        $this->price = $this->getPrice();
        echo "Pound Updated price "  . $this->price . "<br/>";
    }

}




class Yen implements Currency
{

    private $price;


    public function __construct($price)
    {
        $this->price = $price;
        echo "Yen original price : " . $price . "<br/>";
    }


    public function update()
    {
        //$this->price = $this->getPrice();
        $this->price = $this->price * 5;
        echo "Yen updated price : " . $this->price . "<br/>";
    }


    public function getPrice()
    {
        return rand(1, 100);
    }

}



$priceSimulator = new PriceSimulator();

$currency1 = new Pound(77);
$currency2 = new Yen(5) ;
$currency3 = new Pound(99);
$priceSimulator->add($currency1);
$priceSimulator->add($currency2);
$priceSimulator->add($currency3);

$priceSimulator->updatePrice();
$priceSimulator->updatePrice();

//$priceSimulator->updatePrice();
//$priceSimulator->updatePrice();
