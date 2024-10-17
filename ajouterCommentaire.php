<?php
session_start();
require 'data_Base.php';
require 'posteRepository.php';
require 'userRepository.php';

$db = new data_Base('localhost', 'cours_php', 'root', '');
$pdo = $db->getpdo();
$posteRepo = new posteReporitory($pdo);
$userRepo = new UserReporitory($pdo);

if (isset($_POST['commentaire']) && isset($_GET['poste_id'])) {
    $commentaire = $_POST['commentaire'];
    $user_id = $userRepo->getIDdb($_SESSION['user']);  // L'utilisateur connecté
    $poste_id = $_GET['poste_id'];    // Le poste auquel on veut ajouter un commentaire

    // Ajout du commentaire dans la base de données
    $posteRepo->ajouterCommentaire($commentaire, $user_id, $poste_id);

    // Rediriger vers la page du post après ajout du commentaire
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
    
} else {
    echo "Paramètres manquants pour ajouter un commentaire.";
}
?>
