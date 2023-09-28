<?php
include("config\usersDB.php");
$empresa= '';
$nomb_calle= '';
$num_calle= '';
$localidad= '';


if  (isset($_GET['id_almacen'])) {
  $id_almacen = $_GET['id_almacen'];
  $query = "SELECT * FROM almacen WHERE id_almacen=$id_almacen";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_almacen = $row['id_almacen'];
    $empresa = $row['empresa'];
    $nomb_calle = $row['nomb_calle'];
    $num_calle = $row['num_calle'];
    $localidad = $row['localidad'];

  }
}

if (isset($_POST['update'])) {
  $id_almacen = $_GET['id_almacen'];
  $empresa= $_POST['empresa'];
  $nomb_calle = $_POST['nomb_calle'];
  $num_calle = $_POST['num_calle'];
  $localidad = $_POST['localidad'];

  $query = "UPDATE almacen set empresa = '$empresa', nomb_calle = '$nomb_calle', num_calle = '$num_calle', localidad = '$localidad' WHERE id_almacen=$id_almacen";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionAlmacen.php');
}

?>
<?php include('view\home\includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_almacen.php?id_almacen=<?php echo $_GET['id_almacen']; ?>" method="POST">
        <div class="form-group">
          <input name="empresa" type="text" class="form-control" value="<?php echo $empresa; ?>" placeholder="cambiar empresa">
        </div>
        <div class="form-group">
          <input name="nomb_calle" type="text" class="form-control" value="<?php echo $nomb_calle; ?>" placeholder="cambiar nombre de calle">
        </div>
        <div class="form-group">
          <input name="num_calle" type="text" class="form-control" value="<?php echo $num_calle; ?>" placeholder="cambiar el numero de la calle">
        </div>
        <div class="form-group">
          <input name="localidad" type="text" class="form-control" value="<?php echo $localidad; ?>" placeholder="cambiar la localidad">
        </div>
        <button class="btn-success" name="update">
          Update
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('view\home\includes\footer.php'); ?>