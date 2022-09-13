<?php
include('./connection.php');
$user = $_GET['user'];
$arr = explode(":", $user);

$name = $arr[0];
$filmName = $arr[1];

$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql="DELETE FROM favourites WHERE favourites.fname ='$name' AND favourites.filmname='$filmName';";
    $result= $conn->query($sql);
    if($result)  header("Location: ../PHP/detailsPagecreator.php?user='$user'");
   
}
