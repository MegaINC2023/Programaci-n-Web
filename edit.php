<?php
include("bd.php");
$nombre = '';
$apellido= '';
$tipo= '';
$contrasena= '';
$cedula= '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM task WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $tipo = $row['tipo'];
    $contrasena = $row['contrasena'];
    $cedula = $row['cedula'];

  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nombre= $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $tipo = $_POST['tipo'];
  $contrasena = $_POST['contrasena'];
  $cedula = $_POST['cedula'];

  $query = "UPDATE task set nombre = '$nombre', apellido = '$apellido', tipo = '$tipo', contrasena = '$contrasena', cedula = '$cedula' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modificaron los datos';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nuevo nombre">
        </div>
        <div class="form-group">
          <input name="apellido" type="text" class="form-control" value="<?php echo $apellido; ?>" placeholder="Nuevo apellido">
        </div>
        <div class="form-group">
          <input name="tipo" type="text" class="form-control" value="<?php echo $tipo; ?>" placeholder="Nuevo tipo">
        </div>
        <div class="form-group">
          <input name="contrasena" type="text" class="form-control" value="<?php echo $contrasena; ?>" placeholder="Nueva contraseña">
        </div>
        <div class="form-group">
          <input name="cedula" type="text" class="form-control" value="<?php echo $cedula; ?>" placeholder="Nueva cedula">
        </div>
       
        <button class="btn-success" name="update">
          Guardar
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>