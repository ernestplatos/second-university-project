<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Przychodnia nr 1 w Krakowie - Logowanie do kokpitu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="nazwaUzytkownika">Nazwa użytkownika:</label>
  <input type="text" id="nazwaUzytkownika" name="nazwaUzytkownika"><br><br>
  <label for="haslo">Hasło:</label>
  <input type="password" id="haslo" name="haslo"><br>
  <br><input type="submit" value="Zaloguj się">
</form>
<?php
$polaczenieZBaza = mysqli_connect('localhost','root','','glownyProjekt');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$nazwaUzytkownika = $_POST['nazwaUzytkownika'];
$haslo = $_POST['haslo'];

$query = "SELECT * FROM login WHERE login = '".$nazwaUzytkownika."'";
$tbl = mysqli_query($polaczenieZBaza,$query);

if(mysqli_num_rows($tbl) > 0) {
  $wiersz = mysqli_fetch_array($tbl);
  $skrotHasla = $wiersz['haslo'];

  if(password_verify($haslo, $skrotHasla)){
    session_start();
    $_SESSION['uwierzytelnienie'] = 'true';
    header('location: kokpit.php');
  } else {
    echo "<p>Nazwa użytkownika lub hasło jest nieprawidłowe.</p>";
  }

} else {
  echo "<p>Wskazany użytkownik nie istnieje.</p>";
}
}
?>
</body>
</html>