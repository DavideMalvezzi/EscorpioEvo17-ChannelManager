
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
