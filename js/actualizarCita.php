<?php

require_once("conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $id = $_POST['id'];
    $estatus = $_POST['estatus'];
    $comentario = $_POST['comentario'];

    $queryAC = $conn->prepare("UPDATE citas SET Estatus = ?, Comentario = ? WHERE ID = ? ");
    $queryAC->bind_param("ssi", $estatus,$comentario,$id);

    if($queryAC->execute())
    {
        echo'<script>window.alert("Cita actualizada correctamente")</script>';
        header('Location: tablacitasUsuario.php');
    }
    else
    {
        echo'<script>window.alert("Error: '.htmlspecialchars($conn->error).'")</script>';
        header('Location: tablacitasUsuario.php');

    }

}


?>