
var channels = {};

function reloadChannelsTable(){
  var request = {};
  request["cmd"] = "get_all";

  $.ajax({
      type: "post",
      url: "channel_manager.php",
      dataType: "json",
      data: {"request" : JSON.stringify(request)},
      success: function(response){
        if(response.result === "ok"){
          channels = response.channels.slice();

          $("#channel-table-body").empty();

          var row;
          for(var i = 0; i < channels.length; i++){
              row = "<tr id='channel-'" + channels[i].id  + ">";
              for(var attr in channels[i]){
                row += "<td>" + channels[i][attr]  + "</td>";
              }
              row += "</tr>";

              $("#channel-table-body").append(row);
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

}
