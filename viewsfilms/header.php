<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>	
	 <!-- Add icon library Font Awesome 5 Icons-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" 
	integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">   
	<!-- Script for movies cards -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
    
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script language="javascript" src="../js/scripts.js"></script>
	<title>Movie Time</title>
</head>

<body>
  <header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height:100px; border: 1px solid; border-radius: 5px; font-size: 18px !important;">
  <!-- -->
  <img src="https://mbtskoudsalg.com/images/cinema-vector-4.png" class="navbar-brand" width="150" height="100" class="d-inline-block align-top" alt="">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
          <a class="nav-link text-warning" href="listerFilms.php"><i class="fas fa-film"></i> Nos films <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-expand-arrows-alt"></i> Categories
        </a>
        <form class="dropdown-menu" aria-labelledby="navbarDropdown" id="formCateg" name="formCateg" action="listerCategorie.php" method="get">
		  <a class="dropdown-item" href="listerCategorie.php?categorie=Drame"><i class="fas fa-sad-tear"></i> Drame</a>
          <a class="dropdown-item" href="listerCategorie.php?categorie=Comedie"><i class="fas fa-laugh-beam"></i> Comedie</a>
		  <a class="dropdown-item" href="listerCategorie.php?categorie=Thriller"><i class="fas fa-flushed"></i> Thriller</a>
          <a class="dropdown-item" href="listerCategorie.php?categorie=Action"><i class="fas fa-user-ninja"></i> Action</a>
          <a class="dropdown-item" href="listerCategorie.php?categorie=Science Fiction"><i class="fas fa-bolt"></i> Science Fiction</a>
          <a class="dropdown-item" href="listerCategorie.php?categorie=Horreur"><i class="fas fa-ghost"></i> Horreur</a>
          <a class="dropdown-item" href="listerCategorie.php?categorie=Romantique"><i class="fas fa-heart"></i> Romantique</a>
        </form>
      </li>
	 
	  <li class="nav-item dropdown" id="optionsAdmin" style="visibility:hidden;">
		  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-cog"></i> Gestion films
		  </a>
		  <div class="dropdown-menu" aria-labelledby="optionsAdmin">
			<a class="dropdown-item" href="ajouterFilm.php"><i class="fas fa-plus-square"></i> Ajouter un film</a>
			  <a class="dropdown-item" href="modifierFilm.php"><i class="fas fa-edit"></i> Modifier un film</a>
			  <a class="dropdown-item" href="supprimerFilm.php"><i class="fas fa-trash-alt"></i> Supprimer un film</a>
		  </div>
	  </li>
    </ul>
	
    <form class="form-inline my-2 my-lg-0 text-warning" id="headerBefore">
        <a class="nav-link text-warning" href="seConnecter.php"><i class="fas fa-sign-in-alt"></i> Se connecter </a>
        <a class="nav-link text-warning" href="devenirMembre.php"><i class="fas fa-user-plus"></i> Devenir membre </a>
    </form>
	
	<a class="nav-link text-warning" id="panier_logo" href="gestionPanier.php" alt="Panier d'achat" style="visibility:hidden;"><i class="fas fa-cart-plus"></i></a>
	
    <form class="form-inline my-2 my-lg-0" id="headerAfter" style="visibility:hidden;position:absolute;">
		<span class="navbar-text text-warning" id="connEmail" style="visibility:visible;"></span>
        <a class="nav-link text-warning" href="deconnexion.php"><i class="fas fa-sign-out-alt"></i> Se deconnecter </a>
	</form>
  </div>
</nav>

  </header>

	<div class="container-fluid">
	