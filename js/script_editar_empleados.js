
$(document).ready(function() {
  consulta_ajax("start", "null");
});


// ============================================================================
// LISTENERS


// ============================================================================

$(document).click(function(event) {
  /* Act on the event */
  var button = "menu-options";

  if ($(event.target).attr('class')  != button) {
    $('div.options').hide();
  }
});

$(document).on('click', 'ul li a', function(event) {
  console.log($(this).text());
  /* Act on the event */
});

$(document).on('click', 'button.menu-options', function(event) {
  var menu = $(this).parent().find('div');
  $('div.options').hide();
  $(menu).show();
  /* Act on the event */
});

$(document).on('change', 'select#filtro', function(event) {
  event.preventDefault();
  console.log($(this).val());
  consulta_ajax("select_filtro", $(this).val());
});

$(window).scroll(function(event) {
  var scroll = $(window).scrollTop();
  var btn_height = $('div.contenedor-btn').innerHeight();
  console.log(btn_height);
});

$(document).on('keyup', 'input#busqueda', function(event) {
  event.preventDefault();
  var busqueda = $(this).val();
  $.ajax({
    url: 'tabla_empleados.php',
    type: 'POST',
    dataType: 'html',
    data: {type: 'busqueda',
          valor: busqueda}
  })
  .done(function(respuesta) {
    $('div#tabla_empleados').html(respuesta);
  })
  .fail(function() {
    console.log("error");
  });

});


// ============================================================================
// FUNCIONES


// ============================================================================


function consulta_ajax(type, valor){
  $.ajax({
    url: 'tabla_empleados.php',
    type: 'POST',
    dataType: 'html',
    data: {type: type,
          valor: valor}
  })
  .done(function(respuesta) {
    $('div#tabla_empleados').html(respuesta)
  })
  .fail(function() {
    console.log("error");
  });
}
