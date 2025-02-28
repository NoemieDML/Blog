<?php include 'header.php'; ?>

<?php include 'db/db-co-base-donne.php'; ?>

<?php

// Récupérer la catégorie (paramètre GET)
$categorie_id = isset($_GET['categorie_id']) ? intval($_GET['categorie_id']) : 0;

// Préparation de la requête
if ($categorie_id > 0) {
    $sql = "SELECT a.id, a.title, a.content, a.published_at, a.author_id, a.image_url 
            FROM articles a
            INNER JOIN articles_categorie ac ON a.id = ac.articles_id
            INNER JOIN categorie c ON ac.categorie_id = c.id
            WHERE ac.categorie_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categorie_id]);
} else {
    $sql = "SELECT id, title, content, published_at, author_id, image_url FROM articles";
    $stmt = $pdo->query($sql);
}
$articles = $stmt->fetchAll();
?>

<h1 class="center">Articles par Catégorie</h1>

<!-- Affichage des articles sous forme de cartes -->
<section class="card-container">
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <div class="card">
                <div class="card-content">
                    <!-- Image de l'article -->
                    <?php if (!empty($article['image_url'])): ?>
                        <div class="card-img-container">
                            <img src="<?= htmlspecialchars($article['image_url']); ?>" alt="Image de l'article" class="card-img">
                        </div>
                    <?php endif; ?>

                    <!-- Contenu de l'article -->
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($article['title']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars(substr($article['content'], 0, 150)); ?>...</p>
                        <a href="single.php?id=<?= htmlspecialchars($article['id']); ?>" class="btn btn-primary">Lire la suite</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun article dans cette catégorie.</p>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>