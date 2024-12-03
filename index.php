
<?php
include 'Static/connect/db.php';
include 'Controlador/C_Usuarios.php';
include 'Controlador/C_Doctor.php';
include 'Controlador/C_Paciente.php';
include 'Controlador/C_Admi.php';
//include 'Controlador/C_Cita.php';
session_start();

//Controlador
$controller = null;

//Verificamos si existe un usuario 
if (isset($_SESSION['Tipo'])) {
    
    switch ($_SESSION['Tipo']) {
        case 'admin':
            $controller = new C_Admi($conn);
            break;
        case 'Paciente':
            $controller = new C_Paciente($conn);
            break;
        case 'Doctor':
            $controller = new C_Doctor($conn);
            break;
        default:
            $controller = new C_Usuario($conn);
            break;
    }
} else {
    $controller = new C_Usuario($conn);
}

//llamamos a la funcion accion del controlador
$controller->acciones();

?>