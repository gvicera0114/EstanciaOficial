<?php
include '../Static/connect/db.php';
require '../Modelo/Recetas.php';
include '../Modelo/Prescripcion.php';

$id = $_POST['id'];
$cuestionarios = [];

// Primera consulta
$receta = new Receta($conn);
$cuestionarios['receta'] = $receta->obtenerRecetaIdReceta($id);

// Segunda consulta
$prescripcion = new Prescripcion($conn);
$cuestionarios['prescripcion'] = $prescripcion->obtenerPrescripcionId($id);

// Devolver ambos resultados como JSON
echo json_encode($cuestionarios, JSON_UNESCAPED_UNICODE);
?>
