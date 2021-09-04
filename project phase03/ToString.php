<?php
require_once 'Simplify.php';
require_once 'Interfaces\ToStringInterface.php';
class ToString implements ToStringInterface
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

    public function toString() : string
    {
        return implode('',$this->powerCofficientArray);
    }

}