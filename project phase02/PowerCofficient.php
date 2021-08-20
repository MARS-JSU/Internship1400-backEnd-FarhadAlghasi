<?php

class PowerCofficient
{
    private string $coefficient;
    private string $power;

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