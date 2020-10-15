<!DOCTYPE html>
<html>
  <head>
    <title>Przychodnia nr 1 w Krakowie - Kokpit: Rejestracja pacjenta</title>
</head>
<body>
<?php
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

$imieUstawione = false;
$nazwiskoUstawione = false;
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="imie">Imię:</label>
<input type="text" name="imiePacjenta"><br>
<label for="imie">Nazwisko:</label>
<input type="text" name="nazwiskoPacjenta"><br>
<br><br>
<input type="submit" value="Zadeklaruj przynależność">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$imiePacjenta = pobierzDane($_POST["imiePacjenta"]);
if (!preg_match( '/^[a-ząćęłńóśźż]+$/ui', $imiePacjenta))
{
    $bladImieniaPacjenta = "Dozwolone są tylko litery i białe znaki";
} else {
  $imieUstawione = true;
}
$nazwiskoPacjenta = pobierzDane($_POST["nazwiskoPacjenta"]);
if (!preg_match( '/^[a-ząćęłńóśźż]+$/ui', $nazwiskoPacjenta))
{
    $bladNazwiskaPacjenta = "Dozwolone są tylko litery i białe znaki";
} else {
  $nazwiskoUstawione = true;
}

$query1 = "INSERT INTO pacjenci (imie, nazwisko) VALUES ('$imiePacjenta', '$nazwiskoPacjenta');";
if ($imieUstawione && $nazwiskoUstawione){
  if(mysqli_query($polaczenieZBaza, $query1)){
    echo "<br><br>Rejestracja powiodła się.<br>";
  } else{
    echo "BŁĄD: nie można wykonać $query1. " . mysqli_error($polaczenieZBaza);
  }
  
  $result = mysqli_query($polaczenieZBaza,"SELECT idPacjenta FROM pacjenci WHERE imie='$imiePacjenta' && nazwisko='$nazwiskoPacjenta'");
    while($row=mysqli_fetch_array($result)){
      $idDodanegoPacjenta = $row['idPacjenta'];
    }
  echo "Identyfikator nowego pacjenta: <b>".$idDodanegoPacjenta."</b><br><br><br>";
} else {
  echo "<br>".$bladImieniaPacjenta;
}

}
?>
</form>
<br><a href="rezerwacja_wizyty.php">Zarezerwuj wizytę</a>
<br><a href="index.php">Przejdź do strony głównej</a>
</body>
</html>