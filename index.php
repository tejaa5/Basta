
<!DOCTYPE html>
<html>
    <head>
        <title>FloraMart</title>
        <link rel="stylesheet" href="css/loginforma.css">
        
        
    </head>
    <body>
        
        <?php

        $poruka = "";
        if (isset($_GET['registracija'])) {
             if ($_GET['registracija'] == 1) {
                $poruka = "Vas nalog je registrovan, ceka se potvrda administratora";
            }
        }
    
        $greska="";
        if(isset($_GET['error'])){
            if($_GET['error']==1){
                $greska="Unesite parametre";
            }
            if($_GET['error']==2){
                $greska="Pogresna sifra ili nepostojeci korisnik";
            }
        }
        ?>
        <h1 style="display:none"><?php echo $greska ?></h1>
         <h1><?php echo $poruka ?></h1>

    
   
    

        
        
        <h2>FloraMart</h2>

        <div class="login-page">
            <div class="form">
                <form action="proveri_korisnika.php" method="post" class="login-form">
                
                    <input type="text" id="username" name="username" placeholder="Korisnicko ime"/>
                    
                    <input type="password" id="password" name="password" placeholder="Lozinka"/>
                    <button type="submit"  >Uloguj se</button>
                    <p class="message">Niste registrovani? <a href="registracija.php">Kreirajte nalog.</a></p>
                </form>
            </div>
        </div>

        
    </body>
</html>

