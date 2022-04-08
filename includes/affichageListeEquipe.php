<?php 

global $wpdb;
$tablename = $wpdb->prefix."equipe";

// supprimer un enregistrement
if(isset($_GET['sub_supprimer'])){
	$supprimer = $_GET['sub_supprimer'];
	$wpdb->query("DELETE FROM ".$tablename." WHERE id=".$supprimer);
}
if(isset($_GET['modifier'])){
	$modifier = $_GET['modifier'];
	$wpdb->query("SELECT * FROM ".$tablename." WHERE id=".$modifier);
}
?>
<h1>Liste des équipes</h1>

<div class="wrap">
  <button type = "button" class="btn btn-light btn-lg" id="listeEquipe" name ="listeEquipe" >Liste des équipes</button>
  <button type = "button" class="btn btn-light btn-lg" id="parametrage" name ="Parametrage" >Paramétrage</button>
  <input  type="button" class="btn btn-light btn-lg" id="creationEquipe" name="creationEquipe" value="+"></input>
</div>

<br>

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
	$entreeListe = $wpdb->get_results("SELECT * FROM ".$tablename." order by id desc");
	if(count($entreeListe) > 0){
		$count = 1;
		foreach($entreeListe as $entree){
		    $id = $entree->id;
			$annee = $entree->annee;
		    $libelle = $entree->libelle;
		    $numero_championnat = $entree->numero_championnat;
		    $division_championnat = $entree->division_championnat;
			$phase_championnat = $entree->phase_championnat;
			$poule_championnat = $entree->poule_championnat;
			$numero_equipe = $entree->numero_equipe;

		    echo "<tr>
		    	<td>".$id."</td>
				<td>".$annee."</td>
		    	<td>".$libelle."</td>
				<td> Numero championnat : ".$numero_championnat."<br> Division : ".$division_championnat."<br> Phase : ".$phase_championnat."<br> Poule : ".$poule_championnat."<br> Equipe : ".$numero_equipe."</td>
		    	
		    	<td><input type = 'button' class='btn btn-light btn-lg' id='modifier' name='sub_editer' value='Modifier'><a href='#'".$id."'</a></input>
				<br>
				<input type = 'button' class='btn btn-light btn-lg' id='supprimer' name='sub_supprimer' value='Supprimer'><a href='#'".$id."'</a></input>
				</td>
		    </tr>
		    ";
		    
		}
	}else{
		echo "<tr><td colspan='5'>Pas de résultats trouvés </td></tr>";
	}
	

	?>
</table>





  

