<?php
session_start();


if (empty($_SESSION['usuario']) || ($_SESSION['tipo_usuario'] !== 'admin' && $_SESSION['tipo_usuario'] !== 'almacenista')) {
    header("Location: acceso_denegado.php");
    exit(); 
}
?>
<?php
include("config/usersDB.php");

if (isset($_GET['id_paquete'])) {
  $id_paquete = $_GET['id_paquete'];

 
  $query = "SELECT paquete.*, direccion.calle, direccion.numero, direccion.localidad FROM paquete JOIN direccion ON paquete.id_paquete = direccion.id_paquete WHERE paquete.id_paquete = $id_paquete";
  $result = mysqli_query($conn, $query);
  
  if ($row = mysqli_fetch_assoc($result)) {
      
      $estado = $row['estado'];
      $tipo = $row['tipo'];
      $fragil = $row['fragil'];
      $calle = $row['calle'];
      $numero = $row['numero'];
      $localidad = $row['localidad'];
  }
}
if (isset($_POST['update'])) {
    $id_paquete = $_GET['id_paquete'];

    
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];
    $fragil = $_POST['fragil'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $localidad = $_POST['localidad'];

    
    $query = "SELECT estado, tipo, fragil FROM paquete WHERE id_paquete = $id_paquete";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

   
    if ($row['estado'] != $estado || $row['tipo'] != $tipo || $row['fragil'] != $fragil) {
        $update_query = "UPDATE paquete SET estado = '$estado', tipo = '$tipo', fragil = '$fragil' WHERE id_paquete = $id_paquete";
        mysqli_query($conn, $update_query);
    }

    
    $query = "SELECT calle, numero, localidad FROM direccion WHERE id_paquete = $id_paquete";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    
    if ($row['calle'] != $calle || $row['numero'] != $numero || $row['localidad'] != $localidad) {
        $update_query = "UPDATE direccion SET calle = '$calle', numero = '$numero', localidad = '$localidad' WHERE id_paquete = $id_paquete";
        mysqli_query($conn, $update_query);
    }

    
    $_SESSION['message'] = 'Cambios guardados exitosamente';
    $_SESSION['message_type'] = 'success';

    header('Location: gestionPaquete.php');
}
?>
<?php include('includes\header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_paquete.php?id_paquete=<?php echo $_GET['id_paquete']; ?>" method="POST">
      <label for="estado">Estado del Paquete:</label>
      <select name="estado" required>
        <option value="En espera">En espera</option>
        <option value="Recogido">Recogido</option>
        <option value="En almacen destino">En almacen destino</option>
        <option value="En viaje">En viaje</option>
        <option value="En almacen central">En almacen central</option>
        <option value="Entregado">Entregado</option>
        <option value="Fallo entrega">Fallo entrega</option>
      </select>
        <div class="form-group">
          <input name="tipo" type="text" class="form-control" value="<?php echo $tipo; ?>" placeholder="tipo">
        </div>
        <label for="fragil">¿El paquete es fragil?</label>
      <select name="fragil" required>
        <option value="Si">Si</option>
        <option value="No">No</option>
      </select>
        <div class="form-group">
          <input name="calle" type="text" class="form-control" value="<?php echo $calle; ?>" placeholder="cambiar calle">
        </div>
        <div class="form-group">
          <input name="numero" type="text" class="form-control" value="<?php echo $numero; ?>" placeholder="numero de calle">
        </div>
        <div class="form-group">
          <input name="localidad" type="text" class="form-control" value="<?php echo $localidad; ?>" placeholder="localidad">
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