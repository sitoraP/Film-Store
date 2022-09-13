<?php
include('./connection.php');
 $user = $_GET['user1'];
 $arr = explode(":", $user);

$name=$arr[0];
$filmName=$arr[1];

$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else echo "Database Connected successfully=======>>>";
$sql1 = "INSERT INTO `favourites`(`fname`, `filmname`) VALUES ('$name','$filmName')";

if ($conn->query($sql1) === TRUE) {
   header("Location: ../PHP/home.php?user='$name'");
    exit();
} else {
    echo "Error: <br>" . $conn->error;
}

$conn->close();