<?php
    
    include 'Modelo/pdf.php';
    include 'Modelo/respaldoBD.php';


    class C_Admi{

        private $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }



        public function acciones(){

            $op = isset($_GET['accion']) ? $_GET['accion'] : '';

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


        public function actualizarPaciente(){

            $MPaciente= new paciente($this->conn);

            if(isset($_GET['id'])){

                $id=$_GET['id'];



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


        public function eliminarPaciente(){

            $id=$_GET['id'];

            $MPaciente = new paciente($this->conn);
            
            $MPaciente->eliminarPaciente($id);

            
            header("LOCATION: index.php?accion=consultarUsuarios");


        }


        public function registroMedicamento(){


            $MMedicamento = new Medicamentos($this->conn);

            if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
            
                $nombre = $_POST["nombre"];
                $descripcion= $_POST['descripción'];
                $contenido= $_POST['contenido'];
                $caducidad=$_POST["caducidad"];

                $MMedicamento->InsertarMedicamento($nombre,$descripcion,$contenido,$caducidad);
        
            header("Location: index.php?accion=registroMedicamento");
        }

            include 'Vista/registroMedicamento.php';



        }

        public function consultarMedicamento(){

            $MMedicamento = new Medicamentos($this->conn);

            $result = $MMedicamento->ConsultarTodosMedicamento();

            $Salida="";

            while($row = $result->fetch_assoc()){

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


        public function actualizarMedicamento(){

            $MMedicamento = new Medicamentos($this->conn);

            if(isset($_GET['id'])){

                $id=$_GET['id'];
                $ResultMedicamento = $MMedicamento->ConsultarMedicamento($id);
                   
                    $nombre= $ResultMedicamento['Nombre'];
                    $Descripcion= $ResultMedicamento['Descripcion'];
                    $Concentracion= $ResultMedicamento['Concentracion'];
                    $Fecha= $ResultMedicamento['Fecha_Caducidad'];
                  
    
    
            
    
            }
    
    
            if(isset($_POST['actualizarMedicamento'])){
    
                
                $id=$_GET['id'];
                $nombre = $_POST["nombre"];
                $Descripcion= $_POST['descripción'];
                $contenido= $_POST['contenido'];
                $caducidad=$_POST["caducidad"];
              
                $MMedicamento->actualizarMedicamento($nombre,$Descripcion,$contenido,$caducidad,$id);


                
                header("LOCATION: index.php?accion=consultarMedicamento");
        
        
            }
                


            include 'Vista/actualizarMedicamento.php';


        }

        public function eliminarMedicamento(){

            $id=$_POST['id'];

            $MMedicamento = new Medicamentos($this->conn);

            $MMedicamento->eliminarMedicamento($id);

            header("LOCATION: index.php?accion=consultarMedicamento");


        }


        public function reportesPDF(){

            $Mpdf = new PDF($this->conn);

            if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
                  
            $FInicio=$_POST['fechaInicio'];
            $FFin=$_POST['fechaFinal'];
            $Tipo=$_POST['tipo'];

            $Mpdf->AddPage();
            $Mpdf->generarReporte($FInicio, $FFin, $Tipo);
            $Mpdf->Output();
            
        //    header("Location: index.php?accion=reportesPDF");
            
            

            }

            include 'Vista/reportesPDF.php';

        }


        public function respaldoBD(){

            $MBD = new BD();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $action = $_POST['action'];
    
                if ($action == 'download') {
                    $MBD->downloadBackup();
                } elseif ($action == 'upload') {
                    if (isset($_FILES['backup_file']) && $_FILES['backup_file']['error'] == UPLOAD_ERR_OK) {
                        $MBD->uploadBackup($_FILES['backup_file']['tmp_name']);
                        $message = "El archivo de respaldo se cargó correctamente.";
                        $messageType = "success";
                    } else {
                        $message = "Error al cargar el archivo.";
                        $messageType = "danger";
                    }
                }
            }

            include 'Vista/respaldoBD.php';
            
            if (isset($message)) {
                echo "<div class='alert alert-$messageType' role='alert'>$message</div>";
            }


         

        }



    }

    //mensaje restaura.cancelacion,reportes informacion,ortografia
?>
