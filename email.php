<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des données
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Vérifications supplémentaires
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>
                alert('Tous les champs sont obligatoires.');
                window.history.back();
              </script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Adresse email invalide.');
                window.history.back();
              </script>";
        exit;
    }

    // Adresse de réception
    $to = "moyaflorence007@gmail.com";

    // Sujet et contenu de l'email
    $email_subject = "Nouveau message de $name : $subject";
    $email_body = "Nom: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Sujet: $subject\n";
    $email_body .= "Message:\n$message\n";

    // Headers
    $headers = "From: $email";

    // Envoi de l'email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>
                alert('Votre message a été envoyé avec succès.');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "<script>
                alert('Erreur : Votre message n'a pas pu être envoyé.');
                window.history.back();
              </script>";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
