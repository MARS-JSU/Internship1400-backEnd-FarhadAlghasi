<?php
require_once "Interfaces/PowerCofficientOperationInterface.php";
require_once 'Interfaces/StringableInterface.php';

class PowerCofficient implements StringableInterface
{
    private float $coefficient;
    private int $power;

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

    public function __toString() : string
    {
        if(
            $this->power!=0 &&
            $this->coefficient!=0
        )
        {
            if($this->power!=1)
            {
                if ($this->coefficient>0)
                {
                    return '+'.$this->coefficient.'x^'.$this->power;
                }
                else
                {
                    return $this->coefficient.'x^'.$this->power;
                }
            }
            else
            {
                if ($this->coefficient>0)
                {
                    return '+'.$this->coefficient.'x';
                }
                else
                {
                    return $this->coefficient.'x';
                }
            }
        }
        elseif(
            $this->power==0 &&
            $this->coefficient!=0
        )
        {
            if($this->coefficient>0)
            {
                return '+'.$this->coefficient;
            }
            else
            {
                return $this->coefficient;
            }
        }
        return '';
    }
}