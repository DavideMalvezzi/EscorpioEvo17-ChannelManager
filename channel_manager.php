
<?php
  require("db_access.php");

  connectToDb();

  $request = json_decode($_POST["request"]);
  $response = array();

  //Get all channels data
  if($request->cmd === "get_all"){
    $count = 0;
    $sql = "SELECT * FROM channel ORDER BY can_id ASC";
    $result = $conn->query($sql);
    $channels = array();

    while(($row = $result->fetch_assoc())) {
        $channels[] = $row;
        $count++;
    }

    $response["result"] = "ok";
    $response["count"] = $count;
    $response["channels"] = $channels;
  }
  else if($request->cmd === "delete"){
    $sql = "DELETE FROM channel WHERE can_id = " . $request->id;
    if($conn->query($sql) === TRUE){
      $response["result"] = "ok";
    }
    else{
      $response["result"] = "error";
      $response["error"] = $conn->error;
    }
  }

  print json_encode($response);

  disconnectFromDb();
?>
