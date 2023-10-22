<?php
include("config\usersDB.php");
$estado= '';
$nomb_calle= '';
$num_calle= '';
$localidad= '';
$departamento= '';


if  (isset($_GET['id_paquete'])) {
  $id_paquete = $_GET['id_paquete'];
  $query = "SELECT * FROM paquetes WHERE id_paquete=$id_paquete";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_paquete = $row['id_paquete'];
    $estado = $row['estado'];
    $nomb_calle = $row['nomb_calle'];
    $num_calle = $row['num_calle'];
    $localidad = $row['localidad'];
    $departamento = $row['departamento'];

  }
}

if (isset($_POST['update'])) {
  $id_paquete = $_GET['id_paquete'];
  $estado= $_POST['estado'];
  $nomb_calle = $_POST['nomb_calle'];
  $num_calle = $_POST['num_calle'];
  $localidad = $_POST['localidad'];
  $departamento = $_POST['departamento'];

  $query = "UPDATE paquetes set estado = '$estado', nomb_calle = '$nomb_calle', num_calle = '$num_calle', localidad = '$localidad', departamento = '$departamento' WHERE id_paquete=$id_paquete";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionPaquete.php');
}

?>
<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_paquete.php?id_paquete=<?php echo $_GET['id_paquete']; ?>" method="POST">
        <div class="form-group">
          <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="cambiar estado">
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
        <div class="form-group">
          <input name="departamento" type="text" class="form-control" value="<?php echo $departamento; ?>" placeholder="cambiar el departamento">
        </div>
        <button class="btn-success" name="update">
          Cambiar
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes\footer.php'); ?>