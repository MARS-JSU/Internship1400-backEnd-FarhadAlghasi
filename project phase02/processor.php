<?php
require_once 'pc.php';
class processor
{
    protected $mono;
    protected $obj;

    public function __construct($mono)
    {
        $this->mono = $mono;
    }

    public function sortig()
    {
        foreach ($this->mono as $value)
        {
            $zp[]=explode("x^",$value);
        }
        for($k=0;$k<count($zp)-1;$k++)
        {
            for($m=$k+1;$m<count($zp);$m++)
            {
                if($zp[$k][1]<$zp[$m][1])
                {
                    $temp=$zp[$k];
                    $zp[$k]=$zp[$m];
                    $zp[$m]=$temp;
                }
            }
        }
        $this->simplify($zp);
    }

    private function simplify(array $zp)
    {
        for($i=0;$i<count($zp);)
        {
            for($j=$i+1;$j<count($zp)+1;$j++)
            {
                if($zp[$i][1]==$zp[$j][1])
                {
                    $zp[$i][0]=$zp[$i][0]+$zp[$j][0];
                    settype($zp[$i][0],'string');
                }
                else
                {
                    $simple[]=$zp[$i];
                    $i=$j;
                }
            }
        }
        $this->makeobj($simple);
    }

    private function makeobj(array $simple)
    {
        foreach ($simple as $value)
        {
            $this->obj[]=new pc($value[0],$value[1]);
        }
    }

    public function strarray()
    {
        foreach ($this->obj as $value)
        {
            $array[]=$value->getcoefficient()."x^".$value->getpower();
        }
        $this->tostring($array);
    }

    private function tostring(array $str)
    {
        foreach ($str as $value)
        {
            if(strpos($value,'^1'))
            {
                $value=str_replace("x^1","x",$value);
            }
            if($value[0]!="-"&&$value[0]!="+")
            {
                $value="+".$value;
            }
            if(strpos($value,'^0'))
            {
                $value=str_replace("x^0","",$value);
            }
            if(strpos($value,'1x'))
            {
                $value=str_replace("1x","x",$value);
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
                $dev[]=$value->getcoefficient()*$value->getpower()."x^".($value->getpower()-1);
            }
            elseif ($value->getpower()==1)
            {
                $dev[]=$value->getcoefficient();
            }
        }
        $this->tostring($dev);
    }

}