<?php  include '../Static/connect/db.php'?>
<?php
        $salida = "";
        session_start();
        $idDoctor = $_SESSION['idUsuario'];
        $sql = "SELECT *  FROM cita where (Estado_Cita ='Pendiente'OR Estado_Cita ='Cancelada paciente') AND Doctor_idDoctor = $idDoctor ORDER BY Fecha_Cita ASC";
       
        
        //Borarr esta para cuando se lo muestre a sandra
        // $sql = "SELECT * FROM cita WHERE Estado_Cita='Pendiente' AND Fecha_Cita > CURDATE() ORDER BY Fecha_Cita ASC";

        $result = $conn->query($sql);

        // Mostrar los resultados
        if ($result->num_rows > 0) {
            // Salida de cada columna
            $salida .= "<table class='table  table-bordered border-dark table-striped-columns'>
                    <caption>Lista de citas</caption>
                    <thead>
                    <tr>
                    <th>Nombre del paciente</th>
                    <th>Fecha de la cita</th>
                    <th>Hora asignada</th>
                    <th>Estado cita</th>
                    <th>Informacion</th>
                    <th>Receta</th>
                    <th>Cancelar</th>
                    </tr>
                    </thead>
                    ";

            while ($row = $result->fetch_assoc()) {
                //Obtener el nombre del paciente
                $sqlNomDoc = "SELECT Nombre, A_Paterno FROM paciente WHERE idPaciente = " . $row["Paciente_idPaciente"];
                $resultDoc= mysqli_query($conn, $sqlNomDoc);
                $rowDoc = $resultDoc->fetch_assoc();
                //Obtener el cuestionario
                $sqltablaCruzada = "SELECT * FROM cita_has_cuestionario WHERE Cita_idCita = " . $row["idCita"];
                $resultTabla= mysqli_query($conn, $sqltablaCruzada);
                $rowTabla = $resultTabla->fetch_assoc();
                //Obtener el cuestionario
                $sqlCuestionario= "SELECT * FROM cuestionario WHERE idCuestionario = " . $rowTabla["Cuestionario_idCuestionario"];
                $resultCuestionario= mysqli_query($conn, $sqlCuestionario);
                $rowCuestionario = $resultCuestionario->fetch_assoc();
                //Obtener el cuestionario
                $salida .= "<tr>
                
                <td style='visibility:collapse; display:none;'>".$row["idCita"]."</td>
                <td>".$rowDoc["Nombre"]." ". $rowDoc["A_Paterno"]."</td>
                <td>".$row["Fecha_Cita"]."</td>
                <td>".$row["Hora"]."</td>
                <td>".$row["Estado_Cita"]."</td>

                ";
                
                
                //Si la cita fue cancelada por el paciente se muestra el motivo
                if($row["Estado_Cita"] == "Cancelada paciente"){
                    $salida .= "<td colspan='3'>Cancelada - Motivo: " . $row['motivo_cancelacion'] . "</td>";
                }else{  
                //Si la cita no ha sido cancelada se muestra el boton de ver mas
                $salida .= "
                <th><a class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalPaciente' data-bs-id='" . $row["idCita"] . "'>Ver mas</a> </th> 
                <th><a class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#modalReceta' data-bs-id='" . $row["idCita"] . "'>Generar</a></th>
                <th><a class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalCancelar' data-bs-id='" . $row["idCita"] . "'>Cancelar</a></th>

                </tr>
            
                ";
                }
            }
        } else {
            // Si no se encontraron usuarios se muestra un mensaje
            echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
        }


        echo $salida;
?>

