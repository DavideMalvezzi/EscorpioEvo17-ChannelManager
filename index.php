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

    function showAddChannelDialog(){
      selectedChannelID = undefined;
      $("#edit-channel-modal").modal();
    }

    function showEditChannelDialog(channelID){
      selectedChannelID = channelID;
      $("#edit-channel-modal").modal();
    }

  </script>

</head>

<body>

  <!--menu and table-->
  <div class="container-fluid">

    <div class="row">
      <div class="col-xs-12">
        <button type="button" class="btn btn-primary" onclick="showAddChannelDialog()">
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

  <!--delete modal-->
  <div id="remove-channel-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xs">

      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dixsiss="modal">&times;</button>
          <h4 class="modal-title">Remove</h4>
        </div>

        <div class="modal-body">
          <p>Do you want to remove this channel?</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dixsiss="modal" onclick="removeChannel()">Yes</button>
          <button type="button" class="btn btn-default" data-dixsiss="modal">No</button>
        </div>
      </div>

    </div>
  </div>

  <!--edit modal-->
  <div class="modal fade" id="edit-channel-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit</h4>
        </div>
        <div class="modal-body form-horizontal">

            <div class="form-group">
              <label for="channel-id" class="control-label col-xs-2">ID (hex):</label>
              <div class="col-xs-10">
                <input type="text" id="channel-id" class="form-control" maxlength="4">
              </div>
            </div>

            <div class="form-group">
              <label for="channel-name" class="control-label col-xs-2">Name:</label>
              <div class="col-xs-10">
                <input type="text" id="channel-name" class="form-control" maxlength="8">
              </div>
            </div>

            <div class="form-group">
              <label for="channel-type" class="control-label col-xs-2">Type:</label>
              <div class="col-xs-10">
                <select id="channel-type" class="form-control">
                  <?php
                    $sql = "SELECT * FROM data_type ORDER BY combo_order";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                      echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="channel-size" class="control-label col-xs-2">Size:</label>
              <div class="col-xs-10">
                <select id="channel-size" class="form-control">
                  <?php
                    for($i = 1; $i <= 8; $i++){
                      echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="channel-def-value" class="control-label col-xs-2">Default:</label>
              <div class="col-xs-10">
                <input type="text" class="form-control" id="channel-def-value">
              </div>
            </div>

            <div class="form-group">
              <label for="channel-min-value" class="control-label col-xs-2">Min:</label>
              <div class="col-xs-10">
                <input type="text" class="form-control" id="channel-min-value">
              </div>
            </div>

            <div class="form-group">
              <label for="channel-max-value" class="control-label col-xs-2">Max:</label>
              <div class="col-xs-10">
                <input type="text" class="form-control" id="channel-max-value">
              </div>
            </div>

            <div class="form-group">
              <label for="channel-formula" class="control-label col-xs-2">Formula:</label>
              <div class="col-xs-10">
                <input type="text" class="form-control" id="channel-formula">
              </div>
            </div>

            <div class="form-group">
              <label for="channel-description" class="control-label col-xs-2">Max:</label>
              <div class="col-xs-10">
                <input type="text" class="form-control" id="channel-description">
              </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onClick="">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
