<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['send'])) {
    // Récupérer les données du formulaire
    $nom = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
}
// Échapper les données pour les afficher dans du HTML
$nom = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$number = htmlspecialchars($number, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

$message = "Nom : " . $nom . "<br>" . " Email : " . $email . "<br>" . "Numero : " . $number . "<br>" . "message : " . $message;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'mail.agriculturepourtous.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'info@agriculturepourtous.com';                     //SMTP username
    $mail->Password = 'agriculturepourtous2005';                               //SMTP password
    $mail->SMTPSecure = 'tls';          //Enable implicit TLS encryption
    $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@agriculturepourtous.com', 'agriculture pour tous');
    $mail->addAddress('info@agriculturepourtous.com', 'agriculture pour tous');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contact Agriculture pour tous';
    $mail->Body = $message;

    $mail->send();
    echo "
    <!DOCTYPE html>
    <html>
    <head>
      <title>GeeksForGeeks Sweet alert</title>
      <script src=
    'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js'>
      </script>
    </head>
    <body>
      <script>
      swal({
        title: 'E-mail envoyé !',
        text: 'Votre e-mail a été envoyé avec succès.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then((value) => {
        // Si l'utilisateur appuie sur OK, retourne à la page précédente
        if (value) {
          window.history.back();
        }
      });
      </script>
    </body>
    </html>
    ";
} catch (Exception $e) {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
      <title>GeeksForGeeks Sweet alert</title>
      <script src=
    'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js'>
      </script>
    </head>
    <body>
      <script>
      swal({
        title: 'Erreur',
        text: 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail, veuillez réessayer',
        icon: 'error',
        confirmButtonText: 'OK'
      }).then((value) => {
        // Si l'utilisateur appuie sur OK, retourne à la page précédente
        if (value) {
          window.history.back();
        }
      });
      </script>
    </body>
    </html>
    ";
}