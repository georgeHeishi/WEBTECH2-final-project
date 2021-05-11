<?php

session_start();

$code = "Kód testu";

if(isset($_SESSION["code"])){
    $code = $_SESSION["code"];
}else{
    header("Location: index.php?role=student");
    die();
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
    <script src="script/fetch_functions.js"></script>
    <script src="script/start_test.js"></script>
    <script defer src="script/page_visibility.js"></script>
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo $code;?></a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="logout.php">Odhlásiť sa</a>
        </li>
    </ul>
</header>
<div id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
</div>
<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Webové technológie 2</h1>
            </div>

            <div>
                <label for="create-test"></label>
                <input type="button" id="start-test" class="btn btn-primary" value="Začať písať test">
            </div>

            <div id="test" class=" ">

            </div>
        </main>
    </div>
</div>
</body>
</html>