
function getChannels(){
  var request = {};
  request["cmd"] = "get_all";

  $.ajax({
      type: "post",
      url: "channel_manager.php",
      dataType: "json",
      data: {"request" : JSON.stringify(request)},
      success: function(response){
        
      }
  });
}

function reloadChannelsTable(){
  getChannels();
}

function addNewChannel(){

}

function updateChannel(){

}

function removeChannel(){

}
