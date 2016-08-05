<?php

  require('db_access.php');

  define('PROPS_PER_CHANNEL', 4);
  define('CFG_FILE_PATH', "CHANNELS.CFG");

  connectToDb();

  $cfgFile = fopen(CFG_FILE_PATH, 'w');

  $sql = 'SELECT can_id, name, size, type
          FROM channel
          ORDER BY can_id ASC';

  $result = $conn->query($sql);

  echo 'PROPS=' . $result->num_rows * PROPS_PER_CHANNEL . PHP_EOL;

  $i = 0;
  while($row = $result->fetch_assoc()){
    echo '###CH' . $i . '###' . PHP_EOL;
    echo 'CH_ID=' . $row['can_id'] . PHP_EOL;
    echo 'CH_NAME=' . $row['name'] . PHP_EOL;
    echo 'CH_SIZE=' . $row['size'] . PHP_EOL;
    echo 'CH_TYPE=' . $row['type'] . PHP_EOL;
    $i++;
  }

/*
  fwrite($cfgFile, 'PROPS=' . $result->num_rows * PROPS_PER_CHANNEL . PHP_EOL);

  $i = 0;
  while($row = $result->fetch_assoc()){
    fwrite($cfgFile, '###CH' . $i . '###' . PHP_EOL);
    fwrite($cfgFile, 'CH_ID=' . $row['can_id'] . PHP_EOL);
    fwrite($cfgFile, 'CH_NAME=' . $row['name'] . PHP_EOL);
    fwrite($cfgFile, 'CH_SIZE=' . $row['size'] . PHP_EOL);
    fwrite($cfgFile, 'CH_TYPE=' . $row['type'] . PHP_EOL);
    $i++;
  }
  fclose($cfgFile);

  if (file_exists(CFG_FILE_PATH)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename(CFG_FILE_PATH).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize(CFG_FILE_PATH));
    readfile(CFG_FILE_PATH);
  }
  */

  disconnectFromDb();

 ?>
