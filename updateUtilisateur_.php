<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

require 'data_Base.php';
require 'userRepository.php';

$db = new data_Base('localhost', 'cours_php', 'root', '');
$pdo = $db->getpdo();
$userRepo = new UserReporitory($pdo);

// Récupérer les nouvelles données du formulaire
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];

if (!$nom || !$email) {
    echo "Veuillez fournir un nom et un email valide.";
    exit();
}

// Si le mot de passe est rempli, on le met à jour également
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $userRepo->updatedb($_SESSION['user'], $nom, $email, $hashed_password);
} else {
    // Si le mot de passe n'est pas fourni, on ne met pas à jour ce champ
    $userRepo->updatedb($_SESSION['user'], $nom, $email, null);
}

// Mettre à jour la session si l'email a été changé
$_SESSION['user'] = $email;

header('Location: pageConnexion.php');
exit();
?>
