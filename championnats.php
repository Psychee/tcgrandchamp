<?php
/*
  Plugin Name: Championnats
  Plugin URI: https://tcgrandchamp.fr/
  Description: Ce plugin permet d'alimenter le site automatiquement avec les resultats des championnats par equipes sans aller sur le site internet de ten'up
  Version: 1.0
  Author: de Montgolfier Aurelie
*/

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


// Include champ-functions.php, use require_once to stop the script if mfp-functions.php is not found
require_once plugin_dir_path(__FILE__) . 'includes/champ-functions.php';

defined ('ABSPATH') or  die ('Hey, you can\t acces this file, you silly humain!!!');

class ChampionnatsPlugin
{
  function __construct(){

  }
  function register(){
    add_action ('admin_enqueue_scripts', array( $this , 'enqueue' ));
  }

  function enqueue(){
    //enqueue all our scripts
    wp_enqueue_style('mypluginstyle', plugins_url('/styles/style.css', __FILE__), array(''));
  }
  //generate a CPT
  //creer une nouvelle table dans la base
  function championnats_table(){
    global $wpdb;
 
    $charset_collate = $wpdb->get_charset_collate();
    $tablename = $wpdb->prefix."equipe";
    $sql = "CREATE TABLE $tablename (
      id mediumint(11) NOT NULL AUTO_INCREMENT,
      libelle varchar(100) NOT NULL,
      annee varchar(4) NOT NULL,
      numero_championnat mediumint(11) NOT NULL,
      division_championnat mediumint(11) NOT NULL,
      phase_championnat mediumint(11) NOT NULL,
      poule_championnat mediumint(11) NOT NULL,
      numero_equipe mediumint(11) NOT NULL,
      archivee mediumint(11) NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
  }
  
  function deactivate(){
    //flush rewrite rules

  }
  function uninstall(){
	  //delelte CPT
    //delete all the plugin data from the DB
    global $wpdb;
    $tablename = $wpdb->prefix."equipe";
    $sql = "DROP TABLE IF EXISTS $tablename";
    $wpdb->query($sql) ;
  }

  
}
if (class_exists('ChampionnatsPlugin')){
  $championnatsPlugin = new ChampionnatsPlugin();
  $championnatsPlugin ->register();

}


//activation
register_activation_hook( __FILE__, array($championnatsPlugin,'championnats_table'));

//deactivate
register_deactivation_hook( __FILE__, array($championnatsPlugin,'deactivate'));

//uninstall
register_uninstall_hook( __FILE__, array($championnatsPlugin,'uninstall'));
