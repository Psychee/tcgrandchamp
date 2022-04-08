<?php
//mode $_GET en fonction de l' $id
//formulaire en get
global $wpdb;


//verifier l'id energistrer et non vide	
if(!empty($_GET) && $_GET['but_modifier']){
	
	//on recupere le données en les protégeant contre la faille XSS
    $id = $_GET["id"];
	$libelle = strip_tags( $_GET['txt_libelle']);
	$annee = strip_tags( $_GET['txt_annee']);
	$numero_championnat = strip_tags($_GET['txt_numero_championnat']);
    $division_championnat = strip_tags($_GET['txt_division_championnat']);
    $phase_championnat = strip_tags($_GET['txt_phase_championnat']);
    $poule_championnat = strip_tags($_GET['txt_poule_championnat']);
    $numero_equipe = strip_tags($_GET['txt_numero_equipe']);
    $archivee = strip_tags($_GET['txt_archivee']);

	$tablename = $wpdb->prefix."equipe";
	//verifie que chaque champ est rempli
	if($libelle != '' && $annee != '' && $numero_championnat != ''&& $division_championnat != '' && $phase_championnat != ''  && $poule_championnat != ''&& $numero_equipe != ''&& $archivee != ''){
		
		$wpdb->update($tablename, array('libelle'=>$_GET['txt_libelle'],'annee'=>$_GET['txt_annee'],'numero_championnat'=>$_GET['txt_numero_championnat'],'division_championnat'=>$_GET['txt_division_championnat'],'phase_championnat'=>$_GET['txt_phase_championnat'],'poule_championnat'=>$_GET['txt_poule_championnat'],'numero_equipe'=>$_GET['txt_numero_equipe'],'archivee'=>$_GET['txt_archivee']));
		
	    echo "l'équipe à été modifiée avec succès!";

	    }else{
			die("le formulaire est incomplet merci de remplir tout les champs");
	}
}









?>
<h1>Modification de l'équipe</h1>
<form method='get' action=''>
	<table>
		<tr>
			<td>Libelle</td>
			<td><input type='text' name='txt_libelle'value="<?php isset($libelle)?$libelle:""; ?>">
            </td>
		</tr>
		<tr>
			<td>Année</td>
			<td><input type='text' name='txt_annee'></td>
		</tr>
		<tr>
			<td>Numéro de Championnat</td>
			<td><input type='text' name='txt_numero_championnat'></td>
		</tr>
        <tr>
			<td>Division</td>
			<td><input type='text' name='txt_division_championnat'></td>
		</tr>
        <tr>
			<td>Phase</td>
			<td><input type='text' name='txt_phase_championnat'></td>
		</tr>
        <tr>
			<td>Poule</td>
			<td><input type='text' name='txt_poule_championnat'></td>
		</tr>
        <tr>
			<td>Equipe</td>
			<td><input type='text' name='txt_numero_equipe'></td>
		</tr>
        <tr>
			<td>Archiver</td>
			<td><input type='checkbox' name='txt_archivee'></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='but_modifier' value='Enregister les Modifications'></td>
		</tr>
	</table>
</form>