<?php

interface PrepareInterface
{
    public function sepratePowerCofficient():array;
    public function makePowerCofficient(array $powerCofficients):array;
}