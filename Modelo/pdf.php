<?php

require('Static/convertirpdf/fpdf/fpdf.php');
include 'Static/connect/db.php';

class PDF extends FPDF {

    private $conn;

    public function __construct($conn) {
        parent::__construct();
        $this->conn = $conn;
    }

    // Cabecera de página
    function Header() {
        $this->Image('Static/img/upemor_logo.png', 10, 5, 30); 
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(185, 65, 253);
        $this->Cell(0, 10, 'Reportes de Citas Medicas UPEMOR', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Tabla de reportes
    function ReportTable($header, $data) {

        $this->SetLineWidth(0.2);
        $this->SetFontSize(10);
        $this->SetFillColor(240,240,240);
        $this->SetTextColor(40,40,40);
        $this->SetDrawColor(255,255,255);
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $col) {
            $this->Cell(36, 7, $col, 1);
        }
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(36, 6, $col, 1);
            }
            $this->Ln();
        }
    }


    public function generarReporte($FInicio, $FFinal, $tipo) {
    

    // Crea un nuevo objeto PDF
   
    

    if ($tipo == 'Citas') {
        // Establece el título del reporte
        $this->SetFont('Arial', 'B', 12);
        $this->Ln(10);
        // Imprime el título del reporte
        $this->Cell(0, 10, 'Total de citas por cada doctor de la fecha '. $FInicio .' a la fecha '. $FFinal, 0, 1, 'C');
   
        // Salto de línea
        $this->Ln(5);

        // Encabezado de la tabla
        $header = array('Doctor','Total de citas','Total aceptadas', 'Total Canceladas', 'Porcentaje de aceptacion');


        /*Sacamos porcentaje de cada doctor */
        
        // Obtener el número total de citas
        // Obtener el número total de citas canceladas por doctor
        $sqlCanceladas = "SELECT doctor.idDoctor, doctor.nombre, COUNT(cita.idCita) AS total_canceladas
        FROM cita
        JOIN doctor ON cita.Doctor_idDoctor = doctor.idDoctor
        WHERE cita.Estado_Cita = 'Cancelada'
        AND cita.Fecha_Cita BETWEEN '$FInicio' AND '$FFinal'
        GROUP BY doctor.idDoctor";
        $resultCanceladas = mysqli_query($this->conn, $sqlCanceladas);

        $totalCitasPorDoctor = [];
        while ($rowCanceladas = mysqli_fetch_assoc($resultCanceladas)) {
            $totalCitasPorDoctor[$rowCanceladas['idDoctor']] = [
            'nombre' => $rowCanceladas['nombre'],
            'total_canceladas' => $rowCanceladas['total_canceladas'],
            'total_aceptadas' => 0, // Inicializar aceptadas a 0
            'porcentaje_aceptadas' => 0 // Inicializar porcentaje a 0
            ];
        }

        // Obtener el número de citas aceptadas por doctor
        $sqlAceptadas = "SELECT doctor.idDoctor, COUNT(cita.idCita) AS total_aceptadas
        FROM cita
        JOIN doctor ON cita.Doctor_idDoctor = doctor.idDoctor
        WHERE cita.Estado_Cita = 'Atendida'
        AND cita.Fecha_Cita BETWEEN '$FInicio' AND '$FFinal'
        GROUP BY doctor.idDoctor";
        $resultAceptadas = mysqli_query($this->conn, $sqlAceptadas);

        while ($rowAceptadas = mysqli_fetch_assoc($resultAceptadas)) {
            $idDoctor = $rowAceptadas['idDoctor'];
            $citasAceptadas = $rowAceptadas['total_aceptadas'];
            if (isset($totalCitasPorDoctor[$idDoctor])) {
            $totalCanceladas = $totalCitasPorDoctor[$idDoctor]['total_canceladas'];
            $porcentajeAceptadas = ($citasAceptadas / ($citasAceptadas + $totalCanceladas)) * 100;
            $totalCitasPorDoctor[$idDoctor]['total_aceptadas'] = $citasAceptadas;
            $totalCitasPorDoctor[$idDoctor]['porcentaje_aceptadas'] = $porcentajeAceptadas;
            }
        }

        $data = array();

        // Verifica si la consulta se ejecutó correctamente
        if ($resultAceptadas) {
            // Obtiene los datos de la consulta
            foreach ($totalCitasPorDoctor as $idDoctor => $info) {
            $data[] = array(
                $info['nombre'],
                $info['total_canceladas'] + $info['total_aceptadas'], // Total de citas
                $info['total_aceptadas'],
                $info['total_canceladas'],
                number_format($info['porcentaje_aceptadas'], 2) . '%'
            );
            }
            
            // Imprime la tabla de reportes
            $this->ReportTable($header, $data);
        }

            $this->Ln(25);
            $this->SetFont('Arial', 'B', 12);
            $this->cell(0, 10, 'Citas canceladas por cada doctor de la fecha '. $FInicio .' a la fecha '. $FFinal, 0, 1, 'C');
            $this->Ln(5);

            $Sql2="SELECT doctor.nombre, cita.Fecha_Cita, cita.Hora, cita.motivo_cancelacion  
                FROM cita 
                JOIN doctor ON cita.Doctor_idDoctor = doctor.idDoctor
                WHERE cita.Estado_Cita = 'cancelada' 
                AND cita.Fecha_Cita BETWEEN '$FInicio' AND '$FFinal'
                ORDER BY doctor.idDoctor";

            $header2 = array('Doctor', 'Fecha_Cita', 'Hora', 'Motivo Cancelacion');
            // Datos de la tabla
            $data2 = array();
            $result2 = mysqli_query($this->conn, $Sql2);


            while ($row2 = mysqli_fetch_assoc($result2)) {
                // Agrega los datos a la tabla
                $data2[] = array($row2['nombre'], $row2['Fecha_Cita'], $row2['Hora'], $row2['motivo_cancelacion']);
            }

            $this->ReportTable($header2, $data2);
            
         
    } elseif ($tipo == 'realizadas') {


        $this->SetFont('Arial', 'B', 12);
        $this->Ln(10);
        $this->Cell(0, 10, 'Total de citas realizadas por cada doctor de la fecha '. $FInicio .' a la fecha '. $FFinal, 0, 1, 'C');
        $this->Ln(5);

        $header = array('Doctor', 'Total Aceptadas', 'Porcentaje de Aceptacion');
            $data = array();

            // Obtener el número total de citas aceptadas por doctor
            $sqlAceptadas = "SELECT doctor.idDoctor, doctor.nombre, COUNT(cita.idCita) AS total_aceptadas
                             FROM cita
                             JOIN doctor ON cita.Doctor_idDoctor = doctor.idDoctor
                             WHERE cita.Estado_Cita = 'Atendida'
                             AND cita.Fecha_Cita BETWEEN '$FInicio' AND '$FFinal'
                             GROUP BY doctor.idDoctor";
            $resultAceptadas = mysqli_query($this->conn, $sqlAceptadas);

            $totalCitasPorDoctor = [];
            while ($rowAceptadas = mysqli_fetch_assoc($resultAceptadas)) {
                $totalCitasPorDoctor[$rowAceptadas['idDoctor']] = [
                    'nombre' => $rowAceptadas['nombre'],
                    'total_aceptadas' => $rowAceptadas['total_aceptadas'],
                    'porcentaje_aceptadas' => 0 // Inicializar porcentaje a 0
                ];
            }

            // Obtener el número de citas canceladas por doctor
            $sqlCanceladas = "SELECT doctor.idDoctor, COUNT(cita.idCita) AS total_canceladas
                              FROM cita
                              JOIN doctor ON cita.Doctor_idDoctor = doctor.idDoctor
                              WHERE cita.Estado_Cita = 'cancelada'
                              AND cita.Fecha_Cita BETWEEN '$FInicio' AND '$FFinal'
                              GROUP BY doctor.idDoctor";
            $resultCanceladas = mysqli_query($this->conn, $sqlCanceladas);

            while ($rowCanceladas = mysqli_fetch_assoc($resultCanceladas)) {
                $idDoctor = $rowCanceladas['idDoctor'];
                $citasCanceladas = $rowCanceladas['total_canceladas'];
                if (isset($totalCitasPorDoctor[$idDoctor])) {
                    $totalAceptadas = $totalCitasPorDoctor[$idDoctor]['total_aceptadas'];
                    $porcentajeAceptadas = ($totalAceptadas / ($totalAceptadas + $citasCanceladas)) * 100;
                    $totalCitasPorDoctor[$idDoctor]['porcentaje_aceptadas'] = $porcentajeAceptadas;
                }
            }




            foreach ($totalCitasPorDoctor as $idDoctor => $info) {
                $data[] = array(
                    $info['nombre'],
                    $info['total_aceptadas'],
                    number_format($info['porcentaje_aceptadas'], 2) . '%'
                );
            }

            // Imprime la tabla de reportes
            $this->ReportTable($header, $data);

            $this->Ln(25);
            $this->SetFont('Arial', 'B', 12);
            $this->cell(0, 10, 'Citas realizadas por cada doctor de la fecha '. $FInicio .' a la fecha '. $FFinal, 0, 1, 'C');
            $this->Ln(5);
            $Sql2="SELECT doctor.nombre, cita.Fecha_Cita, cita.Hora, cita.motivo_cancelacion  
                FROM cita 
                JOIN doctor ON cita.Doctor_idDoctor = doctor.idDoctor
                WHERE cita.Estado_Cita = 'Atendida' 
                AND cita.Fecha_Cita BETWEEN '$FInicio' AND '$FFinal'
                ORDER BY doctor.idDoctor";

            $header2 = array('Doctor', 'Fecha_Cita', 'Hora');
            // Datos de la tabla
            $data2 = array();
            $result2 = mysqli_query($this->conn, $Sql2);


            while ($row2 = mysqli_fetch_assoc($result2)) {
                // Agrega los datos a la tabla
                $data2[] = array($row2['nombre'], $row2['Fecha_Cita'], $row2['Hora']);
            }

            $this->ReportTable($header2, $data2);





    } elseif ($tipo == 'medicamentos') {

        $this->SetFont('Arial', 'B', 14);
        $this->Ln(10);
        $this->Cell(0, 10, 'Medicamentos mas utilizados de la fecha '. $FInicio .' a la fecha '. $FFinal, 0, 1, 'C');
        $this->Ln(5);

        $header = array('Medicamento', 'Total Utilizado');
        $data = array();
        $sql = "SELECT medicamento.nombre, COUNT(prescripcion.Medicamento_idMedicamento) AS total_utilizado 
                FROM prescripcion 
                JOIN medicamento ON prescripcion.Medicamento_idMedicamento = medicamento.idMedicamento
                JOIN receta ON prescripcion.Receta_idReceta = receta.idReceta
                WHERE receta.Fecha_Emision BETWEEN '$FInicio' AND '$FFinal'
                GROUP BY medicamento.idMedicamento ORDER BY total_utilizado DESC";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = array($row['nombre'], $row['total_utilizado']);
            }
        }else {
        die("Error en la consulta SQL: " . mysqli_error($conn));
        }
        $this->ReportTable($header, $data);
    }

    // Salida del PDF
}

}
?>