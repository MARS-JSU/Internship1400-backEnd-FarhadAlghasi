<?php
require_once 'pc.php';
class processor
{
    private $mono;
    private $obj;

    public function __construct($mono)
    {
        $this->mono = $mono;
    }

    public function getObj()
    {
        return $this->obj;
    }

    public function makePower()
    {
        foreach ($this->mono as $value)
        {
            $zp[]=explode('x^',$value);
        }
        $this->obj=$this->makeObj($zp);
        $this->sortig($this->obj);
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

    private function makeObj(array $zp)
    {
        foreach ($zp as $value)
        {
            $this->obj[]=new pc($value[0],$value[1]);
        }
        return $this->obj;
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
                        $simple[]=new pc($newcoef,$obj[$i]->getpower());
                        $i=$j;
                        $newcoef=$obj[$i]->getcoefficient();
                    }
                }
                if($i!=$j)
                {
                    $simple[]=new pc($newcoef,$obj[$i]->getpower());
                    $i=$j;
                }
            }
            $this->obj=$simple;
    }

    public function makeMono()
    {
        foreach ($this->obj as $value)
        {
            if($value->getcoefficient()!=0)
            {
                $array[]=$value->getcoefficient().'x^'.$value->getpower();
            }
        }
        $this->toString($array);
    }

    private function toString(array $str)
    {
        foreach ($str as $value)
        {
            if(strpos($value,'^1'))
            {
                $value=str_replace('x^1','x',$value);
            }
            if($value[0]!='-'&&$value[0]!='+')
            {
                $value="+".$value;
            }
            if(strpos($value,'^0'))
            {
                $value=str_replace('x^0','',$value);
            }
            if(strpos($value,'+1x'))
            {
                $value=str_replace('+1x','+x',$value);
            }
            elseif (strpos($value,'-1x'))
            {
                $value=str_replace('-1x','-x',$value);
            }
            $string.=$value;


        }
        echo $string;
    }
    public function result($x)
    {
        $res=0;
        foreach ($this->obj as $value)
        {
            $res+=$value->getcoefficient()*($x**$value->getpower());
        }
        echo $res;
    }
    public function derivative()
    {
        foreach ($this->obj as  $value)
        {
            if($value->getpower()!=0 && $value->getcoefficient()!=0 && $value->getpower()!=1)
            {
                $dev[]=($value->getcoefficient()*$value->getpower()).'x^'.($value->getpower()-1);
            }
            elseif ($value->getpower()==1)
            {
                $dev[]=$value->getcoefficient();
            }
        }
        $this->toString($dev);
    }

    public function sum($object)
    {
        $newobj=array_merge($this->obj,$object->getObj());
        $a=new processor('');
        $a->sortig($newobj);
        $a->makeMono();
    }
    public function sub($object)
    {

        foreach ($object->getObj() as $value)
        {
            $ncoef=$value->getcoefficient()*(-1);
            $temp[]=new pc($ncoef,$value->getpower());
        }
        $newobject=array_merge($this->obj,$temp);
        $b=new processor('');
        $b->sortig($newobject);
        $b->makeMono();
    }
    
    public function mul($object)
    {
        foreach ($this->obj as $value)
        {
            foreach ($object->getObj() as $item)
            {
                $newcof=$value->getcoefficient()*$item->getcoefficient();
                $newpow=$value->getpower()+$item->getpower();
                $array[]=new pc($newcof,$newpow);
            }
        }
        $c=new processor('');
        $c->sortig($array);
        $c->makeMono();
    }
}