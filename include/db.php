<?php

$db['db_host']='localhost';
$db['db_user']='root';
$db['db_pass']='';
$db['db_name']='cms';

//make the value of array constant
foreach($db as $key => $value){
    define(strtoupper($key),$value);
}

//connect database with php
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


$query = "SET NAMES utf8";
mysqli_query($connection, $query);
if(!$connection){
    echo "sory not connection";
}


?>