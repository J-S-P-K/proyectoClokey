<?php
session_start(); //Inicia la sesión
session_destroy(); //Cierra la sesión XD
header("Location: index.php"); //Vuelve a index.php
exit();