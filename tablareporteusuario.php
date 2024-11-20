<?php
session_start();
require_once("conn.php");

//Conseguir Usuario y Problema
$queryCUP = $conn -> prepare("SELECT * FROM usuarioproblema WHERE IdUsuario = ?");
$queryCUP -> bind_param("i",$_SESSION["idUsuario"]);

if($queryCUP->execute())
{ 

   echo '<link rel="stylesheet" href="css/Guti.css">

<div class="table-wrapper" role="region" tabindex="0">
<table class="fl-table">
    <h2>Tus reportes</h2>
    <thead>
        <tr>
            <th>ID Reporte<br></th>
            <th>Usuario</th>
            <th>Area</th>
            <th>Descripcion</th>
            <th>Hora Entrada<br></th>
            <th>Hora Salida<br></th>
            <th>Estatus<br></th>
        </tr>
        </thead>';
        

   $resultCUP = $queryCUP->get_result();   

   while($rowCUP = $resultCUP->fetch_assoc())
   {
      $idProblemaActual = $rowCUP['IdProblema'];
      $areaProblemaActual = $rowCUP['AreaProblema'];

      //Conseguir Ticket con el Id del Problema Actual

      $queryCT = $conn -> prepare("SELECT * FROM problematicket WHERE IdProblema = ? ");
      $queryCT -> bind_param("i",$idProblemaActual);
      $queryCT->execute();
      $resultCT = $queryCT->get_result();
      $rowCT = $resultCT->fetch_assoc();

      $idTicketActual = $rowCT['IdTicket'];

      //Conseguir Descripcion y Estatus del Problema Actual con su Id

      $queryCDE = $conn -> prepare("SELECT * FROM problema WHERE ID = ?");
      $queryCDE->bind_param("i",$idProblemaActual);
      $queryCDE->execute();
      $resultCDE = $queryCDE->get_result();
      $rowCDE = $resultCDE->fetch_assoc();

      $estadoProblemaActual = $rowCDE['Estatus'];
      $descProblemaActual = $rowCDE['Descripción'];

      //Conseguir Horas del ticket con Su Id

      $queryCH = $conn -> prepare("SELECT * FROM ticket WHERE ID = ?");
      $queryCH->bind_param("i",$idProblemaActual);
      $queryCH->execute();
      $resultCH = $queryCH->get_result();
      $rowCH = $resultCH->fetch_assoc();

      $horaenTicketActual = $rowCH['HoraEntrada'];
      $horasaTicketActual = $rowCH['HoraSalida'];

      //Al fin mostrar la fila de tabla con los datos

      echo ' 
            <tbody>
            <tr>

            <td>'.htmlspecialchars($_SESSION['nombreUsuario']).'</td>
            <td>'.htmlspecialchars($_SESSION['areaUsuario']).'</td>
            <td>'.htmlspecialchars($descProblemaActual).'</td>
            <td>'.htmlspecialchars($horaenTicketActual).'</td>
            <td>'.htmlspecialchars($horasaTicketActual).'</td>
            <td>'.htmlspecialchars($estadoProblemaActual).'</td>
               </tr>
               </tbody>';
   }

echo<<<HTML
  <tbody></tbody>
</table>
<div style="margin-top:8px"></div>
</div>

<form action="index.php">
<button class="boton1">Regresar</button>
</form>



HTML;
   


}

else{
   echo'o no has reportado algo o ocurrio un problema lol chupalo';
}





?>