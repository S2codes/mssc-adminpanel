// ajax  json request 

HttpRequest=function(url,request,callback){
    
    $.ajax({
        url:url,
        method:"POST",
        data:request,
        success:function(data){
            callback(data);
        },
        error: function(xhr, status, error) {
            console.log('AJAX error:', error);
            // Handle the error as needed
          }
    })
}


// ajax data request  
HttpDataRequest=function(url,request,callback){
  $.ajax({
      url:url,
      method:"POST",
      type:"POST",
      data:request,
      success:function(data){
          callback(data);
      }
  })
}