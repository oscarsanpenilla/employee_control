<section id="filtro_encabezado">
  <strong>Site</strong>
  <p>
    <?php foreach ($_POST['site_checkbox'] as $key=>$value){
      if ($value == "any") {
        echo $value." / ";
        break;
      }else {
        echo $value." / ";
      }
    }
    ?>
  </p>
  <strong>Paid by</strong>
  <p>
    <?php foreach ($_POST['paid_by_checkbox'] as $key=>$value){
      if ($value == "any") {
        echo $value." / ";
        break;
      }else {
        echo $value." / ";
      }
    }
    ?>
  </p>
  <strong>Ocupation</strong>
  <p>
    <?php foreach ($_POST['ocupation_checkbox'] as $key=>$value){
      if ($value == "any") {
        echo $value." / ";
        break;
      }else {
        echo $value." / ";
      }
    }
    ?>
  </p>
</section>
