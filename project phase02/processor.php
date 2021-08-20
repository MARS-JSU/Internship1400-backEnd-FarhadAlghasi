<?php
require_once 'PowerCofficient.php';
class Processor
{
    private array $monos;
    private array $powerCofficientArray;

    public function __construct($monos)
    {
        $this->monos = $monos;
    }

    public function getObj()
    {
        return $this->powerCofficientArray;
    }

    public function makePower()
    {
        foreach ($this->monos as $mono)
        {
            $coeficientpower[]=explode('x^',$mono);
        }
        $this->powerCofficientArray=$this->makeObj($coeficientpower);
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

    private function makeObj(array $coeficientpower)
    {
        foreach ($coeficientpower as $value)
        {
            $this->powerCofficientArray[]=new PowerCofficient($value[0],$value[1]);
        }
        return $this->powerCofficientArray;
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
                        $newcoef=$newcoef+$obj[$j]->getcoefficient();
                        settype($newcoef,'string');
                    }
                    else
                    {
                        $simple[]=new PowerCofficient($newcoef,$obj[$i]->getpower());
                        $i=$j;
                        $newcoef=$obj[$i]->getcoefficient();
                    }
                }
                if($i!=$j)
                {
                    $simple[]=new PowerCofficient($newcoef,$obj[$i]->getpower());
                    $i=$j;
                }
            }
            $this->powerCofficientArray=$simple;
    }

    public function makeMono():string
    {
        foreach ($this->powerCofficientArray as $value)
        {
            if($value->getcoefficient()!=0)
            {
                $array[]=$value->getcoefficient().'x^'.$value->getpower();
            }
        }
        $string=$this->toString($array);
        return $string;
    }

    private function toString(array $strings) : string
    {
        foreach ($strings as $string)
        {
            if(strpos($string,'^1'))
            {
                $string=str_replace('x^1','x',$string);
            }
            if(
                $string[0]!='-'&&
                $string[0]!='+'
              )
            {
                $string="+".$string;
            }
            if(strpos($string,'^0'))
            {
                $string=str_replace('x^0','',$string);
            }
            if(strpos($string,'+1x'))
            {
                $string=str_replace('+1x','+x',$string);
            }
            elseif (strpos($string,'-1x'))
            {
                $string=str_replace('-1x','-x',$string);
            }
            $str.=$string;
        }
        return $str;
    }
    public function result($x)
    {
        $res=0;
        foreach ($this->powerCofficientArray as $value)
        {
            $res+=$value->getcoefficient()*($x**$value->getpower());
        }
        return $res;
    }
    public function derivative(): string
    {
        foreach ($this->powerCofficientArray as  $value)
        {
            if(
                $value->getpower()!=0 &&
                $value->getcoefficient()!=0 &&
                $value->getpower()!=1
              )
            {
                $derivative[]=($value->getcoefficient()*$value->getpower()).'x^'.($value->getpower()-1);
            }
            elseif ($value->getpower()==1)
            {
                $derivative[]=$value->getcoefficient();
            }
        }
        $derivative=$this->toString($derivative);
        return $derivative;
    }

    public function sum($object): string
    {
        $newobj=array_merge($this->powerCofficientArray,$object->getObj());
        $a=new processor('');
        $a->sortig($newobj);
        return $a->makeMono();
    }
    public function sub($object):string
    {

        foreach ($object->getObj() as $value)
        {
            $ncoef=$value->getcoefficient()*(-1);
            $temp[]=new PowerCofficient($ncoef,$value->getpower());
        }
        $newobject=array_merge($this->powerCofficientArray,$temp);
        $b=new processor('');
        $b->sortig($newobject);
        return $b->makeMono();
    }
    
    public function mul($object):string
    {
        foreach ($this->powerCofficientArray as $value)
        {
            foreach ($object->getObj() as $item)
            {
                $newcof=$value->getcoefficient()*$item->getcoefficient();
                $newpow=$value->getpower()+$item->getpower();
                $array[]=new PowerCofficient($newcof,$newpow);
            }
        }
        $c=new processor('');
        $c->sortig($array);
        return $c->makeMono();
    }
}