<?php include 'header.php'; ?>

<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'blog';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Récupération des images et titres des articles
    $sql = "SELECT image_url, title FROM articles";
    $stmt = $pdo->query($sql);
    $articles = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "<p class='error'>Erreur de connexion : " . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}
?>

<section class="container ">

    <?php if (!empty($articles)) : ?>
        <?php foreach ($articles as $article) : ?>
            <div class="article card">
                <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="img-fluid card-img-top">
                <div class="card-body">
                    <h5 class="card-title"> <?= htmlspecialchars($article['title']) ?> </h5>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="text-center w-100">Aucun article trouvé.</p>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>