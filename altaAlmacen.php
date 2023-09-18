<?php include("config\usersDB.php"); ?>

<?php include('view\home\includes\header.php'); ?>

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
        <form action="save_almacen.php" method="POST">
          <div class="form-group">
            <input type="text" name="empresa" class="form-control" placeholder="ingresar empresa del almacen" autofocus>
          </div>
          <div class="form-group">
            <input type="text" name="nomb_calle" class="form-control" placeholder="ingresar el nombre de la calle" autofocus>
          </div>
          <div class="form-group">
            <input type="text" name="num_calle" class="form-control" placeholder="ingresar el numero de la calle" autofocus>
          </div>
          <div class="form-group">
            <input type="text" name="localidad" class="form-control" placeholder="ingresar la localidad" autofocus>
          </div>
          
          <input type="submit" name="save_almacen" class="btn btn-success btn-block" value="Save Task">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id Almacen</th>
            <th>Empresa</th>
            <th>Nombre de la calle</th>
            <th>Numero de la calle</th>
            <th>Localidad</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM almacen";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id_almacen']; ?></td>
            <td><?php echo $row['empresa']; ?></td>
            <td><?php echo $row['nomb_calle']; ?></td>
            <td><?php echo $row['num_calle']; ?></td>
            <td><?php echo $row['localidad']; ?></td>
            <td>
              <a href="edit_almacen.php?id_almacen=<?php echo $row['id_almacen']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_almacen.php?id_almacen=<?php echo $row['id_almacen']?>" class="btn btn-danger">
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

<?php include('view\home\includes\footer.php'); ?>