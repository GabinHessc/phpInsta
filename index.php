<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers la feuille de style -->
</head>
<body>   
    <div class="container"> <!-- Conteneur pour centrer le formulaire -->
        <h2>Se connecter</h2>
        <form method ="POST" action="connexion.php">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required><br>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required><br>
            
            <input type="submit" value="Se connecter">
        </form>
        
        <h2>Créer un Utilisateur</h2>  
        <a href="creationUser.php">Nouvel Utilisateur</a>
    </div>
</body>
</html>
