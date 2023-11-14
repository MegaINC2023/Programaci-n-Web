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
        <form action="save_usuario.php" method="POST">
        <div class="form-group">
            <input type="text" name="cedula" class="form-control" placeholder="ingresar cedula del usuario" autofocus required>
          </div>
          <label for="tipo_de_usuario">Ingresar tipo de usuario</label>
      <select name="tipo_de_usuario" required>
        <option value="admin">admin</option>
        <option value="chofer">chofer</option>
        <option value="almacenista">almacenista</option>
        <option value="administracion">administracion</option>
      </select>
          <div class="form-group">
            <input type="text" name="contraseña" class="form-control" placeholder="ingresar contraseña del usuario" autofocus required> 
          </div>
          <input type="submit" name="save_usuario" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID Usuario</th>
            <th>Cedula</th>
            <th>Tipo de usuario</th>
            <th>Contraseña</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM login";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id_usuario']; ?></td>
            <td><?php echo $row['cedula']; ?></td>
            <td><?php echo $row['tipo_de_usuario']; ?></td>
            <td><?php echo $row['contraseña']; ?></td>
            <td>
              <a href="edit_usuario.php?id_usuario=<?php echo $row['id_usuario']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_usuario.php?id_usuario=<?php echo $row['id_usuario']?>" class="btn btn-danger">
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