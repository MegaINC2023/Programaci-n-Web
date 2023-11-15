<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    
    header("Location: acceso_denegado.php");
    exit();
}
?>
<?php
include("config\usersDB.php");
$matricula = '';
$estado = '';
$licencia = '';
$peso_max = '';

if (isset($_GET['matricula'])) {
  $matricula = $_GET['matricula'];
  $query = "SELECT * FROM Vehiculo WHERE matricula='$matricula'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $matricula = $row['matricula'];
    $estado = $row['estado'];
    $licencia = $row['licencia'];
    $peso_max = $row['peso_max'];
  }
}

if (isset($_POST['update'])) {
  $matricula = $_POST['matricula'];
  $estado = $_POST['estado'];
  $licencia = $_POST['licencia'];
  $peso_max = $_POST['peso_max'];

  
  if (strpos($matricula, 'TM') !== false) {

    $query = "UPDATE Camioneta SET peso_max = '$peso_max' WHERE matricula='$matricula'";
    mysqli_query($conn, $query);
  } else {

    $query = "UPDATE Camion SET peso_max = '$peso_max' WHERE matricula='$matricula'";
    mysqli_query($conn, $query);
  }

  
  $query = "UPDATE Vehiculo SET estado = '$estado', licencia = '$licencia', peso_max = '$peso_max' WHERE matricula='$matricula'";
  mysqli_query($conn, $query);

  $_SESSION['message'] = 'Se modificó correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: gestionVehiculo.php');
}

?>

<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit_vehiculo.php?matricula=<?php echo $_GET['matricula']; ?>" method="POST">
          <div class="form-group">
            <input name="matricula" type="text" class="form-control" value="<?php echo $matricula; ?>" placeholder="Cambiar matricula">
          </div>
          <label for="estado">cambiar estado del camion</label>
      <select name="estado" required>
        <option value="En viaje">En viaje</option>
        <option value="Fuera de servicio">Fuera de servicio</option>
        <option value="En espera">En espera</option>
      </select>
          <div class="form-group">
            <input name="licencia" type="text" class="form-control" value="<?php echo $licencia; ?>" placeholder="Cambiar licencia">
          </div>
          <div class="form-group">
            <input name="peso_max" type="text" class="form-control" value="<?php echo $peso_max; ?>" placeholder="Cambiar peso maximo">
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
    <form action="save_asignarV.php" method="POST">
    <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">
        <div class="form-group">
            <input type="text" name="id_almacen" class="form-control" placeholder="Id Almacen" autofocus require>
        </div>
        <div class="form-group">
            <input type="text" name="id_trayecto" class="form-control" placeholder="id trayecto" autofocus require>
        </div>
        <div class="form-group">
            <input type="text" name="id_lote" class="form-control" placeholder="Id lote" autofocus require>
        </div>
        <input type="submit" name="save_asignarV" class="btn btn-success btn-block" value="Asignar ruta y lotes">
    </form>
</div>


<div class="col-md-4 mx-auto">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Trayecto</th>
                <th>ID Almacen Destino</th>
                <th>ID Lote</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $queryp = "SELECT * FROM Realiza WHERE matricula = '$matricula'";
            $result_tasks = mysqli_query($conn, $queryp);

            while ($row = mysqli_fetch_assoc($result_tasks)) {
                ?>
                <tr>
                    <td><?php echo $row['id_trayecto']; ?></td>
                    <td><?php echo $row['id_almacen']; ?></td>
                    <td><?php echo $row['id_lote']; ?></td>
                    <td>
                        <a href="delete_asignarV.php?id_trayecto=<?php echo $row['id_trayecto']; ?>&id_almacen=<?php echo $row['id_almacen']; ?>&id_lote=<?php echo $row['id_lote']; ?>" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
$queryTrayecto = "SELECT id_trayecto, origen, destino FROM trayecto";
$resultTrayecto = mysqli_query($conn, $queryTrayecto);

$queryLotesSinAsignar = "SELECT l.id_lote, l.almacen_destino
                         FROM Lote AS l
                         LEFT JOIN Realiza AS r ON l.id_lote = r.id_lote
                         WHERE r.id_lote IS NULL";
$resultLotesSinAsignar = mysqli_query($conn, $queryLotesSinAsignar);
?>

<div>
  <h2>Trayecto</h2>
  <table class="table table-bordered tabla-paquetes">
    <thead>
      <tr>
        <th>ID Trayecto</th>
        <th>Origen</th>
        <th>Destino</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($resultTrayecto)) {
        ?>
        <tr>
          <td><?php echo $row['id_trayecto']; ?></td>
          <td><?php echo $row['origen']; ?></td>
          <td><?php echo $row['destino']; ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>

<div>
  <h2>Lotes sin Asignar</h2>
  <table>
    <thead>
      <tr>
        <th>ID Lote</th>
        <th>Almacen Destino del Lote</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($resultLotesSinAsignar)) {
        ?>
        <tr>
          <td><?php echo $row['id_lote']; ?></td>
          <td><?php echo $row['almacen_destino']; ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include('includes\footer.php'); ?>