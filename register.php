<?php 
    require "db.php";
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Inscription</h1>
    <form action="#" method="post">
        <input type="text" name="firstName" placeholder="Prénom" required>
        <input type="text" name="lastName" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Adresse email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <label for="description">Description :</label>
        <textarea id="description" name="description"></textarea><br>
        <button type="submit">S'inscrire</button>
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $description = $_POST['description'] ?? ''; // Valeur vide par défaut si aucune description n'est fournie

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo "Tous les champs sont requis!";
    } else {
        // Vérifier si l'email existe déjà dans la base de données
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $emailExists = $stmt->fetchColumn();

        if ($emailExists > 0) {
            // L'email est déjà utilisé
            echo "Un compte avec cet email existe déjà!";
        } else {
            // Préparation de la requête d'insertion avec description et date
            $stmt = $conn->prepare("INSERT INTO user (firstName, lastName, email, password, description, created_at, updated_at) 
                                    VALUES (?, ?, ?, ?, ?, NOW(), NOW())");

            // Exécution de la requête
            $stmt->execute([$firstName, $lastName, $email, password_hash($password, PASSWORD_DEFAULT), $description]);

            echo "Utilisateur enregistré avec succès!";
        }
    }
}
?>

<a href="login.php">se connecter</a>
</div>
</body>
</html>

</body>
</html>