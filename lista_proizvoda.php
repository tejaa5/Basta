<?php include 'sesija.php'; ?>
<?php include 'konekcija.php'; ?>
<?php

$sql = "SELECT  proizvod.cena, proizvod.idProizvod, proizvod.naziv,
                s_kategorija.kategorija
        FROM proizvod
        LEFT JOIN s_kategorija on proizvod.idKategorija = s_kategorija.id";
        
$stmt = $pdo->prepare($sql);
$stmt->execute();
$proizvodi = $stmt->fetchAll();
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
<h1>Proizvodi</h1>
    <div><a href="dodaj.php">Dodaj proizvod</a></div> 
    
    <div>
        <table border="1">
            <thead>
                <tr>
                    
                    <th>Kategorija</th>
                    <th>Naziv</th>
                    <th>Cena</th>
                    <th>Opcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proizvodi as $proizvod) { ?>
                    <tr>
                        
                        <td><?php echo $proizvod['kategorija'] ?></td>
                        <td><?php echo $proizvod['naziv'] ?></td>
                        <td><?php echo $proizvod['cena'] ?> RSD</td>
                        <td>
                            <div>
                                <a href="izmeni.php?idProizvod=<?php echo $proizvod['idProizvod'] ?>">Izmeni </a>
                            </div>
                            <div>
                                <a href="obrisi.php?idProizvod=<?php echo $proizvod['idProizvod'] ?>">Obrisi </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </body>
</html>