<?php

include 'konekcija.php';

$id = $_GET['id'];

$sql = "DELETE FROM korpa WHERE id = :id";


$stmt = $pdo->prepare($sql);


$stmt->bindParam(':id', $id);


$stmt->execute();


header("Location:korpa.php");