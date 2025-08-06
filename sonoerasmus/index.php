<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>SonoErasmus+</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Colore di sfondo leggero per la pagina */
        }
        header {
            background-color: #fff;
            padding: 20px 40px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between; /* Allinea il titolo e la nav su lati opposti */
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        nav a {
            margin-left: 15px; /* Spazio a sinistra tra i link */
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px 40px;
        }
        .login-register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh; /* Centra il contenuto verticalmente */
        }
        .form-card {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #eee;
        }
    </style>
    <script>
    function confermaLogout() {
        if (confirm("Sei sicuro di voler uscire?")) {
            window.location.href = "esegui_logout.php";
        }
    }
    </script>
</head>
<body>
    <header>
        <h1>SonoErasmus+</h1>
        <nav>
            <?php if (!isset($_SESSION['utente'])): ?>
                <a href="index.php?sezione=register">Registrati</a>
                <a href="index.php?sezione=login">Login</a>
            <?php else: ?>
                <a href="index.php?sezione=home">Home</a>
                <a href="index.php?sezione=universita">La mia università</a>
                <a href="index.php?sezione=cosafare">Cosa fare</a>
                <a href="index.php?sezione=eventi">Eventi</a>
                <a href="index.php?sezione=contatti">Contatti</a>
                <a href="index.php?sezione=profilo">Profilo</a>
                <a href="#" onclick="confermaLogout()">Logout</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <?php
        if (isset($_SESSION['utente_nome'])) {
            echo "<p>👋 Ciao, " . htmlspecialchars($_SESSION['utente_nome']) . "!</p>";
        }

        if (isset($_GET['sezione'])) {
            $sezione = $_GET['sezione'];
            switch ($sezione) {
                case 'register':
                    echo '<div class="login-register-container">';
                    include('register.html');
                    echo '</div>';
                    break;
                case 'login':
                    echo '<div class="login-register-container">';
                    include('login.html');
                    echo '</div>';
                    break;
                case 'universita':
                    include('universita.php');
                    break;
                case 'eventi':
                    include('eventi.php');
                    break;
                case 'profilo':
                    include('profilo.php');
                    break;
                case 'home':
                    include('home.php');
                    break;
                case 'cosafare':
                    include('cosafare.php');
                    break;
                case 'contatti':
                    include('contatti.php');
                    break;

                default:
                    echo "<p>Benvenuto su SonoErasmus+! Seleziona una sezione dal menù per iniziare.</p>";
            }
        } else {
            echo "<p>Benvenuto su SonoErasmus+! Seleziona una sezione dal menù per iniziare.</p>";
        }
        ?>
    </main>
</body>
</html>