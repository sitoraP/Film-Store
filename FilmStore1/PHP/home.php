<?php
$user = $_GET['user'];
include('./connection.php');
$user = str_ireplace("'", "", $user);
$conn = Connect();
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  $sql = "SELECT * FROM films";
  $sql1 = "SELECT * FROM favorites";
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
  <title>Film Club</title>
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
        <h3 id="headerText" style=" margin-left: 10px;color: cornflowerblue;">Welcome, <?php echo $user ?>!</h3>
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
        <form id="register" action="addFilm.php?user=<?php echo $user; ?>" method="POST">
          <h3 id="regHead">Add a new film</h3>


          <input type="text" name="title" id="title" placeholder="Your film's Name" required maxlength="50" minlength="2" />
          <textarea name="Description" id="Description" placeholder="Your films's Description" required maxlength="255" minlength="5"></textarea>

          <button type="submit" style="margin-top: 10px">Add</button>
        </form>
        <div id="login" style="overflow-y: scroll; height:400px;">
          <h3 id="allfilms" style="margin: 20px;"></h3>
          <h3 id="allfilms" style="margin: 20px;">All Films</h3>
          <?php
          if ($result->num_rows > 0) {
            echo '<ul>';
            while ($row = $result->fetch_assoc()) {
              //   $result2 = $conn->query("SELECT * FROM favorites where fname='$user'");
              //  && $result2
              if ((strtolower(trim($row['user'])) == strtolower(trim($user)))) {
                print_r('
                <li>
                  <a id="personName" href="../PHP/detailsPageCreator.php?user=' . $row['user'] . ':' . $row['filmname'] . '">' . $row["filmname"] . '</a>
                  <li>' . '(added by ' . $row["user"] . ')</li>
                  <li><i>this is one of your favorite</i></li>  
               </li>
            ');
              } else {
                print_r('
                <li>
                  <a id="personName" href="../PHP/detailsPage.php?user=' . $user . ':' . $row['filmname'] . '">' . $row["filmname"] . '</a>
                  <li>' . '(added by ' . $row["user"] . ')</li>
                  <li><a href="addFav.php?user1=' .$user. ':' . $row["filmname"] . '">Add to Favourite</a></li>  
               </li>
            ');
              }
            }
            echo '<ul><br>';
          } else {
            echo "<h3>0 results</h3>";
          }
          $conn->close();
          ?>

        </div>
      </div>
    </div>
  </body>

  </html>
</body>

</html>