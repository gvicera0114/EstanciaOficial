<?php
include '../Static/connect/db.php';
date_default_timezone_set('America/Mexico_City'); // zona horaria de mexico pq si no, no funciona XD

if (isset($_GET['doctor_id']) && isset($_GET['fecha'])) {
    $doctor_id = $_GET['doctor_id'];
    $fecha = $_GET['fecha'];
    $hora_seleccionada = isset($_GET['hora']) ? $_GET['hora'] : '';

    // obtener las horas de inicio y fin de atención del doctor
    $sql = "SELECT Horario_Atencion_I, Horario_Atencion_F FROM doctor WHERE idDoctor = '$doctor_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hora_inicio = $row['Horario_Atencion_I'];
        $hora_fin = $row['Horario_Atencion_F'];
    } else {
        echo "Error: No se encontraron las horas de atención del doctor.";
        
    }

    // obtener las horas ocupadas
    $sql = "SELECT Hora FROM cita WHERE Doctor_idDoctor = '$doctor_id' AND Fecha_Cita = '$fecha'";
    $result = $conn->query($sql);
    $horas_ocupadas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($row["Hora"]!=$hora_seleccionada){
            $horas_ocupadas[] = $row["Hora"];
            }
        }
    }

    
    // generar las opciones de horas disponibles en intervalos de 20 minutos

    $hora_actual = strtotime($hora_inicio);
    $hora_fin_timestamp = strtotime($hora_fin);
    $fecha_hora_actual = strtotime(date('Y-m-d H:i:s')); // obtener la fecha y hora actual
    
 

    
    

   
    while ($hora_actual < $hora_fin_timestamp) {
        // formatear la hora actual
        $hora_formateada = date('H:i:s', $hora_actual);
        // convertir la fecha y hora formateada a un timestamp
        $fecha_hora_formateada = strtotime("$fecha $hora_formateada");
       
        
        // verificar si la hora actual es mayor o igual a la hora actual y si no esta en la lista de horas ocupadas
        if ($fecha_hora_formateada >= $fecha_hora_actual && !in_array($hora_formateada, $horas_ocupadas)) {
            // imprimir la opcion de hora
            $selected = ($hora_formateada == $hora_seleccionada) ? 'selected' : '';
            // imprimir la opcion de hora
            echo "<option value='$hora_formateada' $selected>" . substr($hora_formateada, 0, 5) . "</option>";
            
        }
        // aumentar 20 minutos a la hora actual
        $hora_actual = strtotime('+20 minutes', $hora_actual);
    }
    
}
?>
