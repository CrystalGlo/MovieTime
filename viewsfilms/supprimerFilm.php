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
	<legend style="text-align:center;"><i class="fas fa-trash-alt"></i> Supprimer un film</legend>
	<form id="formModif" name="formModif" action="gestionFilm.php" method="POST" ENCTYPE="multipart/form-data">
		<br />
		No du film a supprimer : <input class="form-control" id="noFilmS" name="noFilmS" placeholder="No du film" type="number" />
		<br />
		<input type="hidden" id="action" name="action" value="supprimer"/>
		<input type="submit" value="Supprimer" class="btn btn-md btn-danger btn-block" style="width:60%;text-align:center; display: block; margin: 0 auto;" />
	</form>
</div>
</div>
 
<?php
mysqli_close($connexion);

include 'footer.php';
?>