<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post">
        polynomial expressin:<input type="text" name="polynomial">
        <br>
        <input type="submit" name="btn">
    </form>
</body>
</html>


<?php

if(isset($_POST['btn']))
{

    $a=$_POST['polynomial'];
    $array=explode('x',$a);
    $b=0.0;
    foreach ($array as $value)
    {
        if($value=='+')
        {
            $b+=1;
        }
        elseif ($value=='-')
        {
            $b-=1;
        }
        else{
            settype($value,'double');
            $b+=$value;
        }

    }
    echo "<span style='font-family: Tahoma; color: red;'>monomial expression: </span>","<span style='color: blue;'>",$b,"x</span>";

}

?>


