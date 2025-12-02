<?php
    @session_start();
    $db_connection = mysqli_connect("localhost", "root", "", "database");
?>
<form method="POST" action="security.php?logowanie=1">
    <input type="email" name="email"/>
    <input type="password" name="password"/>
    <button type="submit">Zaloguj</button>
</form>

<?php
    if (isset($_GET["logowanie"])){

        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM `users` WHERE email='$email' AND password=MD5('$password')";

        $result = mysqli_query($db_connection, $sql);

        $user = mysqli_fetch_object($result);

        if ($user) {
            $_SESSION["security"]["user"] = $user;
        }

        header("Location: index.php");

    }
?>


