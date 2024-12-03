<?php

    class paciente{

        private $conn;

        public function __construct($db){

            $this->conn = $db;
        }

        public function ConsultarPaciente($idPaciente){
            $sql = "SELECT * FROM paciente where idPaciente=$idPaciente;";
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();
        }


        public function InsertarPaciente($nombre,$Apaterno,$Amaterno,$genero,$matricula,$contrasenia,$fecha,$estadoCivil,$carrera){


            $sql= "INSERT INTO paciente (Nombre,A_Paterno,A_Materno,Genero,Matricula,Contrasenia,Fecha_Nacimiento,Estado_Civil,Carrera_idCarrera) 
            VALUES ('$nombre','$Apaterno','$Amaterno','$genero','$matricula','$contrasenia','$fecha','$estadoCivil','$carrera');";
            
            mysqli_query($this->conn, $sql);   



        }


        public function actualizarPaciente($nombre,$Apaterno,$Amaterno,$genero,$matricula,$contrasenia,$fecha,$estadoCivil,$carrera,$id){

            $sql= "UPDATE paciente SET nombre='$nombre' , A_Paterno='$Apaterno', A_Materno='$Amaterno', Genero='$genero',
                Matricula='$matricula', Contrasenia='$contrasenia', Fecha_Nacimiento='$fecha',
                Estado_Civil='$estadoCivil', Carrera_idCarrera='$carrera'
                where idPaciente='$id';";


            mysqli_query($this->conn,$sql);


        }


        public function eliminarPaciente($id){

            $delete= "delete from paciente where idPaciente=$id;";
             mysqli_query($conn,$delete);

        }



    }


?>