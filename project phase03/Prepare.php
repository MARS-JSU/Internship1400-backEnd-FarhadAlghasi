<?php
require_once 'processor.php';
require_once 'Interfaces/PrepareInterface.php';
class Prepare implements PrepareInterface
{
    private string $expression;
    private array $monos;

    public function __construct($expression)
    {
        $this->expression=$expression;
    }

    public function starter() : processor
    {
        $this->prepareCofficient();
        $this->prepareMonos();
        $this->preparePower();
        $powercofficients=$this->sepratePowerCofficient();
        return new processor($this->makePowerCofficient($powercofficients));
    }

    public function prepareCofficient()
    {
        if (
            $this->expression[0] != '+' &&
            $this->expression[0] != '-'
            )
        {
            $this->expression = '+' . $this->expression;
        }
        $this->expression = str_replace(['+', '-'], [' +', ' -'], $this->expression);

        $this->expression = str_replace(['+x', '-x'], ['+1x', '-1x'], $this->expression);
    }

    private function prepareMonos()
    {
        $this->monos = explode(' ', $this->expression);
        unset($this->monos[0]);
    }

    private function preparePower()
    {
        $i = 0;
        foreach ($this->monos as $mono)
        {
            if (
                 strpos($mono, 'x') &&
                !strpos($mono, '^')
                )
            {
                $mono = $mono . '^1';
            }
            elseif (!strpos($mono, 'x'))
            {
                $mono = $mono . 'x^0';
            }
            if(strpos($mono,'x^'))
            {
                $strings[$i++] = $mono;
            }
        }
        $this->monos=$strings;
    }

    public function sepratePowerCofficient(): array
    {
        foreach ($this->monos as $mono)
        {
            $cofficientpowers[]=explode('x^',$mono);
        }
        return $cofficientpowers;
    }

    public function makePowerCofficient(array $cofficientpowers) : array
    {
        foreach ($cofficientpowers as $value)
        {
            $powerCofficientArray[]=new PowerCofficient($value[0],$value[1]);
        }
        return $powerCofficientArray;
    }

}