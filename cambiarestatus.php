<?php
session_start();
require_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $estatus = $_POST['estatus'];
    $id = $_POST['id'];

    $queryCE = $conn->prepare("UPDATE problema SET Estatus = ? WHERE ID = ? ");
    $queryCE->bind_param("si",$estatus,$id);
    if ($queryCE->execute())
    {
        header('Location: tablareporteMantenimiento.php');
    }
    else
    {
        echo'<script>window.alert("Error: '.htmlspecialchars($conn->error).'")</script>';
        header('Location: tablareporteMantenimiento.php');
    }



}


?>