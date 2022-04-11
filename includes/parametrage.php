<?php

global $wpdb;

//verifier energistrer et non vide

$url_post = "Aucune valeur";
$url_feuille_match = "Aucune valeur";

$table_name = $wpdb->prefix."parametrage";
$parametres = $wpdb->get_results("SELECT * FROM ".$table_name);
		
foreach($parametres as $parametre){
    $cle = $parametre->cle;
    $valeur = $parametre->valeur;

    if(strcmp($cle, "URL_POST") == 0) {
        $url_post = $valeur;
    } elseif(strcmp($cle, "URL_FEUILLE_MATCH") == 0) {
        $url_feuille_match = $valeur;
    } else {
        // Log précisant la clé inconnue
    }

}


if(!empty($_POST)){
    print_r($_POST);
    
    //on recupere le données en les protégeant contre la faille XSS
    $txt_url_post = strip_tags( $_POST['txt_url_post']);
    $txt_url_feuille_match = strip_tags( $_POST['txt_url_feuille_match']);

   if(!$wpdb->update($table_name, array('valeur'=> $txt_url_post), array('cle' => 'URL_POST'), $format = null, $where_format= null)) {
        echo "URL POST non mis à jours";
   }
   if(!$wpdb->update($table_name, array('valeur'=> $txt_url_feuille_match), array('cle' => 'URL_FEUILLE_MATCH'), $format = null, $where_format= null)) {
    echo "URL FEUILLE MATCH non mis à jours";
   }


   //YAHOUU SUCCS;

   $_POST = null;
}


    echo "<h1>Paramétrage</h1>
    <div class='wrap'>
        <button  type='button' class='btn btn-light btn-lg' id='listeEquipe' name='listeEquipe'><a href='?page=listequipe'>Liste des équipes</a></button>
        <button  type='button' class='btn btn-light btn-lg' id='parametrage' name='parametrage'><a href='?page=parametrage'>Paramétrage</a></button>
    </div>
    <form method='post' action='#'id='form' name='form'>
        <table>
            <tr>
                <td>URL de récupération :</td>
                <td><input type='text' name='txt_url_post' pattern='https://.*' required='required' value='$url_post'></td>
            </tr>
            <tr>
                <td>Pattern lien accès feuille de match :</td>
                <td><input type='text' name='txt_url_feuille_match' pattern='https://.*' required='required' value='$url_feuille_match'></td>
            </tr>
            <tr>
				<td>&nbsp;</td>
				<td><input type='submit' id='but_submit'name='but_submit' value='Enregister'></td>
			</tr>
        </table>
    </form>";

    ?>

