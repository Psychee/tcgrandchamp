<?php 

global $wpdb;

$zoneInformation = true;
$message ="";
//"Une erreur est survenue";
//$false = "l'equipe à été créer avec succès!";
//print_r($_GET["action"]);
if(isset($_GET["action"])){
	$modifier ="modifier";
	$creer ="creer";
	//action ok verifie la valeur 
	$zoneInformation = false;
	if(strcmp($_GET["action"],$creer)==0){
		$titre="Création";
		$libelle="";
		$annee = "";
		$numero_championnat = "";
		$division_championnat = "";
		$phase_championnat = "";
		$poule_championnat = "";
		$numero_equipe = "";


	}elseif(strcmp($_GET["action"],$modifier)==0){
		
		$tablename = $wpdb->prefix."equipe";
		$idEquipe = $_GET['idEquipe'];
		$equipes = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE id=".$idEquipe);
		//print_r ($equipes);
		if(count($equipes)==1){
			foreach($equipes as $equipe){
				$libelle = $equipe->libelle;
				$annee = $equipe->annee;
				$numero_championnat = $equipe->numero_championnat;
				$division_championnat = $equipe->division_championnat;
				$phase_championnat = $equipe->phase_championnat;
				$poule_championnat = $equipe->poule_championnat;
				$numero_equipe = $equipe->numero_equipe;
			}
			
		}else{
			$zoneInformation= true;
			$message= "l'équipe sélectinner n'existe pas";
		}
		$titre="Modification";

	}else{
		$zoneInformation= true;
		$message= "l'action demander est impossible'";
	}
}else{
	$zoneInformation= true;
	$message= "l'action n'exist pas'";
}

//verifier energistrer et non vide	
if($zoneInformation==false && !empty($_POST)){
	print_r($_POST);
	$zoneInformation = true;
	//on recupere le données en les protégeant contre la faille XSS
	$libelle = strip_tags( $_POST['txt_libelle']);
	$annee = strip_tags( $_POST['txt_annee']);
	$numero_championnat = strip_tags($_POST['txt_numero_championnat']);
    $division_championnat = strip_tags($_POST['txt_division_championnat']);
    $phase_championnat = strip_tags($_POST['txt_phase_championnat']);
    $poule_championnat = strip_tags($_POST['txt_poule_championnat']);
    $numero_equipe = strip_tags($_POST['txt_numero_equipe']);
    $archivee = strip_tags($_POST['txt_archivee']);

	$tablename = $wpdb->prefix."equipe";
		
	//si $_get['action']==creer inserer donnée en base préparer les paramêtre pour se protéger contre injection sql 
	if(strcmp($_GET["action"],$creer)==0){
		//l'action est verifier donc on insert les données en base en preparant les parametre pour eviter injection sql à faire!
		$wpdb->insert($tablename, array('libelle'=>$libelle,'annee'=>$annee,'numero_championnat'=>$numero_championnat,'division_championnat'=>$division_championnat,'phase_championnat'=>$phase_championnat ,'poule_championnat'=>$poule_championnat,'numero_equipe'=>$numero_equipe,'archivee'=>$archivee));
		if($wpdb->insert() == false){
			$message="la création de l'équipe n'à pas pu se faire";
		}else{
			$message="l'equipe a bien été créée";
		}
	}elseif(strcmp($_GET["action"],$modifier)==0){
		//l'action est verifier donc on met à jour les données en base en preparant les parametre pour eviter injection sql à faire!
		$wpdb->update($tablename, array('libelle'=>$libelle,'annee'=>$annee,'numero_championnat'=>$numero_championnat,'division_championnat'=>$division_championnat,'phase_championnat'=>$phase_championnat,'poule_championnat'=>$poule_championnat,'numero_equipe'=>$umero_equipe,'archivee'=>$archivee), array('id' => $idEquipe), $format = null, $where_format= null);
		if($wpdb->update() == false){
			$message="la modification de l'équipe n'à pas pu se faire";
		}else{
			$message="l'equipe a bien été modifiée";
		}		
	}
}


if($zoneInformation){
	echo "<h1> $message </h1>
	
	<button><a href ='?page=championnats'>Retour</a></button>";
	
}else{

echo "<h1>$titre Equipe</h1>
<form method='post' action='#'>
	<table>
		<tr>
			<td>Libelle</td>
			<td><input type='text' name='txt_libelle'pattern='[a-zA-Z0-9]+' required='required' value='$libelle'></td>
		</tr>
		<tr>
			<td>Année</td>
			<td><input type='text' name='txt_annee'pattern='[0-9]{4}' required='required' value='$annee'></td>
		</tr>
		<tr>
			<td>Numéro de Championnat</td>
			<td><input type='text' name='txt_numero_championnat'pattern='[0-9]+' required='required' value='$numero_championnat'></td>
		</tr>
        <tr>
			<td>Division</td>
			<td><input type='text' name='txt_division_championnat'pattern='[0-9]+' required='required' value='$division_championnat'></td>
		</tr>
        <tr>
			<td>Phase</td>
			<td><input type='text' name='txt_phase_championnat'pattern='[0-9]+' required='required' value='$phase_championnat'></td>
		</tr>
        <tr>
			<td>Poule</td>
			<td><input type='text' name='txt_poule_championnat' pattern='[0-9]+' required='required' value='$poule_championnat'></td>
		</tr>
        <tr>
			<td>Equipe</td>
			<td><input type='text' name='txt_numero_equipe' pattern='[0-9]+' required='required' value ='$numero_equipe'></td>
		</tr>
        <tr>
			<td>Archiver</td>
			<td><input type='checkbox' name='txt_archivee' pattern='[0-9]+' required='required' value='$archivee'></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='but_submit' value='Enregister' [disabled]='!ngForm.valid'></td>
		</tr>
	</table>
</form>"; 
}
?>