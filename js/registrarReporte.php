<?php

require_once("conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $nombreReporte = $_POST['Nombre'];
    $detallesReporte = $_POST['Detalles'];
    $status = "Reportado";

    $queryTicket = "INSERT INTO ticket (HoraEntrada) VALUES (CURRENT_TIMESTAMP)";

    if ($conn->query($queryTicket) === TRUE) {

        $idTicket = $conn->insert_id;

        $queryProblema = $conn -> prepare("INSERT INTO problema (Descripción,Estatus) VALUES (?,?)");
        $queryProblema->bind_param("ss",$detallesReporte,$status);
        if($queryProblema->execute())
        {
            
            $idProblema = $conn->insert_id;
            $queryProblemaTicket = $conn -> prepare("INSERT INTO problematicket (IdProblema,IdTicket) VALUES (?,?)");
            $queryProblemaTicket->bind_param("ii",$idProblema,$idTicket);
            
            if($queryProblemaTicket->execute())
            {

                $queryUsuarioProblema = $conn -> prepare("INSERT INTO usuarioproblema (IdUsuario,IdProblema,AreaProblema) VALUES (?,?,?)");
                $queryUsuarioProblema->bind_param("iis",$_SESSION['idUsuario'],$idProblema,$_SESSION['areaUsuario']);

                if($queryUsuarioProblema->execute())
                {
                    header('Location: tablareporteusuario.php');
                }

            }

        }
        else
        {
           echo 'wrong nigga';
        }


    
    }



}



?>