<?php
include("config\usersDB.php");
$matricula = '';
$estado = '';
$licencia = '';
$peso_max = '';

if (isset($_GET['matricula'])) {
  $matricula = $_GET['matricula'];
  $query = "SELECT * FROM Vehiculo WHERE matricula='$matricula'"; 
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $matricula = $row['matricula'];
    $estado = $row['estado'];
    $licencia = $row['licencia'];
    $peso_max = $row['peso_max'];
  }
}

if (isset($_POST['update'])) {
  $matricula = $_POST['matricula']; 
  $estado = $_POST['estado'];
  $licencia = $_POST['licencia'];
  $peso_max = $_POST['peso_max'];

  $query = "UPDATE Vehiculo SET estado = '$estado', licencia = '$licencia', peso_max = '$peso_max' WHERE matricula='$matricula'"; 
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionVehiculo.php');
}

?>

<?php include('view\home\includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit_vehiculo.php?matricula=<?php echo $_GET['matricula']; ?>" method="POST">
          <div class="form-group">
            <input name="matricula" type="text" class="form-control" value="<?php echo $matricula; ?>" placeholder="Cambiar matricula">
          </div>
          <div class="form-group">
            <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="Cambiar estado">
          </div>
          <div class="form-group">
            <input name="licencia" type="text" class="form-control" value="<?php echo $licencia; ?>" placeholder="Cambiar licencia">
          </div>
          <div class="form-group">
            <input name="peso_max" type="text" class="form-control" value="<?php echo $peso_max; ?>" placeholder="Cambiar peso maximo">
          </div>
          <button class="btn-success" name="update">
            Cambiar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include('view\home\includes\footer.php'); ?>