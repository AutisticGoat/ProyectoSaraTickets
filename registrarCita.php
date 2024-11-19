<?php

require_once("conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $idProblema = $_POST['idProblema'];
    $idUsuario = $_POST['idUsuario'];
    $idMantenimiento = $_POST['idMantenimiento'];
    $fecha = $_POST['fecha'];

    $queryRC = $conn->prepare("INSERT INTO citas (IdUsuario,IdMantenimiento,IdProblema,FechaAgendada) values (?,?,?,?)");
    $queryRC -> bind_param("iiis",$idUsuario,$idMantenimiento,$idProblema,$fecha);

    if($queryRC->execute())
    {
        echo'<script>window.alert("Cita registrada correctamente")</script>';
        header('Location: tablareporteMantenimiento.php');
    }
    else
    {
        echo'<script>window.alert("Error: '.htmlspecialchars($conn->error).'")</script>';
        header('Location: tablareporteMantenimiento.php');
    }



}


?>