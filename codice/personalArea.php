<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Personal area</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="button marginSide">
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

            <div id="navButtonsContainer">
                <!-- Bottone trigger modal -->
                <button type="button" class="loginButton <?php echo isset($_SESSION['logged_in']) ? 'hidden' : ''; ?>" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Log in
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>

                <!-- Bottone personal area -->
                <a href="personalArea.php">
                    <button type="button" id="personalAreaButton" class="loginButton <?php echo isset($_SESSION['logged_in']) && $_SESSION['role'] == 'admin' ? '' : 'hidden'; ?>">
                        Area Personale
                        <div class="arrow-wrapper">
                            <div class="arrow"></div>
                        </div>
                    </button>
                </a>
            </div>
        </nav>
    </div>


    <div class="row">
        <div class="col-4">
            <h1>Pagina Area Personale</h1>
            <p>Questa è la pagina con cui puoi usare i tuoi permessi all'interno delle wiki!</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>