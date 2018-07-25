<?php
include("functions.php");
if($_GET['action']=="loginSignUp"){
    $error="";
    if($_POST['email']==""){
        $error="An Email Address Is Required";
    }
    else if($_POST['password']==""){
        $error="Password Is Required";
    }
    else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $error="Please Enter Valid Email Address";

    }
    if($error!=""){
        echo $error;
        exit();
    }


    if($_POST['LoginActive']=="0"){
        $query="SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'LIMIT 1";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0)$error="The email address is already taken";
        else{
            $query=$query="INSERT INTO `users`(`email`, `password`) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."',
            '".mysqli_real_escape_string($link,$_POST['password'])."')";
            if(mysqli_query($link, $query)){
                $_SESSION['id']=mysqli_insert_id($link);  
                
                $query="UPDATE users SET password='".md5(md5($_SESSION['id']).$_POST['password'])."' where id=".$_SESSION['id']." LIMIT 1";
                mysqli_query($link, $query);    
                echo 1;
               
            }
            else{
                $error= "Couldn't Create User- Please Try Again";    
            }

            
        }   
    }
    else{
        $query="SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'LIMIT 1";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_assoc($result);
            if($row['password']==md5(md5($row['id']).$_POST['password'])){
                echo 1;
                $_SESSION['id']=$row['id'];
            }
            else{
                $error="Couldn't Find Username/Password Combination.Please Try Again";
            }
        

    }
    if($error!=""){
        echo $error;
        exit();
    }
}
if($_GET['action']=='toggleFollow'){
     $query="SELECT * FROM isFollowing WHERE follower=".mysqli_real_escape_string($link,$_SESSION['id']).
    " AND isFollowing =".mysqli_real_escape_string($link,$_POST['userid'])." LIMIT 1";
     $result=mysqli_query($link,$query);
    
   
    if(mysqli_num_rows($result) > 0){
         $row=mysqli_fetch_assoc($result);   
         mysqli_query($link,"DELETE FROM isFollowing WHERE id=".mysqli_real_escape_string($link,$row['id'])." LIMIT 1");
         echo "1";
            
    }
    else{
        mysqli_query($link,"INSERT INTO  isFollowing(follower,isFollowing)
        VALUES(".mysqli_real_escape_string($link,$_SESSION['id']).", ".mysqli_real_escape_string($link,$_POST['userid']).")");
        echo "2";

    
    
    }
    
    
}
if($_GET['action']=='postTweet'){
    if(!$_POST['tweetContent']){
        echo "Your Tweet is empty";
    }
    else if(strlen($_POST['tweetContent'])>140){
        echo "Your tweet is too Long";

    }
    else{
        mysqli_query($link,"INSERT INTO  tweets(`tweet`,`userid`,`datetime`)
        VALUES('".mysqli_real_escape_string($link,$_POST['tweetContent'])."', "
        .mysqli_real_escape_string($link,$_SESSION['id']).", NOW())");
        echo 1;
    }
}

?>