<?php
session_start();
require_once("conn.php");


//Filtros 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 if (isset($_POST['usuarioFiltro']))  {$filtroNombre = $_POST['usuarioFiltro']; $_SESSION['borro'] = 0;}
 if (isset($_POST['estatusFiltro']))  {$filtroEstado = $_POST['estatusFiltro']; $_SESSION['borro'] = 0;}


 if ($_SESSION['borro'] == 1) {
   $filtroNombre = null;
   $filtroEstado = null;
}


}









//Conseguir Problemas
$string_queryCP = "SELECT * FROM usuarioproblema up INNER JOIN problematicket pt ON up.IdProblema = pt.IdProblema INNER JOIN ticket t ON t.id = pt.IdTicket";

if(!empty($filtroNombre)){
   if(!empty($filtroEstado)){ $string_queryCP = "$string_queryCP AND WHERE up.IdUsuario = (SELECT ID FROM usuario  WHERE Nombre LIKE '%$filtroNombre%') ";
   } else { $string_queryCP = "$string_queryCP WHERE up.IdUsuario = (SELECT ID FROM usuario  WHERE Nombre LIKE '%$filtroNombre%') ";}
}

if(!empty($filtroEstado)){ 
   if (!empty($filtroNombre)){$string_queryCP = "$string_queryCP AND WHERE up.IdProblema = ANY (SELECT ID FROM problema  WHERE Estatus LIKE '%$filtroEstado%')";}
   else  {$string_queryCP = "$string_queryCP WHERE up.IdProblema = ANY (SELECT ID FROM problema  WHERE Estatus LIKE '%$filtroEstado%')";}
};

$string_queryCP = "$string_queryCP ORDER BY t.HoraEntrada ASC";





$queryCP = $conn -> prepare($string_queryCP);
if($queryCP->execute())
{ 

   echo '
<link rel="stylesheet" href="css/Guti.css">

<table style="width: 100%; position: sticky; right:0;">
<tbody>
<tr>
<td style="width: 51.8378%;">
   <form method="post">

      <label> Buscar por Usuario </label>
      <input type="text" name="usuarioFiltro" placeholder="Nombre Usuario" required>
      <button class="boton1"> Buscar </button>

   </form>
</td>
<td style="width: 32.1622%;">

<form method="post">
      <label> Filtrar por estado </label>

      <select class="Select1" name="estatusFiltro" value="Reportado" selected required>
                  <option value="Reportado">Reportado</option>
                  <option value="En proceso">En proceso</option>
                  <option value="Solucionado">Solucionado</option>
      </select>
      <button class="boton1"> Filtrar </button>
   </form>

</td>
<td style="width: 12%;">

   <form method="post" action="inutil2.php">
    <input type="text" name="unset" value="uno" style="display:none;">  
    <button class="boton1"> Borrar filtros </button>
   </form>

</td>
</tr>
</tbody>
</table>


   

<div class="table-wrapper" role="region" tabindex="0">
<table class="fl-table">
    <h2>Reportes</h2>
    <thead>
        <tr>
            <th>Nombre Usuario del Reporte</th>
            <th>Area</th>
            <th>Descripcion</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Estatus</th>
            <th>Cambiar estatus</th>
            <th>Agendar cita</th>
        </tr>
        </thead>';
        

   $resultCP = $queryCP->get_result();   

   while($rowCP = $resultCP->fetch_assoc())
   {
      $idUsuarioProblemaActual = $rowCP['IdUsuario'];
      $idProblemaActual = $rowCP['IdProblema'];
      

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

      //Al fin mostrar la fila de tabla con los datos
    $string_queryCN = "SELECT * FROM usuario u INNER JOIN usuarioproblema up on u.ID = up.IdUsuario INNER JOIN problematicket pt on up.IdProblema = pt.IdProblema INNER JOIN ticket t on pt.IdTicket = t.ID WHERE u.ID = ? ORDER BY t.HoraEntrada ASC";  
    $queryCN = $conn -> prepare($string_queryCN);
    $queryCN->bind_param("i",$idUsuarioProblemaActual);
    $queryCN->execute();
    $resultCN = $queryCN->get_result();
    $rowCN = $resultCN->fetch_assoc();

    $nombreUsuarioProblemaActual = $rowCN['Nombre'];
    $areaProblemaActual = $rowCN['Area'];
      

      echo ' 
            <tbody>
            <tr>
  

            <td>'.htmlspecialchars($nombreUsuarioProblemaActual).'</td>
            <td>'.htmlspecialchars($areaProblemaActual).'</td>
            <td>'.htmlspecialchars($descProblemaActual).'</td>
            <td>'.htmlspecialchars($horaenTicketActual).'</td>
            <td>'.htmlspecialchars($horasaTicketActual).'</td>
            <td>'.htmlspecialchars($estadoProblemaActual).'</td>

            
            <td> 
            
            <form method="post" action="cambiarestatus.php">
            <input name="id" value="'.htmlspecialchars($idProblemaActual).'" style="display:none;"></input>
            <select class="Select1" name="estatus" value="Reportado" selected required>
            <option value="Reportado">Reportado</option>
            <option value="En proceso">En proceso</option>
            <option value="Solucionado">Solucionado</option>
            </select> <br> 
            <button class="boton1">Cambiar estado</button>
            </form>
            
            </td>

            <td>
            
            <form method="post" action="registrarCita.php">
            <input name="idProblema" value="'.htmlspecialchars($idProblemaActual).'" style="display:none;"></input>
            <input name="idUsuario" value="'.htmlspecialchars($idUsuarioProblemaActual).'" style="display:none;"></input>
            <input name="idMantenimiento" value="'.htmlspecialchars($_SESSION['idMantenimiento']).'" style="display:none;"></input>
            <input type="date" id="start" name="fecha" min="'.htmlspecialchars(date("y-m-d")).'" max="2999-12-31" required />
            <button class="boton1">Agendar cita</button>
            </form>
            
            
            </td>
               </tr>
               </tbody>';
   }

echo<<<HTML
  <tbody></tbody>
</table>
<div style="margin-top:8px"></div>
</div>

<form action="indexMAN.html">
<button class="boton1"><h3>De vuelta al index</h3></button>
</form>



HTML;
   


}

else{
   echo'no hay! yupi!!!!!!!!!!!!!!!!!!!!!!';
}





?>