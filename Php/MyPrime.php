<?php
 if($_GET){
     $i=2;
     $isPrime=true;
     while($i<$_GET['number']){
         if($_GET['number']%$i==0){
             //no is prime
             $isPrime=false;

         }
         $i++;
     }
     
    if($_GET['number']<2) {
        echo "<p>".$_GET['number']."  is not prime number </p>";
    }
    if($isPrime){
        echo "<p>".$i."  is prime number </p>";
    }
    else {
        echo "<p>".$i."  is not prime number </p>";
    }
 }


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<p>Enter a Number</p>
<form>
   <input name="number"  type-"text" placeholder="Enter number only"></input>
   <input type="submit"  value="GO"></input>
</form> 
</body>
</html>
