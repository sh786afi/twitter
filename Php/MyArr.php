<?php
$myArray=array("Shafi","Shivam","Atul","sourabh");
$myArray[]="Kattie";
print_r($myArray);
echo $myArray[3];
echo "<br><br>";
$anotherArray[0]="pizza";
$anotherArray[1]="Yogurt";
$anotherArray[5]="coffee";
$anotherArray["MyFavFood"]="icecream";
print_r($anotherArray);
echo "<br><br>";
$thirdArray=array(
    "France" => "French",
    "USA" => "English",
    "Germany" => "German"
);
unset($thirdArray["France"]);
print_r($thirdArray);
echo sizeof($thirdArray);


?>