<?php include 'sesija.php'; ?>
<?php include 'konekcija.php'; ?>

<?php
$idKorisnik = $_SESSION['idKorisnik'];

$sql = "SELECT proizvod.cena, proizvod.idProizvod, proizvod.naziv,
                s_kategorija.kategorija
        FROM proizvod
        LEFT JOIN s_kategorija on proizvod.idKategorija = s_kategorija.id";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$proizvodi = $stmt->fetchAll();

$sql = "SELECT idProizvod
        FROM korpa 
        WHERE idKorisnik = :idKorisnik";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idKorisnik', $idKorisnik);
$stmt->execute();
$mojaKorpa = $stmt->fetchAll();

$brojStavkiUMojojKorpi = count($mojaKorpa);

$poruka = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "uspesno") {
        $poruka = "Uspesno ste dodali proizvod u korpu!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<script src="script.js"></script>
<title>FloraMart Shop</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<!-- Bootstrap icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<!-- Core theme CSS (includes Bootstrap)-->
<link href="css/styles.css" rel="stylesheet" />
</head>

<body onload="setTime()">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex align-items-end " action="korpa.php" method="post">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Korpa
                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $brojStavkiUMojojKorpi; ?></span>
                </button>
            </form>
            <form class="d-flex ms-auto" action="logOut.php">
                <button class="btn btn-outline-dark" type="submit">
                    Izloguj se
                </button>
            </form>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-warning py-5" style="background-image: url('zeleno.jpg'); background-size: cover; background-position: center;">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-3 fw-bolder fst-italic">FloraMart</h1>
            <p class="lead fw-normal text-white-20 mb-0">Sve za vašu baštu</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <!-- Kartice proizvoda -->
            <?php foreach ($proizvodi as $proizvod) { ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        
                        <div id="display-image">
   
    </div>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $proizvod['naziv'] ?></h5>
                                <!-- Product category-->
                                <p class="fw-normal text-muted mb-2"><?php echo $proizvod['kategorija'] ?></p>
                                <!-- Product price-->
                                <span class="fw-bolder"><?php echo $proizvod['cena'] ?> RSD</span>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <form action="ins_korpa.php" method="post">
                                    <input type="hidden" name="idKorisnik" value="<?php echo $idKorisnik ?>">
                                    <input type="hidden" name="idProizvod" value="<?php echo $proizvod['idProizvod'] ?>">
                                    
                                    <button type="submit" class="btn btn-outline-dark mt-auto" onclick="setTime();" >Dodaj u korpu</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- Kraj kartica proizvoda -->
        </div>
    </div>
</section>
<footer class="py-5 bg-warning">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; FloraMart 2024</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
