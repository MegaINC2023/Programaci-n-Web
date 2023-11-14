<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_empresa'])) {
  $id_empresa = $_POST['id_empresa'];
  $empresa = $_POST['empresa'];

  
  $query = "INSERT INTO Empresa(id_empresa, empresa) VALUES (?, ?)";
  $stmt = mysqli_prepare($conn, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ss', $id_empresa, $empresa);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
      $_SESSION['message'] = 'Se guardó correctamente';
      $_SESSION['message_type'] = 'success';
      header('Location: gestionEmpresa.php');
    } else {
      
      $_SESSION['message'] = 'Error al guardar la empresa';
      $_SESSION['message_type'] = 'danger';
     
      header('Location: error.php');
    }

    mysqli_stmt_close($stmt);
  } else {
    
    $_SESSION['message'] = 'Error interno al intentar guardar la empresa';
    $_SESSION['message_type'] = 'danger';
    
    header('Location: error.php');
  }
}
?>