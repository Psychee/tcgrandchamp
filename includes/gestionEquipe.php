<?php 

global $wpdb;

$zoneInformation = true;
$true = "Une erreur est survenue";
$false = "l'equipe à été créer avec succès!";
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
			$zoneInformation= $true;
		}
		$titre="Modification";

	}else{
		$zoneInformation= $true;
	}
}else{
	$zoneInformation= $true;
}

//verifier energistrer et non vide	
if(empty($_POST['but_submit']) && $_POST['but_submit']){
	$zoneInformation = false;
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
	//verifie que chaque champ est rempli
	if($libelle != '' && $annee != '' && $numero_championnat != ''&& $division_championnat != '' && $phase_championnat != ''  && $poule_championnat != ''&& $numero_equipe != ''&& $archivee != ''){
		
		//si $_get['action']==creer inserer donnée en base préparer les paramêtre pour se protéger contre injection sql 
		if($idEquipe==0){
			//l'action est verifier donc on insert les données en base en preparant les parametre pour eviter injection sql
			$wpdb->insert($tablename, array('libelle'=>$_POST['txt_libelle'],'annee'=>$_POST['txt_annee'],'numero_championnat'=>$_POST['txt_numero_championnat'],'division_championnat'=>$_POST['txt_division_championnat'],'phase_championnat'=>$_POST['txt_phase_championnat'],'poule_championnat'=>$_POST['txt_poule_championnat'],'numero_equipe'=>$_POST['txt_numero_equipe'],'archivee'=>$_POST['txt_archivee']));
	    	$zoneInformation = $false;
		}elseif($idEquipe!==0){
			//l'action est verifier donc on met à jour les données en base en preparant les parametre pour eviter injection sql
			$wpdb->update($tablename, array('libelle'=>$_POST['txt_libelle'],'annee'=>$_POST['txt_annee'],'numero_championnat'=>$_POST['txt_numero_championnat'],'division_championnat'=>$_POST['txt_division_championnat'],'phase_championnat'=>$_POST['txt_phase_championnat'],'poule_championnat'=>$_POST['txt_poule_championnat'],'numero_equipe'=>$_POST['txt_numero_equipe'],'archivee'=>$_POST['txt_archivee']), array('id' => $idEquipe), $format = null, $where_format= null);
			$zoneInformation = $false;
		}

	}else{
		?><button><a href ="?page=championnats">Retour</a></button><br><?php 
		die("le formulaire est incomplet merci de remplir tout les champs");
	}
}


if($zoneInformation){
	echo $true ;
	?><button><a href ="?page=championnats">Retour</a></button><?php 
	
}else{

echo "<h1>$titre Equipe</h1>
<form method='post' action='#'>
	<table>
		<tr>
			<td>Libelle</td>
			<td><input type='text' name='txt_libelle' value='$libelle'></td>
		</tr>
		<tr>
			<td>Année</td>
			<td><input type='text' name='txt_annee'value='$annee'></td>
		</tr>
		<tr>
			<td>Numéro de Championnat</td>
			<td><input type='text' name='txt_numero_championnat'value='$numero_championnat'></td>
		</tr>
        <tr>
			<td>Division</td>
			<td><input type='text' name='txt_division_championnat'value='$division_championnat'></td>
		</tr>
        <tr>
			<td>Phase</td>
			<td><input type='text' name='txt_phase_championnat' value='$phase_championnat'></td>
		</tr>
        <tr>
			<td>Poule</td>
			<td><input type='text' name='txt_poule_championnat' value='$poule_championnat'></td>
		</tr>
        <tr>
			<td>Equipe</td>
			<td><input type='text' name='txt_numero_equipe' value ='$numero_equipe'></td>
		</tr>
        <tr>
			<td>Archiver</td>
			<td><input type='checkbox' name='txt_archivee' value='$archivee'></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='but_submit' value='Enregister'></td>
		</tr>
	</table>
</form>"; 
}
?>