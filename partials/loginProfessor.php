<?php
require_once(__DIR__ . "/../classes/helpers/Database.php");

$conn = (new Database())->createConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((isset($_POST['email']) && isset($_POST['psw'])) &&
        (!empty($_POST['email']) && !empty($_POST['psw']))
    ) {
        $sql = "SELECT email, password FROM professor WHERE email=?";

        $stm = $conn->prepare($sql);
        $stm->execute([$_POST["email"]]);
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if (!empty($user)) {
            if (password_verify($_POST["psw"], $user["password"])) {
                $_SESSION['username'] = $user['email'];
                header("location: professor.php");
            } else {
                echo 'Nesprávne heslo.';
            }
        } else {
            echo "Učiteľ nebol nájdený.";
        }
    }
}
?>
<form action="loginProfessor.php" method="post">
    <div class="row mb-2">
        <div class=" d-flex justify-content-center">
            <div class="p-2"><a href="index.php">Študent</a></div>
            <div class="p-2"><a href="index.php?role=professor">Učiteľ</a></div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-2">
            <div class="form-group col">
                <label for="email"><b>Email</b></label>
            </div>
            <div class="form-group col">
                <input type="text" id="email" placeholder="Vložte email" name="email" required>
            </div>
        </div>
        <div class="row mb-2">
            <div class="form-group col">
                <label for="psw"><b>Heslo</b></label>
            </div>
            <div class="form-group col">
                <div class="form-group col">
                    <input type="password" id="psw" placeholder="Vložte heslo" name="psw" required>
                </div>
            </div>
        </div>
        <div class="row mb-2">

            <button type="submit" class="btn btn-secondary mt-3">Prihlásiť sa</button>
        </div>
    </div>
    <div class="row mb-2">
        <p>ak nie ste zaregistrovaný, registrujte sa na odkaze: <a href="registration.php">Registrácia</a></p>
    </div>
</form>
