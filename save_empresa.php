<?php

include('config\usersDB.php');

if (isset($_POST['save_empresa'])) {
  $id_empresa = $_POST['id_empresa'];
  $empresa = $_POST['empresa'];
  $query = "INSERT INTO Empresa(id_empresa, empresa) VALUES ('$id_empresa', '$empresa')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionEmpresa.php');

}

?>