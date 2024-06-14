<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/registracija.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
</head>

<body>
  <div class="wrapper">
    <h2>Registracija</h2>
    <form action="ins_registracija.php" method="POST" >
      <div class="input-box">
        <input type="text" placeholder="Ime i Prezime"  id="imePrezime" required name="imePrezime">
      </div>
      
      <div class="input-box">
        <input type="text" placeholder="Korisnicko ime" id="username"  required name="username">
      </div>
      <div class="input-box">
        <input type="password" placeholder="Lozinka"  id="password" required name="password">
      </div>
      
      <div class="policy">
        <input type="checkbox">
        <h3>Prihvatam uslove koriscenja</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Ok">
      </div>
      <div class="text">
        <h3>Vec imate nalog? <a href="index.php">Ulogujte se</a></h3>
      </div>
    </form>
  </div>
</body>

</html>