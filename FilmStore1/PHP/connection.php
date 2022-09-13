<?php 
function Connect(){
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "filmstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
return $conn;
}
?>