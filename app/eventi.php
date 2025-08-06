<?php
include("connessione.php");

try {
    $sql = "SELECT e.id, e.titolo, e.descrizione, e.data_evento, e.luogo, u.nome AS universita
            FROM Evento e
            JOIN Universita u ON e.universita_id = u.id
            ORDER BY e.data_evento ASC";
    $stmt = $pdo->query($sql);
    $eventi = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Errore nel recupero eventi: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eventi Erasmus</title>
</head>
<body>
    <h2>Prossimi Eventi Erasmus</h2>
   
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] === 'successo') {
            echo '<p style="color: green;">🎉 Ti sei iscritto con successo all\'evento!</p>';
        } elseif ($_GET['status'] === 'errore') {
            $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Si è verificato un errore.';
            echo '<p style="color: red;">⚠️ Errore: ' . $message . '</p>';
        }
    }
    ?>
    <?php if ($eventi): ?>
        <ul>
        <?php foreach ($eventi as $evento): ?>
            <li>
                <form action="partecipa.php" method="POST">
                    <input type="hidden" name="evento_id" value="<?= $evento['id'] ?>">
                    
                    <strong><?= htmlspecialchars($evento['titolo']) ?></strong><br>
                    <?= htmlspecialchars($evento['descrizione']) ?><br>
                    📍 <?= htmlspecialchars($evento['luogo']) ?> — 📅 <?= htmlspecialchars($evento['data_evento']) ?><br>
                    🎓 Università: <?= htmlspecialchars($evento['universita']) ?><br>

                    <?php if (isset($_SESSION['utente_id'])): ?>
                        <button type="submit">Partecipa</button>
                    <?php else: ?>
                        <p><em>Effettua il login per partecipare</em></p>
                    <?php endif; ?>
                    <hr>
                </form>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nessun evento disponibile al momento.</p>
    <?php endif; ?>

    <p><a href="index.php">Torna alla Home</a></p>
</body>
</html>
