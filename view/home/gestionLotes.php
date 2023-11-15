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
    <?php unset($_SESSION['message']);}?>

      
      <div class="card card-body">
  <form action="save_lotes.php" method="POST">
    <div class="form-group">
      <label for="estado">Estado del lote:</label>
      <select name="estado" required>
        <option value="En espera">En espera</option>
        <option value="Recogido">Recogido</option>
        <option value="Armado">Armado</option>
        <option value="En viaje">En viaje</option>
        <option value="En transbordo">En transbordo</option>
        <option value="Entregado">Entregado</option>
        <option value="Fallo entrega">Fallo entrega</option>
      </select>
    </div>
    <div class="form-group">
      <input type="text" name="peso" class="form-control" placeholder="Ingresar el peso del lote" autofocus required>
    </div>
    <div class="form-group">
      <input type="text" name="almacen_destino" class="form-control" placeholder="ID del almacén destino" autofocus required>
    </div>

    <input type="submit" name="save_lotes" class="btn btn-success btn-block" value="Guardar">
  </form>
</div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id lote</th>
            <th>Estado</th>
            <th>Peso(KG)</th>
            <th>Almacen Destino</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM Lote";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id_lote']; ?></td>
            <td><?php echo $row['estado']; ?></td>
            <td><?php echo $row['peso']; ?></td>
            <td><?php echo $row['almacen_destino']; ?></td>
            <td>
              <a href="edit_lotes.php?id_lote=<?php echo $row['id_lote']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_lotes.php?id_lote=<?php echo $row['id_lote']?>" class="btn btn-danger">
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

