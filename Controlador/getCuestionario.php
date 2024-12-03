<?php
include '../Static/connect/db.php';

$id = $_POST['id'];
$cuestionarios = [];


// Primera consulta


$sqlidPaciente = "SELECT * FROM cita WHERE idCita = $id;";
$resultado3 = $conn->query($sqlidPaciente);
$fila = $resultado3->fetch_assoc();


$sqlCruzada= "SELECT * FROM cita_has_cuestionario WHERE Cita_idCita = $id;";
$resultadoCruzada = $conn->query($sqlCruzada);
$filaCruzada = $resultadoCruzada->fetch_assoc();


$sql1 = "SELECT * FROM cuestionario WHERE idCuestionario = ". $filaCruzada['Cuestionario_idCuestionario'];
$resultado1 = $conn->query($sql1);

if ($resultado1->num_rows > 0) {
    $cuestionarios['cuestionario'] = $resultado1->fetch_array(MYSQLI_ASSOC);
}

// Segunda consulta 
$sql2 = "SELECT *, timestampdiff(YEAR,Fecha_Nacimiento,now()) as edad from paciente where idPaciente= ". $fila['Paciente_idPaciente'];
$resultado2 = $conn->query($sql2);

if ($resultado2->num_rows > 0) {
    $cuestionarios['otraConsulta'] = $resultado2->fetch_all(MYSQLI_ASSOC);
}

$resultado2 = $conn->query($sql2);
$fila2 = $resultado2->fetch_assoc();

$sql4 = "SELECT * from carrera where idCarrera= ". $fila2['Carrera_idCarrera'];
$resultado4 = $conn->query($sql4);


if ($resultado4->num_rows > 0) {
    $cuestionarios['carrera'] = $resultado4->fetch_all(MYSQLI_ASSOC);
}   

// Devolver ambos resultados como JSON
echo json_encode($cuestionarios, JSON_UNESCAPED_UNICODE);
?>
