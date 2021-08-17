<?php
require_once 'prepare.php';
require_once 'processor.php';

$exp1="2x^2+3x^3-x^3+1";
$exp2="4x^2+x^3-3";

$ex1=new prepare();
$ex2=new prepare();

$ex1->expression=$exp1;
$ex2->expression=$exp2;

$process1=$ex1->seprator();
$process1->sortig();

$process2=$ex2->seprator();
$process2->sortig();

echo "expression1= ",$process1->strarray()."<br>";
echo "expression2= ",$process2->strarray()."<br>";

echo "<hr>";
$x=2;
echo "f1($x)= ",$process1->result($x)."<br>";
echo "f2($x)= ",$process2->result($x)."<br>";

echo "<hr>";
echo "derivative exp1= ",$process1->derivative()."<br>";
echo "derivative exp2= ",$process2->derivative()."<br>";

echo "<hr>";
