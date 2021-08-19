<?php
require_once 'prepare.php';
require_once 'processor.php';

$exp1="+2x^2+3x^3-x^3+1";
$exp2="3x^2-5x^3+x^4+3x^3";

$ex1=new prepare($exp1);
$ex2=new prepare($exp2);

$process1=$ex1->prepareCoefficient();
$process1->makePower();

$process2=$ex2->prepareCoefficient();
$process2->makePower();

echo "expression1= ",$process1->makeMono()."<br>";
echo "expression2= ",$process2->makeMono()."<br>";

echo "<hr>";
$x=2;
echo "f1($x)= ",$process1->result($x)."<br>";
echo "f2($x)= ",$process2->result($x)."<br>";

echo "<hr>";
echo "derivative exp1= ",$process1->derivative()."<br>";
echo "derivative exp2= ",$process2->derivative()."<br>";

echo "<hr>";
echo "f1+f2= ",$process1->sum($process2)."<br>";
echo "f1-f2= ",$process1->sub($process2)."<br>";
echo "f1*f2= ",$process1->mul($process2)."<br>";