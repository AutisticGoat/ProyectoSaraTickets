<?php

require_once("conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$nombreUsuario = $_POST['Usuario'];
$contraseña = $_POST['Contraseña'];

//SECRETO ADMIN!!!!!!!!!!!!!!!!!!//


    $querySA = $conn-> prepare("SELECT * FROM usuario WHERE Nombre = ? AND Contraseña = 'secretoAdmin'");
    $querySA->bind_param("s",$nombreUsuario);
    $querySA->execute();
    $result = $querySA->get_result();
    $row = $result->fetch_assoc();
    if (!$result || $result->num_rows == 0)
    {
echo<<<HTML

        <script>
        
        console.log(`
        ⠉⠉⠉⣿⡿⠿⠛⠋⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⠉⣻⣩⣉⠉⠉
        ⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⢀⣀⣀⣀⣀⣀⣀⡀⠄⠄⠉⠉⠄⠄⠄
        ⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⣠⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣤⠄⠄⠄⠄
        ⠄⠄⠄⠄⠄⠄⠄⠄⠄⢤⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡀⠄⠄⠄
        ⡄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠉⠄⠉⠉⠉⣋⠉⠉⠉⠉⠉⠉⠉⠉⠙⠛⢷⡀⠄⠄
        ⣿⡄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠠⣾⣿⣷⣄⣀⣀⣀⣠⣄⣢⣤⣤⣾⣿⡀⠄
        ⣿⠃⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⣹⣿⣿⡿⠿⣿⣿⣿⣿⣿⣿⣿⣿⢟⢁⣠
        ⣿⣿⣄⣀⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠉⠉⣉⣉⣰⣿⣿⣿⣿⣷⣥⡀⠉⢁⡥⠈
        ⣿⣿⣿⢹⣇⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠒⠛⠛⠋⠉⠉⠛⢻⣿⣿⣷⢀⡭⣤⠄
        ⣿⣿⣿⡼⣿⠷⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⢀⣀⣠⣿⣟⢷⢾⣊⠄⠄
        ⠉⠉⠁⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠈⣈⣉⣭⣽⡿⠟⢉⢴⣿⡇⣺⣿⣷
        ⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠁⠐⢊⣡⣴⣾⣥⣿⣿⣿
        `);
        
        
        
        </script>
        
        
HTML;

$queryCUN = $conn-> prepare("SELECT * FROM usuario WHERE Nombre = ? AND Contraseña = ?");
$queryCUN->bind_param("ss",$nombreUsuario,$contraseña);
$queryCUN->execute();
$result = $queryCUN->get_result();
$row = $result->fetch_assoc();

if (!$result || $result->num_rows == 0)
{

    $queryCUM = $conn-> prepare("SELECT * FROM mantenimiento WHERE Nombre = ?  AND Contraseña = ? ");
    $queryCUM->bind_param("ss",$nombreUsuario,$contraseña);
    $queryCUM->execute();
    $resultM = $queryCUM->get_result();
    $rowM = $resultM->fetch_assoc();

    if (!$resultM || $resultM->num_rows == 0)
    {
        echo'<script> window.alert("Usuario o Contraseña incorrectos");</script>';
        echo'<script> history.back() </script>';
        
    }
    else
    {
        $_SESSION['nombreMantenimiento'] = $nombreUsuario;
        $_SESSION['idMantenimiento'] = $rowM['ID'];
        $_SESSION['areaMantenimiento'] = $rowM['Opupación'];
        $_SESSION['borro'] = 0;

        header('Location: indexMAN.html');
        //Va a regresar aqui, cuando se tenga seccion de mantenimiento mandar ahi en vez.
        //Ya estuvo bien hijo de toda tu puta madre no?

    }

} 
else
{
    $_SESSION['nombreUsuario'] = $nombreUsuario;
    $_SESSION['idUsuario'] = $row['ID'];
    $_SESSION['areaUsuario'] = $row['Area'];
    $_SESSION['borro'] = 0;
    header('Location: index.php');
}


       
    }
    else
    {  
        $_SESSION['nombreUsuario'] = $nombreUsuario;
        $_SESSION['idUsuario'] = $row['ID'];
        $_SESSION['areaUsuario'] = $row['Area'];
        $_SESSION['borro'] = 0;
        header('Location: indexAD.html');
    }










/////////////////////////////////////






}





?>