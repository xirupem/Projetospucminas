<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chique
 */

$sidebar = chique_get_sidebar_id();

// Is active sidebar check in function chique_get_sidebar_id.
if ( '' === $sidebar ) {
    return;
}

?>