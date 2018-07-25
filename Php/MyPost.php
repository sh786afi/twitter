<?php
 if($_POST){
     $family=array("shafi","shivam","Atul","Sourabh","Prashant");
     $isKnown=false;
     foreach($family as $value){
         if($value==$_POST['name']){
             //no is prime
             $isKnown=true;

         }
       
     }
     
     if($isKnown){
        echo "Hi there ".$_POST['name']."!";
    }
    else{
        echo "I don't know";
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
<p>What is your name?</p>
<form method="post">
   <input name="name"  type-"text" placeholder="Enter name only"></input>
   <input type="submit"  value="GO"></input>
</form> 
</body>
</html>
