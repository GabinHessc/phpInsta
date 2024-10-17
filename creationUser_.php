<?php
include 'UserRepository.php';
include 'data_Base.php';

// Connexion à la base de données
$db = new data_Base('localhost', 'cours_php','root','');
$pdo = $db->getpdo();
$userRepo = new UserReporitory($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email invalide.";
        return;
    }

    $userRepo->ajoutdb($nom, $email, $password);

}
header('Location: index.php');
?>