var empleado;
var sites;
$('#fila_new_event').hide();
$('.btn_edit').hide();

buscar_empleados();
obtener_sites();


////////////////////////////////////////////////////////////////////////////////
                              //FUNCIONES

////////////////////////////////////////////////////////////////////////////////
function obtener_sites(consulta){
  var obj = {
    type: 'site',
    con: consulta
  }
  $.ajax({
    url: 'buscar.php',
    type: 'POST',
    dataType: 'json',
    data: {data: obj}
  })
  .done(function(respuesta) {
    sites = respuesta;
  })
  .fail(function() {
    console.log("error");
  });

}

function buscar_empleados(consulta){
  var obj = {
    type: 'name',
    con: consulta
  }

  $.ajax({
    url: '../admin/buscar.php',
    type: 'POST',
    dataType: 'json',
    data: {data: obj}
  })
  .done(function(respuesta) {
    empleado = respuesta;
    insertDataRow(empleado);

  })
  .fail(function() {
    console.log("error");
  });
}

function insertDataRow(respuesta){
  //console.log(respuesta);
  $('#new_name').append(respuesta.name);
  $('#new_ocupation').append(respuesta.ocupation);
  $('#td_new_id').append(respuesta.id);
  $('#new_id').attr("value",respuesta.id);
}

////////////////////////////////////////////////////////////////////////////////
                              //LISTENERS

////////////////////////////////////////////////////////////////////////////////

// Insertar nuevos empleados
$('#btn_submit').on('click',function(e){
  e.preventDefault();
  var eventos = [];
  var inputs = $('.hours');
  var site = $('#new_site').val();
  $.each(inputs,function(index, el) {
    var evento = {
      type: "new",
      id: empleado.id,
      work_for: empleado.work_for,
      name: empleado.name,
      employee_rate: empleado.employee_rate,
      work_for_rate: empleado.work_for_rate,
      ocupation: empleado.ocupation,
      phone: empleado.phone,
      pay_week: empleado.pay_week,
      paid_by: empleado.paid_by,
      bank_info: empleado.bank_info,
      site: site,
      date: $(el).attr('id'),
      hours_day: $(el).val(),
      total_day: empleado.work_for_rate*$(el).val(),
      note: ""
    }
    if (evento.hours_day != "") {
      eventos.push(evento);
    }
  });
  $.ajax({
    url: 'editar_timesheet.php',
    type: 'POST',
    dataType: 'json',
    data: {data: eventos}
  })
  .done(function(respuesta) {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function(respuesta) {
    console.log("always");
    location.reload(true);
  });


});


// Eliminar y Actualizar eventos
$('.btn_edit').on('click',function(e) {
  e.preventDefault();
  if ($(this).html()== 'edit') {
    // Editamos la informacion
    $('.btn_edit').hide();
    var btn_id = $(this).attr('id');
    var btn_clicked = $('#'+btn_id);
    btn_clicked.show();
    btn_clicked.html('ok');

    // Modificamos el site, permitiendo elegir uno
    var event_edit = $(this).parent().parent().find('td.event_edit');
    var site_edit = $(this).parent().parent().find('td#site');
    var site = site_edit.text();
    // $(site_edit).empty();
    // $(site_edit).append('<select class="select" name="site" required id="new_site"></select>');
    // $(site_edit).find('select').append('<option value='+site+' selected> '+site+' </option>');
    // $.each(sites, function(index, el) {
    //   $(site_edit).find('select').append('<option value='+el.site+'> '+el.site+' </option>');
    // });
    // agregamos los valores de las horas en un input
    $.each(event_edit,function(index, el) {
      var horas = $(el).text();
      horas = Number(horas);
      $(el).empty();
      if (horas != '') {
        $(el).append('<input class="edit_hours" type="number" value='+horas+' />');
      }else {
        $(el).append('<input class="edit_hours" type="number" value="" />');
      }
    });
  } // fin edit
  else if ($(this).html()== 'ok') {
    // Traemos la informacion para la creacion del arreglo de eventos
    var employee_id = $(this).parent().find('input').val();
    var inputs = $(this).parent().parent().find('input.edit_hours');
    var site = $('select#new_site').val();
    var eventos = [];
    // creamos el arreglo de eventos
    $.each(inputs,function(index, el) {
      var horas = $(el).val();
      var date = $(el).parent().attr('value');
      var evento = {
        id: employee_id,
        site: site,
        date: date,
        hours_day: horas,
        note: ""
      }
      eventos.push(evento);
    });
    var obj = {
      type: 'edit',
      id_empleado: employee_id,
      con: eventos
    }
    $.ajax({
      url: 'buscar.php',
      type: 'POST',
      dataType: 'json',
      data: {data: obj }
    })
    .done(function(respuesta) {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
      location.reload(true);
    });

  }


});

// Muestra la fila para insertar nuevo empleado
$('#btn_agregar_eventos').on('click', function(e) {
  e.preventDefault();
  $('#fila_new_event').show();
});

// Muestra los btns de editar en cada fila
$('#btn_editar_eventos').on('click', function(event) {
  event.preventDefault();
  $('.btn_edit').show();
  /* Act on the event */
});
