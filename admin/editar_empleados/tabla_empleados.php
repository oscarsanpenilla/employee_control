<?php
include("../../funtions.php");
include("../../validar_inicio_sesion_admin.php");

$conexion_db = new ConexionDB();

$type = $_POST['type'];
$select_val = $_POST['valor'];



if ($type == "start" || $select_val == "last_periods") {
  $events = new Events();
  $end_date = $events->getEndDateRT();
  $start_date = date('Y-m-d',strtotime('-27 day',strtotime($end_date)));

  $sql = "SELECT DISTINCT users.id,users.name,users.work_for,users.ocupation,users.work_for_rate
          FROM events
          JOIN users ON events.id = users.id
          WHERE active=1 AND date BETWEEN '$start_date' AND '$end_date' ";

  $array_usuarios = $conexion_db->ConsultaArray($sql);
}

if ($type == "select_filtro" && $select_val != "last_periods") {
  $sql = "SELECT *
  FROM users
  WHERE active=1 AND work_for='$select_val'
  ORDER BY work_for,ocupation,name";
  $array_usuarios = $conexion_db->ConsultaArray($sql);
}

if ($type == "busqueda") {
  $busqueda = $_POST['valor'];
  $sql = "SELECT *
  FROM users
  WHERE active=1 AND name LIKE '%".$busqueda."%'
  ORDER BY work_for,ocupation,name";
  $array_usuarios = $conexion_db->ConsultaArray($sql);
}

 ?>

<table>
  <thead>
    <tr >
      <th>Work for</th>
      <th>Ocupation</th>
      <th>Name</th>
      <th>Work for Rate</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($array_usuarios as $elemento): ?>
      <tr>
        <td> <?php echo $elemento->work_for ?></td>
        <td> <?php echo $elemento->ocupation ?></td>
        <td> <?php echo $elemento->name ?></td>
        <td> <?php echo $elemento->work_for_rate ?></td>
        <td class="btn-crud">
          <input type="hidden" name="id" value="<?php echo $elemento->id;?>">
          <button class="menu-options">:::</button>
          <div class="options">
            <ul>
              <li><a href="../../crud_eventos/insertar_eventos_crud.php?Id=<?php echo $elemento->id ?>">View</a></li>
              <li><a href="crud_borrar.php?Id=<?php echo $elemento->id ?>">Delate</a></li>
              <li><a href="crud_formulario_actualizar.php?Id=<?php echo $elemento->id ?>">Update</a></li>
            </ul>
          </div>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
  <tfoot>
  </tfoot>
</table>
