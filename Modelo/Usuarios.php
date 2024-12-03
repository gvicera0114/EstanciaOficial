
<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validar($usuario, $contrasenia) {
       

        $sqlDoctor = "SELECT * FROM doctor WHERE Usuario = '$usuario' and Contrasenia = '$contrasenia';";
        $sqlPaciente = "SELECT * from paciente where Matricula='$usuario' and  Contrasenia = '$contrasenia';";
        $sqlAdmi = "SELECT * from administrador where Usuario='$usuario' and  Contrasenia = '$contrasenia';";

        $result1 = $this->conn->query($sqlDoctor);
        $result2 = $this->conn->query($sqlPaciente);
        $result3 = $this->conn->query($sqlAdmi);

        if ($result1->num_rows > 0) {
            $_SESSION['Tipo'] = 'Doctor';
            return $result1->fetch_assoc();
        } elseif ($result2->num_rows > 0) {
            $_SESSION['Tipo'] = 'Paciente';
            return $result2->fetch_assoc();
        } elseif ($result3->num_rows > 0) {
            $_SESSION['Tipo'] = 'admin';
            return $result3->fetch_assoc();
        } else {
            return null;
        }
    }

}
?>