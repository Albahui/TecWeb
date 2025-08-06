<?php
// Controlla se l'utente è loggato
if (!isset($_SESSION['utente'])) {
    echo "<h1>Accesso negato</h1>";
    echo "<p>Devi essere loggato per visualizzare questa sezione.</p>";
    exit();
}

// Inizializza la variabile per la query di ricerca
$search_query = '';
$results = [];

// Questo blocco si esegue solo se l'utente ha inviato il form di ricerca
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = htmlspecialchars($_GET['search_query']);

    // Qui puoi simulare la ricerca o connetterti a un database
    $universities = [
        "Università di Bologna",
        "Università di Roma La Sapienza",
        "Politecnico di Milano",
        "Università di Firenze",
        "Università di Padova",
        "Università di Torino"
    ];

    // Cerchiamo le università che contengono il testo della ricerca
    foreach ($universities as $university) {
        if (stripos($university, $search_query) !== false) {
            $results[] = $university;
        }
    }
}
?>

<h2>La mia università</h2>
<p>
    👋 Benvenuto, <?php echo htmlspecialchars($_SESSION['utente_nome']); ?>! 
    Qui puoi trovare tutte le informazioni utili per il tuo percorso Erasmus.
</p>
<hr>

<h3>Cerca altre università</h3>
<form action="index.php" method="GET">
    <input type="hidden" name="sezione" value="universita">
    
    <label for="search_query">Nome Università:</label>
    <input type="text" id="search_query" name="search_query" placeholder="Es. Bologna" value="<?php echo htmlspecialchars($search_query); ?>" required>
    
    <button type="submit">Cerca</button>
</form>

<?php
// Mostriamo i risultati solo se c'è stata una ricerca
if (!empty($results)) {
    echo "<h4>Risultati della ricerca:</h4>";
    echo "<ul>";
    foreach ($results as $result) {
        echo "<li>" . htmlspecialchars($result) . "</li>";
    }
    echo "</ul>";
} elseif (isset($_GET['search_query'])) { // Mostriamo questo se la ricerca è vuota
    echo "<p>Nessun risultato trovato per '" . htmlspecialchars($search_query) . "'.</p>";
}
?>