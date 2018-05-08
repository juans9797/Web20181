<?php
$remitente = $_POST['email'];
$Nombre = $_POST['nombre'];
$asunto = $_POST['Asunto']; // acá se puede modificar el asunto del mail
$Mensaje = $_POST['Mensaje'];
$servername = "17.18.18.4:3306";
$username = "test";
$password = "test";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$createTable = "CREATE TABLE IF NOT EXISTS correos (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30),
asunto VARCHAR(30),
email VARCHAR(50),
mensaje VARCHAR(150)
)";

$insert = "INSERT INTO correos (nombre,asunto,email,mensaje) VALUES ('$Nombre','$asunto','$remitente','$Mensaje')";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';



$mail = new PHPMailer;
$mail->isSMTP(); //Indicar que se usará SMTP
$mail->CharSet = 'UTF-8';//permitir envío de caracteres especiales (tildes y ñ)
    
$mail->SMTPDebug = 0; 
$mail->Debugoutput = 'html'; //Mostrar mensajes (resultados) de depuración(debug) en html
    /*CONFIGURACIÓN DE PROVEEDOR DE CORREO QUE USARÁ EL EMISOR(GMAIL)*/
$mail->Host = 'smtp.gmail.com'; //Nombre de host
        // $mail->Host = gethostbyname('smtp.gmail.com'); // Si su red no soporta SMTP sobre IPv6
$mail->Port = 587; //Puerto SMTP, 587 para autenticado TLS
$mail->SMTPSecure = 'tls'; //Sistema de encriptación - ssl (obsoleto) o tls
$mail->SMTPAuth = true;//Usar autenticación SMTP
$mail->SMTPOptions = array(
            'ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true)
        );//opciones para "saltarse" comprobación de certificados (hace posible del envío desde localhost)
    //CONFIGURACIÓN DEL EMISOR
        $mail->Username = "sebastianrivera97@gmail.com";
        $mail->Password = "N58705870";
        $mail->setFrom('from@example.com', $asunto);
        $mail->addAddress('sebastianrivera97@gmail.com', 'Mario'); 

    //CONFIGURACIÓN DEL MENSAJE, EL CUERPO DEL MENSAJE SERA UNA PLANTILLA HTML QUE INCLUYE IMAGEN Y CSS
        $mail->Subject = $asunto; //asunto del mensaje
        $mail->Body    = "Nombre:   ".$Nombre."\t\n". "Correo:  ".$remitente. "\t\n". "Mensaje: ". $Mensaje. "\t\n";
        if (!$mail->send()) {
        echo "Error al enviar: " . $mail->ErrorInfo;
    } else {
    
    if ($conn->query($createTable) === TRUE)     
    if ($conn->query($insert) === TRUE)     
    include 'confirma.html'; //se debe crear un html que confirma el envío
}
?>
