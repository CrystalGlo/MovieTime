<?php 
session_start();
require_once("../BD/connexion.inc.php");

include 'header.php'; 
if($_SESSION['usager_poste']=="A"){
	echo '<script type="text/javascript">',
			 'headerAdmin();',
			 '</script>';
} elseif($_SESSION['usager_poste']=="M") {
	echo '<script type="text/javascript">',
			 'headerUsager();',
			 '</script>';
} else{
	echo '<script type="text/javascript">',
			 'headerPublic();',
			 '</script>';
} 
?>

<div class="row" style="position: relative;padding-top:30px; padding-left:40%;">
	<div class="col-xs-12 col-sm-12 col-md-4 well well-sm">
	<legend style="text-align:center;"><i class="fa fa-plus-square"></i> Ajouter un film</legend>
	<br />
	<form id="formAjout" name="formAjout" action="gestionFilm.php" method="POST" ENCTYPE="multipart/form-data">	   
		<span>Titre du film : </span><input class="form-control" id="titre" name="titre" placeholder="Titre" type="text" />		
		<br />		
		Realisateur : <input class="form-control" id="realisateur" name="realisateur" placeholder="Realisateur" type="text" />
		<br />	
		Categorie : <div class="form-group">
		  <label for="sel1">Choisir la categorie:</label>
		  <select class="form-control" id="categorie" name="categorie">
			<option value="Drame">Drame</option>
			<option value="Comedie">Comedie</option>
			<option value="Thriller">Thriller</option>
			<option value="Action">Action</option>
			<option value="Science Fiction">Science Fiction</option>
			<option value="Romantique">Romantique</option>
		  </select>
		</div>
		<br />
		Duree : <input class="form-control" id="duree" name="duree" placeholder="..h..m" type="text"/>
		<br>
		Prix : <input class="form-control" id="prix" name="prix" placeholder="prix en $" type="number"/>
		<br>
		Photo : <input class="form-control" id="photo" name="photo" type="file"/>
		<br>
		<input type="hidden" id="action" name="action" value="ajouter"/>
		<input type="submit" value="Ajouter" class="btn btn-md btn-success btn-block"
			style="width:60%;text-align:center;display:block;margin:0 auto;"/> 
		<br><br>
	</form>
	</div>
</div>


<?php 
mysqli_close($connexion);
include 'footer.php'; 
?> 


