<?php

   class Medicamentos{

        private $conn;


        public function __construct($db){
            $this->conn = $db;
        }


        public function nomMedicamento($id){
            $sql = "SELECT * FROM medicamento WHERE idMedicamento = $id";
            $result = mysqli_query($this->conn,$sql);

            return $result->fetch_assoc();
        }


        public function ConsultarMedicamento($idMedicamento){


            $sql = "SELECT * FROM medicamento where idMedicamento = $idMedicamento";
            $result = mysqli_query($this->conn,$sql);
            return $result->fetch_assoc();
        }


        public function InsertarMedicamento($nombre,$descripcion,$contenido,$caducidad){


            $sql= "INSERT INTO medicamento (Nombre,Descripcion,Concentracion,Fecha_Caducidad) 
            VALUES ('$nombre','$descripcion','$contenido','$caducidad');";  
                
                mysqli_query($this->conn, $sql);
                

        }


        public function ConsultarTodosMedicamento(){

            $sql = "SELECT * FROM medicamento";
            $result = mysqli_query($this->conn,$sql);
            return $result;


        }

        public function actualizarMedicamento($nombre,$Descripcion,$contenido,$caducidad,$id){

            $sql= "UPDATE medicamento SET Nombre='$nombre' , Descripcion='$Descripcion', Concentracion='$contenido', Fecha_Caducidad='$caducidad'
            where idMedicamento='$id';";
        
            mysqli_query($this->conn,$sql);
        }


        public function eliminarMedicamento($id){

            $sql = "DELETE FROM medicamento WHERE idMedicamento=$id";

            mysqli_query($this->conn,$sql);
        }
   }
?>