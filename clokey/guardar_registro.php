<?php
// Datos de conexión (modificá según tu config)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Revisar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos POST
$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
$curso = isset($_POST['curso']) ? $conn->real_escape_string($_POST['curso']) : '';
$tarde = isset($_POST['tarde']) ? 1 : 0;
$leche = isset($_POST['leche']) ? 1 : 0;
$pan = isset($_POST['pan']) ? 1 : 0;

// Validar datos básicos
if (empty($nombre) || empty($curso)) {
    die("Error: Nombre y curso son obligatorios.");
}

// Insertar en la tabla (ajustá los nombres de columnas según tu tabla)
$sql = "INSERT INTO asistencia (alumno, curso, llegada_tarde, toma_leche, come_pan, fecha) VALUES (?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la preparación: " . $conn->error);
}

// "ssiii" = string, string, int, int, int
$stmt->bind_param("ssiii", $nombre, $curso, $tarde, $leche, $pan);

if ($stmt->execute()) {
    echo "ok";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>