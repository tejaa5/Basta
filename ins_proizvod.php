<?php
include 'konekcija.php';

$naziv = $_POST["naziv"];
$idKategorija = $_POST["kategorija"];
$cena = $_POST["cena"];



$sql = "INSERT INTO proizvod (idKategorija, naziv, cena) 
                    VALUES (:idKategorija, :naziv, :cena)";

$stmt = $pdo->prepare($sql); 

$stmt->bindParam(':idKategorija', $idKategorija);
$stmt->bindParam(':naziv', $naziv);
$stmt->bindParam(':cena', $cena);


$stmt->execute();

header("Location:admin.php");




