<?php
require_once 'PowerCofficient.php';
class Processor
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

    private function powerCofficientArraySort()
    {
        $this->sortig($this->powerCofficientArray);
    }

    private function sortig($obj)
    {
        for($k=0;$k<count($obj)-1;$k++)
        {
            for($m=$k+1;$m<count($obj);$m++)
            {
                if($obj[$k]->getpower()<$obj[$m]->getpower())
                {
                    $temp=$obj[$k];
                    $obj[$k]=$obj[$m];
                    $obj[$m]=$temp;
                }
            }
        }
        $this->simplify($obj);
    }

    private function simplify($obj)
    {
            for($i=0;$i<count($obj)-1;)
            {
                $newcoef=$obj[$i]->getcoefficient();
                for($j=$i+1;$j<count($obj);$j++)
                {
                    if($obj[$i]->getpower()==$obj[$j]->getpower())
                    {
                        settype($newcoef,'float');
                        $newcoef=$newcoef+$obj[$j]->getcoefficient();
                    }
                    else
                    {
                        settype($newcoef,'float');
                        $simple[]=new PowerCofficient($newcoef,$obj[$i]->getpower());
                        $i=$j;
                        $newcoef=$obj[$i]->getcoefficient();
                    }
                }
                if($i!=$j)
                {
                    settype($newcoef,'float');
                    $simple[]=new PowerCofficient($newcoef,$obj[$i]->getpower());
                    $i=$j;
                }
            }
            $this->powerCofficientArray=$simple;
    }

    public function toString() : string
    {
       $this->powerCofficientArraySort();
       return implode('',$this->powerCofficientArray);
    }

    public function result($x) : float
    {
        $res=0;
        foreach ($this->powerCofficientArray as $value)
        {
            $res+=$value->resultForx($x);
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

    public function sum($object): processor
    {
        $newpowercofficient=array_merge($this->powerCofficientArray,$object->getpowerCofficientArray());
        return new processor($newpowercofficient);
    }

    public function sub($object): Processor
    {

        foreach ($object->getpowerCofficientArray() as $powercofficient)
        {
          $negative[]=$powercofficient->symmetry();
        }
        return new Processor(array_merge($this->powerCofficientArray,$negative));
    }
    
    public function mul($object): Processor
    {
        foreach ($this->powerCofficientArray as $value)
        {
            foreach ($object->getpowerCofficientArray() as $item)
            {
                $newcof=$value->getcoefficient()*$item->getcoefficient();
                $newpow=$value->getpower()+$item->getpower();
                $newpowercofficient[]=new PowerCofficient($newcof,$newpow);
            }
        }
         return new processor($newpowercofficient);
    }
}