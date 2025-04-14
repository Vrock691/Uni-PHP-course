<?php

class HelloWorld
{

    private $n;

    public function retournerN()
    {
        return $this->n;
    }

    function __construct($defineN)
    {
        $this->n = $defineN;
    }
}

// Tableau
class Tableau
{

    private $t;

    function __construct(array $paramsT)
    {
        $this->t = $paramsT;
    }

    public function returnT()
    {
        return $this->t;
    }
}


// Matrice
class Matrice extends Tableau
{
    function __construct(array $paramsT)
    {
        parent::__construct($paramsT);
    }

    public function sum()
    {
        $sum = 0;
        $t = parent::returnT();

        for ($i = 0; $i < count($t); $i++) {
            for ($y = 0; $y < count($t[$i]); $y++) {
                $sum = $sum + $t[$i][$y];
            }
        }

        return $sum;
    }

    public function returnAll()
    {
        $t = parent::returnT();
        $newArray = array();

        for ($i = 0; $i < count($t); $i++) {
            for ($y = 0; $y < count($t[$i]); $y++) {
                $newArray[] = $t[$i][$y];
            }
        }

        return $newArray;
    }
}

?>