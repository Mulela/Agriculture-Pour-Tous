<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Charger l'autoloader de Composer
require 'vendor/autoload.php';

// Traitement de la requête AJAX pour l'envoi du formulaire de contact
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $nom = isset($_POST['name']) ? $_POST['name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $number = isset($_POST['number']) ? $_POST['number'] : '';
  $address = isset($_POST['address']) ? $_POST['address'] : '';
  $message = isset($_POST['message']) ? $_POST['message'] : '';

  // Insertion dans la base de données ou envoi par e-mail, selon le cas
  if (!empty($nom) && !empty($email) && !empty($number) && !empty($address) && !empty($message)) {
    try {
      // Créer une instance de PHPMailer
      $mail = new PHPMailer(true);
      // Paramètres du serveur SMTP
      $mail->isSMTP();
      $mail->Host = 'mail.agriculturepourtous.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'info@agriculturepourtous.com';
      $mail->Password = 'agriculturepourtous2005';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      // Destinataires
      $mail->setFrom('noreply@agriculturepourtous.com', 'agriculturepourtous');
      $mail->addAddress('info@agriculturepourtous.com', 'agriculturepourtous');

      // Contenu de l'e-mail
      $mail->isHTML(true);
      $mail->Subject = "Contacte Agriculture Pour Tous";
      $mail->Body = "
          <html>
          <head>
              <style>
                  body {
                      background-color: #000;
                      color: #fff;
                      font-family: Arial, sans-serif;
                      padding: 20px;
                      border: 2px solid #fff;
                      max-width: 600px;
                      margin: 0 auto;
                  }
                  h2 {
                      text-align: center;
                  }
                  p {
                      margin-bottom: 10px;
                  }
                  .logo {
                      display: block;
                      margin: 0 auto;
                  }
              </style>
          </head>
          <body>
              <img class='logo' src='https://i.imgur.com/cGcgWgn.png' alt='Logo' width='250'>
              <h2>Informations du formulaire :</h2>
              <p><strong>Nom :</strong> $nom</p>
              <p><strong>Email :</strong> $email</p>
              <p><strong>Numero :</strong> $number</p>
              <p><strong>Adresse :</strong> $address</p>
              <hr>
              <p><strong>Message :</strong><br>$message</p>
          </body>
          </html>
      ";

      // Envoyer l'e-mail
      $mail->send();

      // Répondre avec un message de succès
      echo json_encode(['success' => true, 'message' => 'Votre message a été envoyé avec succès.']);
      exit;
    } catch (Exception $e) {
      // Répondre avec un message d'erreur
      echo json_encode(['success' => false, 'error' => 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail, veuillez réessayer.' . $mail->ErrorInfo]);
      exit;
    }
  } else {
    // Répondre avec un message d'erreur si un champ est vide
    echo json_encode(['success' => false, 'error' => 'Les champs ne peuvent pas être vides.']);
    exit;
  }
}

