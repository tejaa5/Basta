<?php include 'sesija.php'; ?>
<?php include 'konekcija.php'; ?>
<?php



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

    <h1>Dodaj proizvod</h1>
    <form  action="ins_proizvod.php" method="post" >
        <div>
            <label for="naziv">Naziv</label>
            <input class="form-control" type="text" id="model" type="text" name="naziv">
        </div>
        <div>
            <label for="kategorija">Kategorija</label>
            <select class="form-select" name="kategorija" id="kategorija">
                <?php foreach ($kategorije as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['kategorija'] ?></option>
                <?php } ?>
            </select>
        </div>
      
        <div>
            <label for="cena">Cena</label>
            <input  class="form-control" type="text" id="cena" type="text" name="cena">
        </div>
       
        <div>
            <input type="submit" value="Sacuvaj">
        </div>
    </form>
                
</body>

</html>