<?php include("config\usersDB.php"); ?>

<?php include('includes\header.php'); ?>

<?php
session_start();

// Verificar si el usuario ha iniciado sesión y es de tipo "admin"
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    // Redirigir a otra página (puedes cambiar la ruta según tus necesidades)
    header("Location: acceso_denegado.php");
    exit(); // Asegúrate de detener la ejecución del script después de la redirección
}
?>
<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_trayecto.php" method="POST">
        <div class="form-group">
            <input type="text" name="origen" class="form-control" placeholder="ingresar punto de origen" autofocus required>
          </div>
        <div class="form-group">
            <input type="text" name="destino" class="form-control" placeholder="ingresar el destino" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="distancia" class="form-control" placeholder="ingresar la distancia" autofocus required>
          </div>
          <input type="submit" name="save_trayecto" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID Trayecto</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Distancia(KM)</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM trayecto";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id_trayecto']; ?></td>
            <td><?php echo $row['origen']; ?></td>
            <td><?php echo $row['destino']; ?></td>
            <td><?php echo $row['distancia']; ?></td>
            <td>
              <a href="edit_trayecto.php?id_trayecto=<?php echo $row['id_trayecto']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_trayecto.php?id_trayecto=<?php echo $row['id_trayecto']?>" class="btn btn-danger">
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