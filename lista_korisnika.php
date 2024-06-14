<?php include 'sesija.php'; ?>
<?php include 'konekcija.php'; ?>
<?php

$user = $_SESSION['imePrezime'];
$idKorisnik = $_SESSION['idKorisnik']; 

$sql = "SELECT * FROM korisnik WHERE idKorisnik != :idKorisnik";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idKorisnik', $idKorisnik);
$stmt->execute();
$korisnici = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

<div>
       

<?php foreach ($korisnici as $key => $korisnik) {
    $key++;
    
?>

    <div>
        <?php echo $key ?>.
        Ime i prezime: <?php echo $korisnik['imePrezime'] ?>
        Username: <?php echo $korisnik['username'] ?>
        <?php if ($korisnik['aktivan'] == 1) { ?>
          
            <a href="aktivacija.php?status=0&idKorisnik=<?php echo $korisnik['idKorisnik'] ?>">Deaktiviraj</a>
        <?php } ?>
        <?php if ($korisnik['aktivan'] == 0) { ?>
            
            <a href="aktivacija.php?status=1&idKorisnik=<?php echo $korisnik['idKorisnik'] ?>">Aktiviraj</a>
        <?php } ?>
    </div>

<?php } ?>

</div>
</body>
</html>
