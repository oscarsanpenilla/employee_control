
$(function(){
  $('section#sem_actual').show();
  $('section#quin_pago ').show();
  $('section#sem_actual table tbody tr a input').show();
  $('section#quin_pago table tbody tr a input').show();
  $('section#quin_pasada table tbody tr td a input').remove();
  $('section#quin_antepasada table tbody tr td a input').remove();

  //Remover en el dia de pago

  // $('input.btn_principal').remove();
  // $('section#quin_pago table tbody tr td a input').remove();

});

$('select#intervalo').change(function(){
  var opcion_selec = ($( "select option:selected" ).attr('id'));
  opcion_selec = String(opcion_selec);
  console.log(opcion_selec);
  if (opcion_selec == 'ambos') {
    $.each($('div section'),function(key,value){
        $(value).hide();
      });
      $('section#quin_pago ').show();
      $('section#sem_actual').show();

  }else{
    $.each($('div section'),function(key,value){
        $(value).hide();
      });
    $('section#'+opcion_selec).show();
  }


});
