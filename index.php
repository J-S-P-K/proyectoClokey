<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registro con QR</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://unpkg.com/html5-qrcode"></script>
  <style>
    body {
      background: linear-gradient(135deg, #dbeafe, #f0f9ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Segoe UI", sans-serif;
    }

    .card {
      max-width: 500px;
      width: 100%;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    #qr-reader {
      width: 100%;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      margin-bottom: 20px;
    }

    .form-control {
      background-color: #f0f9ff;
      border-radius: 12px;
      border: 1px solid #cbd5e1;
    }

    .form-check-label {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      background: #f8fafc;
      padding: 10px 15px;
      border-radius: 10px;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.06);
    }

    .form-switch .form-check-input {
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="card text-center">
    <h2 class="mb-4 text-primary"><i class="bi bi-qr-code-scan"></i> Registro de Asistencia</h2>

    <div id="qr-reader"></div>

    <form id="registroForm" method="POST" action="index.php">
      <input type="text" id="qr-result" name="nombre" class="form-control mt-3" placeholder="Resultado del QR..." readonly required />

      <div class="mt-4 d-grid gap-3 text-start">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="tarde" name="tarde" value="1" />
          <label class="form-check-label" for="tarde">Llegó tarde</label>
        </div>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="leche" name="leche" value="1" />
          <label class="form-check-label" for="leche">Toma leche</label>
        </div>

        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="pan" name="pan" value="1" />
          <label class="form-check-label" for="pan">Come pan</label>
        </div>
      </div>

      <button type="submit" class="btn btn-primary mt-4 w-100" id="btnEnviar" disabled>
        <i class="bi bi-send-fill"></i> Enviar registro
      </button>
    </form>
  </div>
  
<?php

// Cambiá estos datos con los de tu base de datos
$servername = "localhost ";
$username = "root";
$password = "";
$dbname = "registros";

// Crear conexión
$conn =  mysqli_connect ($servername, $username, $password, $dbname);

// Chequear conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
$tarde = isset($_POST['tarde']) ? 1 : 0;
$leche = isset($_POST['leche']) ? 1 : 0;
$pan = isset($_POST['pan']) ? 1 : 0;

// Validar que haya nombre
if (empty($nombre)) {
    die("Error: el nombre no puede estar vacío.");
}

// Preparar y ejecutar consulta para insertar registro
$sql = "INSERT INTO asistencia (nombre, llego_tarde, toma_leche, come_pan, fecha_registro) VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("siii", $nombre, $tarde, $leche, $pan);

if ($stmt->execute()) {
    echo "<h2>Registro guardado con éxito.</h2>";
    echo "<p><a href='registro_qr.html'>Volver</a></p>";
} else {
    echo "Error al guardar el registro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

  <script>
    const resultInput = document.getElementById("qr-result");
    const btnEnviar = document.getElementById("btnEnviar");
    let lastResult = null;
    let lastScanTime = 0;
    const minDelay = 3000;

    function onScanSuccess(decodedText, decodedResult) {
      const now = Date.now();
      if (decodedText !== lastResult || now - lastScanTime > minDelay) {
        lastResult = decodedText;
        lastScanTime = now;
        resultInput.value = decodedText;
        btnEnviar.disabled = false;
        console.log("QR leído:", decodedText);
      }
    }

    const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
      fps: 10,
      qrbox: 250,
      rememberLastUsedCamera: true,
      aspectRatio: 1,
    });

    html5QrcodeScanner.render(onScanSuccess);
  </script>

</body>
</html>