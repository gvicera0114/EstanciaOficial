
<?php
include 'Modelo/Usuarios.php';

class C_Usuario {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Usuario($db);
    }

    public function acciones() {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'inciarSesion':
                $this->inciarSesion();
                break;
            default:
                $this->mostrarInicioDeSesion();
                break;
        }
    }

    private function inciarSesion() {
        session_start();
        //Obtener los datos del formulario
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];

        //Validar los datos
        $result = $this->modelo->validar($usuario, $contrasenia);
        SLEEP(2);
        if ($result) {
            
            //Guardar los datos en la sesion
            switch ($_SESSION['Tipo']) {
                case 'Doctor':
                    //Guardar los datos en la sesion
                    $_SESSION['idUsuario'] = $result['idDoctor'];
                    $_SESSION['Nombre'] = $result['Nombre'];
                    
                    //Redireccionar a la pagina principal        
                    header("Location: index.php");
                    break;
                case 'Paciente':

                    //Guardar los datos en la sesion
                    $_SESSION['idUsuario'] = $result['idPaciente'];
                    $_SESSION['Nombre'] = $result['Nombre'];
                    //Redireccionar a la pagina principal   
                    header("Location: index.php");
                    break;
                case 'admin':
                    //Guardar los datos en la sesion
                    $_SESSION['idUsuario'] = $result['idAdministrador'];
                    $_SESSION['Nombre'] = $result['Usuario'];
                    //Redireccionar a la pagina principal
                    header("Location: index.php");
                    break;
            }
        } else {
            //Redireccionar a la pagina de inicio de sesion
            header("Location: index.php?error=AccessDenied");
        }
    }

    private function mostrarInicioDeSesion() {
        include 'login.php';
    }
}
?>