<?php

interface powerCofficientInterface
{
    public function __toString():string;
    public function resultForX(float $x):float;
    public function derivative() : PowerCofficient;
    public function symmetry() : PowerCofficient;
}