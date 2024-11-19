<?php
session_start();
require_once("conn.php");

//Conseguir Citas relacionadas 
$queryCC = $conn -> prepare("SELECT * FROM citas WHERE IDMantenimiento = ?");
$queryCC->bind_param("i",$_SESSION['idMantenimiento']); //Jaja anecdota graciosa del programador, casi me wacareo y vomito escribiendo este bind_param ayuda Por Favor

if ($queryCC->execute())
{
   echo '
   <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/tabla.css">

<div class="table-wrapper" role="region" tabindex="0">
<table class="fl-table">
    <h2>Citas Pendientes</h2>
    <thead>
        <tr>
            <th>ID Cita</th>
            <th>ID Usuario</th>
            <th>Nombre Usuario</th>
            <th>ID Mantenimiento</th>
            <th>Nombre mantenimiento citado</th>
            <th>ID Problema</th>
            <th>Descripcion</th>
            <th>Area</th>
            <th>Fecha Agendada</th>
            <th>Estatus</th>
            <th>Comentario</th>
        </tr>
        </thead>';

        $resultCC = $queryCC->get_result();
        while($rowCC = $resultCC->fetch_assoc())
        {
            //Datos generales de la tabla citas
            $idCitaActual = $rowCC['ID'];
            $idUsuarioActual = $rowCC['IdUsuario'];
            $idMantenimiento = $rowCC['IdMantenimiento'];
            $idProblemaActual = $rowCC['IdProblema'];
            $fechaActual = $rowCC['FechaAgendada'];
            $estatusActual = $rowCC['Estatus'];
            $comentarioActual = $rowCC['Comentario'];

            //Consiguiendo nombre del usuario actual
            $queryCN = $conn -> prepare("SELECT * FROM usuario WHERE ID = ?");
            $queryCN->bind_param("i",$idUsuarioActual);
            $queryCN->execute();
            $resultCN = $queryCN->get_result();
            $rowCN = $resultCN->fetch_assoc();
        
            $nombreUsuarioActual = $rowCN['Nombre'];
            $areaProblemaActual = $rowCN['Area'];
            //Consiguiendo descripcion y Area

            $queryCDE = $conn -> prepare("SELECT * FROM problema WHERE ID = ?");
            $queryCDE->bind_param("i",$idProblemaActual);
            $queryCDE->execute();
            $resultCDE = $queryCDE->get_result();
            $rowCDE = $resultCDE->fetch_assoc();
      
            
            $descProblemaActual = $rowCDE['Descripción'];

            //trampa LoL !!
            $nombreMantenimiento = $_SESSION['nombreMantenimiento'];

            //Imprimiendo tabla
            echo ' 
            <tbody>
            <tr>
            <td>'.htmlspecialchars($idCitaActual).'</td>
            <td>'.htmlspecialchars($idUsuarioActual).'</td>
            <td>'.htmlspecialchars($nombreUsuarioActual).'</td>
            <td>'.htmlspecialchars($idMantenimiento).'</td>
            <td>'.htmlspecialchars($nombreMantenimiento).'</td>
            <td>'.htmlspecialchars($idProblemaActual).'</td>
            <td>'.htmlspecialchars($descProblemaActual).'</td>
            <td>'.htmlspecialchars($areaProblemaActual).'</td>
            <td>'.htmlspecialchars($fechaActual).'</td>
            <td>'.htmlspecialchars($estatusActual).'</td>
            <td>'.htmlspecialchars($comentarioActual).'</td>

               </tr>
               </tbody>';
        }
        
        
echo<<<HTML
        <tbody></tbody>
      </table>
      <div style="margin-top:8px"></div>
      </div>
      
      <form action="indexMAN.html">
      <button><h3>De vuelta al index</h3></button>
      </form>
      
      
      
      HTML;
}         
else
{
         echo'o no has citado algo o ocurrio un problema lol chupalo';
}


?>      
        


