<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données et validation
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $website = !empty($_POST['website']) ? htmlspecialchars(trim($_POST['website'])) : 'Non fourni';
    $message = htmlspecialchars(trim($_POST['message']));

    // Validation des champs obligatoires
    if (empty($name) || empty($email) || empty($message)) {
        echo "Erreur : Tous les champs marqués d'un * sont obligatoires.";
        exit;
    }

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Erreur : Adresse email invalide.";
        exit;
    }

    // Adresse de réception
    $to = "moyaflorence007@gmail.com"; // Remplacez par votre email

    // Sujet de l'email
    $subject = "Nouveau message de $name via votre formulaire";

    // Contenu de l'email
    $body = "Nom: $name\n";
    $body .= "Email: $email\n";
    $body .= "Site Web: $website\n";
    $body .= "Message:\n$message\n";

    // Headers de l'email
    $headers = "From: $email";

    // Envoi de l'email
    if (mail($to, $subject, $body, $headers)) {
        // Envoi de l'email de confirmation à l'utilisateur
        $confirmation_subject = "Confirmation de réception de votre message";
        $confirmation_body = "Bonjour $name,\n\nMerci pour votre message. Nous vous répondrons dès que possible.\n\nCordialement,\nL'équipe.";
        $confirmation_headers = "From:  moyaflorence007@gmail.com"; // Changez cette adresse si nécessaire

        // Envoi de l'email de confirmation
        mail($email, $confirmation_subject, $confirmation_body, $confirmation_headers);

        // Redirection ou message de succès
        echo "<script>
                alert('Votre message a été envoyé avec succès.');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "<script>
                alert('Erreur : Impossible d\'envoyer votre message. Veuillez réessayer plus tard.');
                window.history.back();
              </script>";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
