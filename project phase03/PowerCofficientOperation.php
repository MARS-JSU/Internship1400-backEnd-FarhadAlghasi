<?php
require_once 'PowerCofficient.php';
require_once 'Interfaces/PowerCofficientOperationInterface.php';

class PowerCofficientOperation implements PowerCofficientOperationInterface
{
    private PowerCofficient $powerCoefficient;

    /**
     * PowerCofficientOperation constructor.
     * @param $powerCoefficient
     */

    public function __construct(PowerCofficient $powerCoefficient)
    {
        $this->powerCoefficient = $powerCoefficient;
    }

    public function resultForVariable(float $x):float
    {
        return $this->powerCoefficient->getCoefficient()*pow($x,$this->powerCoefficient->getPower());
    }

    public function derivative() : PowerCofficient
    {
        $newCofficient=$this->powerCoefficient->getCoefficient()*$this->powerCoefficient->getPower();
        $newpower=$this->powerCoefficient->getPower()-1;
        return new PowerCofficient($newCofficient,$newpower);
    }

    public function symmetry() : PowerCofficient
    {
        $newcoef=(-1)*$this->powerCoefficient->getCoefficient();
        return new PowerCofficient($newcoef,$this->powerCoefficient->getPower());
    }

}