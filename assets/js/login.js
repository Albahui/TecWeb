// assets/js/login.js

// L'evento 'DOMContentLoaded' assicura che lo script venga eseguito dopo che il DOM è stato completamente caricato.
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const urlParams = new URLSearchParams(window.location.search);
    
    // Logica per mostrare gli errori che provengono dal PHP (lato server)
    if (urlParams.has('error')) {
        const error = urlParams.get('error');
        const loginErrorSpan = document.getElementById('loginError');

        if (error === 'utente_non_trovato') {
            loginErrorSpan.textContent = "Utente non trovato.";
            loginErrorSpan.style.display = 'block';
        } else if (error === 'password_errata') {
            loginErrorSpan.textContent = "Password errata.";
            loginErrorSpan.style.display = 'block';
        }
    }

    // Aggiungi un 'listener' per l'invio del form
    loginForm.addEventListener('submit', function(event) {
        // Previene l'invio del form per permettere la validazione lato client
        event.preventDefault();

        // Nasconde tutti i messaggi di errore precedenti
        document.querySelectorAll('.error').forEach(function(errorSpan) {
            errorSpan.style.display = 'none';
        });

        const usernameOrEmail = document.getElementById('username_or_email').value.trim();
        const password = document.getElementById('password').value.trim();
        let isValid = true;

        // Validazione: i campi non devono essere vuoti
        if (usernameOrEmail === '') {
            isValid = false;
            document.getElementById('loginError').textContent = "Inserisci il tuo username o e-mail.";
            document.getElementById('loginError').style.display = 'block';
        }

        if (password === '') {
            isValid = false;
            document.getElementById('passwordError').textContent = "Inserisci la tua password.";
            document.getElementById('passwordError').style.display = 'block';
        }

        // Se tutte le validazioni passano, invia il form al server
        if (isValid) {
            this.submit();
        }
    });
});