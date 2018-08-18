$(function(){
  $('section#periodo').hide();
  $('section#form_modificar').show();
 console.log("funciona");
});

$("#date_checkbox").click(function(event){
  //event.preventDefault();
  // $(this).checked.toggle();
  //console.log($("#date_checkbox")[0].checked);
  $('section#periodo').toggle("flip");

  // $('section#form_modificar').hide();
  // $('section#pregunta_actualizar_eventos').show();
  // console.log("click");
});
