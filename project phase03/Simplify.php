<?php
require_once 'Interfaces/SimplifyInterface.php';

class Simplify implements SimplifyInterface
{
    private array $powerCofficientArray;

    /**
     * simplify constructor.
     * @param $powerCofficientArray
     */

    public function __construct($powerCofficientArray)
    {
        $this->powerCofficientArray = $powerCofficientArray;
    }

    /**
     * @return mixed
     */

    public function getPowerCofficientArray()
    {
        return $this->powerCofficientArray;
    }

    public function sorting()
    {
        for($k=0;$k<count($this->powerCofficientArray)-1;$k++)
        {
            for($m=$k+1;$m<count($this->powerCofficientArray);$m++)
            {
                if($this->powerCofficientArray[$k]->getpower()<$this->powerCofficientArray[$m]->getpower())
                {
                    $temp=$this->powerCofficientArray[$k];
                    $this->powerCofficientArray[$k]=$this->powerCofficientArray[$m];
                    $this->powerCofficientArray[$m]=$temp;
                }
            }
        }
        $this->simplify();
    }

    public function simplify()
    {
        for($i=0;$i<count($this->powerCofficientArray)-1;)
        {
            $newcoef=$this->powerCofficientArray[$i]->getcoefficient();
            for($j=$i+1;$j<count($this->powerCofficientArray);$j++)
            {
                if($this->powerCofficientArray[$i]->getpower()==$this->powerCofficientArray[$j]->getpower())
                {
                    $newcoef=$newcoef+$this->powerCofficientArray[$j]->getcoefficient();
                }
                else
                {
                    $simple[]=new PowerCofficient($newcoef,$this->powerCofficientArray[$i]->getpower());
                    $i=$j;
                    $newcoef=$this->powerCofficientArray[$i]->getcoefficient();
                }
            }
            if($i!=$j)
            {
                $simple[]=new PowerCofficient($newcoef,$this->powerCofficientArray[$i]->getpower());
                $i=$j;
            }
        }
        $this->powerCofficientArray=$simple;
    }

}