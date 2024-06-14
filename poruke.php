<?php
$poruka = "";
if (isset($_GET['registracija'])) {
    if ($_GET['registracija'] == 1) {
        $poruka = "Vaš nalog je registrovan, čeka se potvrda administratora.";
    }
}

$greska = "";
if(isset($_GET['error'])){
    if($_GET['error'] == 1){
        $greska = "Unesite parametre.";
    }
    if($_GET['error'] == 2){
        $greska = "Pogrešna šifra ili nepostojeći korisnik.";
    }
}

// Vraćanje poruka u JSON formatu
echo json_encode(array("poruka" => $poruka, "greska" => $greska));
?>
