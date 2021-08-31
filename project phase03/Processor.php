<?php
require_once 'PowerCofficient.php';
require_once 'Simplify.php';

class Processor
{

    private  $powerCofficientArray;

    public function __construct($powerCofficientArray)
    {
        $this->powerCofficientArray = $powerCofficientArray;
    }

    public function getpowerCofficientArray()
    {
        return $this->powerCofficientArray;
    }

    public function toString() : string
    {
       $simplify=new simplify($this->powerCofficientArray);
       $simplify->sorting();
       $this->powerCofficientArray=$simplify->getPowerCofficientArray();
       return implode('',$this->powerCofficientArray);
    }

    public function resultForX($x) : float
    {
        $res=0;
        foreach ($this->powerCofficientArray as $value)
        {
            $res+=$value->resultForX($x);
        }
        return $res;
    }

    public function derivative() : Processor
    {
        foreach ($this->powerCofficientArray as $powercofficient)
        {
            $derivative[]=$powercofficient->derivative();
        }
        return new Processor($derivative);
    }

    private function mergePowerCofficientArrays($array) : array
    {
        return  array_merge($this->powerCofficientArray,$array);
    }

    public function sum($objects): processor
    {
        return new processor( $this->mergePowerCofficientArrays($objects->getpowerCofficientArray()));
    }

    public function sub($array): Processor
    {
        return new Processor($this->mergePowerCofficientArrays($this->symmetry($array)));
    }

    private function symmetry($array):array
    {
        foreach ($array->getpowerCofficientArray() as $powercofficient)
        {
            $negative[]=$powercofficient->symmetry();
        }
        return $negative;
    }
    
    public function mul($objects): Processor
    {
        foreach ($this->powerCofficientArray as $value)
        {
            foreach ($objects->getpowerCofficientArray() as $item)
            {
                $newcof=$value->getcoefficient()*$item->getcoefficient();
                $newpow=$value->getpower()+$item->getpower();
                $newpowercofficient[]=new PowerCofficient($newcof,$newpow);
            }
        }
         return new processor($newpowercofficient);
    }
}