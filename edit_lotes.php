<?php
include("config\usersDB.php");
$estado= '';
$peso= '';

if  (isset($_GET['id_lotes'])) {
  $id_lotes = $_GET['id_lotes'];
  $query = "SELECT * FROM lotes WHERE id_lotes=$id_lotes";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_lotes = $row['id_lotes'];
    $estado = $row['estado'];
    $peso = $row['peso'];
  }
}

if (isset($_POST['update'])) {
  $id_lotes = $_GET['id_lotes'];
  $estado= $_POST['estado'];
  $peso = $_POST['peso'];

  $query = "UPDATE lotes set estado = '$estado', peso = '$peso' WHERE id_lotes=$id_lotes";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionLotes.php');
}

?>
<?php include('view\home\includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_lotes.php?id_lotes=<?php echo $_GET['id_lotes']; ?>" method="POST">
        <div class="form-group">
          <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="cambiar estado">
        </div>
        <div class="form-group">
          <input name="peso" type="text" class="form-control" value="<?php echo $peso; ?>" placeholder="cambiar peso">
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