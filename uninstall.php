<?php

/**
 * Trigger this file fon Plugin uninstall
 * 
 * @package ChampionnatsPlugin
 * 
 */

 if( ! defined ('WP_UNINSTALL_PLUGIN') ){
     die;
 }

 //clear database stored data
//sql query or wordpress method

/*
exemple method wp
$book = get_posts( array ('post_type' => 'book','numberposts'=>-1));
foreach($books as $book) {
    wp_delete_post($book->ID, true);
}
*/

/*
exmple sql query
global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE post_type ='book'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN(SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
*/