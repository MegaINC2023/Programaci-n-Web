<?php include("config\usersDB.php"); ?>

<?php include('includes\header.php'); ?>

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
        <form action="save_paquete.php" method="POST">
          <div class="form-group">
            <input type="text" name="estado" class="form-control" placeholder="ingresar estado del paquete" autofocus>
          </div>
          <div class="form-group">
            <input type="text" name="tipo" class="form-control" placeholder="ingresar el tipo del paquete" autofocus>
          </div>
          <div class="form-group">
            <input type="text" name="fragil" class="form-control" placeholder="¿El paquete es fragil?" autofocus>
          </div>
          <input type="submit" name="save_paquete" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id Paquete</th>
            <th>Estado</th>
            <th>Nombre de la calle</th>
            <th>Numero de la calle</th>
            <th>Departamento</th>
            <th>Localidad</th>
            <th>Fecha de registro</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM paquete";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id_paquete']; ?></td>
            <td><?php echo $row['estado']; ?></td>
            <td><?php echo $row['nomb_calle']; ?></td>
            <td><?php echo $row['num_calle']; ?></td>
            <td><?php echo $row['departamento']; ?></td>
            <td><?php echo $row['localidad']; ?></td>
            <td><?php echo $row['fecha_registro']; ?></td>
            <td>
              <a href="edit_paquete.php?id_paquete=<?php echo $row['id_paquete']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_paquete.php?id_paquete=<?php echo $row['id_paquete']?>" class="btn btn-danger">
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