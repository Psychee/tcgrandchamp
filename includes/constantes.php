
<?php
  global $wpdb;
  
  // Définition des tables de la BDD
  $TABLE_EQUIPE = $wpdb->prefix."equipe";
  $TABLE_PARAMETRAGE = $wpdb->prefix."parametrage";

  // Clés de la table "paramétrage"
  $URL_POST = "URL_POST";
  $URL_FEUILLE_MATCH = "URL_FEUILLE_MATCH";
  
?>