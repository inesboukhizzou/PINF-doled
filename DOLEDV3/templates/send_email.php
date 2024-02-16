<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Adresse e-mail de réception
    $to = "martialhuret@gmail.com";

    // Sujet de l'e-mail
    $subject = "Nouveau message de $name";

    // Corps de l'e-mail
    $body = "Vous avez reçu un nouveau message de $name ($email):\n\n$message";

    // En-têtes de l'e-mail
    $headers = "From: $email";

    // Envoi de l'e-mail
    if (mail($to, $subject, $body, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi de votre message.";
    }
}
?>
