<?php
require_once 'prepare.php';
require_once 'processor.php';

$exp1="2x^2+3x^3-x^3+1+2";
$exp2="3x^2-5x^3+x^4+3x^3";

$prepare1=new Prepare($exp1);
$prepare2=new Prepare($exp2);

$process1=$prepare1->starter();
$process2=$prepare2->starter();

echo "expression1= ".$process1->tostring()->toString()."<br>";
echo "expression2= ".$process2->toString()->toString()."<br>";

echo "<hr>";
$x=2;
echo "f1($x)= ",$process1->resultForVariable($x)."<br>";
echo "f2($x)= ",$process2->resultForVariable($x)."<br>";

echo "<hr>";
echo "derivative exp1= ",$process1->derivative()->toString()."<br>";
echo "derivative exp2= ",$process2->derivative()->toString()."<br>";

echo "<hr>";
echo "f1+f2= ",$process1->sum($process2)->toString()."<br>";
echo "f1-f2= ",$process1->sub($process2)->toString()."<br>";
echo "f1*f2= ",$process1->mul($process2)->toString()."<br>";