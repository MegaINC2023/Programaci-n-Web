<?php
include("config/usersDB.php");

if (isset($_GET['id_paquete'])) {
  $id_paquete = $_GET['id_paquete'];

  // Realizamos una consulta para obtener los datos actuales del paquete y la dirección
  $query = "SELECT paquete.*, direccion.calle, direccion.numero, direccion.localidad FROM paquete JOIN direccion ON paquete.id_paquete = direccion.id_paquete WHERE paquete.id_paquete = $id_paquete";
  $result = mysqli_query($conn, $query);
  
  if ($row = mysqli_fetch_assoc($result)) {
      // Asignamos los valores a las variables
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

    // Recopilamos los datos del formulario
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];
    $fragil = $_POST['fragil'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $localidad = $_POST['localidad'];

    // Realizamos una consulta para verificar qué campos se han modificado
    $query = "SELECT estado, tipo, fragil FROM paquete WHERE id_paquete = $id_paquete";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Verificamos y actualizamos los campos en la tabla "paquete" si es necesario
    if ($row['estado'] != $estado || $row['tipo'] != $tipo || $row['fragil'] != $fragil) {
        $update_query = "UPDATE paquete SET estado = '$estado', tipo = '$tipo', fragil = '$fragil' WHERE id_paquete = $id_paquete";
        mysqli_query($conn, $update_query);
    }

    // Realizamos una consulta para verificar qué campos se han modificado en la tabla "direccion"
    $query = "SELECT calle, numero, localidad FROM direccion WHERE id_paquete = $id_paquete";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Verificamos y actualizamos los campos en la tabla "direccion" si es necesario
    if ($row['calle'] != $calle || $row['numero'] != $numero || $row['localidad'] != $localidad) {
        $update_query = "UPDATE direccion SET calle = '$calle', numero = '$numero', localidad = '$localidad' WHERE id_paquete = $id_paquete";
        mysqli_query($conn, $update_query);
    }

    // Redireccionamos o mostramos un mensaje de éxito
    $_SESSION['message'] = 'Cambios guardados exitosamente';
    $_SESSION['message_type'] = 'success';

    header('Location: gestionPaquete.php'); // Cambia "index.php" a la página a la que desees redirigir después de guardar.
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
        <div class="form-group">
          <input name="fragil" type="text" class="form-control" value="<?php echo $fragil; ?>" placeholder="fragil">
        </div>
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