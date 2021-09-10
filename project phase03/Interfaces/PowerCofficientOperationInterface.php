<?php

interface PowerCofficientOperationInterface
{
    public function resultForVariable(float $variable):float;
    public function derivative() : PowerCofficient;
    public function symmetry() : PowerCofficient;
}