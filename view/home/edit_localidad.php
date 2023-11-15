<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("Location: acceso_denegado.php");
    exit();
}
?>
<?php
include("config\usersDB.php");

$localidad = '';
$departamento = '';

if (isset($_GET['localidad'])) {
  $localidad = $_GET['localidad'];
  $query = "SELECT * FROM Localidad WHERE localidad='$localidad'"; 
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $localidad = $row['localidad'];
    $departamento = $row['departamento'];
  }
}

if (isset($_POST['update'])) {
  $newLocalidad = $_POST['new_localidad'];
  $newDepartamento = $_POST['departamento'];

  $query = "UPDATE Localidad SET localidad = '$newLocalidad', departamento = '$newDepartamento' WHERE localidad='$localidad'"; 
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modificó correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionLocalidad.php');
}

?>

<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit_localidad.php?localidad=<?php echo $_GET['localidad']; ?>" method="POST">
          <div class="form-group">
            <input name="new_localidad" type="text" class="form-control" value="<?php echo $localidad ?>" placeholder="Cambiar localidad">
          </div>
          <div class="form-group">
            <input name="departamento" type="text" class="form-control" value="<?php echo $departamento; ?>" placeholder="Cambiar departamento">
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