<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

echo "<pre>";
echo "Usuario recibido: $usuario\n";
echo "Contraseña recibida: $contrasena\n";

// Buscamos en preceptores
$sql_preceptor = "SELECT * FROM preceptores WHERE usuario = ?";
$stmt = $conn->prepare($sql_preceptor);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  echo "Encontró preceptor\n";
  $row = $result->fetch_assoc();
  if (password_verify($contrasena, $row['contrasena'])) {
    echo "Contraseña preceptor OK\n";
    $_SESSION['usuario'] = $usuario;
    $_SESSION['rol'] = 'preceptor';
    header("Location: inicio.php");
    exit();
  } else {
    echo "Contraseña preceptor INCORRECTA\n";
  }
} else {
  echo "No encontró preceptor\n";
}

// Buscamos en alumnos
$sql_alumno = "SELECT * FROM alumnos WHERE gmail = ?";
$stmt = $conn->prepare($sql_alumno);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  echo "Encontró alumno\n";
  $row = $result->fetch_assoc();
  if (password_verify($contrasena, $row['contrasena'])) {
    echo "Contraseña alumno OK\n";
    $_SESSION['usuario'] = $usuario;
    $_SESSION['rol'] = 'alumno';
    $_SESSION['nombre_alumno'] = $row['nombre'];
    header("Location: inicio_alumnos.php");
    exit();
  } else {
    echo "Contraseña alumno INCORRECTA\n";
  }
} else {
  echo "No encontró alumno\n";
}

echo "Usuario o contraseña incorrectos";
echo "<p><a href='index.php'>Volver</a></p>";
?>