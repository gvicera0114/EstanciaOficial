<?php

class Receta{


    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function obtenerRecetaId($id){

        $sql = "SELECT * FROM receta WHERE Cita_idCita = $id;";
        $resultado =  mysqli_query($this->conn,$sql);
        if ($resultado->num_rows > 0) {
            
            return $resultado->fetch_assoc();
            
        }
        return null;
    }


    public function obtenerRecetaIdReceta($id){

        $sql = "SELECT * FROM receta WHERE idReceta = $id;";
        $resultado =  mysqli_query($this->conn,$sql);
        if ($resultado->num_rows > 0) {
            
            return $resultado->fetch_assoc();
            
        }
        return null;
    }


    public function eliminarReceta($id){


        $sqlPrescripcion = "DELETE FROM prescripcion WHERE Receta_idReceta=$id";

        mysqli_query($this->conn,$sqlPrescripcion);

        $sql = "DELETE FROM receta WHERE idReceta=$id";

        mysqli_query($this->conn,$sql);
    }


    public function InsertarReceta($Recomendaciones,$Nota_Doctor,$TensionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Temperatura,$Diagnostico,$idCita){


        $sqlReceta= "INSERT INTO receta (Recomendacion_Doctor,Fecha_Emision,Nota_Doctor,Tension_Arterial,Frecuencia_Cardiaca,Frecuencia_Respiratoria,Temperatura,Diagnostico,Cita_idCita) 
            VALUES ('$Recomendaciones',now(),'$Nota_Doctor','$TensionArterial','$FrecuenciaCardiaca','$FrecuenciaRespiratoria','$Temperatura',
            '$Diagnostico','$idCita');";


        if (!mysqli_query($this->conn, $sqlReceta)) {
        die("Error en la consulta SQL de receta: " . mysqli_error($conn));
        }

        return mysqli_insert_id($this->conn);

    }


    public function actualizarReceta($idReceta,$Recomendaciones,$Nota_Doctor,$TensionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Temperatura,$Diagnostico){

        $sqlReceta="UPDATE receta SET Recomendacion_Doctor='$Recomendaciones', Nota_Doctor='$Nota_Doctor', Tension_Arterial='$TensionArterial', Frecuencia_Cardiaca='$FrecuenciaCardiaca', 
        Frecuencia_Respiratoria='$FrecuenciaRespiratoria', Temperatura='$Temperatura', Diagnostico='$Diagnostico' WHERE idReceta='$idReceta'";

        if (!mysqli_query($this->conn, $sqlReceta)) {
            die("Error en la consulta SQL de receta: " . mysqli_error($conn));
        }

    }

    public function obtenerTodasRecetaId($id){

        $sql = "SELECT * FROM receta WHERE Cita_idCita = $id;";
        $resultado =  mysqli_query($this->conn,$sql);

            
            return $resultado;
            
        


    


    }
    


}


?>