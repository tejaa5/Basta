<?php

include 'konekcija.php';


$idKorisnik = $_POST["idKorisnik"];
$idProizvod = $_POST["idProizvod"];



$sql = "INSERT INTO korpa (idProizvod, idKorisnik) 
                    VALUES (:idProizvod, :idKorisnik)";


$stmt = $pdo->prepare($sql); 


$stmt->bindParam(':idProizvod', $idProizvod);
$stmt->bindParam(':idKorisnik', $idKorisnik);




$stmt->execute();

header("Location:korisnik.php?msg=uspesno");