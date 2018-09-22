$(function(){
  $('section#periodo').hide();
  $('section#form_modificar').show();
 console.log("funciona");
});

$("#date_checkbox").click(function(event){

  $('section#periodo').toggle("flip");

});
