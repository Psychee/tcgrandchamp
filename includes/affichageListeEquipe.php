<?php 

global $wpdb;
$table_name = $wpdb->prefix."equipe";

// supprimer un enregistrement
if(isset($_GET['supprimer'])){
	$supprimer = $_GET['supprimer'];
	$wpdb->query("DELETE FROM ".$table_name." WHERE id=".$supprimer);
}
?>
<h1>Liste des équipes</h1>

<div class="wrap">
  <button type = "button" class="btn btn-light btn-lg" id="listeEquipe" name ="listeEquipe" >Liste des équipes</button>
  <button type = "button" class="btn btn-light btn-lg" id="parametrage" name ="Parametrage" >Paramétrage</button>
  <p>Afficher la liste des equipes non archiver dans un tableau</p>
</div>  

<table width='100%' border='1' style='border-collapse: collapse;'>
	<tr>
		<th>id</th>
		<th>Annee Sportive</th>
        <th>Libelle équipe</th>
		<th>Détails</th>
		<th>&nbsp;</th>
	</tr>
	<?php
	// Selectionner un enregistrement
	$entreeListe = $wpdb->get_results("SELECT * FROM ".$table_name." order by id desc");
	if(count($entreeListe) > 0){
		$count = 1;
		foreach($entreeListe as $entree){
		    $id = $entree->id;
		    $libelle = $entree->name;
		    $annee = $entree->username;
		    

		    echo "<tr>
		    	<td>".$id."</td>
		    	<td>".$libelle."</td>
		    	<td>".$annee."</td>
		    	<td><a href='?page=allentries&delid=".$id."'>Suprimer</a></td>
		    </tr>
		    ";
		    
		}
	}else{
		echo "<tr><td colspan='5'>No record found</td></tr>";
	}
	

	?>
</table>





  

