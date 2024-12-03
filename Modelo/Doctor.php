<?php

    class Doctor{

        private $conn;

        public function __construct($db){

            $this->conn = $db;
        }


        public function ConsultarDoctores($idDoctor){
            $sql = "SELECT * FROM doctor where idDoctor=$idDoctor;";
            $result = mysqli_query($this->conn, $sql);
            return $result->fetch_assoc();
        }    


        public function InsertarDoctor($nombre,$Apaterno,$Amaterno,$genero,$cedula,$usuario,$contrasenia,$especialidad,$telefono,$Hini,$Hfin,$fecha,$Email){

            $sql= "INSERT INTO doctor (Nombre,A_Paterno,A_Materno,Genero,Cedula,Usuario,Contrasenia,Especialidad,Telefono,Horario_Atencion_I,Horario_Atencion_F,Fecha_Ingreso,Email)
            VALUES ('$nombre','$Apaterno','$Amaterno','$genero','$cedula','$usuario','$contrasenia','$especialidad','$telefono','$Hini','$Hfin','$fecha','$Email');";
                    
                    
                    
            mysqli_query($this->conn, $sql);
                    



        }


        public function actualizarDoctor($nombre,$Apaterno,$Amaterno,$genero,$cedula,$usuario,$contrasenia,$especialidad,$telefono,$Hini,$Hfin,$fecha,$Email,$id){

            
            $sql= "UPDATE doctor SET nombre='$nombre' , A_Paterno='$Apaterno', A_Materno='$Amaterno', Genero='$genero',
            Cedula='$cedula', Usuario='$usuario', Contrasenia='$contrasenia', Especialidad='$especialidad',
            Telefono='$telefono', Horario_Atencion_I='$Hini' , Horario_Atencion_F = '$Hfin',Fecha_Ingreso ='$fecha', Email='$Email'
            where idDoctor='$id';";
   
           mysqli_query($this->conn,$sql);


        }


        public function eliminarDoctor($id){


            $delete= "delete from doctor where idDoctor=$id;";
            mysqli_query($this->conn,$delete);
            

        }

    }

?>