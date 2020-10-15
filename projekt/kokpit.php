<!DOCTYPE html>
<html>
<head>
<title>Kokpit</title>
</head>
<body>
<?php
session_start();
if(!$_SESSION['uwierzytelnienie']){
    header('location:login.php');
}
?>
<p><a href="kokpit-funkcje/dodaj_lekarza.php">Dodaj lekarza do bazy</a></p>
<p><a href="kokpit-funkcje/usun_lekarza.php">Usuń lekarza z bazy</a></p>
<p><a href="dodaj_pacjenta.php">Dodaj pacjenta do bazy</a></p>
<p><a href="rezerwacja_wizyty.php">Rezerwacja wizyty lekarskiej</a></p>
<p><a href="kokpit-funkcje/dodaj_administratora.php">Dodaj administratora do kokpitu</a></p>
<p><a href="logout.php">Wyloguj się</a></p>
</body>
</html>