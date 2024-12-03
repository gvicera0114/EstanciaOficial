
<?php
include 'Static/connect/db.php';
include 'Controlador/C_Usuarios.php';
include 'Controlador/C_Doctor.php';
include 'Controlador/C_Paciente.php';
include 'Controlador/C_Admi.php';

session_start();

$controller = null;

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

$controller->acciones();

?>