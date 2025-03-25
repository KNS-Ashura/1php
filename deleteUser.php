<?php
session_start();
require "db.php";

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Vérifier si l'utilisateur est connecté et qu'il a les droits pour supprimer
    if (isset($_SESSION['firstName']) && isset($_SESSION['lastName'])) {
        // Ne pas permettre à l'utilisateur connecté de se supprimer
        if ($_SESSION['firstName'] != $userId) {
            try {
                // Exécuter la requête DELETE
                $stmt = $conn->prepare("DELETE FROM user WHERE Id = ?");
                $stmt->execute([$userId]);

                // Rediriger vers la liste des utilisateurs après la suppression
                header("Location: index.php");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression de l'utilisateur: " . $e->getMessage();
            }
        } else {
            echo "Vous ne pouvez pas vous supprimer vous-même.";
        }
    } else {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        header("Location: login.php");
        exit();
    }
}
?>