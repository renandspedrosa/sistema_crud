<?php
session_start(); //deve iniciar mesmo se for deslogar
session_destroy();
header("Location: index.php"); exit;
?>