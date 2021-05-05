<?php
if (isset($_GET["role"])) {
    if (strcmp($_GET["role"], "professor") == 0) {
        include __DIR__ . "/loginProfessor.php";
    }else {
        include __DIR__ . "/loginStudent.php";
    }
} else {
    include __DIR__ . "/loginStudent.php";
}
