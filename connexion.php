<?php
session_start();
include 'UserRepository.php';
include 'data_Base.php';

$db = new data_Base('localhost', 'cours_php','root','');
$pdo = $db->getpdo();
$userRepo = new UserReporitory($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Tous les champs sont requis.";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email invalide.";
        return;
    }
    $isConnected = $userRepo->connexiondb($email, $password);
    
    if ($isConnected) {
        // Stocker des informations en session
        $_SESSION['user'] = $email;
        $_SESSION['user_id'] = $user['id']; 
        echo "Connexion réussie.";
        // Rediriger vers une page protégée après connexion réussie
        header('Location: http://localhost/projetInsta/pageConnexion.php');
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}
?>