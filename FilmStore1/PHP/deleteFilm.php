<?php
include('./connection.php');
$user = $_GET['user'];
$arr = explode(":", $user);

$name = $arr[0];
$filmName = $arr[1];
echo $name." ".$filmName;
$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql="DELETE films,favourites FROM films INNER JOIN
        favourites ON favourites.fname = films.user AND favourites.filmname = films.filmname
        WHERE
        films.user = '$name' AND films.filmname='$filmName';";
    $result= $conn->query($sql);
    if($result)  header("Location: ../PHP/detailsPagecreator.php?user='$user'");
   
}
