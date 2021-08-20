<?php
require_once 'processor.php';
class Prepare
{
    private $expression;
    public function __construct($expression)
    {
        $this->expression=$expression;
    }
    public function prepareCoefficient() : Processor
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

        $monos = explode(' ', $this->expression);
        unset($monos[0]);
        $monos=$this->preparePower($monos);
        return new Processor($monos);
    }
    private function preparePower(array $monos)
    {
        $i = 0;
        foreach ($monos as $mono)
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
                $temp[$i++] = $mono;
            }
        }
        return $temp;
    }
}