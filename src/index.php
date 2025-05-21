<?php
  echo "<h1>Here are all the supercats</h1>";

  $servername = getenv('DB_URL');
  $username = getenv('DB_USER');
  $password = getenv('DB_PW');

  $con = mysqli_connect($servername, $username ,$password);

  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT * FROM supercatdb.users";

  $res = $con->query($sql);

  if($res->num_rows > 0) {
    $data = array();
    while($row = $res->fetch_assoc()) {
      echo "<div>id: " . $row["id"]. " - Name: " . $row["user"]. "<br /></div>";
    }
  } else {
    echo "<div>No users.</div>";
  }

  mysqli_close($con);
?>
