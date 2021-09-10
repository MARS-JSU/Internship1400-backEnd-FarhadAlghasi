<?php
require_once 'Simplify.php';
require_once 'Interfaces/StringableInterface.php';

class ToString implements StringableInterface
{
    private array $powerCofficientArray;

    /**
     * ToString constructor.
     * @param $powerCofficientArray
     */

    public function __construct($powerCofficientArray)
    {
        $this->powerCofficientArray = $powerCofficientArray;
    }

    public function __toString() : string
    {
        return implode('',$this->powerCofficientArray);
    }
}