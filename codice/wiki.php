<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wiki";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT w.titolo, w.immagine_url, w.abstract, v.contenuto
        FROM versione_wiki v
        JOIN wiki w ON v.wiki_id = w.id
        WHERE w.id = $wiki_id
        ORDER BY v.data_creazione DESC
        LIMIT 1";

$result = $conn->query($sql);
$wiki = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $wiki ? htmlspecialchars($wiki['titolo']) : "Voce non trovata"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <div class="col-6" id="left-part">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <?php if ($wiki && !empty($wiki['immagine'])): ?>
                <img src="<?php echo htmlspecialchars($wiki['immagine']); ?>" class="img-fluid" style="max-width: 50%; height: auto;">
            <?php else: ?>
                <p class="text-muted">Nessuna immagine disponibile</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-6 bg-light pt-3" id="right-part" style="height: 100vh; overflow-y: auto">
        <?php if ($wiki): ?>
            <h1 class="fw-bold"><?php echo htmlspecialchars($wiki['titolo']); ?></h1>
            <h5 class="fst-italic text-muted">Contenuto</h5>
            <p><?php echo nl2br(htmlspecialchars($wiki['contenuto_testo'])); ?></p>
        <?php else: ?>
            <h1 class="fw-bold text-danger">Voce non trovata</h1>
        <?php endif; ?>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

<?php $conn->close(); ?>
