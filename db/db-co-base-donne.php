<?php
// Connexion à la base de données
$host = 'localhost';  // Hôte
$user = 'root';       // Utilisateur
$pass = '';           // Mot de passe
$dbname = 'blog'; // Nom de la base de données

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
