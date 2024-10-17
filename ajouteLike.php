<?php
session_start();
require 'data_Base.php';
require 'posteRepository.php';
require 'userRepository.php';

$db = new data_Base('localhost', 'cours_php', 'root', '');
$pdo = $db->getpdo();
$posteRepo = new posteReporitory($pdo);
$userRepo = new UserReporitory($pdo);


echo $_SESSION['user_id'];
echo $userRepo->getIDdb($_SESSION['user']);

if (isset($_GET['poste_id'])) {
    $user_id = $userRepo->getIDdb($_SESSION['user']);
    $poste_id = $_GET['poste_id'];

    // Vérifiez d'abord si l'utilisateur a déjà aimé ce poste
    $sql = "SELECT * FROM aime WHERE id_utilisateur = :user_id AND id_posteInsta = :poste_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'poste_id' => $poste_id]);

    if ($stmt->rowCount() == 0) {
        // Si l'utilisateur n'a pas encore aimé, ajoutez un like
        $sql = "INSERT INTO aime (id_utilisateur, id_posteInsta) VALUES (:user_id, :poste_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'poste_id' => $poste_id]);

        

        echo "Like ajouté avec succès.";
    } else {
        echo "Vous avez déjà aimé ce poste.";
    }

    // Rediriger l'utilisateur vers la page précédente
    header('Location: pageConnexion.php');
    
} else {
    echo "Paramètres manquants.";
}
?>
