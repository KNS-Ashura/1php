<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
<?php
// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données envoyées
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validation basique (ajoute ici ta propre logique de validation)
    if (empty($username) || empty($email) || empty($password)) {
        echo "Tous les champs sont requis!";
    } else {
        // Ici tu peux ajouter la logique pour enregistrer les données dans la base de données
        echo "Utilisateur enregistré avec succès!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'enregistrement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Page d'enregistrement</h2>

<form method="POST" action="register.php">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="S'enregistrer">
</form>

</body>
</html>