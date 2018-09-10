var empleado = {
  id: ""
};


ActualizarTabla();



////////////////////////////////////////////////////////////////////////////////
//FUNCIONES

////////////////////////////////////////////////////////////////////////////////

// Actuliza la informacion de la tabla
function ActualizarTabla(){
  $.ajax({
    url: 'timesheet_ajax.php',
    type: 'POST',
    dataType: 'html',
    data: datos
  })
  .done(function(respuesta) {
    // Trae la tabla por primera vez
    $('div.ajax_response').html(respuesta);
    EditBtnsHide();
    FilaNuevoEmpleadoHide();
  })
  .fail(function() {
    console.log("error");
  });
}

// Actualizar la base de datos`
function ActualizarBaseDatos(data){
  $.ajax({
    url: 'actualizar_base.php',
    type: 'POST',
    dataType: 'html',
    data: data
  })
  .done(function(respuesta) {
    swal({
      title: 'Correcto',
      text: 'Operaciones realizadas con exito',
      type: 'success'
    });
    // Actualizamos la tabla
    ActualizarTabla();
  })
  .fail(function() {
    swal({
      title: 'Error',
      text: 'No se agregaron los registros',
      type: 'error'
    });
  });
}

// Inserta el nombre, la ocupacion y los id's en la tabla
function insertDataRow(respuesta){
  //console.log(respuesta);
  $('#new_name').append(respuesta.name);
  $('#new_ocupation').append(respuesta.ocupation);
  $('#td_new_id').append(respuesta.id);
  $('#new_id').attr("value",respuesta.id);
}

// Oculta para agregar nuevos empleados
function FilaNuevoEmpleadoHide(){
  $('tr.nueva_fila').hide();
}

// Oculta los btns de editar
function EditBtnsHide(){
  $('input.update').hide();
}

// Oculta los inputs de horas en la nueva filas
function InputHorasHide(){
  $('td.event_edit input[type="number"]').hide();
}

// Muestra los inputs de horas en la nueva filas
function InputHorasShow(){
  $('td.event_edit input[type="number"]').show();
}


// Muestra los btns de editar
function EditBtnsShow(){
  $('input.update').show();
}

// Borra el campo de Ocupacion en la fila de nuevo empleado
function ClearOcupationNewEmployee(){
  $('tr.nueva_fila td.ocupation').empty();
}

// Vertifica si se busco un empleado que ya estaba en la lista
function BuscarEmpleadoLista(id,site){
  var filas = $('tr.fila_evento');
  var ids = $('input.employee_id');
  $.each(filas,function(index, el) {
    var fila_site = $(el).find('td.site').text();
    var fila_id = $(el).find('input.employee_id').val()

    if (fila_id == id && fila_site == site){
      InputHorasHide();
      swal({
        title: 'Warning!',
        text: 'This employee with the selected site is already on the list',
        type: 'warning'
      });
    }


  });
}

// Busca los empleados en la base de datos
function BuscarEmpleadoBase(busqueda){
  $.ajax({
    url: 'actualizar_base.php',
    type: 'POST',
    dataType: 'json',
    data: {busqueda: busqueda,
      type: 'name'}
    })
    .done(function(respuesta) {
      ClearOcupationNewEmployee();
      if (respuesta.length == 1) {
        $('tr.nueva_fila td.ocupation').append(respuesta[0].ocupation);
        var id_empleado = respuesta[0].id;
        var site = $('tr.nueva_fila').find('select').val();
        // Actaliza el id en input.employee_id
        $('tr.nueva_fila td input.employee_id').attr('value',id_empleado);
        // Vertifica si se busco un empleado que ya estaba en la lista
        InputHorasShow();
        BuscarEmpleadoLista(id_empleado, site);
      }else InputHorasHide();
    })
    .fail(function() {
      console.log("error al buscar empleados");
    });
}

////////////////////////////////////////////////////////////////////////////////
//LISTENERS

////////////////////////////////////////////////////////////////////////////////

// Selector de Site
$(document).on('change', 'tr.nueva_fila select', function(event) {
  event.preventDefault();
  console.log("chambio");
  var id_empleado = $('tr.nueva_fila td input.employee_id').val();
  var site = $(this).val();
  BuscarEmpleadoLista(id_empleado, site);
});

// Insertar nuevos empleados
$(document).on('click','input#add_new',function(e){
  e.preventDefault();
  var fila = $(this).parent().parent();
  var td_events = fila.children('td.event_edit');
  var inputs = fila.find('input.edit_hours');
  var id_empleado = fila.find('input.employee_id').val();
  var site = fila.find('td.site select').val();
  var eventos = [];
  $.each(inputs,function(index, el) {
    var date = $(el).attr('id');
    var horas = $(el).val();
    var evento = {
      id: id_empleado,
      site: site,
      date: date,
      hours_day: horas
    }
    eventos.push(evento);
  });
  var data = {
    type:'edit',
    id_empleado: id_empleado,
    eventos: eventos
  }
  ActualizarBaseDatos(data);
  
});

// Eliminar y Actualizar eventos
$(document).on('click', 'input.update', function(event) {
  event.preventDefault();
  var fila = $(this).parent().parent();
  var td_events = fila.children('td.event_edit');
  var id_empleado = fila.find('input.employee_id').val();
  var site = fila.find('td.site').text();
  var eventos = [];
  //console.log(td_events);

  if ($(this).val()== 'update') {
    // Editamos la informacion
    $(this).attr('value', 'ok');
    $('input.update').hide();
    $(this).show();

    // agregamos los valores de las horas en un input
    $.each(td_events,function(index, el) {
      var horas = Number($(el).text());
      $(el).empty();
      if (horas > 0) $(el).append("<input class='edit_hours' type='number' value="+horas+" />");
      else $(el).append("<input class='edit_hours' type='number' value='' />");
    });
  } // fin edit
  else {
    var inputs = fila.find('input.edit_hours');
    // creamos el arreglo de eventos
    $.each(inputs,function(index, el) {
      var horas = $(el).val();
      var date = $(el).parent().attr('value');
      var evento = {
        id: id_empleado,
        site: site,
        date: date,
        hours_day: horas
      }
      eventos.push(evento);
    });
    var data = {
      type:'edit',
      id_empleado: id_empleado,
      eventos: eventos
    }
    ActualizarBaseDatos(data);

  }
});

// Muestra la fila para insertar nuevo empleado
$(document).on('click', 'input#agregar_eventos' ,function(e) {
  e.preventDefault();
  $('tr.nueva_fila').show();
  InputHorasHide();
});

// Muestra los btns de editar en cada fila
$(document).on('click','input#editar_eventos',function(e) {
  e.preventDefault();
  EditBtnsShow();
  /* Act on the event */
});

// Buscar buscar_empleados
$(document).on('keyup','input#search_employee', function(e) {
  e.preventDefault();
  var busqueda = $(this).val();
  BuscarEmpleadoBase(busqueda);

});
