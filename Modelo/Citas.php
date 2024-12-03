<?php

    class Cita{

        private $conn;

        public function __construct($db){

            $this->conn = $db;
        }



        public function InsertarCita($idDoctor,$Fecha,$Hora,$idUsuario){

            $sqlCita= "INSERT INTO cita (Doctor_idDoctor,Paciente_idPaciente,Fecha_Cita,Hora,Estado_Cita) 
            VALUES ('$idDoctor','$idUsuario','$Fecha','$Hora','Pendiente')";
            mysqli_query($this->conn, $sqlCita);

           
            // Get the last inserted id for cita
            $idCita = mysqli_insert_id($this->conn );


            return $idCita;

        }


        public function InsertarCitaCuestionario($idCita,$idCuestionario){

            $sqlTablaCruzada= "INSERT INTO cita_has_cuestionario (Cita_idCita,Cuestionario_idCuestionario) 
            VALUES ('$idCita','$idCuestionario')";
    
    
            if (!mysqli_query($this->conn, $sqlTablaCruzada)) {
                die("Error: " . mysqli_error($this->conn));
            }
    
        }

        public function ConsultarCita($idUsuario){

            $sql= "select * from cita where idCita=$idUsuario;";
            $resul=mysqli_query($this->conn,$sql);
            
            return $resul->fetch_assoc();
        }

        public function ActualizarCita($id,$idDoctor,$fechaCita,$hora){

            $sqlCita= "UPDATE cita SET Doctor_idDoctor='$idDoctor', Fecha_Cita='$fechaCita', Hora='$hora' where idCita=$id;";
            mysqli_query($this->conn, $sqlCita);

            if (!mysqli_query($this->conn, $sqlCita)) {
                die("Error: " . mysqli_error($this->conn));
            }

        }
        
        
        public function EliminarCita($id){

            $sqlCita= "DELETE FROM cita WHERE idCita=$id;";
            mysqli_query($this->conn, $sqlCita);

            if (!mysqli_query($this->conn, $sqlCita)) {
                die("Error: " . mysqli_error($this->conn));
            }

        }


        public function ConsultarCitas($idUsuario){

            $sql= "select * from cita where Paciente_idPaciente=$idUsuario;";
            $resul=mysqli_query($this->conn,$sql);
            
            return $resul;
        }


        public function ActualizarCitaEstado($idCita){

        $sqlCita="UPDATE cita SET Estado_Cita='Atendida' WHERE idCita=$idCita";

    
        if (!mysqli_query($this->conn, $sqlCita)) {
            die("Error en la consulta SQL de cita: " . mysqli_error($conn));
        }



        }


        public function ContsultarCitasDoctor($idDoctor){

            $sql= "select * from cita where Doctor_idDoctor=$idDoctor;";
            $resul=mysqli_query($this->conn,$sql);
            
            return $resul;
        }



    }


?>