<?php
// database.php
$host = 'db';
$dbname = 'monsite';
$user = 'user';
$password = 'password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { ?>
    <p> Votre base de données n'est pas connectée</p>
<?php } ?>