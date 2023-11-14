<?php
session_start();


if (empty($_SESSION['usuario']) || ($_SESSION['tipo_usuario'] !== 'admin' && $_SESSION['tipo_usuario'] !== 'almacenista')) {
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
          <div class="form-group">
            <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="Cambiar estado">
          </div>
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
    <form action="save_asignarP.php" method="POST">
    <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">
        <div class="form-group">
            <input type="text" name="id_paquete" class="form-control" placeholder="ID Paquete" autofocus require>
        </div>
        <input type="submit" name="save_asignarP" class="btn btn-success btn-block" value="Asignar paquete a camioneta">
    </form>
</div>


<div class="col-md-4 mx-auto">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Paquete</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $queryp = "SELECT * FROM entrega WHERE matricula = '$matricula'";
            $result_tasks = mysqli_query($conn, $queryp);

            while ($row = mysqli_fetch_assoc($result_tasks)) {
                ?>
                <tr>
                    <td><?php echo $row['id_paquete']; ?></td>
                    <td>
                    <a href="delete_asignarP.php?matricula=<?php echo $row['matricula']; ?>&id_paquete=<?php echo $row['id_paquete']; ?>" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include('config\usersDB.php');

$query = "SELECT p.id_paquete
          FROM paquete p
          WHERE NOT EXISTS (
              SELECT 1
              FROM entrega e
              WHERE e.id_paquete = p.id_paquete
          )";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<div>
  <h2>Paquetes no asignados a camioneta</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID Paquete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <td><?php echo $row['id_paquete']; ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>

<?php
mysqli_close($conn);
?>