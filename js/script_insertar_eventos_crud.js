$(document).ready(function(){
  //Muestra el btn elminar en la semana actual y quincena de pago
  $('section#sem_actual table tbody tr td.td_btn,section#quin_pago table tbody tr td.td_btn').show();
  $('section#sem_actual').show();
  $('nav ul a input#sem_actual').addClass('selected');


});



//Muestra el periodo seleccionado
$('nav ul a input').on('click',function(){
  var btn = $(this).attr('id');
  var section = 'div#registros section#';
  section += btn;
  $('#registros section').css({'display':'none'});
  $('input.selected').removeClass('selected');
  $($(this)).addClass('selected');
  $(section).css({'display':'block'});
})


//Muestra la seccion de registro de horas
$('#btn_nuevo_registro').on('click',function(event){
  event.preventDefault();
  $('#insertar_eventos').css({'display':'block'});
  $('#registros').css({'display':'none'});

});

// $('#btn_agregar').on('click',function(event){
//   event.preventDefault();
//   $('div.insertar_eventos').css({'display':'none'});
//   $('div.registros').css({'display':'block'});
//
// });

$('#btn_regresar').on('click',function(event){

  event.preventDefault();
  $('#insertar_eventos').css({'display':'none'});
  $('#registros').css({'display':'block'});
  console.log("funciona");
});
