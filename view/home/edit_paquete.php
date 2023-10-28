<?php
include("config\usersDB.php");
$estado= '';
$tipo= '';
$fragil= '';


if  (isset($_GET['id_paquete'])) {
  $id_paquete = $_GET['id_paquete'];
  $query = "SELECT * FROM paquete WHERE id_paquete=$id_paquete";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_paquete = $row['id_paquete'];
    $estado = $row['estado'];
    $tipo = $row['tipo'];
    $fragil = $row['fragil'];

  }
}

if (isset($_POST['update'])) {
  $id_paquete = $_GET['id_paquete'];
  $estado= $_POST['estado'];
  $tipo = $_POST['tipo'];
  $fragil = $_POST['fragil'];

  $query = "UPDATE paquete set estado = '$estado', tipo = '$tipo', fragil = '$fragil' WHERE id_paquete=$id_paquete";
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
          <input name="tipo" type="text" class="form-control" value="<?php echo $nomb_calle; ?>" placeholder="tipo">
        </div>
        <div class="form-group">
          <input name="fragil" type="text" class="form-control" value="<?php echo $num_calle; ?>" placeholder="fragil">
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