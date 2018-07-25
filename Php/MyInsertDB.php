<?php

$link=mysqli_connect("localhost","root","","MyDB");
if(mysqli_connect_error()){
    die( "There was error in connecting to DB");
}
$query="INSERT INTO `users`(`email`,`password`)
          VALUES('shivam@gmail.com','chunnu')";
          mysqli_query($link, $query);

$query="SELECT * FROM users";
if($result = mysqli_query($link, $query)){
    $row=mysqli_fetch_array($result);
    print_r($row);

    echo "<br>your email is ".$row[1]."<br>your passworod is ".$row[2];

    
}

?>