<?php  include '../Static/connect/db.php'?>
<?php

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//Verificamos si existe una sesion
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Obtenemos los datos del formulario
    $idCita = $_POST['id'];
    $motivo = $_POST['motivo'];
    $Tipo = $_POST['Tipo'];
    //Verificamos si es un paciente o un doctor
    if($Tipo == "Paciente")
    {
        //Actualizamos el estado de la cita
        $update = $conn->prepare("UPDATE cita SET Estado_Cita = 'Cancelada paciente', motivo_cancelacion='$motivo' WHERE idCita = ?");
        $update->bind_param("i", $idCita);
        $update->execute();
        //Obtenemos el id del paciente
        $sqlidDoctor= "SELECT Doctor_idDoctor FROM cita WHERE idCita = $idCita";
        $resultDoctor= mysqli_query($conn, $sqlidDoctor);
        $rowDoctor = $resultDoctor->fetch_assoc();
        $idDoctor = $rowDoctor["Doctor_idDoctor"];
        $sqlDoctor = "SELECT * FROM doctor WHERE idDoctor = $idDoctor";
        $resultDoctor= mysqli_query($conn, $sqlDoctor);
        $rowDoctor = $resultDoctor->fetch_assoc();
        $nombre= $rowDoctor["Nombre"];
        $correo= $rowDoctor["Email"];
        $stmt=1;

    }
    else
    {
        //Actualizamos el estado de la cita
        $update = $conn->prepare("UPDATE cita SET Estado_Cita = 'Cancelada', motivo_cancelacion='$motivo' WHERE idCita = ?");
        $update->bind_param("i", $idCita);
        $update->execute();
        $sqlidPaciente= "SELECT Paciente_idPaciente FROM cita WHERE idCita = $idCita";
        $resultPaciente= mysqli_query($conn, $sqlidPaciente);
        $rowPaciente = $resultPaciente->fetch_assoc();
        $idPaciente = $rowPaciente["Paciente_idPaciente"];
        $sqlPaciente = "SELECT * FROM paciente WHERE idPaciente = $idPaciente";
        $resultPaciente= mysqli_query($conn, $sqlPaciente);
        $rowPaciente = $resultPaciente->fetch_assoc();
        $nombre= $rowPaciente["Nombre"];
        $matricula= $rowPaciente["Matricula"];
        $correo= "{$matricula}@upemor.edu.mx";
        $stmt=2;

    }
    if ($stmt==1 || $stmt==2) 
    {   //Enviamos un correo al paciente o doctor
        $mail = new PHPMailer(true);

        try {
            //Server configuraciones
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pruebaestancia0114@gmail.com';
            $mail->Password = 'mffl mykm bbwb hqfp';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('pruebaestancia0114@gmail.com', 'Consultorio UPEMOR');
            $mail->addAddress($correo);
            $mail->Subject = "Aviso de cancelacion de cita";
            $mail->Body = "Hola $nombre, tu cita ha sido cancelada por el siguiente motivo: $motivo";
        

            //Enviar el correo
            $mail->send();
            if($stmt==1)
            {
                header("Location: ../index.php?accion=consultarCitas");
            }
            else
            {
                header("Location: ../index.php?accion=consultaCitaDoctor");
            }
            
        }
        catch (Exception $e) 
        {
            echo "Error al enviar el correo";
        }
    } 
    else 
    {
        echo "Error en el registro: " . $stmt->error;
    }
    //Cerramos la conexion
    $stmt->close();
    $conn->close();
}
?>
