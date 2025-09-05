<?php
//session_start();
//if (!isset($_SESSION['usuario'])) {
  //header("Location: procesar_login.php");
  //exit();
//}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel Preceptor - Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background: #f0f9ff;
      font-family: "Segoe UI", sans-serif;
    }

    .curso-card {
      cursor: pointer;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
      text-align: center;
      transition: transform 0.2s ease;
      background: white;
    }

    .curso-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Panel Preceptor</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-three-dots-vertical"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="menuDropdown">
            <li><a class="dropdown-item" href="inicio.php">🏠 Inicio</a></li>
            <li><a class="dropdown-item" href="registro_qr.html">📷 Escanear QR</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item text-danger" href="logout.php">🚪 Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido -->
<div class="container pt-5 mt-5">
  <h3 class="mb-4 text-primary">Cursos Disponibles</h3>
  <div class="row g-4">
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">1°A</div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">1°B</div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">2°A</div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">2°B</div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">3°A</div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">3°B</div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">4°A</div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="curso-card">4°B</div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
