<?php 
require "env.php";
require "db.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <a href="register.php">register</a>
    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo "Tous les champs sont requis!";
    } else {
        echo "Utilisateur enregistré avec succès!";
        

        $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        
        $stmt->execute([$firstName, $lastName, $email, password_hash($password, PASSWORD_DEFAULT)]);
        
        echo "Utilisateur enregistré avec succès!";
    }
}
?>

<h2>Page des utilisateurs</h2>

</body>
</html>