<?php

interface PowerCofficientOperationInterface
{
    public function resultForX(float $x):float;
    public function derivative() : PowerCofficient;
    public function symmetry() : PowerCofficient;
}