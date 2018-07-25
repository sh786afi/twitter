<?php

if(array_key_exists('email', $_POST) OR array_key_exists('password',$_POST)){
    //print_r($_POST);



$link=mysqli_connect("localhost","root","","MyDB");
if(mysqli_connect_error()){
    die( "There was error in connecting to DB");
}
if($_POST['email']==""){
    echo "<p>Email address is required</p>";
}
else if($_POST['password']==""){
    echo "<p>password  is required</p>";
}
else{
    $query="SELECT `id` FROM `users` WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'";
    $result=mysqli_query($link,$query);
    if(mysqli_num_rows($result)>0){
        echo "This email is already taken";
    }
    else{
        $query="INSERT INTO `users`(`email`, `password`) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."',
        '".mysqli_real_escape_string($link,$_POST['password'])."')";
        if(mysqli_query($link, $query)){
            echo "You are signed up";
        }
        else{
            echo "Problem occured while sign up";
        }
    }
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<form method="post">
   <input name="email"  type-"text" placeholder="Enter email only"></input>
   <input name="password"  type-"password" placeholder="Enter Password"></input>
   <input type="submit"  value="Signup"></input>
</form> 
</body>
</html>
