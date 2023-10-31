<?php
include("config\usersDB.php");
$estado= '';
$peso= '';
$almacen_destino= '';

if  (isset($_GET['id_lote'])) {
  $id_lote = $_GET['id_lote'];
  $query = "SELECT * FROM lote WHERE id_lote=$id_lote";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_lote = $row['id_lote'];
    $estado = $row['estado'];
    $peso = $row['peso'];
    $almacen_destino = $row['almacen_destino'];
  }
}

if (isset($_POST['update'])) {
  $id_lote = $_GET['id_lote'];
  $estado= $_POST['estado'];
  $peso = $_POST['peso'];
  $almacen_destino = $_POST['almacen_destino'];

  $query = "UPDATE lote set estado = '$estado', peso = '$peso', almacen_destino = '$almacen_destino'  WHERE id_lote=$id_lote";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionLotes.php');
}

?>
<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_lotes.php?id_lote=<?php echo $_GET['id_lote']; ?>" method="POST">
        <div class="form-group">
          <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="cambiar estado">
        </div>
        <div class="form-group">
          <input name="peso" type="text" class="form-control" value="<?php echo $peso; ?>" placeholder="cambiar peso">
        </div>
        <div class="form-group">
          <input name="almacen_destino" type="text" class="form-control" value="<?php echo $almacen_destino; ?>" placeholder="cambiar el destino">
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
