<?php
session_start();
require_once("conn.php");


//Filtros 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['borro'] = 1;
   }
header('Location: tablacitasUsuario.php ')   

?>