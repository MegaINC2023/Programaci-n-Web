<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    // Redirigir a otra página (puedes cambiar la ruta según tus necesidades)
    header("Location: acceso_denegado.php");
    exit(); // Asegúrate de detener la ejecución del script después de la redirección
}
?>
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
<div class="col-md-4 mx-auto">
    <form action="save_asignarT.php" method="POST">
        <div class="form-group">
            <input type="text" name="id_almacen" class="form-control" placeholder="Id Almacen" autofocus>
        </div>
        <div class="form-group">
            <input type="text" name="posicion" class="form-control" placeholder="Posición del almacén en trayecto" autofocus>
        </div>
        <input type="hidden" name="id_trayecto" value="<?php echo $id_trayecto; ?>">
        <input type="submit" name="save_asignarT" class="btn btn-success btn-block" value="Asignar almacén a trayecto">
    </form>
</div>
<div class="col-md-4 mx-auto">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id Trayecto</th>
                <th>Id Almacen</th>
                <th>Posición</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $queryp = "SELECT * FROM tiene WHERE id_trayecto = $id_trayecto;";
            $result_tasks = mysqli_query($conn, $queryp);

            while ($row = mysqli_fetch_assoc($result_tasks)) {
                ?>
                <tr>
                    <td><?php echo $id_trayecto; ?></td>
                    <td><?php echo $row['id_almacen']; ?></td>
                    <td><?php echo $row['posicion']; ?></td>
                    <td>
                        <a href="delete_asignarT.php?id_trayecto=<?php echo $row['id_trayecto']; ?>&posicion=<?php echo $row['posicion']; ?>" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
// Mostrar tabla de dirección
$queryDireccion = "SELECT A.id_almacen, A.localidad, L.departamento
FROM almacen AS A
INNER JOIN localidad AS L ON A.localidad = L.localidad;";
$resultDireccion = mysqli_query($conn, $queryDireccion);
?>
<div>
  <h2>Almacenes</h2>
  <table>
    <thead>
      <tr>
        <th>ID Almacen</th>
        <th>Localidad</th>
        <th>Departamento</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($resultDireccion)) {
        ?>
        <tr>
          <td><?php echo $row['id_almacen']; ?></td>
          <td><?php echo $row['localidad']; ?></td>
          <td><?php echo $row['departamento']; ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include('includes\footer.php'); ?>