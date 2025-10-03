<?php
session_start(); //Inicia la sesión
if (!isset($_SESSION['usuario'])) { //
  header("Location: index.php");
  exit();
}
?>

<!--  -->
<!DOCTYPE html> 
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Preceptores</title>
  <meta http-equiv="refresh" content="0;url=registro_qr.html" />
</head>
<body>
  Redirigiendo...
</body>
</html>
