<?php
include("config\usersDB.php");
$matricula = '';
$estado = '';
$pesoMax = '';

if (isset($_GET['matricula'])) {
  $matricula = $_GET['matricula'];
  $query = "SELECT * FROM camion WHERE matricula='$matricula'"; // Añade comillas simples alrededor de '$matricula'
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $matricula = $row['matricula'];
    $estado = $row['estado'];
    $pesoMax = $row['pesoMax'];
  }
}

if (isset($_POST['update'])) {
  $matricula = $_POST['matricula']; // Obtén la matrícula de la URL
  $estado = $_POST['estado'];
  $pesoMax = $_POST['pesoMax'];

  $query = "UPDATE camion SET estado = '$estado', pesoMax = '$pesoMax' WHERE matricula='$matricula'"; // Añade comillas simples alrededor de '$matricula'
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionCamion.php');
}

?>

<?php include('view\home\includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit_camiones.php?matricula=<?php echo $_GET['matricula']; ?>" method="POST">
          <div class="form-group">
            <input name="matricula" type="text" class="form-control" value="<?php echo $matricula; ?>" placeholder="Cambiar matricula">
          </div>
          <div class="form-group">
            <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="Cambiar estado">
          </div>
          <div class="form-group">
            <input name="pesoMax" type="text" class="form-control" value="<?php echo $pesoMax; ?>" placeholder="Cambiar peso maximo">
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