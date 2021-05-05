<div class="d-flex flex-column p-4 border rounded mt-5">
    <div id="login-container ">
        <div class="flex-row d-flex justify-content-center">
            <?php include __DIR__ . "/form-login.php"; ?>
        </div>
    </div>
    <div class="flex-row d-flex justify-content-center">

        <p class="error-text">
            <?php
            if (isset($_GET["loginError"])) {
                switch ($_GET["loginError"]) {
                    case 1:
                        echo "Prihlásenie zlyhalo: Prosím zadajte valídne prihlasovacie údaje";
                        break;
                    case 2:
                        echo "Prihlásenie zlyhalo: Prosím skontrolujte svoje prihlasovací email a heslo";
                        break;
                }
            } else if (isset($_GET["registerError"])) {
                switch ($_GET["registerError"]) {
                    case 1:
                        echo "Registrácia zlyhala: Prosím zadajte valídne údaje";
                        break;
                    case 2:
                        echo "Registrácia zlyhala: Prosím zadajte zhodujúce sa heslo s maximálnou dlžkou 16 znakov";
                        break;
                    case 3:
                        echo "Registrácia zlyhala: Konto sa daným emailom už existuje";
                        break;
                }
            }
            ?>
        </p>
    </div>
</div>