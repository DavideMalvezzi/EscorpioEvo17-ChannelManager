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

    function showRemoveChannelDialog(channelID){
      selectedChannelID = channelID;
      $("#remove-channel-modal").modal();
    }
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
                <th>Edit</th>
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

            <tbody id="channel-table-body">

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal -->
  <div id="remove-channel-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Remove</h4>
        </div>

        <div class="modal-body">
          <p>Do you want to remove this channel?</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="removeChannel()">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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
