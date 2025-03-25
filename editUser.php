<?php
session_start();
require "db.php";

// Vérifier si l'utilisateur est connecté et a accès à la modification
if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Vérifier si l'ID de l'utilisateur à modifier est passé dans l'URL
if (!isset($_GET['id'])) {
    // Si l'ID n'est pas présent, rediriger vers la page d'accueil
    header("Location: index.php");
    exit();
}

// Récupérer l'ID de l'utilisateur à modifier
$userId = $_GET['id'];

// Récupérer les informations de l'utilisateur à modifier
$user = [];
try {
    $sql = "SELECT * FROM user WHERE Id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des informations de l'utilisateur: " . $e->getMessage();
    exit();
}

// Vérifier si l'utilisateur connecté est celui qui doit être modifié
if ($_SESSION['firstName'] != $user['firstName'] || $_SESSION['lastName'] != $user['lastName']) {
    // Si ce n'est pas l'utilisateur connecté, rediriger vers la page d'accueil
    header("Location: index.php");
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $description = htmlspecialchars($_POST['description']);

    // Mettre à jour les informations dans la base de données
    try {
        $sql = "UPDATE user SET firstName = :firstName, lastName = :lastName, email = :email, description = :description WHERE Id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Rediriger vers la page d'accueil après la modification
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour de l'utilisateur: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
</head>
<body>

    <a href="index.php">Retour à l'accueil</a>
    <h2>Modifier les informations de l'utilisateur</h2>

    <form method="POST" action="editUser.php?id=<?= $user['Id'] ?>">
        <label for="firstName">Prénom :</label>
        <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($user['firstName']) ?>" required><br><br>

        <label for="lastName">Nom :</label>
        <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($user['lastName']) ?>" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($user['description']) ?></textarea><br><br>

        <button type="submit">Mettre à jour</button>
    </form>

</body>
</html>