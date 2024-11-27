<?php
session_start();
require_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['estatusFiltro']))  {$filtroEstado = $_POST['estatusFiltro']; $_SESSION['borro'] = 0;}
   
   
    if ($_SESSION['borro'] == 1) {
      $filtroEstado = null;
   }
   
   
   }
 
   $string_queryCC = "SELECT * FROM citas WHERE IdUsuario = ?";

   if(!empty($filtroEstado)){ 
   
       $string_queryCC = "$string_queryCC AND Estatus LIKE '%$filtroEstado%'";
   
   }
   
   $string_queryCC = "$string_queryCC ORDER BY FechaAgendada ASC ";
   
   //Conseguir Citas relacionadas 
$queryCC = $conn -> prepare($string_queryCC);

$queryCC->bind_param("i",$_SESSION['idUsuario']); //Jaja anecdota graciosa del programador, casi me wacareo y vomito escribiendo este bind_param ayuda Por Favor

if ($queryCC->execute())
{
   echo '
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

      <form method="post" action="inutil5.php">
    <input type="text" name="unset" value="uno" style="display:none;">  
    <button class="boton1"> Borrar filtros </button>
   </form>







<table class="fl-table">
    <h2>Citas Pendientes</h2>
    <thead>
        <tr>


            <th>Usuario</th>

            <th>Mantenimiento citado</th>

            <th>Descripcion</th>
            <th>Area</th>
            <th>Fecha Agendada</th>
            <th>Estatus</th>
            <th>Comentario</th>
            <th>Editar Comentario</th>
            <th>Editar Estado</th>
            <th></th>
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

            //Consiguiendo nombre del man actual
            $queryCN = $conn -> prepare("SELECT * FROM mantenimiento m INNER JOIN citas c on m.ID = c.IdMantenimiento  WHERE m.ID = ? ORDER BY c.FechaAgendada ASC");
            $queryCN->bind_param("i",$idMantenimiento);
            $queryCN->execute();
            $resultCN = $queryCN->get_result();
            $rowCN = $resultCN->fetch_assoc();
        
            $nombreMantenimiento = $rowCN['Nombre'];
            
            //Consiguiendo descripcion y Area

            $queryCDE = $conn -> prepare("SELECT * FROM problema p INNER JOIN citas c on p.ID = c.IdProblema  WHERE p.ID = ? ORDER BY c.FechaAgendada ASC");
            $queryCDE->bind_param("i",$idProblemaActual);
            $queryCDE->execute();
            $resultCDE = $queryCDE->get_result();
            $rowCDE = $resultCDE->fetch_assoc();
      
            
            $descProblemaActual = $rowCDE['Descripción'];

            //trampa LoL !!
            $nombreUsuarioActual = $_SESSION['nombreUsuario'];
            $areaProblemaActual = $_SESSION['areaUsuario'];

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
            <form method="post" action="actualizarCita.php">
            <input type="text" name="id" value="'.htmlspecialchars($idCitaActual).'" style="display:none;"/>
            <td>
                    <input class="input1" type="text" name="comentario"></input>
            </td>
            <td>
                <select class="Select1" name="estatus" value="Activa" selected required>
                    <option value="Activa">Activa</option>
                    <option value="Sin presentar">Sin presentar</option>
                    <option value="Completa">Completa</option>
                </select>
            </td>
            <td><button class="boton1" >Actualizar</button></td>
            </form>
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
else
{
         echo'o no has citado algo o ocurrio un problema lol chupalo';
}


?>      
        


