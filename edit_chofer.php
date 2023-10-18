<?php
include("config\usersDB.php");
$cedula= '';
$licencia= '';
$nombre= '';
$apellido= '';


if  (isset($_GET['cedula'])) {
  $cedula = $_GET['cedula'];
  $query = "SELECT * FROM chofer WHERE cedula=$cedula";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $cedula = $row['cedula'];
    $licencia = $row['licencia'];
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];

  }
}

if (isset($_POST['update'])) {
  $cedula = $_GET['cedula'];
  $licencia= $_POST['licencia'];
  $nombre= $_POST['nombre'];
  $apellido = $_POST['apellido'];
  


  $query = "UPDATE chofer set licencia = '$licencia', nombre = '$nombre', apellido = '$apellido' WHERE cedula=$cedula";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionChofer.php');
}

?>
<?php include('view\home\includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_chofer.php?cedula=<?php echo $_GET['cedula']; ?>" method="POST">
        <div class="form-group">
          <input name="licencia" type="text" class="form-control" value="<?php echo $licencia; ?>" placeholder="cambiar licencia del chofer">
        </div>
        <div class="form-group">
          <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="cambiar nombre del chofer">
        </div>
        <div class="form-group">
          <input name="apellido" type="text" class="form-control" value="<?php echo $apellido; ?>" placeholder="cambiar apellido del chofer">
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