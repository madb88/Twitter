<?php

$servername = "localhost";
$username = "root";
$password = "coderslab";
$baseName = "Twitter";

//Tworzenie nowego polaczenia 
$conn = new mysqli($servername, $username, $password, $baseName);

//Sprawdzamy czy polaczenie sie udalo
if($conn->connect_error){
    die("Polaczenie nieudane. Blad: ".$conn->connect_error);
} 



