<?php
    @session_start();
    $db_connection = mysqli_connect("localhost", "root", "", "database");
?>

<form method="POST" action="registration.php?rejestracja=1">
    <input type="email" name="email"/>
    <input type="password" name="password"/>
    <input type="password" name="confirm_password"/>
    <p class="alert alert-danger" role="alert"><?=$_COOKIE['error']??""?></p>
    <button type="submit">Zarejestruj</button>
</form>


<?php
    setcookie('error', "", -1);


    if (isset($_GET["rejestracja"])){

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($password != $confirm_password){
            setcookie('error', "Hasła nie są takie same!");
            header("Location: index.php?route=register");
        }

        $sql = "SELECT * FROM `users` WHERE email='$email'";
        $result = mysqli_query($db_connection, $sql);

        if(mysqli_num_rows($result))
        {
            setcookie('error', "Dla tego email konto istnieje!");
            header("Location: index.php?route=register");
        }


        $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('$email', MD5('$password'))";

        $result = mysqli_query($db_connection, $sql);

        header("Location: index.php");

    }
?>
