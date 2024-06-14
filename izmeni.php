<?php include 'sesija.php'; ?>
<?php include 'konekcija.php'; ?>
<?php

$idProizvod = $_GET['idProizvod'];

$sql = "SELECT *
        FROM proizvod
        WHERE idProizvod = :idProizvod";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idProizvod', $idProizvod);
$stmt->execute();

$proizvodZaIzmenu = $stmt->fetch(PDO::FETCH_ASSOC);


$upit = $pdo->prepare("SELECT * FROM s_kategorija");

$upit->execute();
$kategorije = $upit->fetchAll(PDO::FETCH_ASSOC);





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Izmeni proizvod</h1>
    <form action="updt_proizvod.php" method="POST"  >
        <div>
            <label for="naziv">Naziv</label>
           
            <input type="text" name="idProizvod" hidden value="<?php echo $idProizvod ?>">
            <input  class="form-control" id="naziv" type="text" name="naziv" value="<?php echo $proizvodZaIzmenu['naziv'] ?>">
        </div>
        <div>
            <label for="kategorija">Kategorija</label>
            <select class="form-select" name="kategorija" id="kategorija">
                <?php foreach ($kategorije as $row) {
                    $selected = "";
                    if ($row['id'] == $proizvodZaIzmenu['idKategorija']) {
                        $selected = "selected";
                    }

                ?>
                    <option <?php echo $selected ?> value="<?php echo $row['id'] ?>"><?php echo $row['kategorija'] ?></option>
                <?php } ?>
            </select>
        </div>
       
        <div>
            <label for="cena">Cena</label>
            <input  class="form-control" id="cena" type="text" name="cena" value="<?php echo $proizvodZaIzmenu['cena'] ?>">
        </div>
        
        <div>
            <input type="submit" value="Sacuvaj">
        </div>
    </form>
</body>

</html>