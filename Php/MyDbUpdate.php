<?php

$link=mysqli_connect("localhost","root","","MyDB");
if(mysqli_connect_error()){
    die( "There was error in connecting to DB");
}
$query="UPDATE  `users` SET email='pushparaj@gmail.com'
          WHERE id = 2 LIMIT    1";
          mysqli_query($link, $query);



?>