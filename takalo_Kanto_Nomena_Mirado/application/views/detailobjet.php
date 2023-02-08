<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->library('session');
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- include bootstrap 5'css -->
	 <link rel="stylesheet" href="<?php echo site_url("assets/css/bootstrap.min.css"); ?>">
     <!-- personnalisation -->
     <link id="mainStyle" rel="stylesheet" href="<?php echo site_url("assets/css/style.css"); ?>">
     <!-- font awesome 5 -->
     <link rel="stylesheet" href="<?php echo site_url("assets/fontawesome-5/fa_brand_reg_solide/all.min.css"); ?>"> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detailleObjet</title>
</head>
<body>

<!--header-->
<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top"style="background-color: #45a29e;">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarExample01"
        aria-controls="navbarExample01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
      <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="toacceuil">Acceuil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="toficheobjet">ficheObjet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="topropositionreceive"> proposition receive</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="topropositionsend"> proposition send</a>
          </li>
          <!--<li class="nav-item">
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="veuillez ecrire ici" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Rechercher</button>
          </form>-->
          </li>
        </ul>
      </div>
      <form class="d-flex">
        <a class="nav-link" href="deconnexion"> deconnexion</a>
      </form>
    </div>
  </nav>
  <!-- Navbar -->

  
  <!-- Jumbotron -->
  <div class="p-5 text-center bg-light" style="margin-top: 58px;">
    <h1 class="mb-3">TAKALO-TAKALO</h1>
    <h4 class="mb-3">Here to Exchange</h4>
  </div>
  <!-- Jumbotron -->
</header>
<!--header fin-->

<!--center-->
    <div class="container-fluid">
      <div class="row flex-nowrap">
        <div class="col py-3">
          <div class="container text-center">
            <h3>Detaille de l'objet</h3>
              <div class="d-flex justify-content-center">
              <?php
	              if($objet!=null){
                  if($images!=null){
                    for($i=0;$i<count($images);$i++){ ?>
                      <div class="p-2 bd-highlight"><img width="250px" height="250px" src="<?php echo site_url("assets/image/".$images[$i]['nomimage']); ?>" > </div><?php
                    }
                  } ?>
              </div>
              <div class="d-flex justify-content-center">
                <div class="p-2 bd-highlight">
                  <div class="mb-3">
                    <div class="collapse.show" id="collapseExample">
                      <div class="card card-body">
                        <p>Nom: <?php echo $objet['nom']; ?></p>
                        <p>Prix estime:<?php echo $objet['prixestim']; ?></p>
                        <p>desription: <?php echo $objet['descriptions']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              </div>
              <div class="d-flex justify-content-center">
                <div class="p-2 bd-highlight">
                  <div class="mb-3">
                </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
<!--center-->

<footer class="text-center text-black" style="background-color: #45a29e;">
  <!-- Grid container -->
  <div class="container pt-4">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Google -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-google"></i
      ></a>

      <!-- Instagram -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-linkedin"></i
      ></a>
      <!-- Github -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-github"></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    <p>MAMIARIVONY Mirado Ifaliana : ETO1786</p>
    <p>ANDRIANAIVOSOA Kanto : ETU1756</p>
    <p>RAJAONARIVELO Andrianomena Yval : ETU1813</p>
  </div>
  <!-- Copyright -->
</footer>

</body>
</html>