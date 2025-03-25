<?php
session_start();
require "db.php";

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    if (isset($_SESSION['firstName']) && isset($_SESSION['lastName'])) {
        if ($_SESSION['firstName'] != $userId) {
            try {
                $stmt = $conn->prepare("DELETE FROM user WHERE Id = ?");
                $stmt->execute([$userId]);

                header("Location: index.php");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression de l'utilisateur: " . $e->getMessage();
            }
        } else {
            echo "Vous ne pouvez pas vous supprimer vous-même.";
        }
    } else {
        header("Location: login.php");
        exit();
    }
}
?>