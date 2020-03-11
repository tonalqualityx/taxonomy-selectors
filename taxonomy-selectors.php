<?php 
/*
 * Plugin Name: Taxonomy Selectors
 * Plugin URI: https://becomeindelible.com
 * Description: Creates a selector based on the given taxonomy using shortcode [ind-tax-selector tax='$taxonomy_slug']
 * Author: Michael Dion
 * Version: 1.0
 * Author URI: https://becomeindelible.com
 * License: GPL2+
 */

define( 'IND_TAX_SELECT_PATH', plugin_dir_path( __FILE__ ) );
define( 'IND_TAX_SELECT_URL', plugin_dir_url( __FILE__ ) );



// 	<option value="-1">Select Category</option>
// 	<option class="level-0" value="aerial-devices">Aerial Devices</option>
// 	<option class="level-1" value="utem">&nbsp;&nbsp;&nbsp;UTEM</option>
// 	<option class="level-2" value="utem-aerial-lift">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UTEM Aerial Lift</option>

add_shortcode( 'ind-taxonomy-selector', 'ind_tax_selector' );

function ind_tax_selector($atts){

    $atts = shortcode_atts(
        array(
            'tax' => 'category',
            'id' => '',
            'name' => '',
            'classes' => '',
            'hide_empty' => false,
        ), $atts, $tag );

    if(taxonomy_exists( $atts['tax'] )){
        $response = "<select name='{$atts['name']}' id='{$atts['id']}' class='{$atts['classes']}'>";   
    
        $level = 0;
        
        $taxonomy = get_terms(array("taxonomy" => $atts['tax'], "parent" => 0, "hide_empty" => $atts['hide_empty']));

        foreach($taxonomy as $tax){

            $response .= ind_recursive_tax_options(0, $atts, $tax);

        }

    $response .= "</select>";

    } else {

        $response .= "<p>Sorry, this taxonomy doesn't exist.";

    }

    return $response;

}


function ind_recursive_tax_options($level, $atts, $tax){

    $response = "";
        
    $response .= ind_tax_option($level, $tax->slug);        
        
    $children = get_terms(array("taxonomy"=>$atts['tax'], "parent" => $tax->term_id, "hide_empty" => $atts['hide_empty']));

    if(is_array($children)){
        foreach($children as $child){

            $response .= ind_recursive_tax_options($level + 1, $atts, $child);

        }
    }

    return $response;
}

function ind_tax_option($level, $value){

    return "<option class='level-{$level}' value='{$value}'>" . ucwords(str_replace("-", " ", $value)) ;

}