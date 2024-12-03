<?php



class Prescripcion{





    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }



    public function obtenerPrescripcionId($id){

        $sql = "SELECT * FROM prescripcion where Receta_idReceta = $id;";
        $resultado = mysqli_query($this->conn,$sql);

        if($resultado->num_rows > 0){


            return $resultado->fetch_array();

        }else{

            return null;
        }
    }

    public function InsertarPrescripcion($idReceta,$Medicamento,$Dosis,$Horario){


        
        $sqlRecetaMedicamento = "INSERT INTO prescripcion (Receta_idReceta, Medicamento_idMedicamento, Dosis, Horario) 
        VALUES ($idReceta, '$Medicamento', '$Dosis', '$Horario');";


        if (!mysqli_query($this->conn, $sqlRecetaMedicamento)) {
            die("Error en la consulta SQL de prescripción: " . mysqli_error($conn));
        }



    }


    public function ActualizarPrescripcion($idReceta,$Medicamento,$Dosis,$Horario){

        $sql = "UPDATE prescripcion SET Medicamento_idMedicamento='$Medicamento', Dosis='$Dosis', Horario='$Horario' WHERE Receta_idReceta=$idReceta;";

        if (!mysqli_query($this->conn, $sql)) {
            die("Error en la consulta SQL de prescripción: " . mysqli_error($conn));
        }

    }


}    



?>