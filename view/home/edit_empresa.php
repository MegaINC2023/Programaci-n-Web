<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("Location: acceso_denegado.php");
    exit(); 
}
?>
<?php
include("config\usersDB.php");
$id_empresa = '';
$empresa = '';

if (isset($_GET['id_empresa'])) {
  $id_empresa = $_GET['id_empresa'];
  $query = "SELECT * FROM Empresa WHERE id_empresa='$id_empresa'"; 
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id_empresa = $row['id_empresa'];
    $empresa = $row['empresa'];
  }
}

if (isset($_POST['update'])) {
  $id_empresa = $_POST['id_empresa']; 
  $empresa = $_POST['empresa'];

  $query = "UPDATE Empresa SET empresa = ? WHERE id_empresa = ?";
  
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'si', $empresa, $id_empresa);
  
  if (mysqli_stmt_execute($stmt)) {
      $_SESSION['message'] = 'Se modificó correctamente';
      $_SESSION['message_type'] = 'warning';
      header('Location: gestionEmpresa.php' );
  }

  mysqli_stmt_close($stmt);
}

?>

<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit_empresa.php?id_empresa=<?php echo $_GET['id_empresa']; ?>" method="POST">
          <div class="form-group">
            <input name="empresa" type="text" class="form-control" value="<?php echo $empresa; ?>" placeholder="Cambiar empresa asignada a esa id">
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