<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

require 'data_Base.php';
require 'userRepository.php';

$db = new data_Base('localhost', 'cours_php','root','');
$pdo = $db->getpdo();
$userRepo = new UserReporitory($pdo);

// Récupérer les informations de l'utilisateur connecté
$email = $_SESSION['user'];
$userData = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
$userData->execute(['email' => $email]);
$user = $userData->fetch();

if (!$user) {
    echo "Utilisateur introuvable.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
</head>
<body>

<h2>Modifier le profil</h2>

<form method="POST" action="updateUtilisateur_.php">
    Nom : <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>"><br>
    Email : <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>
    Mot de passe (ne pas remplire pour ne pas modifier): <input type="password" name="password"><br>
    <input type="submit" value="Mettre à jour">
</form>

</body>
</html>
