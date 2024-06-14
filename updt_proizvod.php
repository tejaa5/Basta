<?php
include 'konekcija.php';

$idProizvod = $_POST["idProizvod"];
$naziv = $_POST["naziv"];
$idKategorija = $_POST["kategorija"];
$cena = $_POST["cena"];


// Priprema SQL upita sa placeholder-ima
$sql = "UPDATE `proizvod` SET `idKategorija` = :idKategorija, `naziv` = :naziv, `cena` = :cena 
        WHERE `idProizvod` = :idProizvod";

$stmt = $pdo->prepare($sql);

// Povezivanje parametara

$stmt->bindParam(':idKategorija', $idKategorija);
$stmt->bindParam(':naziv', $naziv);
$stmt->bindParam(':cena', $cena);
$stmt->bindParam(':idProizvod', $idProizvod);

// Izvršavanje naredbe
$stmt->execute();

header("Location:admin.php");
