<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$port = "5432";
$dbname = "sonoerasmus";
$user = "postgres";
$password = "diana"; 

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password_pura = $_POST['password'];

    $hashed = password_hash($password_pura, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO Utente (nome, cognome, email, username, password) 
            VALUES (:nome, :cognome, :email, :username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':cognome' => $cognome,
        ':email' => $email,
        ':username' => $username,
        ':password' => $hashed
    ]);

    echo "✅ Registrazione completata con successo!";
} catch (PDOException $e) {
    echo "❌ Errore durante la registrazione: " . $e->getMessage();
}
?>