<?php

class pc
{
    private $coefficient;
    private $power;

    public function __construct($coefficient,$power)
    {
        $this->coefficient=$coefficient;
        $this->power=$power;
    }

    public function getCoefficient()
    {
        return $this->coefficient;
    }

    public function getPower()
    {
        return $this->power;
    }

}