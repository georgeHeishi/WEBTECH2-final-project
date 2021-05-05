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

                $stm->execute([ $_POST['name'], $_POST['surname'], $_POST['email'], $hash]);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        else {
            echo "Nespravne heslo";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
    <title>WEBTE2</title>
</head>

<body>
    <form action="registration.php" method="POST">
        <h2>Registrácia</h2>
        <div class="container">
            <h3>Prosím, vyplňte tento formulár na dokončenie registrácie.</h3>
            <br>
            <label for="name"><b>Meno</b></label>
            <input type="text" placeholder="Vložte meno" name="name" id="name" required>
            <br>
            <label for="surname"><b>Priezvisko</b></label>
            <input type="text" placeholder="Vložte priezvisko" name="surname" id="surname" required>
            <br>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Vložte email" name="email" id="email" required>
            <br>
            <label for="psw"><b>Heslo</b></label>
            <input type="password" placeholder="Vložte heslo" name="psw" id="psw" required>
            <br>
            <label for="psw-repeat"><b>Heslo znova</b></label>
            <input type="password" placeholder="Vložte znova heslo" name="psw-repeat" id="psw-repeat" required>
            <br>

            <button type="submit" class="registerbtn" id="rgstr">Registrovať</button>
        </div>
    </form>
    <p>Máte už vytvorený účet? <a href="index.php" class="register">Prihlásenie</a></p>
    <script>
    var reg = document.getElementById('rgstr');
    reg.onclick = function() {
        var psw = document.getElementById('psw').innerHTML;
        var psw_rep = document.getElementById('psw-repeat').innerHTML;
        
        var n = psw.localeCompare(psw_rep);
        console.log("Velkost n je: "+ n);
        if(n != 0) {
            alert("Heslá sa nezhodujú, prosím zadajte zhodné heslá.");
        }
    }
    </script>
</body>

</html>