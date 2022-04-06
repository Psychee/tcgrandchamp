<?php 

global $wpdb;

// ajouter une equipe
if(isset($_POST['but_submit'])){

	$libelle = $_POST['txt_libelle'];
	$annee = $_POST['txt_annee'];
	$numero_champ = $_POST['txt_numero_champ'];
    $division_champ = $_POST['txt_division_champ'];
    $phase_champ = $_POST['txt_phase_champ'];
    $poule_champ = $_POST['txt_poule_champ'];
    $equipe_champ = $_POST['txt_equipe_champ'];
    $archiver = $_POST['txt_archiver'];

	$table_name = $wpdb->prefix."equipe";

	if($libelle != '' && $annee != '' && $numero_champ != ''&& $division_champ != '' && $phase_champ != ''  && $poule_champ != ''&& $equipe_champ != ''&& $archiver != ''){
		$check_data = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE libelle ='".$libelle."' ");
	    if(count($check_data) == 0){
	        $insert_sql = "INSERT INTO ".$table_name."(libelle,annee,numer_champ,division_champ,phase_champ,poule_champ,equipe_champ,archiver) values('".$libelle."','".$annee."','".$numero_champ."','".$division_champ."','".$phase_champ."','".$poule_champ."','".$equipe_champ."','".$archiver."') ";
	        $wpdb->query($insert_sql);
	        echo "l'equipe a ete creer avec succes!";
	    }
	}
}

?>
<h1>Création Equipe</h1>
<form method='post' action=''>
	<table>
		<tr>
			<td>Libelle</td>
			<td><input type='text' name='txt_libelle'></td>
		</tr>
		<tr>
			<td>Année</td>
			<td><input type='text' name='txt_annee'></td>
		</tr>
		<tr>
			<td>Numéro de Championnat</td>
			<td><input type='text' name='txt_numero_champ'></td>
		</tr>
        <tr>
			<td>Division</td>
			<td><input type='text' name='txt_division_champ'></td>
		</tr>
        <tr>
			<td>Phase</td>
			<td><input type='text' name='txt_phase_champ'></td>
		</tr>
        <tr>
			<td>Poule</td>
			<td><input type='text' name='txt_poule_champ'></td>
		</tr>
        <tr>
			<td>Equipe</td>
			<td><input type='text' name='txt_equipe_champ'></td>
		</tr>
        <tr>
			<td>Archiver</td>
			<td><input type='checkbox' name='txt_archiver'></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='but_submit' value='Enregister'></td>
		</tr>
	</table>
</form>