<?php
include('./connection.php');
/*$user = $_GET['user'];
$user1 = json_decode($user);
$obj = json_encode($user1);
$obj = str_replace(',', ':', $obj);
$obj = str_replace(array('{', '}', '"', ','), ' ', $obj);
$arr = explode(":", $obj);

$fname = $arr[1];
$lname = $arr[3];
$email = $arr[5];
$passw = $arr[7];
*/
$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$email = $_REQUEST["email"];
$passw = $_REQUEST["password"];

$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else echo "Database Connected successfully=======>>>";
$sql = "INSERT INTO user VALUES ('$fname', '$lname', '$email','$passw')";
echo $sql;
if ($conn->query($sql) === TRUE) {
    echo 'New record created successfully';
    header("Location: ../login_register.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
