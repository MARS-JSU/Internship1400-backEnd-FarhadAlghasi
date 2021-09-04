<?php
interface ProcessorInterface
{
    public function resultForVariable(float $variable): float;
    public function derivative(): ToStringInterface;
    public function sum():ToStringInterface;
    public function sub():ToStringInterface;
    public function mul():ToStringInterface;
}