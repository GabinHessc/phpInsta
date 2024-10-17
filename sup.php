<?php
session_start(); // Démarrer la session

// Inclure le fichier de connexion à la base de données et le repository
require 'data_Base.php'; 
require 'userRepository.php';

// Initialiser la base de données et le repository
$db = new data_Base('localhost', 'cours_php', 'root', ''); // Remplacez par vos propres informations de connexion
$userRepo = new UserReporitory($db->getpdo()); // Créer une instance du UserRepository

// Vérifier si l'utilisateur connecté est admin
if ($_SESSION['user'] === "e@admin.fr") {
    // Vérifier si le paramètre 'num' est présent dans l'URL
    if (isset($_GET['num'])) {
        // Appeler la méthode de suppression
        $userRepo->supprdb($_GET['num']);

        $l = $_GET['num'];
        echo "La ligne à l'id $l a été supprimée <br>";
    } else {
        echo "Aucun ID d'utilisateur fourni.";
    }

    // Afficher tous les utilisateurs restants après la suppression
    $stmt = $userRepo->getAllUsers(); // Récupérer tous les utilisateurs
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlspecialchars($row['id']) . " - " . htmlspecialchars($row['nom']) . " - " . htmlspecialchars($row['email']) . "<br>";
    }
} else {
    echo "Vous n'avez pas la permission de supprimer cet utilisateur.";
}

// Rediriger vers test.php après un délai (optionnel)
header('Location: pageConnexion.php');
exit();
?>

