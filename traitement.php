<?php
try {
    // Connexion à la base de données "salma"
    $pdo = new PDO('mysql:host=localhost;dbname=salma', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si les champs sont remplis
        if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['message'])) {
            // Récupérer et protéger les données du formulaire
            $nom = htmlspecialchars($_POST['nom']); 
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            // Préparation et exécution de la requête
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, message) VALUES (:nom, :email, :message)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            // Message de confirmation
            echo "Merci, $nom. Votre message a été reçu avec succès !";
        } else {
            echo "Tous les champs sont requis.";
        }
    } else {
        echo "Aucune donnée soumise.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>