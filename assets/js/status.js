$(document).on('click','.badge-employees',function(){
  var div_id  = $(this).attr("data");
  var status = ($(this).hasClass("bg-success")) ? '0' : '1';
  var msg = (status=='0')? 'Deactivate' : 'Activate';
  if(confirm("Are you sure to "+ msg)){
    var current_element = $(this);
    url = "statusemployees";
    $.ajax({
      type:"POST",
      url: url,
      data: {UserActive:'active',employeesid:$(current_element).attr('data'),status:status},
      success: function(data)
      {
        $("#divToReload_"+div_id).load(location.href + " #divToReload_"+div_id);
      }
    });
  }
});