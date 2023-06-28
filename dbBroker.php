<?php

$host = "localhost";
$db = "kozmeticki_salon";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_errno){
    exit("Neuspesna konekcija: greska>".$conn->connection_error.", err kod>".$conn->connection_errno);}

?>