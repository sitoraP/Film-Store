<?php
include('./connection.php');
 $user = $_GET['user'];
 $user = str_replace("'", ' ', $user);
 $user=trim($user);
 $desc = $_POST['Description'];
 $arr = explode(":", $user);

$name=trim($arr[0]);
$filmName=$arr[1];

$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else echo "Database Connected successfully=======>>>";
$sql1 = "UPDATE `films` SET `description`='$desc' WHERE `user`='$name' AND `filmname`='$filmName'";

if ($conn->query($sql1) === TRUE) {
   header("Location: ../PHP/detailsPagecreator.php?user='$name.':'.$filmName'");
    exit();
} else {
    echo "Error: <br>" . $conn->error;
}

$conn->close();