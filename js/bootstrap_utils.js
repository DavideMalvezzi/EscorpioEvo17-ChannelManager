
function setError(id, hasError){
  if(hasError){
    $(id).parent().addClass("has-error");
  }
  else{
    $(id).parent().removeClass("has-error");
  }
}
