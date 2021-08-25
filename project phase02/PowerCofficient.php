<?php

class PowerCofficient
{
    private  $coefficient;
    private  $power;

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

    public function __tostring() : string
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

    public function resultForx(float $x):float
    {
        return $this->coefficient*($x**$this->power);
    }

    public function derivative() : PowerCofficient
    {
            $newCofficient=$this->coefficient*$this->power;
            $newpower=$this->power-1;
            return new PowerCofficient($newCofficient,$newpower);
    }

    public function symmetry() : PowerCofficient
    {
        $newcoef=(-1)*$this->coefficient;
        return new PowerCofficient($newcoef,$this->power);
    }
}