<?php
include 'konekcija.php';

$idProizvod = $_GET['idProizvod'];


$sql = "DELETE FROM `proizvod` WHERE `idProizvod` = :idProizvod";

$stmt = $pdo->prepare($sql);


$stmt->bindParam(':idProizvod', $idProizvod);


$stmt->execute();


header("Location:admin.php");