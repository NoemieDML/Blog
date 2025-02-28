<?php include 'db/db-co-base-donne.php'; ?>

<?php
// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentaire = $_POST['comment'];

    // Insérer le commentaire dans la base de données
    $sql = "INSERT INTO commentaires (commentaire) VALUES (:commentaire)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $stmt->execute();

    echo "<p>Votre commentaire a été soumis avec succès !</p>";
}

// Récupérer les commentaires
$sql = "SELECT message, date_creation, author FROM commentaires ORDER BY date_creation DESC";
$stmt = $pdo->query($sql);

// Afficher les commentaires
if ($stmt->rowCount() > 0) {
    echo "<div class='comments-list'>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='comment'>";
        echo "<p><strong>" . htmlspecialchars($row['author']) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
        echo "<p><em>Le " . htmlspecialchars($row['date_creation']) . "</em></p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Aucun commentaire trouvé.</p>";
}
?>
