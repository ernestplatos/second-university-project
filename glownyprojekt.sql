-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Cze 2020, 21:42
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `glownyprojekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekarze`
--

CREATE TABLE `lekarze` (
  `idLekarza` int(11) NOT NULL,
  `imie` text DEFAULT NULL,
  `nazwisko` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `lekarze`
--

INSERT INTO `lekarze` (`idLekarza`, `imie`, `nazwisko`) VALUES
(1, 'Łukasz', 'Szumowski'),
(2, 'Konstanty', 'Radziwiłł'),
(3, 'Marian', 'Zembala'),
(4, 'Zbigniew', 'Religa'),
(5, 'Bartosz', 'Arłukowicz'),
(6, 'Ewa', 'Kopacz'),
(7, 'Marek', 'Balicki'),
(8, 'Marian', 'Czakanski'),
(9, 'Mariusz', 'Łapiński');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE `login` (
  `login` varchar(20) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `login`
--

INSERT INTO `login` (`login`, `haslo`) VALUES
('liliana.kalinowska', '$argon2i$v=19$m=65536,t=4,p=1$bENTSHE5V0RpTy5jemtqVg$jB7to+t5LUL6HeUP7uKrfnd4TutsnEkKeutdXstEqBw'),
('roksana.jakubowska', '$argon2i$v=19$m=65536,t=4,p=1$dFpIUVQxNS5TS3Z6YlZ2eg$IdN/aP+nEzwPweOZoSMOT4PYv8KfmmUsrbVexx+WEJs'),
('olga.kowalczyk', '$argon2i$v=19$m=65536,t=4,p=1$V0QwWmRZREl1MlNuaE5veg$F5n5LVaDfiDHMzr3k1NkEq4kn2/wDuPPmIut+iYCSWU'),
('florentyna.pietrzak', '$argon2i$v=19$m=65536,t=4,p=1$YTFwdThzbTRaa015QTVRVA$wkT/y6ZakeHftB/uZbGMOOtGkzLZsOKFGfu4W8NfnbQ'),
('remigiusz.cieslak', '$argon2i$v=19$m=65536,t=4,p=1$dnV4LkkveHB0dWFKZ1RqMQ$qag4vm0Uw/pJJJJBlXCjYXc3yLsoa/cNRpQ19n/YVV0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjenci`
--

CREATE TABLE `pacjenci` (
  `idPacjenta` int(11) NOT NULL,
  `imie` text DEFAULT NULL,
  `nazwisko` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pacjenci`
--

INSERT INTO `pacjenci` (`idPacjenta`, `imie`, `nazwisko`) VALUES
(1, 'Kamil', 'Czarnecki'),
(2, 'Miłosz', 'Stępień'),
(3, 'Franciszek', 'Brzeziński'),
(4, 'Aniela', 'Dąbrowska'),
(5, 'Eliza', 'Przybylska'),
(6, 'Klara', 'Adamska'),
(7, 'Olgierd', 'Baran'),
(8, 'Blanka', 'Czarnecka'),
(9, 'Stefania', 'Baranowska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wizyty`
--

CREATE TABLE `wizyty` (
  `godzina` time NOT NULL,
  `idLekarza` int(11) NOT NULL,
  `idPacjenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wizyty`
--

INSERT INTO `wizyty` (`godzina`, `idLekarza`, `idPacjenta`) VALUES
('15:17:00', 2, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `lekarze`
--
ALTER TABLE `lekarze`
  ADD PRIMARY KEY (`idLekarza`);

--
-- Indeksy dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  ADD PRIMARY KEY (`idPacjenta`);

--
-- Indeksy dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD PRIMARY KEY (`godzina`),
  ADD KEY `idLekarza` (`idLekarza`),
  ADD KEY `idPacjenta` (`idPacjenta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `lekarze`
--
ALTER TABLE `lekarze`
  MODIFY `idLekarza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  MODIFY `idPacjenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`idLekarza`) REFERENCES `lekarze` (`idLekarza`),
  ADD CONSTRAINT `wizyty_ibfk_2` FOREIGN KEY (`idPacjenta`) REFERENCES `pacjenci` (`idPacjenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
