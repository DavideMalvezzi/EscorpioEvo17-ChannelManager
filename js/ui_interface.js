function showRemoveChannelDialog(channelID){
  selectedChannelID = channelID;

  $("#remove-channel-modal-error").hide();
  $("#remove-channel-modal").modal();
}

function showAddChannelDialog(){
  selectedChannelID = undefined;

  resetEditDialog();

  $("#edit-channel-modal").modal();
}

function showEditChannelDialog(channelID){
  selectedChannelID = channelID;

  i = 0;
  while(i < channels.length && channels[i].can_id != channelID)i++;

  resetEditDialog();

  $("#channel-id").val(channels[i].can_id);
  $("#channel-name").val(channels[i].name);
  $("#channel-type").val(channels[i].type);
  $("#channel-size").val(channels[i].size);
  $("#channel-min").val(channels[i].min_value);
  $("#channel-max").val(channels[i].max_value);
  $("#channel-def").val(channels[i].def_value);
  $("#channel-formula").val(channels[i].formula);
  $("#channel-desc").val(channels[i].description);

  $("#edit-channel-modal").modal();
}

function resetEditDialog(){
  $("#channel-id").val("");
  $("#channel-name").val("");
  $("#channel-type").val("B");
  $("#channel-size").val("1");
  $("#channel-min").val("");
  $("#channel-max").val("");
  $("#channel-def").val("");
  $("#channel-formula").val("");
  $("#channel-desc").val("");

  $("#edit-channel-modal-error").hide();

  setError("#channel-id", false);
  setError("#channel-name", false);
}

function saveChannelEdits(){
  if(selectedChannelID === undefined){
    addNewChannel();
  }
  else{
    updateChannel();
  }
}

function downloadCfg(){
  $.ajax({
      type: 'post',
      url: 'download_cfg.php',
      success: function(response){
        var properties = {type: 'plain/text'}; // Specify the file's mime-type.
        var file = new File([response], "CHANNELS.CFG", properties);
        var link = document.createElement("a");
        link.download = "CHANNELS.CFG";
        link.href = URL.createObjectURL(file);
        link.click();
      }
  });

  //window.location = "download_cfg.php";
}
