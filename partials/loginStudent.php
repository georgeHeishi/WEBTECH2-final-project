<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

date_default_timezone_set('Europe/Bratislava');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once(__DIR__ . "/../classes/helpers/Database.php");

    $conn = (new Database())->createConnection();

    $statement = $conn->prepare("SELECT id FROM tests WHERE code=?");
    $statement->execute([$_POST["code"]]);
    $test_id = $statement->fetch(PDO::FETCH_ASSOC);

    $s = $conn->prepare("INSERT INTO test_logs (test_id, student_id, start) VALUES (?, ?, ?)");
    $s->execute([$test_id['id'], $_POST['id_num'], date('Y-m-d H:i:s', time())]);

    $stm = $conn->prepare("INSERT INTO student (id, name, surname) VALUES (?, ?, ?)");
    $stm->execute([$_POST['id_num'], $_POST['name'], $_POST['surname']]);

    $_SESSION['name'] = $_POST["name"];
    $_SESSION['surname'] = $_POST["surname"];
    $_SESSION['id'] = $_POST["id_num"];

    header("Location: tests/" . $_POST["code"] . ".php");
}

?>

<form action="#" method="post">
    <div class="row mb-2">
        <div class=" d-flex justify-content-center">
            <div class="p-2"><a href="index.php">Študent</a></div>
            <div class="p-2"><a href="index.php?role=professor">Učiteľ</a></div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-2">
            <div class="form-group col">
                <label for="code"><b>Kód testu</b></label>
            </div>
            <div class="form-group col">
                <input type="text" id="code" placeholder="Vložte kód testu" name="code" required>
            </div>
        </div>
        <div id="login" style="display: none;">
            <div class="row mb-2">
                <label for="name"><b>Meno</b></label>
                <input type="text" id="name" placeholder="Vložte meno" name="name" required>
            </div>
            <div class="row mb-2">
                <label for="surname"><b>Priezvisko</b></label>
                <input type="text" id="surname" placeholder="Vložte priezvisko" name="surname" required>
            </div>
            <div class="row mb-2">
                <label for="id_num"><b>Identifikačné číslo</b></label>
                <input type="number" id="id_num" placeholder="Vložte identifikačné číslo" name="id_num" required>
            </div>
            <div class="row mb-2">
                <button type="submit" class="btn btn-secondary mt-3">Prihlásiť sa</button>
            </div>
        </div>
    </div>

</form>
<script>
    $("#code").blur(function (e) {
        var code = document.getElementById("code");
        e.preventDefault();
        $.ajax({
            url: "https://wt69.fei.stuba.sk/test123/validate.php",
            type: "get",
            data: {
                code: code.value
            },
            success: function (data) {
                if (data.code == "") {
                    document.getElementById("login").style.display = "none";
                    document.getElementById("code").style.borderColor = "red";
                } else {
                    document.getElementById("login").style.display = "block";
                    document.getElementById("code").style.borderColor = "green";
                }
            }
        })
    });
</script>
