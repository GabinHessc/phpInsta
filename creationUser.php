<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un nouvel Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Police générale */
            background-color: #f4f4f4; /* Couleur d'arrière-plan */
            color: #333; /* Couleur du texte */
            margin: 0; /* Supprime les marges par défaut */
            padding: 20px; /* Espacement interne */
        }

        h1 {
            text-align: center; /* Centre le titre */
            color: #2c3e50; /* Couleur du titre */
        }

        .form-container {
            max-width: 400px; /* Largeur maximale du formulaire */
            margin: 20px auto; /* Centre le formulaire */
            padding: 20px; /* Espacement interne */
            background: white; /* Couleur de fond du formulaire */
            border-radius: 8px; /* Arrondir les coins */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Ombre autour du formulaire */
        }

        label {
            display: block; /* Étiquette en bloc */
            margin-bottom: 5px; /* Espacement en bas des étiquettes */
            font-weight: bold; /* Met en gras les étiquettes */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%; /* Largeur complète */
            padding: 10px; /* Espacement interne */
            margin-bottom: 15px; /* Espacement en bas des champs */
            border: 1px solid #ccc; /* Bordure des champs */
            border-radius: 4px; /* Arrondir les coins des champs */
            font-size: 16px; /* Taille de la police des champs */
        }

        input[type="submit"] {
            background-color: #2c3e50; /* Couleur de fond du bouton */
            color: white; /* Couleur du texte du bouton */
            border: none; /* Pas de bordure */
            padding: 10px; /* Espacement interne */
            border-radius: 4px; /* Arrondir les coins du bouton */
            cursor: pointer; /* Curseur en main */
            font-size: 16px; /* Taille de la police du bouton */
            transition: background-color 0.3s; /* Transition de couleur de fond */
        }

        input[type="submit"]:hover {
            background-color: #34495e; /* Couleur de fond du bouton au survol */
        }
    </style>
</head>
<body>
    <h1>Création d'un nouvel Utilisateur</h1>
    <div class="form-container">
        <form method="POST" action="creationUser_.php">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Envoyer">
        </form>
    </div>
</body>
</html>
