<?php
/*
Plugin Name: Championnats
Plugin URI: https://tcgrandchamp.fr/
Description: Ce plugin permet d'alimenter le site automatiquement avec les resultats des championnats par equipes sans aller sur le site internet de ten'up
Version: 1.0
Author: de Montgolfier Aurelie
*/

// TODO : Pas de franglish
// Include champ-functions.php, use require_once to stop the script if mfp-functions.php is not found
require_once plugin_dir_path(__FILE__) . 'includes/champ-functions.php';

defined('ABSPATH') or die('Hey, you can\t acces this file, you silly humain!!!');

// TODO : commentaires ?
class ChampionnatsPlugin
{
    // TODO : commentaires ?
    function __construct()
    {
       // TODO : commentaires ?
    }

    // TODO : commentaires ?
    function register()
    {
        add_action('admin_enqueue_scripts', array(
            $this,
            'enqueue'
        ));
    }
    
    // TODO : commentaires ?
    function enqueue()
    {
        //enqueue all our scripts
        wp_enqueue_style('mypluginstyle', plugins_url('/styles/style.css', __FILE__), array(
            ''
        ));
    }

    // Fonction d'installation du plugin Championnats
    function championnats_table()
    {
        global $wpdb;
        
        $tableEquipe       = $wpdb->prefix . "equipe";
        $tableParametrage      = $wpdb->prefix . "parametrage";
        $charset_collate = $wpdb->get_charset_collate();

        $sql_equipe      = "CREATE TABLE $tableEquipe (
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
        
        $sql_parametrage = "CREATE TABLE $tableParametrage (
          cle varchar(50) NOT NULL,
          valeur varchar(255) NOT NULL,
          PRIMARY KEY  (cle)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_equipe);
        dbDelta($sql_parametrage);
        
        // Création des clés des URL
        $url_post          = $wpdb->insert($table_name, array(
            'cle' => 'URL_POST',
            'valeur' => 'TO DEFINE'
        ));
        $url_feuille_match = $wpdb->insert($table_name, array(
            'cle' => 'URL_FEUILLE_MATCH',
            'valeur' => 'TO DEFINE'
        ));
    }
    
    // TODO : commentaires ?
    function deactivate()
    {
        // TODO : Pas de franglish
        //flush rewrite rules
    }

    // Fonction de déinstallation du plugin Championnats
    function uninstall()
    {
        // TODO : Pas de franglish
        // Delete all the plugin data from the DB
        global $wpdb;

        // Suppression de la table EQUIPE
        $tablename = $wpdb->prefix . "equipe";
        $sql       = "DROP TABLE IF EXISTS $tablename";
        $wpdb->query($sql);

        // Suppression de la table PARAMETRAGE
        $tablename = $wpdb->prefix . "parametrage";
        $sql       = "DROP TABLE IF EXISTS $tablename";
        $wpdb->query($sql);
    }    
}

// TODO : commentaires ?
if (class_exists('ChampionnatsPlugin')) {
    $championnatsPlugin = new ChampionnatsPlugin();
    $championnatsPlugin->register();
}

// TODO : A mieux commenter
//activation
register_activation_hook(__FILE__, array(
    $championnatsPlugin,
    'championnats_table'
));

// TODO : A mieux commenter
//deactivate
register_deactivation_hook(__FILE__, array(
    $championnatsPlugin,
    'deactivate'
));

// TODO : A mieux commenter
//uninstall
register_uninstall_hook(__FILE__, array(
    $championnatsPlugin,
    'uninstall'
));