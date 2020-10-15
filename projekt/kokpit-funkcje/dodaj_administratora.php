<!DOCTYPE html>
<html>

<head>
    <title>Przychodnia nr 1 w Krakowie - Kokpit: Dodaj administratora do bazy danych</title>
</head>

<body>
    <?php 
    session_start();
    if(!$_SESSION['uwierzytelnienie']){
        header('location:../login.php'); 
    }
    $polaczenieZBaza = mysqli_connect("localhost", "root", "", "glownyProjekt");
    if (!$polaczenieZBaza){ die('Nie można było się połączyć, błąd: ' . mysqli_error());}
    ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login">Login:</label>
        <input type="text" name="login"><br>
        <label for="haslo">Hasło:</label>
        <input type="password" name="haslo"><br>
        <br><br>
        <input type="submit" value="Dodaj administratora do bazy danych">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["login"];
        $haslo = $_POST["haslo"];

        $skrotHasla = password_hash($haslo, PASSWORD_ARGON2I);
        $query1 = "INSERT INTO login (login, haslo) VALUES ('$login', '$skrotHasla')";

        if(mysqli_query($polaczenieZBaza, $query1)){
            echo "<br><br>Administrator został dodany.<br>";
          } else{
            echo "BŁĄD: nie można wykonać $query1. " . mysqli_error($polaczenieZBaza);
          }
    }
    ?>
    <br><a href="../kokpit.php">Wróć do kokpitu</a><br>
<a href="../index.php">Przejdź do strony głównej</a>
</body>

</html>