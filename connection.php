<?php
    $dsn="mysql:host=localhost;dbname=user";
    $username='root';
    $password='';
    $option=[];

    try {

        $connection=new PDO($dsn,$username,$password,$option);
        // echo "Connection Successfullllllll";
    }
    catch(PDOException){
        echo "Connection error";
    }
?>