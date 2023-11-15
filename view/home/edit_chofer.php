<?php
session_start();


if (empty($_SESSION['usuario']) || ($_SESSION['tipo_usuario'] !== 'admin' && $_SESSION['tipo_usuario'] !== 'almacenista')) {
    header("Location: acceso_denegado.php");
    exit();
}
?>
<?php
include("config\usersDB.php");
$cedula= '';
$licencia= '';
$nombre= '';
$apellido= '';


if  (isset($_GET['cedula'])) {
  $cedula = $_GET['cedula'];
  $query = "SELECT * FROM Chofer WHERE cedula=$cedula";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $cedula = $row['cedula'];
    $licencia = $row['licencia'];
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];

  }
}

if (isset($_POST['update'])) {
  $cedula = $_GET['cedula'];
  $licencia= $_POST['licencia'];
  $nombre= $_POST['nombre'];
  $apellido = $_POST['apellido'];
  


  $query = "UPDATE Chofer set licencia = '$licencia', nombre = '$nombre', apellido = '$apellido' WHERE cedula=$cedula";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionChofer.php');
}

?>
<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_chofer.php?cedula=<?php echo $_GET['cedula']; ?>" method="POST">
        <div class="form-group">
          <input name="licencia" type="text" class="form-control" value="<?php echo $licencia; ?>" placeholder="cambiar licencia del chofer">
        </div>
        <div class="form-group">
          <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="cambiar nombre del chofer">
        </div>
        <div class="form-group">
          <input name="apellido" type="text" class="form-control" value="<?php echo $apellido; ?>" placeholder="cambiar apellido del chofer">
        </div>
        <button class="btn-success" name="update">
          Cambiar
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4 mx-auto">
        <form action="save_asignarC.php" method="POST">
          <div class="form-group">
            <input type="text" name="matricula" class="form-control" placeholder="Matricula" autofocus>
          </div>
          <input type="hidden" name="cedula" value="<?php echo $cedula; ?>">
          <input type="submit" name="save_asignarC" class="btn btn-success btn-block" value="Asignar a camion">
        </form>
      </div>
      <div class="col-md-4 mx-auto">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Cedula</th>
            <th>Matricula</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $queryp = "SELECT matricula FROM Maneja WHERE cedula = $cedula";
          $result_tasks = mysqli_query($conn, $queryp);    

          while ($row = mysqli_fetch_assoc($result_tasks)) {
            ?>
            <tr>
                <td><?php echo $cedula; ?></td> 
                <td><?php echo $row['matricula']; ?></td>
                <td>
                    <a href="delete_asignarC.php?matricula=<?php echo $row['matricula']; ?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

      <?php
$queryDireccion = "SELECT matricula
FROM Camion
WHERE matricula NOT IN (SELECT matricula FROM Maneja);";
$resultDireccion = mysqli_query($conn, $queryDireccion);
?>
<div>
  <h2>Camiones sin asignar</h2>
  <table  class="table table-bordered tabla-paquetes">
    <thead>
      <tr>
        <th>Matriculas</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($resultDireccion)) {
        ?>
        <tr>
          <td><?php echo $row['matricula']; ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include('includes\footer.php'); ?>