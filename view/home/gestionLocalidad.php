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
        <form action="save_localidad.php" method="POST">
          <div class="form-group">
            <input type="text" name="localidad" class="form-control" placeholder="ingresar una localidad" autofocus>
          </div>
          <div class="form-group">
            <input type="text" name="departamento" class="form-control" placeholder="ingresar un departamento" autofocus>
          </div>
          
          <input type="submit" name="save_localidad" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Localidad</th>
            <th>Departamento</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM localidad";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['localidad']; ?></td>
            <td><?php echo $row['departamento']; ?></td>
            <td>
              <a href="edit_localidad.php?localidad=<?php echo $row['localidad']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_localidad.php?localidad=<?php echo $row['localidad']?>" class="btn btn-danger">
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