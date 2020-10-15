<!DOCTYPE html>
<html>
  <head>
    <title>Przychodnia nr 1 w Krakowie - Kokpit: Dodaj lekarza do bazy danych</title>
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

$imieUstawione = false;
$nazwiskoUstawione = false;


?>
<h1>Przychodnia lekarska nr 1 w Krakowie</h1>
<h3>Dodaj lekarza do bazy danych</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="imie">Imię:</label>
<input type="text" name="imiePacjenta"><br>
<label for="imie">Nazwisko:</label>
<input type="text" name="nazwiskoPacjenta"><br>
<br><br>
<input type="submit" value="Dodaj lekarza do bazy danych">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$imiePacjenta = pobierzDane($_POST["imiePacjenta"]);
if (!preg_match( '/^[a-ząćęłńóśźż]+$/ui', $imiePacjenta))
{
    $bladImieniaPacjenta = "Dozwolone są tylko litery i białe znaki";
}else {
  $imieUstawione=true;
}
$nazwiskoPacjenta = pobierzDane($_POST["nazwiskoPacjenta"]);
if (!preg_match( '/^[a-ząćęłńóśźż]+$/ui', $nazwiskoPacjenta))
{
    $bladImieniaPacjenta = "Dozwolone są tylko litery i białe znaki";
} else {
  $nazwiskoUstawione = true;
}
$query1 = "INSERT INTO lekarze (imie, nazwisko) VALUES ('$imiePacjenta', '$nazwiskoPacjenta');";
if($imieUstawione && $nazwiskoUstawione){
  if(mysqli_query($polaczenieZBaza, $query1)){
    echo "<br><br>Lekarz został dodany.<br>";
  } else{
    echo "BŁĄD: nie można wykonać $query1. " . mysqli_error($polaczenieZBaza);
  }
  $result = mysqli_query($polaczenieZBaza,"SELECT idLekarza FROM lekarze WHERE imie='$imiePacjenta' && nazwisko='$nazwiskoPacjenta'");
  while($row=mysqli_fetch_array($result)){
    $idDodanegoPacjenta = $row['idLekarza'];
  }
echo "Identyfikator nowego lekarza: <b>".$idDodanegoPacjenta."</b><br><br><br>";
} else {
  echo '<br><p style="color:red;">'.$bladImieniaPacjenta.'</p>';
}
}
?>
</form>
<br><a href="../kokpit.php">Wróć do kokpitu</a><br>
<a href="../index.php">Przejdź do strony głównej</a>
</body>
</html>