<?php


$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'login'
) or die(mysqli_erro($mysqli));

?>
<?php
include('c://xampp/htdocs/Programacion-Web/config/db.php');

$cedula = '';
$contraseña= '';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM usuarios WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $cedula = $row['cedula'];
    // La contraseña no se almacena directamente en la variable $contraseña.
    // Esto se debe a que la contraseña nunca se muestra ni se edita directamente en su forma encriptada.
  }
  
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $cedula = $_POST['cedula'];
  $nuevaContraseña = $_POST['contraseña'];

  // Encriptar la nueva contraseña antes de almacenarla en la base de datos
  $hashContraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);

  $query = "UPDATE usuarios SET cedula = '$cedula', password = '$hashContraseña' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: signup.php');
}

include('includes/header.php');
?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input name="cedula" type="text" class="form-control" value="<?php echo $cedula; ?>" placeholder="Cambiar Cedula">
          </div>
          <div class="form-group">
            <input name="contraseña" type="password" class="form-control" placeholder="Nueva Contraseña">
          </div>
          <button class="btn-success" name="update">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>