$("#form_date").show();
$("#form_site").show();
$("#form_paid_by").show();
$("#form_ocupation").show();

$("#checkbox_options_site").hide();
$("#checkbox_options_paid_by").hide();
$("#checkbox_options_ocup").hide();


var array_check = $("div#checkbox_options_site div input");
$(document).ready(function(){

  $("#btn_any_site")[0].checked = true;
  $("#btn_any_paid_by")[0].checked = true;
  $("#btn_any_ocup")[0].checked = true;

});


$("div#checkbox_options_site div input").click(function(event){
  console.log("click");
});

$("#btn_any_site").click(function(){
  $("#checkbox_options_site").toggle("flip");
});

$("#btn_any_paid_by").click(function(){
  $("#checkbox_options_paid_by").toggle("flip");
});

$("#btn_any_ocup").click(function(){
  $("#checkbox_options_ocup").toggle("flip");
});
