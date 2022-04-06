<?php

 
 //creer une nouvelle table dans la base

 function championnats_table(){
  global $wpdb;

 
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix."equipe";
	$sql = "CREATE TABLE $table_name (
	  id int NOT NULL AUTO_INCREMENT,
	  libelle varchar(100) NOT NULL,
	  annee varchar(4) NOT NULL,
	  numero_champ int NOT NULL,
	  division_champ int NOT NULL,
	  phase_champ int NOT NULL,
	  poule_champ int NOT NULL,
	  equipe_champ int NOT NULL,
	  archiver bit NOT NULL
	 
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

  
}
register_activation_hook( __FILE__, 'championnats_table' );

/*function parametrage_table(){
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();
	$tablename = $wpdb->prefix."parametrage";
	$sql = "CREATE TABLE $tablename (
	  cle_pattern varchar(50) NOT NULL,
	  valeur_url varchar(255) NOT NULL,
	 
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'parametrage_table' );*/
 
// Add a new top level menu link to the ACP
function championnats_menu()
{
  
 add_menu_page("Championnats Options", "Championnats","manage_options", "championnats", "affichageListeEquipe", plugins_url('/championnats/img/TCicon.png'));
    add_submenu_page("championnats","Liste Equipe", "Liste Equipe","manage_options", "listequipe", "affichageListeEquipe");
    add_submenu_page("championnats","Creation", "Creation","manage_options", "creationEquipe", "creationEquipe");

}
// Hook the 'admin_menu' action hook, run the function named 'championnats_menu()'
add_action( 'admin_menu', 'championnats_menu' );

function affichageListeEquipe(){
	include "affichageListeEquipe.php";
}

function creationEquipe(){
	include "creationEquipe.php";
}

class ChampionnatsPlugin
{
  function register(){
    add_action ('admin_enqueue_scripts', array( $this , 'enqueue' ));
  }

  function enqueue(){
    //enqueue all our scripts
    wp_enqueue_style('mypluginstyle', plugins_url('/styles/style.css', __FILE__), array(''));
  }

  
}
if (class_exists('ChampionnatsPlugin')){
  $championnatsPlugin = new ChampionnatsPlugin();
  $championnatsPlugin ->register();

}

function customfunctiontest($arg){
  echo $arg;
}

customfunctiontest('hello test de mon plugin');