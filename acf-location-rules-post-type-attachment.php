<?php
/**
 * Plugin Name: ACF Location Rules Post Type Attachment
 * Plugin URI: http://www.KCPT.org/
 * Description: This plugin filters Advanced Custom Fields to add attachment back to post_type options in location rules
 * Version: 0.0.1
 * Author: Steven Kohlmeyer
 * Author URI: http://StevenKohlmeyer.com
 * License: LGPL2
 * Tag:
 */

add_filter('acf/get_post_types', 'override_get_post_types', 99, 3);

function override_get_post_types( $post_types, $exclude = array(), $include = array() )
{
    // The key line to this plugin:
    $exclude = array_diff($exclude, array('attachment'));

    // get all custom post types
    $post_types = array_merge($post_types, get_post_types());


    // core include / exclude
    $acf_includes = array_merge( array(), $include );
    $acf_excludes = array_merge( array( 'acf', 'revision', 'nav_menu_item' ), $exclude );


    // include
    foreach( $acf_includes as $p )
    {
        if( post_type_exists($p) )
        {
            $post_types[ $p ] = $p;
        }
    }


    // exclude
    foreach( $acf_excludes as $p )
    {
        unset( $post_types[ $p ] );
    }


    return $post_types;

}