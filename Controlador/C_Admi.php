<?php
    
    include 'Modelo/pdf.php';
    include 'Modelo/respaldoBD.php';


    class C_Admi{

        private $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }


        //Funcion para redireccionar a las acciones
        public function acciones(){

            $op = isset($_GET['accion']) ? $_GET['accion'] : '';
            //Validar si se envio un formulario
            switch($op){
                case 'registrarUsuarios':
                    $this->registrarUsuarios();
                    break;
                case 'consultarUsuarios':
                    $this->consultarUsuarios();
                    break;
                case 'actualizarPaciente':
                    $this->actualizarPaciente();
                    break;
                case 'eliminarPaciente':
                    $this->eliminarPaciente();
                    break;
                case 'actualizarDoctor':
                    $this->actualizarDoctor();
                    break;
                case 'eliminarDoctor':
                    $this->eliminarDoctor();
                    break;
                case 'registroMedicamento':
                    $this->registroMedicamento();
                    break;
                case 'actualizarMedicamento':
                    $this->actualizarMedicamento();
                    break;
                case 'eliminarMedicamento':
                    $this->eliminarMedicamento();
                    break;
                case 'consultarMedicamento':
                    $this->consultarMedicamento();
                    break;
                case 'reportesPDF':
                    $this->reportesPDF();
                    break;  
                case 'respaldoBD':
                    $this->respaldoBD();
                    break;      
                default:
                    $this->dashboardAdmi();
                    break;
            }
        }


        public function dashboardAdmi(){

            
            include 'Vista/dashboardAdmi.php';
        }

        



        public function registrarUsuarios(){

            //Crear objetos de los modelos
            $MPaciente = new Paciente($this->conn);
            $MDoctor = new Doctor($this->conn);

            //Validar si se envio un formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

                //Validar si se envio un formulario de doctor o paciente
                if (!empty($_POST["cedula"]) || !empty($_POST["matricula"])) {
                
                //Validar si se envio un formulario de doctor
                if (isset($_POST["cedula"])) {
                    
                    //Obtener los datos del formulario
                    $nombre = $_POST["nombre"];
                    $Apaterno= $_POST['apellidoPaterno'];
                    $Amaterno= $_POST['apellidoMaterno'];
                    $genero=$_POST["genero"];
                    $cedula=$_POST["cedula"];
                    $usuario=$_POST["usuario"];
                    $contrasenia=$_POST["password"];
                    $especialidad=$_POST["especialidad"];
                    $telefono=$_POST["telefono"];
                    $Hini=$_POST["horas"];
                    $Hfin=$_POST["horasFinal"];
                    $fecha=$_POST["fechaIngreso"];
                    $Email=$_POST["correo"];


                    
                    //Insertar los datos en la base de datos

                    $MDoctor->InsertarDoctor($nombre,$Apaterno,$Amaterno,$genero,$cedula,$usuario,$contrasenia,$especialidad,$telefono,$Hini,$Hfin,$fecha,$Email);
                
                    
                    
                    
                
                } else if (isset($_POST["matricula"])) {
                    
                    
                    //Obtener los datos del formulario
                    $nombre = $_POST["nombrePaciente"];
                    $Apaterno= $_POST['apellidoPaternoPaciente'];
                    $Amaterno= $_POST['apellidoMaternoPaciente'];
                    $genero=$_POST["generoPaciente"];
                    $matricula=$_POST["matricula"];
                    $contrasenia=$_POST["contrasenia"];
                    $fecha=$_POST["fechaNacimiento"];
                    $estadoCivil=$_POST["estadoCivil"];
                    $carrera=$_POST["carrera"];


                    $MPaciente->InsertarPaciente($nombre,$Apaterno,$Amaterno,$genero,$matricula,$contrasenia,$fecha,$estadoCivil,$carrera);
                        
                    
                }
            }
                //Redireccionar a la pagina de registro de usuarios
                header("Location:index.php?accion=registrarUsuarios");
            }
        
            //Consultar las carreras
            include 'Vista/registroUsuarios.php';
        }


        public function consultarUsuarios(){

            include 'Vista/consultarUsuarios.php';

        }

        //Funcion para actualizar los datos del paciente
        public function actualizarPaciente(){
            //Crear un objeto de la clase paciente
            $MPaciente= new paciente($this->conn);
            //Validar si se envio un formulario
            if(isset($_GET['id'])){
                //Obtener el id del paciente
                $id=$_GET['id'];


                //Consultar los datos del paciente
                $ResultPaciente = $MPaciente->ConsultarPaciente($id);
    
                    
                    $nombre= $ResultPaciente['Nombre'];
                    $Apaterno= $ResultPaciente['A_Paterno'];
                    $Amaterno= $ResultPaciente['A_Materno'];
                    $Genero= $ResultPaciente['Genero'];
                    $Matricula= $ResultPaciente['Matricula'];
                    $Contrasenia= $ResultPaciente['Contrasenia'];
                    $FechaNac= $ResultPaciente['Fecha_Nacimiento'];
                    $EstadoCivil= $ResultPaciente['Estado_Civil'];
                    $carrera= $ResultPaciente['Carrera_idCarrera'];

    
                    // echo $nombre . "|" . $precio;
    
    
                
    
            }
    
            //Validar si se envio un formulario
    
            if(isset($_POST['actualizarPaciente'])){
    
                //Obtener los datos del formulario
                $id=$_GET['id'];
                $nombre = $_POST["nombrePaciente"];
                $Apaterno= $_POST['apellidoPaternoPaciente'];
                $Amaterno= $_POST['apellidoMaternoPaciente'];
                $genero=$_POST["genero"];
                $matricula=$_POST["matricula"];
                $contrasenia=$_POST["contrasenia"];
                $fecha=$_POST["fechaNacimiento"];
                $estadoCivil=$_POST["estadoCivil"];
                $carrera=$_POST["carrera"];

                //Actualizar los datos del paciente
                $MPaciente->actualizarPaciente($nombre,$Apaterno,$Amaterno,$genero,$matricula,$contrasenia,$fecha,$estadoCivil,$carrera,$id);
    
                    
                
                
                //Redireccionar a la pagina de consulta de usuarios
                header("LOCATION: index.php?accion=consultarUsuarios");
    
    
            }


            include 'Vista/actualizarPaciente.php';







        }



        public function actualizarDoctor(){
            //Crear un objeto de la clase Doctor
            $MDoctor = new Doctor($this->conn);

            //Validar si se envio un formulario
            if(isset($_GET['id'])){
                //Obtener el id del doctor
                $id=$_GET['id'];
                //Consultar los datos del doctor
                $ResultDoctr = $MDoctor->ConsultarDoctores($id);   
                //Obtener los datos del doctor
                $nombre= $ResultDoctr['Nombre'];
                $Apaterno= $ResultDoctr['A_Paterno'];
                $Amaterno= $ResultDoctr['A_Materno'];
                $Genero= $ResultDoctr['Genero'];
                $Cedula= $ResultDoctr['Cedula'];                    
                $Usuario= $ResultDoctr['Usuario'];
                $Contrasenia= $ResultDoctr['Contrasenia'];
                $Especialidad= $ResultDoctr['Especialidad'];
                $Telefono= $ResultDoctr['Telefono'];
                $Hr_I= $ResultDoctr['Horario_Atencion_I'];
                $Hr_F= $ResultDoctr['Horario_Atencion_F'];
                $FechaIngreso= $ResultDoctr['Fecha_Ingreso'];   
                $Email= $ResultDoctr['Email'];
    
    
                
    
            }
    
            //Validar si se envio un formulario
            if(isset($_POST['actualizarDoctor'])){
    
                //Obtener los datos del formulario
                $id=$_GET['id'];
                $nombre = $_POST["nombre"];
                $Apaterno= $_POST['apellidoPaterno'];
                $Amaterno= $_POST['apellidoMaterno'];
                $genero=$_POST["genero"];
                $cedula=$_POST["cedula"];
                $usuario=$_POST["usuario"];
                $contrasenia=$_POST["password"];
                $especialidad=$_POST["especialidad"];
                $telefono=$_POST["telefono"];
                $Hini=$_POST["horas"];
                $Hfin=$_POST["horasFinal"];
                $fecha=$_POST["fechaIngreso"];
                $Email=$_POST["correo"];
                //Actualizar los datos del doctor
                $MDoctor->actualizarDoctor($nombre,$Apaterno,$Amaterno,$genero,$cedula,$usuario,$contrasenia,$especialidad,$telefono,$Hini,$Hfin,$fecha,$Email,$id);   

                //Redireccionar a la pagina de consulta de usuarios
                header("LOCATION: index.php?accion=consultarUsuarios");
        
        
            }


            include 'Vista/actualizarDoctor.php';




        }


        public function eliminarDoctor(){
            //Obtener el id del doctor
            $id=$_GET['id'];
            //Crear un objeto de la clase Doctor
            $MDoctor = new Doctor($this->conn);
            //Eliminar el doctor
            $MDoctor->eliminarDoctor($id);



            header("LOCATION: index.php?accion=consultarUsuarios");




        }

        //Funcion para eliminar un paciente
        public function eliminarPaciente(){
            //Obtener el id del paciente
            $id=$_GET['id'];
            //Crear un objeto de la clase paciente
            $MPaciente = new paciente($this->conn);
            //Eliminar el paciente
            $MPaciente->eliminarPaciente($id);

            //Redireccionar a la pagina de consulta de usuarios
            header("LOCATION: index.php?accion=consultarUsuarios");


        }

        //Funcion para registrar un medicamento

        public function registroMedicamento(){

            //Crear un objeto de la clase Medicamentos
            $MMedicamento = new Medicamentos($this->conn);

            //Validar si se envio un formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
                //Obtener los datos del formulario
                $nombre = $_POST["nombre"];
                $descripcion= $_POST['descripción'];
                $contenido= $_POST['contenido'];
                $caducidad=$_POST["caducidad"];
                //Insertar los datos en la base de datos
                $MMedicamento->InsertarMedicamento($nombre,$descripcion,$contenido,$caducidad);
                //Redireccionar a la pagina de registro de medicamentos
            header("Location: index.php?accion=registroMedicamento");
        }

            include 'Vista/registroMedicamento.php';



        }
        //Funcion para consultar los medicamentos
        public function consultarMedicamento(){
            //Crear un objeto de la clase Medicamentos
            $MMedicamento = new Medicamentos($this->conn);
            //Consultar los medicamentos
            $result = $MMedicamento->ConsultarTodosMedicamento();
            //Validar si hay medicamentos


            $Salida="";
            
            while($row = $result->fetch_assoc()){
                //Mostrar los medicamentos
                $Salida .= "<tr>";
                $Salida .= "<td>" . $row["idMedicamento"] . "</td>";
                $Salida .= "<td>" . $row["Nombre"] . "</td>";
                $Salida .= "<td>" . $row["Descripcion"] . "</td>";
                $Salida .= "<td>" . $row["Concentracion"] . "</td>";
                $Salida .= "<td>" . $row["Fecha_Caducidad"] . "</td>";
               
                $Salida .= "<td >
                        <a class='btn btn-primary' href='index.php?accion=actualizarMedicamento&id=" . $row["idMedicamento"] . "' >Modificar</a>
                      </td>  
                      <td >
                        <a href='#' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminaMedicamento' data-bs-id='" . $row["idMedicamento"] . "' >Eliminar</a>
                      </td>";
                $Salida .= "</tr>";
            
            }

            include 'Vista/consultarMedicamentos.php';


        }

        //Funcion para actualizar los datos del medicamento
        public function actualizarMedicamento(){
            //Crear un objeto de la clase Medicamentos
            $MMedicamento = new Medicamentos($this->conn);
            //  Validar si se envio un formulario
            if(isset($_GET['id'])){
                //Obtener el id del medicamento
                $id=$_GET['id'];
                $ResultMedicamento = $MMedicamento->ConsultarMedicamento($id);
                //Obtener los datos del medicamento    
                    $nombre= $ResultMedicamento['Nombre'];
                    $Descripcion= $ResultMedicamento['Descripcion'];
                    $Concentracion= $ResultMedicamento['Concentracion'];
                    $Fecha= $ResultMedicamento['Fecha_Caducidad'];
                  
    
    
            
    
            }
    
            //Validar si se envio un formulario
            if(isset($_POST['actualizarMedicamento'])){
    
                //Obtener los datos del formulario
                $id=$_GET['id'];
                $nombre = $_POST["nombre"];
                $Descripcion= $_POST['descripción'];
                $contenido= $_POST['contenido'];
                $caducidad=$_POST["caducidad"];
              //Actualizar los datos del medicamento
                $MMedicamento->actualizarMedicamento($nombre,$Descripcion,$contenido,$caducidad,$id);


                //Redireccionar a la pagina de consulta de medicamentos
                header("LOCATION: index.php?accion=consultarMedicamento");
        
        
            }
                


            include 'Vista/actualizarMedicamento.php';


        }

        public function eliminarMedicamento(){
            //Crear un objeto de la clase Medicamentos
            $id=$_POST['id'];
            //Obtener el id del medicamento
            $MMedicamento = new Medicamentos($this->conn);
            //Eliminar el medicamento
            $MMedicamento->eliminarMedicamento($id);
            //Redireccionar a la pagina de consulta de medicamentos
            header("LOCATION: index.php?accion=consultarMedicamento");


        }

        //Funcion para generar reportes en PDF
        public function reportesPDF(){
            //Crear un objeto de la clase PDF
            $Mpdf = new PDF($this->conn);
            //Validar si se envio un formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
             //Obtener los datos del formulario     
            $FInicio=$_POST['fechaInicio'];
            $FFin=$_POST['fechaFinal'];
            $Tipo=$_POST['tipo'];
                //Generar el reporte en PDF
            $Mpdf->AddPage();
            $Mpdf->generarReporte($FInicio, $FFin, $Tipo);
            $Mpdf->Output();
            
        //    header("Location: index.php?accion=reportesPDF");
            
            

            }

            include 'Vista/reportesPDF.php';

        }

        //Funcion para respaldar la base de datos
        public function respaldoBD(){
            //Crear un objeto de la clase BD
            $MBD = new BD();
            //Validar si se envio un formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $action = $_POST['action'];
                //Realizar la accion correspondiente
                if ($action == 'download') {
                    //Descargar el respaldo
                    $MBD->downloadBackup();
                } elseif ($action == 'upload') {
                    //Subir el respaldo
                    if (isset($_FILES['backup_file']) && $_FILES['backup_file']['error'] == UPLOAD_ERR_OK) {
                        //Subir el archivo
                        $MBD->uploadBackup($_FILES['backup_file']['tmp_name']);
                        $message = "El archivo de respaldo se cargó correctamente.";
                        $messageType = "success";
                    } else {
                        //Mostrar un mensaje de error
                        $message = "Error al cargar el archivo.";
                        $messageType = "danger";
                    }
                }
            }

            include 'Vista/respaldoBD.php';
            //Mostrar un mensaje
            if (isset($message)) {  
                //Mostrar un mensaje
                echo "<div class='alert alert-$messageType' role='alert'>$message</div>";
            }


         

        }



    }

    //mensaje restaura.cancelacion,reportes informacion,ortografia
?>
