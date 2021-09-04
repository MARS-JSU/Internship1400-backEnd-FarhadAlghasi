<?php
require_once 'PowerCofficient.php';
require_once 'Simplify.php';
require_once 'ToString.php';
require_once 'PowerCofficientOperation.php';
require_once 'Interfaces/ProcessorInterface.php';

class Processor implements ProcessorInterface
{
    private array $powerCofficientArray;

    public function __construct($powerCofficientArray)
    {
        $this->powerCofficientArray = $powerCofficientArray;
    }

    public function getpowerCofficientArray()
    {
        return $this->powerCofficientArray;
    }

    public function simplify()
    {
        $simplify=new Simplify($this->powerCofficientArray);
        $simplify->sorting();
        $this->powerCofficientArray=$simplify->getPowerCofficientArray();
    }

    public function toString() : ToStringInterface
    {
        $this->simplify();
        return new ToString($this->powerCofficientArray);
    }

    public function resultForVariable($x) : float
    {
        $res=0;
        foreach ($this->powerCofficientArray as $value)
        {
            $powerCofficientOperation=new PowerCofficientOperation($value);
            $res+= $powerCofficientOperation->resultForVariable($x);
        }
        return $res;
    }

    public function derivative() : ToStringInterface
    {
        foreach ($this->powerCofficientArray as $powercofficient)
        {
            $powerCofficientOperation=new PowerCofficientOperation($powercofficient);
            $derivative[]=$powerCofficientOperation->derivative();
        }
        $newProcessor=new Processor($derivative);
        $newProcessor->simplify();
        return new ToString($newProcessor->getpowerCofficientArray());
    }

    private function mergePowerCofficientArrays($array) : array
    {
        return  array_merge($this->powerCofficientArray,$array);
    }

    public function sum($objects): ToStringInterface
    {
        return new ToString( $this->mergePowerCofficientArrays($objects->getpowerCofficientArray()));
    }

    public function sub($array): ToStringInterface
    {
        return new ToString($this->mergePowerCofficientArrays($this->symmetry($array)));
    }

    private function symmetry($array):array
    {
        foreach ($array->getpowerCofficientArray() as $powercofficient)
        {
            $powerCofficientOperation=new PowerCofficientOperation($powercofficient);
            $negative[]=$powerCofficientOperation->symmetry();
        }
        return $negative;
    }
    
    public function mul($objects): ToStringInterface
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
         return new ToString($newpowercofficient);
    }
}