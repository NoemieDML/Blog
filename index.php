<?php include 'header.php'; ?>

<div class="content">
  <h1>Article Populaire</h1>
</div>

<?php
// Connexion à la base de données avec PDO
$host = 'localhost';
$db = 'blog';
$user = 'root';
$pass = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Récupérer les articles les plus récents
  $sql = "SELECT id, title, content, image_url FROM articles ORDER BY published_at DESC LIMIT 3";
  $stmt = $pdo->query($sql);
  $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<div class="carousel">
  <div class="carousel-inner">
    <?php if (!empty($articles)): ?>
      <?php foreach ($articles as $index => $article): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
          <div class="image-container" style="text-align: center;">
            <img src="<?= htmlspecialchars($article['image_url'] ?: 'default.jpg'); ?>"
              alt="<?= htmlspecialchars($article['title']); ?>"
              class="article-image"
              style="max-width: 60%; height: auto;">
          </div>
          <div class="carousel-caption">
            <h3><?= htmlspecialchars($article['title']); ?></h3>
            <p><?= substr(htmlspecialchars($article['content']), 0, 150); ?>...</p>
            <a href="single.php?id=<?= $article['id']; ?>" class="read-more">Lire la suite</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Aucun article trouvé.</p>
    <?php endif; ?>
  </div>

  <!-- Flèches de navigation -->
  <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
  <button class="next" onclick="changeSlide(1)">&#10095;</button>
</div>

<script>
  let slideIndex = 0;
  const slides = document.querySelectorAll('.carousel-item');

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.style.display = (i === index) ? 'block' : 'none';
    });
  }

  function changeSlide(direction) {
    slideIndex += direction;
    if (slideIndex >= slides.length) slideIndex = 0;
    if (slideIndex < 0) slideIndex = slides.length - 1;
    showSlide(slideIndex);
  }

  showSlide(slideIndex);
</script>

<?php include 'footer.php'; ?>