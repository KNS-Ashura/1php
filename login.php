<?php require "db.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form action="#" method="post">
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                echo "Tous les champs sont requis!";
            } else {
                $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                var_dump($user);
                echo "<br>";
                var_dump($password);
                echo "<br>";
                var_dump($user['password']);
                echo "<br>";
                echo "<br>";
                var_dump(password_verify($password, $user['password']));


                if (password_verify($password, $user['password'])) {
                    echo "Connexion réussie!";
                } else {
                    echo "Identifiants incorrects!";
                }
            }
        }

    ?>
</body>
</html>