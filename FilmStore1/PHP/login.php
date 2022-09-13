<?php
include('./connection.php');

$email = $_POST['email1'];
$passw = $_POST['password1'];

$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else echo "Database Connected successfully=======>>>";

$result = $conn->query("SELECT * FROM user");
$found = false;

while ($row = $result->fetch_assoc()) {
    $e = $row['email'];
    $p = $row['pass'];

    if ((trim($e) === $email) && (trim($p) === $passw)) {
        $user = $row['fname'];
        $found = true;
        echo $row['email'] . $passw . $user;
        break;
    } else echo 'no user found<br>';
}
if ($found == true) {
    $found = false;
    header("Location: ./home.php?user='$user'");
} else {
    echo "Error:<br>";
}

$conn->close();
