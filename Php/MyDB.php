<?php

mysqli_connect("localhost","root","");
if(mysqli_connect_error()){
    echo "There was error in connecting to DB";
}
else{
    echo "Database connection sucessfully";
}
?>