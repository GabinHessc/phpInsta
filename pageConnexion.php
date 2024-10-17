<?php
session_start();

// Vérifie si l'utilisateur est connecté, sinon redirige vers la page d'accueil
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

echo "Bienvenue, " . htmlspecialchars($_SESSION['user']) . " !"; // Affiche le nom de l'utilisateur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Post</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers la feuille de style -->
</head>
<body>
    <?php
        // Inclusion des fichiers nécessaires
        require 'data_Base.php';
        require 'userRepository.php';
        require 'posteRepository.php';

        // Initialisation de la base de données et des repos
        $db = new data_Base('localhost', 'cours_php', 'root', '');
        $pdo = $db->getpdo();
        $userRepo = new UserReporitory($pdo);
        $stmt = $userRepo->getAllUsers(); // Récupération de tous les utilisateurs
        $posteRepo = new posteReporitory($pdo);
        $stmt2 = $posteRepo->getAllPosts(); // Récupération de tous les posts
    ?>

    <div class="profile-info">Vous êtes connecté en tant que <?php echo htmlspecialchars($_SESSION['user']); ?>.</div>
    <a href="updateUtilisateur.php?user=<?php echo urlencode($_SESSION['user']); ?>">Modifier son profil</a>
    <a href="logout.php" style="float: right;">Se déconnecter</a>

    <h2>Ajouter un nouveau post</h2>
    <form method="POST" action="nouveauPoste.php" enctype="multipart/form-data">
        <label for="description">Description :</label>
        <input type="text" name="descriptions" id="description" required>
        
        <label for="fileUpload">Télécharger une image :</label>
        <input type="file" name="photo" id="fileUpload" accept="image/*" required>
        
        <input type="submit" value="Envoyer"> <!-- Bouton d'envoi du post -->
    </form>

    <h2>Utilisateurs enregistrés</h2>
    <table>
        <tr>
            <th>Info</th>
        </tr>
        <?php while ($row = $stmt->fetch()) : ?>
        <tr>
            <td> <?php $userRepo->getdb($row); ?> </td> <!-- Affiche les informations de l'utilisateur -->
            <td><a href="sup.php?num=<?php echo $row['id']; ?>">Supprimer</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Poste</h2>
    <table>
        <?php while ($row = $stmt2->fetch()) : ?>
        <tr>
            <td> <?php $posteRepo->getdb($row); ?> </td> <!-- Affiche la description du post -->
            <td> Posté par : <?php echo htmlspecialchars($posteRepo->getPostOwnerName($row['id'])); ?> </td> <!-- Nom de l'utilisateur qui a posté -->
            <td> <img src=<?php $posteRepo->getImagedb($row); ?> width="80" height="60" > </td> <!-- Image du post -->
            <td> <a href="ajouteLike.php?poste_id=<?php echo urlencode($row['id']); ?>">Aimer</a> </td> <!-- Lien pour aimer le post -->
            <td> <p><?php echo $posteRepo->countLikes($row['id']); ?> j'aime</p> </td> <!-- Nombre de likes -->
            <td>
                <form method="POST" action="ajouterCommentaire.php?poste_id=<?php echo urlencode($row['id']); ?>">
                    <textarea name="commentaire" placeholder="Ajouter un commentaire"></textarea><br> <!-- Zone de texte pour ajouter un commentaire -->
                    <input type="submit" value="Commenter"> <!-- Bouton pour soumettre le commentaire -->
                </form>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <h4>Commentaires :</h4>
                <ul>
                    <?php 
                    $commentaires = $posteRepo->getCommentairesByPost($row['id']); // Récupération des commentaires pour le post
                    foreach ($commentaires as $commentaire) : ?>
                        <li>
                            <strong><?php echo htmlspecialchars($commentaire['nom']); ?>:</strong> 
                            <?php echo htmlspecialchars($commentaire['comentaire']); ?> <!-- Affichage des commentaires -->
                        </li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
