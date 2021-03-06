<?php

require_once(__DIR__ . "/classes/helpers/Database.php");


$conn = (new Database())->createConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['psw-repeat'])) &&
        (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['psw']) && !empty($_POST['psw-repeat']))
    ) {
        if (strcmp($_POST['psw'], $_POST['psw-repeat']) == 0) {
            try {
                $stm = $conn->prepare("INSERT INTO professor (name, surname, email, password) VALUES (?, ?, ?, ?)");
                $hash = password_hash($_POST['psw'], PASSWORD_BCRYPT);

                $stm->execute([$_POST['name'], $_POST['surname'], $_POST['email'], $hash]);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Nespravne heslo";
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Testovanie</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <link href="css/custom-style/index-style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <link href="css/custom-style/index-style.css" rel="stylesheet">
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="">Registrácia</a>
</header>
<div class="container-fluid">
    <div class="row">
        <main class="col px-md-4">
            <div class="flex-row d-flex justify-content-center">
                <div class="d-flex flex-column p-4 border rounded mt-5">
                    <form action="registration.php" method="POST">
                        <div class="container">
                            <div class="row mb-2">
                                <h3>Prosím, vyplňte tento formulár na dokončenie registrácie.</h3>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="form-group col">
                                    <label for="name" class="col-form-label"><b>Meno</b></label>
                                </div>
                                <div class="form-group col-lg-7">
                                    <input class="form-control" type="text" placeholder="Vložte meno" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="form-group col">
                                    <label for="surname" class="col-form-label"><b>Priezvisko</b></label>
                                </div>
                                <div class="form-group  col-lg-7">
                                    <input class="form-control" type="text" placeholder="Vložte priezvisko" name="surname" id="surname"
                                           required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="form-group col">
                                    <label for="email" class="col-form-label"><b>Email</b></label>
                                </div>
                                <div class="form-group  col-lg-7">
                                    <input class="form-control" type="email" placeholder="Vložte email" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="form-group col">
                                    <label for="psw" class="col-form-label"><b>Heslo</b></label>
                                </div>
                                <div class="form-group  col-lg-7">
                                    <input class="form-control" type="password" placeholder="Vložte heslo" name="psw" id="psw" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="form-group col">
                                    <label for="psw-repeat" class="col-form-label"><b>Heslo znova</b></label>
                                </div>
                                <div class="form-group  col-lg-7">
                                    <input class="form-control" type="password" placeholder="Vložte znova heslo" name="psw-repeat"
                                           id="psw-repeat"
                                           required>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <button type="submit" class="btn btn-secondary mt-5" id="rgstr">Registrovať</button>
                            </div>
                        </div>
                        <div class="row mx-auto" style="width: 300px">
                            <p>Máte už vytvorený účet? <a href="index.php" class="register reglog">Prihlásenie</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </main>
    </div>
</div>
<script>
    var reg = document.getElementById('rgstr');
    reg.onclick = function () {
        var psw = document.getElementById('psw').innerHTML;
        var psw_rep = document.getElementById('psw-repeat').innerHTML;

        var n = psw.localeCompare(psw_rep);
        console.log("Velkost n je: " + n);
        if (n != 0) {
            alert("Heslá sa nezhodujú, prosím zadajte zhodné heslá.");
        }
    }
</script>
</body>

</html>