<?php

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}


require 'data_Base.php';
require 'posteRepository.php';
require 'userRepository.php';

// Créer une instance de la connexion à la base de données
$db = new data_Base('localhost', 'cours_php','root','');
$pdo = $db->getpdo();
$postRepo = new posteReporitory($pdo);
$userRepo = new UserReporitory($pdo); // Instance de UserReporitory

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descriptions = $_POST['descriptions'];
    $email = $_SESSION['user']; // Supposons que vous stockez l'email dans la session
    $id_utilisateur = $userRepo->getIDdb($email); // Récupérer l'ID de l'utilisateur

    // Gestion du fichier uploadé
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $uploadFileDir = './uploads/'; // Dossier pour stocker les images
        $dest_path = $uploadFileDir . $fileName;

        // Déplacer le fichier vers le dossier cible
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Ajouter le poste à la base de données
            $postRepo->ajoutdb($dest_path, $descriptions, $id_utilisateur); // ID utilisateur passé ici
        } else {
            echo "Erreur lors de l'upload de l'image.";
        }
    } else {
        echo "Aucun fichier image sélectionné ou erreur dans l'upload.";
    }
}
header('Location: pageConnexion.php');

?>

