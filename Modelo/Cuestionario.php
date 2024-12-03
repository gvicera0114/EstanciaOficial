<?php
    class Cuestionario{

        private $conn;

        public function __construct($db){

            $this->conn = $db;
        }


        public function InsertarCuestionario($Sintomas,$Alergias,$Medicamentos,$Historial,$Dolor){

            $sqlFormulario= "INSERT INTO cuestionario (Sintomas,Alergias,Medicamentos_Actuales,Historial_Medico,Lugar_Dolor) 
            VALUES ('$Sintomas','$Alergias','$Medicamentos','$Historial','$Dolor')";
            mysqli_query($this->conn,$sqlFormulario);

            // Recuperamos el id del cuestionario
            $idCuestionario = mysqli_insert_id($this->conn);


            return $idCuestionario;

        }


        public function ConsultarCuestionario($idCita){


            $sqlTablaCruzada= "select * from cita_has_cuestionario where Cita_idCita=$idCita;";
            $resulCru=mysqli_query($this->conn,$sqlTablaCruzada);
            $rowCru=mysqli_fetch_array($resulCru);


            $sql= "select * from cuestionario where idCuestionario=". $rowCru['Cuestionario_idCuestionario'] .";";
            $resul=mysqli_query($this->conn,$sql);
            
            return $resul->fetch_assoc();
        }


        public function ActualizarCuestionario($idCita,$Sintomas,$Alergias,$Medicamentos,$Historial,$Dolor){


            $sqlTablaCruzada= "select * from cita_has_cuestionario where Cita_idCita=$idCita;";
            $resulCru=mysqli_query($this->conn,$sqlTablaCruzada);
            $rowCru=mysqli_fetch_array($resulCru);

            $id=$rowCru['Cuestionario_idCuestionario'];
            $sqlFormulario= "UPDATE cuestionario SET Sintomas= '$Sintomas', Alergias='$Alergias', Medicamentos_Actuales='$Medicamentos', Historial_Medico='$Historial', Lugar_Dolor='$Dolor' Where idCuestionario='$id';";
            mysqli_query($this->conn, $sqlFormulario);

            if (!mysqli_query($this->conn, $sqlFormulario)) {
                die("Error: " . mysqli_error($this->conn));
            }

        }


        public function EliminarCuestionario($idCita){

            $sqlTablaCruzada= "select * from cita_has_cuestionario where Cita_idCita=$idCita;";
            $resulCru=mysqli_query($this->conn,$sqlTablaCruzada);
            $rowCru=mysqli_fetch_array($resulCru);

            $sqlFormulario= "DELETE FROM cita_has_cuestionario WHERE Cuestionario_idCuestionario=". $rowCru['Cuestionario_idCuestionario'] .";";
            mysqli_query($this->conn, $sqlFormulario);


            $id=$rowCru['Cuestionario_idCuestionario'];
            $sqlFormulario= "DELETE FROM cuestionario WHERE idCuestionario='$id';";
            mysqli_query($this->conn, $sqlFormulario);

            if (!mysqli_query($this->conn, $sqlFormulario)) {
                die("Error: " . mysqli_error($this->conn));
            }

        }

    }


?>