<?php
include("config\usersDB.php");
$id_trayecto= '';
$origen= '';
$destino= '';
$distancia= '';


if  (isset($_GET['id_trayecto'])) {
  $id_trayecto = $_GET['id_trayecto'];
  $query = "SELECT * FROM trayecto WHERE id_trayecto=$id_trayecto";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_trayecto = $row['id_trayecto'];
    $origen = $row['origen'];
    $destino = $row['destino'];
    $distancia = $row['distancia'];

  }
}

if (isset($_POST['update'])) {
  $id_trayecto = $_GET['id_trayecto'];
  $origen= $_POST['origen'];
  $destino = $_POST['destino'];
  $distancia = $_POST['distancia'];

  $query = "UPDATE Trayecto set id_trayecto = '$id_trayecto', origen = '$origen', destino = '$destino', distancia = '$distancia' WHERE id_trayecto=$id_trayecto";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionTrayecto.php');
}

?>
<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_trayecto.php?id_trayecto=<?php echo $_GET['id_trayecto']; ?>" method="POST">
        <div class="form-group">
          <input name="origen" type="text" class="form-control" value="<?php echo $origen; ?>" placeholder="cambiar origen">
        </div>
        <div class="form-group">
          <input name="destino" type="text" class="form-control" value="<?php echo $destino; ?>" placeholder="cambiar destino">
        </div>
        <div class="form-group">
          <input name="distancia" type="text" class="form-control" value="<?php echo $distancia; ?>" placeholder="cambiar el numero de la distancia">
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