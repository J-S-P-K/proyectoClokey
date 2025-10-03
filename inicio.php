<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: procesar_login.php");
  exit();
}
?>