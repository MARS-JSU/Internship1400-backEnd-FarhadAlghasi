<?php
require_once 'processor.php';
class prepare
{
    public $expression;
    public function seprator()
    {

        $this->expression = str_replace(["+", "-"], [" +", " -"], $this->expression);
        if ($this->expression[0] != "+" && $this->expression[0] != "-")
        {
            $this->expression = "+" . $this->expression;
        }
        $this->expression = str_replace(array("+x", "-x"), array("+1x", "-1x"), $this->expression);
        $mono = explode(" ", $this->expression);
        $mono=$this->tvn($mono);

        return new processor($mono);
    }
    private function tvn(array $mono)
    {
        $i = 0;
        foreach ($mono as $value)
        {
            if (strpos($value, 'x') && !strpos($value, '^'))
            {
                $value = $value . "^1";
            }
            elseif (!strpos($value, 'x'))
            {
                $value = $value . "x^0";
            }
            $mono[$i] = $value;
            $i++;
        }
        return $mono;
    }
}