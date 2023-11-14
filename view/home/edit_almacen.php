<?php
session_start();
if (empty($_SESSION['usuario']) ||( $_SESSION['tipo_usuario'] !== 'admin' && $_SESSION['tipo_usuario'] !== 'almacenista')) {
    header("Location: acceso_denegado.php");
    exit(); 
}
?>
<?php
include("config\usersDB.php");
$id_empresa= '';
$calle= '';
$numero= '';
$localidad= '';


if  (isset($_GET['id_almacen'])) {
  $id_almacen = $_GET['id_almacen'];
  $query = "SELECT * FROM Almacen WHERE id_almacen=$id_almacen";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_almacen = $row['id_almacen'];
    $id_empresa = $row['id_empresa'];
    $calle = $row['calle'];
    $numero = $row['numero'];
    $localidad = $row['localidad'];

  }
}

if (isset($_POST['update'])) {
  $id_almacen = $_GET['id_almacen'];
  $id_empresa= $_POST['id_empresa'];
  $calle = $_POST['calle'];
  $numero = $_POST['numero'];
  $localidad = $_POST['localidad'];

  $query = "UPDATE Almacen set id_empresa = '$id_empresa', calle = '$calle', numero = '$numero', localidad = '$localidad' WHERE id_almacen=$id_almacen";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionAlmacen.php');
}

?>
<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_almacen.php?id_almacen=<?php echo $_GET['id_almacen']; ?>" method="POST">
        <div class="form-group">
          <input name="id_empresa" type="text" class="form-control" value="<?php echo $id_empresa; ?>" placeholder="cambiar id empresa">
        </div>
        <div class="form-group">
          <input name="calle" type="text" class="form-control" value="<?php echo $calle; ?>" placeholder="cambiar nombre de calle">
        </div>
        <div class="form-group">
          <input name="numero" type="text" class="form-control" value="<?php echo $numero; ?>" placeholder="cambiar el numero de la calle">
        </div>
        <div class="form-group">
          <input name="localidad" type="text" class="form-control" value="<?php echo $localidad; ?>" placeholder="cambiar la localidad">
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