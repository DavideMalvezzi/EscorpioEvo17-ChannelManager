
var channels = {};
var selectedChannelID;

function reloadChannelsTable(){
  var request = {};
  request['cmd'] = 'get_all';

  $.ajax({
      type: 'post',
      url: 'channel_manager.php',
      dataType: 'json',
      data: {'request' : JSON.stringify(request)},
      success: function(response){
        if(response.result === 'ok'){
          channels = response.channels.slice();

          $('#channel-table-body').empty();

          var row;
          for(var i = 0; i < channels.length; i++){
              row = '<tr id="channel-' + channels[i].can_id  + '">';

              row += '<td>';
              row += '<button type="button" class="btn btn-warning" onclick="showEditChannelDialog(' + channels[i].can_id + ')">';
              row += '<span class="glyphicon glyphicon-edit"></span></button>';
              row += '<button type="button" class="btn btn-danger" onclick="showRemoveChannelDialog(' + channels[i].can_id + ')">';
              row += '<span class="glyphicon glyphicon-remove"></span></button>';
              row += '</td>';

              for(var attr in channels[i]){
                row += '<td>' + channels[i][attr]  + '</td>';
              }
              row += '</tr>';

              $('#channel-table-body').append(row);
          }
        }
      }
  });
}

function addNewChannel(){
  var request = {};
  request['cmd'] = 'add_new';
  request['id'] = parseInt($("#channel-id").val(), 16);
  request['name'] = $("#channel-name").val().replace(/\s+/g, '');
  request['type'] = $("#channel-type").val();
  request['size'] = $("#channel-size").val();
  request['def'] = $("#channel-def").val();
  request['min'] = $("#channel-min").val();
  request['max'] = $("#channel-max").val();
  request['formula'] = $("#channel-formula").val();
  request['desc'] = $("#channel-desc").val();

  if(request['id'] === NaN){
    setError("#channel-id", true);
    return false;
  }

  if(request['name'].length == 0){
    setError("#channel-name", true);
    return false;
  }

/*
  $.ajax({
    type: 'post',
    url: 'channel_manager.php',
    dataType: 'json',
  });
  */
}

function updateChannel(){

}

function removeChannel(){
  var request = {};
  request["cmd"] = "delete";
  request["id"] = selectedChannelID;
  $.ajax({
    type: "post",
    url: 'channel_manager.php',
    dataType: 'json',
    data: {'request' : JSON.stringify(request)},
    success: function(response){
      if(response.result === "ok"){
        reloadChannelsTable();
      }else{
        console.log(response.error);
      }
    }
  });
}
