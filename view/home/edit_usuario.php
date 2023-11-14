<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
   
    header("Location: acceso_denegado.php");
    exit(); 
}
?>
<?php
include("config\usersDB.php");
$cedula= '';
$tipo_de_usuario= '';
$contraseña= '';



if  (isset($_GET['id_usuario'])) {
  $id_usuario = $_GET['id_usuario'];
  $query = "SELECT * FROM login WHERE id_usuario=$id_usuario";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $cedula = $row['cedula'];
    $tipo_de_usuario = $row['tipo_de_usuario'];
    $contraseña = $row['contraseña'];

  }
}

if (isset($_POST['update'])) {
  $id_usuario = $_GET['id_usuario'];
  $cedula= $_POST['cedula'];
  $tipo_de_usuario= $_POST['tipo_de_usuario'];
  $contraseña= $_POST['contraseña'];
  $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

  


  $query = "UPDATE login set cedula = '$cedula', tipo_de_usuario = '$tipo_de_usuario', contraseña = '$hashed_password' WHERE id_usuario=$id_usuario";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionUsuario.php');
}

?>
<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_usuario.php?id_usuario=<?php echo $_GET['id_usuario']; ?>" method="POST">
        <div class="form-group">
          <input name="cedula" type="text" class="form-control" value="<?php echo $cedula; ?>" placeholder="cambiar cedula del usuario">
        </div>
        <label for="tipo_de_usuario">cambiar tipo de usuario</label>
      <select name="tipo_de_usuario" required>
        <option value="admin">admin</option>
        <option value="chofer">chofer</option>
        <option value="almacenista">almacenista</option>
        <option value="administracion">administracion</option>
      </select>
        <div class="form-group">
          <input name="contraseña" type="text" class="form-control" value="<?php echo $contraseña; ?>" placeholder="cambiar contraseña del usuario">
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