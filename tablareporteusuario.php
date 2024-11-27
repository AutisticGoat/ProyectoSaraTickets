<?php
session_start();
require_once("conn.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (isset($_POST['estatusFiltro']))  {$filtroEstado = $_POST['estatusFiltro']; $_SESSION['borro'] = 0;}
  
  
   if ($_SESSION['borro'] == 1) {
     $filtroEstado = null;
  }
  
  
  }


$string_queryCUP = "SELECT * FROM usuarioproblema up INNER JOIN problematicket pt ON up.IdProblema = pt.IdProblema INNER JOIN ticket t ON t.id = pt.IdTicket WHERE up.IdUsuario = ?";

if(!empty($filtroEstado)){ 
   $string_queryCUP = "$string_queryCUP AND up.IdProblema = ANY (SELECT ID FROM problema  WHERE Estatus LIKE '%$filtroEstado%')";
 
};

$string_queryCUP = "$string_queryCUP ORDER BY t.HoraEntrada ASC";
//Conseguir Usuario y Problema
$queryCUP = $conn -> prepare($string_queryCUP);
$queryCUP -> bind_param("i",$_SESSION["idUsuario"]);

if($queryCUP->execute())
{ 

   echo '<link rel="stylesheet" href="css/Guti.css">



<div class="table-wrapper" role="region" tabindex="0">

<form method="post">
      <label> Filtrar por estado </label>

      <select class="Select1" name="estatusFiltro" value="Reportado" selected required>
                  <option value="Reportado">Reportado</option>
                  <option value="En proceso">En proceso</option>
                  <option value="Solucionado">Solucionado</option>
      </select>
      <button class="boton1"> Filtrar </button>
   </form>

      <form method="post" action="inutil3.php">
    <input type="text" name="unset" value="uno" style="display:none;">  
    <button class="boton1"> Borrar filtros </button>
   </form>


<table class="fl-table">
    <h2>Tus reportes</h2>
    <thead>
        <tr>
   
        
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
      

      //Conseguir Ticket con el Id del Problema Actual


      $string_queryCT = "SELECT * FROM problematicket pt INNER JOIN ticket t ON t.id = pt.IdTicket WHERE pt.IdProblema = ? ORDER BY t.HoraEntrada ASC ";

      $queryCT = $conn -> prepare($string_queryCT);
      $queryCT -> bind_param("i",$idProblemaActual);
      $queryCT->execute();
      $resultCT = $queryCT->get_result();
      $rowCT = $resultCT->fetch_assoc();

      $idTicketActual = $rowCT['IdTicket'];

      //Conseguir Descripcion y Estatus del Problema Actual con su Id

      $string_queryCDE = "SELECT * FROM problema p INNER JOIN problematicket pt ON p.ID = pt.IdProblema INNER JOIN ticket t ON t.id = pt.IdTicket WHERE p.ID = ? ORDER BY t.HoraEntrada ASC";

      $queryCDE = $conn -> prepare($string_queryCDE);
      $queryCDE->bind_param("i",$idProblemaActual);
      $queryCDE->execute();
      $resultCDE = $queryCDE->get_result();
      $rowCDE = $resultCDE->fetch_assoc();

      $estadoProblemaActual = $rowCDE['Estatus'];
      $descProblemaActual = $rowCDE['Descripción'];

      //Conseguir Horas del ticket con Su Id

      $string_queryCH = "SELECT * FROM ticket t INNER JOIN problematicket pt ON t.ID = pt.IdTicket INNER JOIN problema p ON p.ID = pt.IdProblema WHERE p.ID = ? ORDER BY t.HoraEntrada ASC";

      $queryCH = $conn -> prepare($string_queryCH);
      $queryCH->bind_param("i",$idProblemaActual);
      $queryCH->execute();
      $resultCH = $queryCH->get_result();
      $rowCH = $resultCH->fetch_assoc();

      $horaenTicketActual = $rowCH['HoraEntrada'];
      $horasaTicketActual = $rowCH['HoraSalida'];

      $string_queryCN = "SELECT * FROM usuario u INNER JOIN usuarioproblema up on u.ID = up.IdUsuario INNER JOIN problematicket pt on up.IdProblema = pt.IdProblema INNER JOIN ticket t on pt.IdTicket = t.ID WHERE u.ID = ? ORDER BY t.HoraEntrada ASC";  
      $queryCN = $conn -> prepare($string_queryCN);
      $idUsuarioProblemaActual = $_SESSION['idUsuario'];
      $queryCN->bind_param("i",$idUsuarioProblemaActual);
      $queryCN->execute();
      $resultCN = $queryCN->get_result();
      $rowCN = $resultCN->fetch_assoc();
  
      $areaProblemaActual = $rowCN['Area'];

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