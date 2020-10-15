<?php
$polaczenieZBaza = mysqli_connect("localhost", "root", "", "glownyProjekt");
if (!$polaczenieZBaza)
{
    die('Nie można było się połączyć, błąd: ' . mysql_error());
}

function pobierzDane($dane)
{
    $dane = trim($dane);
    $dane = stripslashes($dane);
    $dane = htmlspecialchars($dane);
    return $dane;
}
$idPacjenta = 0;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Przychodnia nr 1 w Krakowie - Rezerwacja wizyty lekarskiej</title>
</head>
<body>
<h1>Przychodnia lekarska nr 1 w Krakowie</h1>
<h3>Rezerwacja wizyty lekarskiej</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="imie">Imię:</label>
<input type="text" name="imiePacjenta"><br>
<label for="imie">Nazwisko:</label>
<input type="text" name="nazwiskoPacjenta">
<br><label for="imie">Lekarz:</label>
<select name="lekarz" id="lekarz">
<?php
$query2 = mysqli_query($polaczenieZBaza, "SELECT * FROM lekarze");
while ($wiersz = mysqli_fetch_array($query2))
{
    $daneLekarza = $wiersz['nazwisko']." ".$wiersz['imie'];
    echo '<option value="' . $wiersz['idLekarza'] . '">' . $wiersz['nazwisko'] . ' ' . $wiersz['imie'] . '</option>';
}
?>
</select><br>
<label for="godzina">Godzina wizyty:</label>
<input type="time" id="godzina" name="godzina"><br><br>
<input type="submit" value="Dokonaj rezerwacji wizyty">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST["imiePacjenta"] && $_POST["nazwiskoPacjenta"] && $_POST["lekarz"] && $_POST["godzina"]){
        $imiePacjenta = $_POST["imiePacjenta"];
        $nazwiskoPacjenta = $_POST["nazwiskoPacjenta"];
        $result = mysqli_query($polaczenieZBaza, "SELECT idPacjenta FROM pacjenci WHERE imie='$imiePacjenta' && nazwisko='$nazwiskoPacjenta'");
        if(mysqli_num_rows($result) > 0)
        while ($row = mysqli_fetch_array($result))
            {
                $idPacjenta = $row['idPacjenta'];
            }
        if($idPacjenta){
        $godzina = $_POST["godzina"];
        $idLekarza = $_POST["lekarz"];
        $query3 = "INSERT INTO wizyty (godzina, idLekarza, idPacjenta) VALUES ('$godzina', '$idLekarza', '$idPacjenta')";
        if (mysqli_query($polaczenieZBaza, $query3))
        {
            echo "<br>Wizyta została zarejestrowana u: <b>".$daneLekarza."</b><br>";
        }
        else
        {
            echo "<br>Wizyta nie została zarejestrowana: $query3. " . mysqli_error($polaczenieZBaza);
        }
        }else{
            echo '<p>Osoba o danych '.$_POST["imiePacjenta"].' '.$_POST["nazwiskoPacjenta"].' nie jest pacjentem tej przychodni. Użyj formularza deklaracji, dostępnego poniżej.</p>';
        }
    }else{
        echo '<p style="color:red;">Wymagane jest wypełnienie wszystkich pól.</p>';
    }
}
?>
<br><a href="dodaj_pacjenta.php">Zadeklaruj przynależność do tej przychodni</a>
<br><a href="index.php">Przejdź do strony głównej</a>
</body>
</html>
