<?php 
session_start();
require "db.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>

    <a href="register.php">S'inscrire</a>
    <a href="login.php">Se connecter</a>
    
    <?php
    if (isset($_SESSION['firstName']) && isset($_SESSION['lastName'])) {
        echo "<h2>Bonjour, {$_SESSION['firstName']} {$_SESSION['lastName']} !</h2>";
        echo '<a href="logout.php">Se déconnecter</a>';
    } else {
        echo "<h2>Bienvenue, invité ! <a href='login.php'>Connectez-vous</a> pour voir plus de contenu.</h2>";
    }

    $users = [];

    try {
        $sql = "SELECT Id, email, firstName, lastName, description FROM user";
        $users = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des utilisateurs: " . $e->getMessage();
    }
    ?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f4f4f4;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<h2>Liste des utilisateurs :</h2>

<?php if (!empty($users)) : ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= htmlspecialchars($user['Id']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?></td>
                <td><?= htmlspecialchars($user['description']) ?></td>
                <td>
                    <?php if (isset($_SESSION['id'])) : ?>
                        <?php if ($_SESSION['id'] != $user['Id']) : ?>
                            <a href="editUser.php?id=<?= $user['Id'] ?>">Modifier</a> | 
                            <a href="deleteUser.php?id=<?= $user['Id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>Aucun utilisateur trouvé.</p>
<?php endif; ?>
</body>
</html>
