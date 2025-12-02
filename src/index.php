<?php
    session_start();
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dziennik elektroniczny</title>
</head>
<body class="container-fluid">
    <h1>Dziennik elektroniczny</h1>
    <nav>
        <ul class="d-flex justify-content-start list-unstyled">
            <li class="pe-3"><a href="index.php?route=students">Uczniowie</a></li>
            <li class="pe-3"><a href="index.php?route=register">Zarejestruj</a></li>
            <li class="pe-3">
                <?php if(!isset($_SESSION["security"])): ?>
                    <a href="index.php?route=login">Zaloguj</a>
                <?php else: ?>
                    <a href="logout.php">Wyloguj</a>
                    <?php echo "Witaj! " . $_SESSION["security"]["user"]->email; ?>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
    <main>
        <?php
        // routing
            if (isset($_GET["route"])){
                switch ($_GET["route"]) {
                    case "login":
                        require_once("security.php");
                        break;
                    case "register":
                        require_once("registration.php");
                        break;
                    case "students":
                        require_once("Controllers\StudentsController.php");
                        $studentsController = new StudentsController($_GET["action"]??"index");
                        break;
                }
            }
            else {
                require_once("security.php");
            }
        ?>
    </main>

</body>
</html>
