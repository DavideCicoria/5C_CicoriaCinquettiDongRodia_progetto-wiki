<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wiki";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupero id passato tramite GET e faccio il cast sicuro a intero
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Uso prepared statement
$sql = "SELECT wiki.titolo, wiki.immagine_url, wiki.abstract, versione_wiki.contenuto
        FROM versione_wiki
        JOIN wiki ON versione_wiki.wiki_id = wiki.id
        WHERE wiki.id = ?
        ORDER BY versione_wiki.data_creazione DESC
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$wiki = $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $wiki ? htmlspecialchars($wiki['titolo']) : "Voce non trovata"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="button marginSide" onclick="location.href='index.php'">
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1024 1024"
                     stroke-width="0" fill="currentColor" stroke="currentColor" class="icon">
                    <path
                            d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2zM568 868H456V664h112v204zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z">
                    </path>
                </svg>
            </a>
            <span class="navText">Home</span>
        </button>
    </nav>
</div>
<div class="row">
    <div class="col-6" id="left-part">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <?php if ($wiki && !empty($wiki['immagine_url'])): ?>
                <img src="<?php echo htmlspecialchars($wiki['immagine_url']); ?>" class="img-fluid" style="max-width: 50%; height: auto;">
            <?php else: ?>
                <p class="text-muted">Nessuna immagine disponibile</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-6 bg-light pt-3" id="right-part" style="height: 100vh; overflow-y: auto">
        <?php if ($wiki): ?>
            <h1 class="fw-bold"><?php echo htmlspecialchars($wiki['titolo']); ?></h1>
            <h5 class="fst-italic text-muted"><?php echo htmlspecialchars($wiki['abstract']); ?></h5>
            <p><?php echo htmlspecialchars($wiki['contenuto']); ?></p>
        <?php else: ?>
            <h1 class="fw-bold text-danger">Voce non trovata</h1>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
