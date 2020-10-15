<!DOCTYPE html>
<html>
  <head>
    <title>Przychodnia nr 1 w Krakowie - Kokpit: Usuń lekarza z bazy danych</title>
</head>
<body>
<?php
session_start();
if(!$_SESSION['uwierzytelnienie']){
    header('location:../login.php');
}

$polaczenieZBaza = mysqli_connect("localhost", "root", "", "glownyProjekt");
if (!$polaczenieZBaza)
{
    die('Nie można było się połączyć, błąd: ' . mysql_error());
}

function pobierzDane($dane) {
  $dane = trim($dane);
  $dane = stripslashes($dane);
  $dane = htmlspecialchars($dane);
  return $dane;
}
?>
<h1>Przychodnia lekarska nr 1 w Krakowie</h1>
<h3>Usuń lekarza z bazy danych</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="imie">Imię:</label>
<input type="text" name="imiePacjenta"><br>
<label for="imie">Nazwisko:</label>
<input type="text" name="nazwiskoPacjenta"><br>
<br><br>
<input type="submit" value="Usuń lekarza z bazy danych">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (!preg_match( '/^[a-ząćęłńóśźż]+$/ui', $_POST["imiePacjenta"]))
{
    $bladImieniaPacjenta = "Dozwolone są tylko litery i białe znaki";
    echo $bladImieniaPacjenta;
} else {
    $imiePacjenta = pobierzDane($_POST["imiePacjenta"]);
}
if (!preg_match( '/^[a-ząćęłńóśźż]+$/ui', $_POST["nazwiskoPacjenta"]))
{
    $bladNazwiskaPacjenta = "Dozwolone są tylko litery i białe znaki";
    echo $bladNazwiskaPacjenta;
} else {
    $nazwiskoPacjenta = pobierzDane($_POST["nazwiskoPacjenta"]);
}
$query1 = "DELETE FROM lekarze WHERE imie='$imiePacjenta' AND nazwisko='$nazwiskoPacjenta';";
if(mysqli_query($polaczenieZBaza, $query1)){
  echo "<br><br>Wskazany lekarz został usunięty z listy.<br>";
} else{
  echo "BŁĄD: nie można wykonać $query1. " . mysqli_error($polaczenieZBaza);
}
}
?>
</form>
<br><a href="../kokpit.php">Wróć do kokpitu</a><br>
<a href="../index.php">Przejdź do strony głównej</a>
</body>
</html>