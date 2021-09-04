<?php
interface ProcessorInterface
{
    public function resultForVariable(float $variable): float;
    public function derivative(): ToString;
    public function sum($array):ToString;
    public function sub($array):ToString;
    public function mul($array):ToString;
}