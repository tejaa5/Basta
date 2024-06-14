<?php include 'sesija.php' ?>
<?php include 'konekcija.php' ?>

<?php
$idKorisnik = $_SESSION['idKorisnik'];
$sql = "SELECT korpa.id,
               korpa.kolicina,
               proizvod.naziv,
               proizvod.cena,
               s_kategorija.kategorija
        FROM korpa
        LEFT JOIN proizvod ON korpa.idProizvod = proizvod.idProizvod
        LEFT JOIN s_kategorija ON proizvod.idKategorija = s_kategorija.id
        WHERE idKorisnik = :idKorisnik";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idKorisnik', $idKorisnik);
$stmt->execute();
$stavkeIzKorpe = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korpa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body onload="setTime()">
    <a href="korisnik.php" class="btn btn-warning">Nazad</a>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Kategorija</th>
                    <th>Kolicina</th>
                    <th>Cena</th>
                    <th>Opcije</th>
                    
                    
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $suma = 0;
                foreach ($stavkeIzKorpe as $stavka) { 
                    $racun = $stavka['kolicina'] * $stavka['cena'];
                    $suma += $racun;
                ?>
                <tr>
                    <form action="updt_korpa.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $stavka['id'] ?>">
                        <td><?php echo $stavka['naziv'] ?></td>
                        <td><?php echo $stavka['kategorija'] ?></td>
                        <td><input type="number" name="kolicina" value="<?php echo $stavka['kolicina'] ?>"></td>
                        <td><?php echo $stavka['cena'] ?> rsd</td>
                        
                        <td>
                        <input type="submit"  class="btn btn-warning" value="Izmeni kolicinu">
                            <a href="obrisi_iz_korpe.php?id=<?php echo $stavka['id'] ?>" class="btn btn-warning">Obriši</a>
                        </td>
                        
                    </form>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" class="text-end"><b>Ukupno: </b> <?php echo $suma ?> rsd 
                    <b>Vreme porudzbine:</b> <input id="field" type="text" name="field" value="" size="15" ></td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
function getTimeStamp() {
       var now = new Date();
       return ((now.getMonth() + 1) + '/' + (now.getDate()) + '/' + now.getFullYear() + " " + now.getHours() + ':'
                     + ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())) + ':' + ((now.getSeconds() < 10) ? ("0" + now
                     .getSeconds()) : (now.getSeconds())));
}
function setTime() {
    document.getElementById('field').value = getTimeStamp();
}
</script>
</body>

</html>