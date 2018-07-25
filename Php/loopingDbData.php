<?php

$link=mysqli_connect("localhost","root","","MyDB");
if(mysqli_connect_error()){
    die( "There was error in connecting to DB");
}
$query="INSERT INTO `users`(`email`,`password`)
          VALUES('shivam@gmail.com','chunnu')";
          mysqli_query($link, $query);
$name="pushp'a";
$query="SELECT `email` FROM users WHERE name='".mysqli_real_escape_string($link,$name)."'";
if($result = mysqli_query($link, $query)){
    while($row=mysqli_fetch_array($result)){
        print_r($row);

    }
    

    
}

?>