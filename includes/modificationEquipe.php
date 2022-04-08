<?php
//mode $_POST en fonction de l' $id
//formulaire en get
global $wpdb;

/*if(isset($_GET['modifier'])){
	$modifier = $_GET['modifier'];
	$wpdb->query("SELECT * FROM ".$tablename." WHERE id=".$modifier);
}*/

//verifier l'id energistrer et non vide	
if(!empty($_POST) && $_POST['but_modifier']){
	
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
		
		$wpdb->update($tablename, array('libelle'=>$_POST['txt_libelle'],'annee'=>$_POST['txt_annee'],'numero_championnat'=>$_POST['txt_numero_championnat'],'division_championnat'=>$_POST['txt_division_championnat'],'phase_championnat'=>$_POST['txt_phase_championnat'],'poule_championnat'=>$_POST['txt_poule_championnat'],'numero_equipe'=>$_POST['txt_numero_equipe'],'archivee'=>$_POST['txt_archivee']));
		
	    echo "l'équipe à été modifiée avec succès!";

	    }else{
			die("le formulaire est incomplet merci de remplir tout les champs");
	}
}









?>
<h1>Modification de l'équipe</h1>
<form method='post' action=''>
	<table>
		<tr>
			<td>Libelle</td>
			<td><input type='text' name='txt_libelle'/>
            </td>
		</tr>
		<tr>
			<td>Année</td>
			<td><input type='text' name='txt_annee'/></td>
		</tr>
		<tr>
			<td>Numéro de Championnat</td>
			<td><input type='text' name='txt_numero_championnat'/></td>
		</tr>
        <tr>
			<td>Division</td>
			<td><input type='text' name='txt_division_championnat'/></td>
		</tr>
        <tr>
			<td>Phase</td>
			<td><input type='text' name='txt_phase_championnat'/></td>
		</tr>
        <tr>
			<td>Poule</td>
			<td><input type='text' name='txt_poule_championnat'/></td>
		</tr>
        <tr>
			<td>Equipe</td>
			<td><input type='text' name='txt_numero_equipe'/></td>
		</tr>
        <tr>
			<td>Archiver</td>
			<td><input type='checkbox' name='txt_archivee'/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='but_modifier' value='Enregister les Modifications'/></td>
		</tr>
				<script type='text/Javascript'>
					window.onload = funtion(){
						document.getElementById('pageurl').value = window.location.href;
						}
				</script>
	</table>
	
</form>