<?php include 'header.php'; ?>

<?php include 'db/db-co-base-donne.php'; ?>

<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupérer l'article correspondant
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article): ?>

        <body>
            <div class="container">
                <h1><?= htmlspecialchars($article['title']); ?></h1>
                <p class="date"><em>Publié le <?= date('d/m/Y', strtotime($article['published_at'])); ?></em></p>

                <?php if (!empty($article['image_url'])): ?>
                    <img src="<?= htmlspecialchars($article['image_url']); ?>" alt="<?= htmlspecialchars($article['title']); ?>" class="article-image">
                <?php endif; ?>


                <p class="content"><?= nl2br(htmlspecialchars($article['content'], ENT_QUOTES, 'UTF-8')); ?></p>
                <a class="btn btn-primary" href="index.php">Retour à l'accueil</a>
                <a class="btn btn-primary" href="blog.php">Retour au blog</a>
            </div>
        </body>



    <?php else: ?>
        <p style='text-align:center;color:red;'>Article non trouvé.</p>
    <?php endif; ?>
<?php } else { ?>
    <p style='text-align:center;color:red;'>ID invalide.</p>
<?php } ?>


<div class="commentaire">

    <?php include 'db\db-comments.php' ?>

    <form action="submit_comment.php" method="POST">
        <label for="comment">Votre commentaire :</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>
        <br>
        <button type="submit">Envoyer</button>
    </form>

</div>


<?php include 'footer.php'; ?>