<?php include("config\usersDB.php"); ?>

<?php include('includes\header.php'); ?>

<?php
session_start();

if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
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
      <?php session_unset(); } ?>

     
      <div class="card card-body">
        <form action="save_vehiculo.php" method="POST">
          <div class="form-group">
            <input type="text" name="matricula" class="form-control" placeholder="ingresar matricula" autofocus required>
          </div>
          <label for="estado">Ingresar estado del camion</label>
      <select name="estado" required>
        <option value="En viaje">En viaje</option>
        <option value="Fuera de servicio">Fuera de servicio</option>
        <option value="En espera">En espera</option>
      </select>
          <div class="form-group">
            <input type="text" name="licencia" class="form-control" placeholder="ingresar licencia del camion" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="peso_max" class="form-control" placeholder="ingresar peso maximo del camion" autofocus required>
          </div>
          
          <input type="submit" name="save_vehiculo" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Matricula</th>
            <th>Estado</th>
            <th>licencia</th>
            <th>Peso Maximo(KG)</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM Vehiculo";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['matricula']; ?></td>
            <td><?php echo $row['estado']; ?></td>
            <td><?php echo $row['licencia']; ?></td>
            <td><?php echo $row['peso_max']; ?></td>
            <td>
            <a href="<?php echo (strpos($row['matricula'], 'TM') !== false) ? 'asignar_paquete_camioneta.php?matricula=' . $row['matricula'] : 'edit_vehiculo.php?matricula=' . $row['matricula']; ?>" class="btn btn-secondary">
  <i class="fas fa-marker"></i>
</a>
              <a href="delete_vehiculo.php?matricula=<?php echo $row['matricula']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes\footer.php'); ?>