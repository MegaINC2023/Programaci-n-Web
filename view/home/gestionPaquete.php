<?php include("config\usersDB.php"); ?>

<?php include('includes\header.php'); ?>

<?php
session_start();

if (empty($_SESSION['usuario']) || ($_SESSION['tipo_usuario'] !== 'admin' && $_SESSION['tipo_usuario'] !== 'almacenista')) {
    
    header("Location: acceso_denegado.php");
    exit(); 
}
?>
<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      

      <?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
    </div>
    <?php unset($_SESSION['message']);}?>

      
      <div class="card card-body">
        <form action="save_paquete.php" method="POST">
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
            <input type="text" name="tipo" class="form-control" placeholder="ingresar el tipo del paquete" autofocus required>
          </div>
      
          <label for="fragil">¿El paquete es fragil?</label>
      <select name="fragil" required>
        <option value="Si">Si</option>
        <option value="No">No</option>
      </select>
          
          <div class="form-group">
            <input type="text" name="calle" class="form-control" placeholder="ingresar el nombre de la calle" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="numero" class="form-control" placeholder="ingresar el numero de la calle" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="localidad" class="form-control" placeholder="ingresar la localidad del paquete" autofocus required>
          </div>
          <input type="submit" name="save_paquete" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
    
    <table>
        <thead>
            <tr>
                <th>ID Paquete</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Fragil</th>
                <th>Calle</th>
                <th>Numero</th>
                <th>Localidad</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
  $query = "SELECT Paquete.*, Direccion.*
  FROM Paquete
  JOIN Direccion ON Paquete.id_paquete = Direccion.id_paquete;";
  $result_tasks = mysqli_query($conn, $query);
?>



<tbody>
  <?php
    while ($row = mysqli_fetch_assoc($result_tasks)) {
  ?>
  <tr>
    <td><?php echo $row['id_paquete']; ?></td>
    <td><?php echo $row['estado']; ?></td>
    <td><?php echo $row['tipo']; ?></td>
    <td><?php echo $row['fragil']; ?></td>
    <td><?php echo $row['calle'];?></td>
    <td><?php echo $row['numero'];?></td>
    <td><?php echo $row['localidad'];?></td>
    <td><?php echo $row['fecha_registro'];?></td>
    <td>
    </td>
    <td>
      <a href="edit_paquete.php?id_paquete=<?php echo $row['id_paquete']?>" class="btn btn-secondary">
        <i class="fas fa-marker"></i>
      </a>
      <a href="delete_paquete.php?id_paquete=<?php echo $row['id_paquete']?>" class="btn btn-danger">
        <i class="far fa-trash-alt"></i>
      </a>
    </td>
  </tr>
  <?php
    }
  ?>
</tbody>