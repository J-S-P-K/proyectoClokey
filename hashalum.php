
<?php
// datos conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros";

// conectar
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// datos para crear alumno (editá acá abajo)
$nombre = "Abril Bedrij";
$gmail = "bedrijchagas.abril@esim.edu.ar";
$contrasenaPlano = "B#48891251";

// crear hash
$hash = password_hash($contrasenaPlano, PASSWORD_DEFAULT);

// preparar insert
$sql = "INSERT INTO alumnos (nombre, gmail, contrasena) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $gmail, $hash);

if ($stmt->execute()) {
  echo "Alumno creado con éxito";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
