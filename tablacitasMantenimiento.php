<?php
session_start();
require_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['estatusFiltro']))  {$filtroEstado = $_POST['estatusFiltro']; $_SESSION['borro'] = 0;}
   
   
    if ($_SESSION['borro'] == 1) {
      $filtroEstado = null;
   }
   
   
   }
 



$string_queryCC = "SELECT * FROM citas WHERE IDMantenimiento = ?";

if(!empty($filtroEstado)){ 

    $string_queryCC = "$string_queryCC AND Estatus LIKE '%$filtroEstado%'";

}

$string_queryCC = "$string_queryCC ORDER BY FechaAgendada ASC ";

//Conseguir Citas relacionadas 
$queryCC = $conn -> prepare($string_queryCC);
$queryCC->bind_param("i",$_SESSION['idMantenimiento']); //Jaja anecdota graciosa del programador, casi me wacareo y vomito escribiendo este bind_param ayuda Por Favor

if ($queryCC->execute())
{
   echo '
   <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/Guti.css">

<div class="table-wrapper" role="region" tabindex="0">

<form method="post">
      <label> Filtrar por estado </label>

      <select class="Select1" name="estatusFiltro" value="Reportado" selected required>
                  <option value="Sin Presentar">Sin Presentar</option>
                  <option value="En Proceso">En proceso</option>
                  <option value="Completado">Completado</option>
      </select>
      <button class="boton1"> Filtrar </button>
   </form>

      <form method="post" action="inutil4.php">
    <input type="text" name="unset" value="uno" style="display:none;">  
    <button class="boton1"> Borrar filtros </button>
   </form>








<table class="fl-table">
    <h2>Citas Pendientes</h2>
    <thead>
        <tr>


            <th>Nombre Usuario</th>

            <th>Nombre mantenimiento citado</th>

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
            $queryCN = $conn -> prepare("SELECT * FROM usuario u INNER JOIN citas c on u.ID = c.IdUsuario  WHERE u.ID = ? ORDER BY c.FechaAgendada ASC ");
            $queryCN->bind_param("i",$idUsuarioActual);
            $queryCN->execute();
            $resultCN = $queryCN->get_result();
            $rowCN = $resultCN->fetch_assoc();
        
            $nombreUsuarioActual = $rowCN['Nombre'];
            $areaProblemaActual = $rowCN['Area'];
            //Consiguiendo descripcion y Area

            $queryCDE = $conn -> prepare("SELECT * FROM problema p INNER JOIN citas c on p.ID = c.IdProblema  WHERE p.ID = ? ORDER BY c.FechaAgendada ASC");
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


            <td>'.htmlspecialchars($nombreUsuarioActual).'</td>

            <td>'.htmlspecialchars($nombreMantenimiento).'</td>

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
      <button class="boton1">Regresar</button>
      </form>
      
      
      
      HTML;
}         
else
{
         echo'o no has citado algo o ocurrio un problema lol chupalo';
}


?>      
        


