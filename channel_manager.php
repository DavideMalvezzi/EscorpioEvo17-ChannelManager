
<?php
  require("db_access.php");

  connectToDb();

  $request = json_decode($_POST["request"]);
  $response = array();

  //Get all channels data
  if($request->cmd === "get_all"){
    $i = 0;
    $sql = "SELECT * FROM channel ORDER BY id ASC";
    $result = $conn->query($sql);

    $channels = array();
    while($row = $result->fetch_assoc()) {
        $channels[] = $row;
        $i++;
    }

    $response["result"] = "ok";
    $response["count"] = $i;
    $response["channels"] = $channels;
  }

  print json_encode($response);

  disconnectFromDb();
?>
