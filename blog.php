<?php include 'header.php'; ?>

<?php include 'db/db-co-base-donne.php'; ?>

<?php

// Récupérer les articles
$sql = "SELECT * FROM articles ORDER BY published_at DESC";
$stmt = $pdo->query($sql);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="latest-posts">
    <div class="title">
        <br>
        <h1>Nos Blogs</h1>
    </div>
    <br><br>
    <section class="card-container">
        <?php if (!empty($articles)) : ?>
            <?php foreach ($articles as $article) : ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="Image de l'article" class="card-img">
                    <div class="card-body">
                        <h5 class="card-title"> <?= htmlspecialchars($article['title']) ?> </h5>
                        <p class="card-text"> <?= htmlspecialchars(substr($article['content'], 0, 150)) ?>...</p>
                        <a href="single.php?id=<?= $article['id'] ?>" class="btn btn-primary">Lire la suite</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>
    </section>
</section>

<?php include 'footer.php'; ?>