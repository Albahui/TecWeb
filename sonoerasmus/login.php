<?php
session_start();

$host = "localhost";
$port = "5432";
$dbname = "sonoerasmus";
$user = "postgres";
$password = "diana";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'];
    $password_input = $_POST['password'];

    $sql = "SELECT * FROM Utente WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    $utente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utente && password_verify($password_input, $utente['password'])) {
        $_SESSION['utente'] = $utente['username'];
        $_SESSION['utente_nome'] = $utente['nome'];
        $_SESSION['utente_id'] = $utente['id'];
        header("Location: index.php");
        exit();
    } else {
        echo "❌ Email o password errati.";
    }

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
}
?>
