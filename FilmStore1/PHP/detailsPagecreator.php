<?php
include('./connection.php');
$user = $_GET['user'];
$user = str_replace("'", ' ', $user);
$user = str_replace(".", ' ', $user);
$user=trim($user);
$arr = explode(":", $user);

$name = $arr[0];
$filmName = $arr[1];

$conn = Connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "SELECT * FROM films WHERE filmname='$filmName'";
    $sql1 = "SELECT * FROM `favourites` WHERE filmname='$filmName'";
    $result = $conn->query($sql);
    $result1 = $conn->query($sql1);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Details Page For Viewer</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login and regster</title>
        <link rel="stylesheet" href="../css/logRef.css" />
        <link rel="stylesheet" href="../css/home.css" />
    </head>

    <body>
        <div id="container">
            <div class="header">
                <h3 id="headerText" style="margin-left: 10px; color: cornflowerblue">
                    Welcome, <?php echo $name; ?>!
                </h3>
                <h1 id="headerText">Film Store</h1>
                <button style="
                height: 40px;
                width: auto;
                background-color: cornflowerblue;
                color: black;
                border-radius: 20px;
                font-weight: bold;
                font-size: x-large;
                margin-right: 10px;
              ">
                    <a href="../login_register.html">logout</a>
                </button>
            </div>
            <div class="logregpart">
                <div id="register">
                <form action="updateFilm.php?user='<?php echo $name.':'.$filmName;?>'" method="post">
                    <?php
                    if (!empty($result) && $result->num_rows > 0) {
                        echo '<ul>';
                        while ($row = $result->fetch_assoc()) {
                            if($row['user']!=$name)continue;
                            echo '<h3 id="regHead">Film Details</h3>
                            <h1 style="text-align:center;background-color: cornflowerblue;padding:5px">' . $row['filmname'] . '</h1>
                            <h3 style="display:inline-block;">Added By:</h3><h4 style="display:inline-block;margin-left:5px;">' . $row['user'] . '</h4>
                            <br>
                            <h3 >Description:</h3>' .

                            '<textarea
                                name="Description"
                                id="Description"
                                required
                                maxlength="255"
                                minlength="5"
                                >' . $row['description'] . '
                            </textarea>';
                        }
                    }
                    echo ' <div style="display: flex;align-items: center;justify-content: space-evenly;margin-top: 10px;">
                        <button
                        style="
                            height: 40px;
                            width: fit-content;
                            background-color: cornflowerblue;
                            color: black;
                            border-radius: 20px;
                            font-weight: bold;
                            font-size: x-large;
                            margin-right: 10px;
                        "
                        >
                            Update
                            </button>
                            <button
                            style="
                                height: 40px;
                                width: fit-content;
                                background-color: red;
                                color: black;
                                border-radius: 20px;
                                font-weight: bold;
                                font-size: x-large;
                                margin-right: 10px;
                            "
                            >
                           <a href="deleteFilm.php?user='.$user.'" style="color:black"> Delete</a>
                            </button>
                         </div> </form>';
                         
                    echo '     
                </div>

                <div id="login" style="overflow-y: scroll; height: 400px">
                            <h3 id="regHead">users Who Like This Film</h3>
                            <ul style="list-style: circle;">
                            ';
                        if (!empty($result1) &&  $result1->num_rows > 0) {

                            while ($row = $result1->fetch_assoc()) {
                                if($name== $row['fname'])
                                echo ' <li style="font-size:18px;font-weight:bold;display:inline-block;">' . $row['fname'] . '</li><a href="deleteFilmFav.php?user=' . $user .'" style="margin-left:10px;">un-favorite</a>';
                                else
                                echo ' <li style="font-size:18px;font-weight:bold;">' . $row['fname'] . '</li>';
                            }
                        }
                        echo '. </ul>';
                        ?>
                        </ul>
                    </div>
            </div>
        </div>
    </body>

    </html>
</body>

</html>