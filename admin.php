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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/add.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/trash.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/pen.css' rel='stylesheet'>
</head>

<body>
    

 
    <nav id="navbar-example2" class="navbar bg-danger  text-white px-3 mb-3" >
  <a class="navbar-brand text-light" href="#"><?php echo $user ?></a>
  <ul class="nav nav-pills">
    
   
    <li class="nav-item">
        <a class="nav-link text-light" href="logOut.php">Izloguj se</i></a>
    </li>
   
  </ul>
</nav>
<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
  <h2 id="scrollspyHeading1">Proizvodi</h2>
  
    
    
    <div>
        <table class="table table-hover">
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
                           

                        <div class="d-inline-flex align-items-center">
                                <button id="showModalBtn1" class="btn btn-danger" data-toggle="modal" data-target="#myModal1" value="<?php echo $proizvod['idProizvod'] ?>">Izmeni</button>
    </div>                   
    <div  class="modal" id="myModal1">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body" id="modalContent1">
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
   $(document).ready(function(){
    $("#showModalBtn1").click(function(){
        var proizvodId = $(this).val(); 
        $.ajax({
            url: "izmeni.php",
            method: "GET", 
            data: { idProizvod: proizvodId }, 
            success: function(response){
                $("#modalContent1").html(response); 
                $("#myModal1").modal("show"); 
            }
        });
    });
});

    </script> 
                
                
                                
                            
                            
                            <div class="d-inline-flex align-items-center">
                            
                                <a class="link-danger" href="obrisi.php?idProizvod=<?php echo $proizvod['idProizvod'] ?>"><i class="gg-trash"></i> </a>
</div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>
   
    <div >
        <button id="showModalBtn" class="btn btn-danger">Dodaj proizvod</button>
    </div>

    
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body" id="modalContent">
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#showModalBtn").click(function(){
                $.ajax({
                    url: "dodaj.php",
                    success: function(response){
                        $("#modalContent").html(response); 
                        $("#myModal").modal("show"); 
                    }
                });
            });
        });
    </script>

    
  
       

       
  
  <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
  <h2 id="scrollspyHeading2">Korisnici</h2>
  
   <table class="table table-hover">
       <thead>
           <tr>
           
      <th>ID</th>
      <th>Ime i prezime </th>
      <th>Korisnicko ime</th>
      <th>Status</th>
           </tr>
           
      </thead>
      <tbody>
       <?php foreach ($korisnici as $key => $korisnik) {
           $key++;
  
       ?>
           
       <tr>
           <td><?php echo $key ?>.</td>
           <td><?php echo $korisnik['imePrezime'] ?></td>
           <td><?php echo $korisnik['username'] ?></td>
           <td><?php if ($korisnik['aktivan'] == 1) { ?>
        
        <a class="link-danger" href="aktivacija.php?status=0&idKorisnik=<?php echo $korisnik['idKorisnik'] ?>">Deaktiviraj</a>
           <?php } ?>
        <?php if ($korisnik['aktivan'] == 0) { ?>
        
        <a href="aktivacija.php?status=1&idKorisnik=<?php echo $korisnik['idKorisnik'] ?>">Aktiviraj</a>
           <?php } ?></td>

       </tr>
       <?php } ?>
      </tbody>
    </table>
   </div>


    
                
   


  
  


       
             
    

   
    
  
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>