<?php
// Connexion à la base de données
$servername = "localhost"; // Ton serveur de base de données
$username = "root"; // Ton nom d'utilisateur
$password = ""; // Ton mot de passe
$dbname = "blog"; // Nom de ta base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer toutes les catégories pour afficher le menu déroulant
$categorie_sql = "SELECT * FROM categorie"; // Assure-toi que la table s'appelle 'categorie'
$categorie_result = $conn->query($categorie_sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Potin Popcorn</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Potin Popcorn">
    <meta name="keywords" content="Blog, Blog stitch,stitch,potin, potin stitch">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <header>
        <div class="navbar-container">
            <div class="title">Potin Popcorn</div>
            <div class="navbar">
                <img src="img/Stitch_popcorn.jpg" alt="Logo" class="logo">
                <a href="index.php">Accueil</a>
                <a href="blog.php">Blog</a>

                <!-- Menu déroulant pour les catégories -->
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Catégories</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="categorie.php">Toutes les catégories</a></li>
                        <?php while ($category = $categorie_result->fetch_assoc()): ?>
                            <li><a class="dropdown-item" href="categorie.php?categorie_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <a href="a_propos.php">À propos</a>
                <a href="galeries.php">Galerie</a>
                <a href="faq.php">FAQ</a>
                <img src="img/Stitch_popcorn.jpg" alt="Logo" class="logo">
            </div>
        </div>
    </header>
</body>

</html>