<?php

 


 
// Add a new top level menu link to the ACP
function championnats_menu()
{
  
 add_menu_page("Championnats Options", "Championnats","manage_options", "championnats", "affichageListeEquipe", plugins_url('/championnats/img/TCicon.png'));
    add_submenu_page("championnats","Liste Equipe", "Liste Equipe","manage_options", "listequipe", "affichageListeEquipe");
    add_submenu_page("championnats","Creation", "Création","manage_options", "gestionEquipe", "gestionEquipe");
  

}
// Hook the 'admin_menu' action hook, run the function named 'championnats_menu()'
add_action( 'admin_menu', 'championnats_menu' );

function affichageListeEquipe(){
	include "affichageListeEquipe.php";
}

function gestionEquipe(){
	include "gestionEquipe.php";
}
function parametrage(){
  include "parametrage.php";
}


/*function customfunctiontest($arg){
  echo $arg;
}

customfunctiontest('hello test de mon plugin');*/