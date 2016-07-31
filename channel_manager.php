
<?php
  require('db_access.php');

  connectToDb();

  $request = json_decode($_POST['request']);
  $response = array();

  //Get all channels data
  if($request->cmd === 'get_all'){
    $count = 0;
    $sql = 'SELECT */*CONV(can_id, 10, 16) AS can_id, name, type, size, def_value, min_value, max_value, formula, description*/
            FROM channel
            ORDER BY can_id ASC';

    $result = $conn->query($sql);
    $channels = array();

    while(($row = $result->fetch_assoc())) {
        $channels[] = $row;
        $count++;
    }

    $response['result'] = 'ok';
    $response['count'] = $count;
    $response['channels'] = $channels;
  }

  else if($request->cmd === 'delete'){
    $sql = 'DELETE FROM channel WHERE can_id = ' . $request->id;

    if($conn->query($sql) === TRUE){
      $response['result'] = 'ok';
    }
    else{
      $response['result'] = 'error';
      $response['error'] = $conn->error;
    }
  }

  else if($request->cmd === 'add_new'){
    $sql = 'INSERT INTO channel VALUES(' .
              $request->id . ',' .
              '"' . $request->name . '",' .
              '"' . $request->type . '",' .
              $request->size . ',' .
              '"' . $request->def . '",' .
              '"' . $request->min . '",' .
              '"' . $request->max . '",' .
              '"' . $request->formula . '",' .
              '"' . $request->desc . '")';

    if($conn->query($sql) === TRUE){
      $response['result'] = 'ok';
    }
    else{
      $response['result'] = 'error';
      $response['error'] = $conn->error;
    }
  }

  else if($request->cmd === 'update'){
    $sql = 'UPDATE channel SET ' .
              'can_id = ' . $request->id . ', ' .
              'name = "' . $request->name . '", ' .
              'type = "' . $request->type . '", ' .
              'size = ' . $request->size . ', ' .
              'def_value = "' . $request->def . '", ' .
              'min_value = "' . $request->min . '", ' .
              'max_value = "' . $request->max . '", ' .
              'formula = "' . $request->formula . '", ' .
              'description = "' . $request->desc . '" ' .
              'WHERE can_id = ' . $request->old_id;

    if($conn->query($sql) === TRUE){
      $response['result'] = 'ok';
    }
    else{
      $response['result'] = 'error';
      $response['error'] = $conn->error;
    }
  }

  print json_encode($response);

  disconnectFromDb();
?>
