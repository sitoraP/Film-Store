<?php
include('./connection.php');
$user = $_GET['user'];

$filmName = $_POST['title'];
$description = $_POST['Description'];

$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else echo "Database Connected successfully=======>>>";
$sql = "INSERT INTO `films`(`user`, `filmname`, `description`) VALUES ('$user','$filmName','$description')";
$sql1 = "INSERT INTO `favourites`(`fname`, `filmname`) VALUES ('$user','$filmName')";

if ($conn->query($sql) === TRUE) {
    $conn->query($sql1);
    header("Location: ../PHP/home.php?user='$user'");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
