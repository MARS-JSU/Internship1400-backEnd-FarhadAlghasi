<?php
require_once 'processor.php';
class prepare
{
    private $expression;
    public function __construct($expression)
    {
        $this->expression=$expression;
    }
    public function prepareCoefficient()
    {
        if ($this->expression[0] != '+' && $this->expression[0] != '-')
        {
            $this->expression = '+' . $this->expression;
        }
        $this->expression = str_replace(['+', '-'], [' +', ' -'], $this->expression);

        $this->expression = str_replace(['+x', '-x'], ['+1x', '-1x'], $this->expression);

        $mono = explode(' ', $this->expression);
        unset($mono[0]);
        $mono=$this->preparePower($mono);
        return new processor($mono);
    }
    private function preparePower(array $mono)
    {
        $i = 0;
        foreach ($mono as $value)
        {
            if (strpos($value, 'x') && !strpos($value, '^'))
            {
                $value = $value . '^1';
            }
            elseif (!strpos($value, 'x'))
            {
                $value = $value . 'x^0';
            }
            if(strpos($value,'x^'))
            {
                $temp[$i] = $value;
                $i++;
            }
        }
        return $temp;
    }
}