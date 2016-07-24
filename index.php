<!DOCTYPE html>
<html lang="en">
<head>
  <title>Channel Manager</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--bootstrap css-->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <!--custom css-->
  <link rel="stylesheet" href="css/style.css">

  <!--bootstrap js-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!--custom js-->
  <script src="js/channel_manager.js"></script>

  <!-- db connection-->
  <?php
    include("db_access.php");

    connectToDb();
  ?>

  <script>
    $(function() {
      reloadChannelsTable();
    });
  </script>

</head>

<body>

  <div class="container-fluid">

    <div class="row">
      <div class="col-xs-12">
        <button type="button" class="btn btn-primary" onclick="addChannel()">
          <span class="glyphicon glyphicon-plus"></span>&#160;Add new channel
        </button>

        <button type="button" class="btn btn-primary" onClick="downloadCfg()">
          <span class="glyphicon glyphicon-download-alt"></span>&#160;Download CFG file
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table table-bordered" id="channel-table">
            <thead>
              <tr>
                <th>CAN ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Min Value</th>
                <th>Max Value</th>
                <th>Default Value</th>
                <th>Formula</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>ciao</td></tr>
              <tr><td>ciao</td></tr>
              <tr><td>ciao</td></tr>
              <tr><td>ciao</td></tr>
              <tr><td>ciao</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!--db disconnection-->
  <?php
    disconnectFromDb();
  ?>

</body>
</html>
