<?php
/*
 * Add my new menu to the Admin Control Panel
 */
 
// Hook the 'admin_menu' action hook, run the function named 'championnats_menu()'
add_action( 'admin_menu', 'championnats_menu' );
 
// Add a new top level menu link to the ACP
function championnats_menu()
{
  $page_title = 'Championnats Options';
  $menu_title = 'Championnats';
  $capatibility = 'manage_options';
  $slug = 'championnats';
  $callback ='championnats_html';
  $function = 'displayList';
  $icon_url = plugins_url('/championnats/img/TCicon.png');
  $position = 70;
 /* add_menu_page("Championnats Options", "Championnats","manage_options", "championnats","championnats_html", "displayList",plugins_url('/customplugin/img/icon.png'));
    add_submenu_page("myplugin","All Entries", "All entries","manage_options", "allentries", "displayList");
    add_submenu_page("myplugin","Add new Entry", "Add new Entry","manage_options", "addnewentry", "addEntry");*/

  add_menu_page($page_title, $menu_title, $capatibility, $slug, $callback, $function, $icon_url, $position);
}

function championnats_html() { ?>

<div class="wrap">
  <h1>Résultats des champions !</h1>
  <button type = "button" class="btn btn-light btn-lg" id="listeEquipe" name ="listeEquipe" >Liste des équipes</button>
  <button type = "button" class="btn btn-light btn-lg" id="parametrage" name ="Parametrage" >Paramétrage</button>
  <p>Afficher la liste des equipes non archiver dans un tableau</p>
</div>    

<?php }

class ChampionnatsPlugin
{
  function register(){
    add_action ('admin_enqueue_scripts', array( $this , 'enqueue' ));
  }
 
  function activate(){
   //generated a cpt
   //flush rewrite rules

  }
  function deactivate(){
   //flush rewrite rules

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

customfunctiontest('hello test de ma page');

//activation
register_activation_hook( __FILE__, array($championnatsPlugin, 'activate'));
  

//deactivation
register_deactivation_hook( __FILE__, array($championnatsPlugin, 'deactivate') );
  


 