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

    //TODO: start sa meni az ked sa button stlaci
    $s = $conn->prepare("INSERT IGNORE INTO test_logs (test_id, student_id, start) VALUES (?, ?, ?)");
    $s->execute([$test_id['id'], $_POST['id_num'], date('Y-m-d H:i:s', time())]);

    $stm = $conn->prepare("INSERT IGNORE INTO student (id, name, surname) VALUES (?, ?, ?)");
    $stm->execute([$_POST['id_num'], $_POST['name'], $_POST['surname']]);

    session_start();
    $_SESSION['name'] = $_POST["name"];
    $_SESSION['surname'] = $_POST["surname"];
    $_SESSION['id'] = $_POST["id_num"];
    $_SESSION['code'] = $_POST["code"];
    $_SESSION['role'] = "student";

    header("Location: student_home.php");
}

?>

<form action="#" method="post">
    <div class="row mb-2">
        <div class="d-flex justify-content-center">
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
                <div class="form-group col">
                    <label for="name"><b>Meno</b></label>
                </div>
                <div class="form-group col">
                    <input type="text" id="name" placeholder="Vložte meno" name="name" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col">
                    <label for="surname"><b>Priezvisko</b></label>
                </div>
                <div class="form-group col">
                    <input type="text" id="surname" placeholder="Vložte priezvisko" name="surname" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col">
                    <label for="id_num"><b>Identifikačné číslo</b></label>
                </div>
                <div class="form-group col">
                    <input type="number" id="id_num" placeholder="Vložte identifikačné číslo" name="id_num" required>
                </div>
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
            url: "validate.php",
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
