<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "Title".
 *
 * @package Brando
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <?php 
        // Set Header for Ajax Popup.
        brando_set_header( get_the_ID() );
        wp_head(); 
    ?>
    <?php if( brando_option('general_css_code') ){ ?>
        <style>
            <?php echo brando_option('general_css_code'); ?>
        </style>
    <?php } ?>
</head>
<body <?php body_class(); ?><?php brando_body_background();  ?>>
<?php
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } else {
        do_action( 'wp_body_open' );
    }
    // Add Div For Ajax Popup
    brando_add_ajax_page_div_header( get_the_ID() );

    if ( is_search() || is_category() || is_archive() ) {
        get_template_part( 'templates/archive-menu' );
    } else {
        get_template_part( 'templates/menu' );
    }
    $brando_header_layout = brando_option('brando_header_layout');
    $brando_enable_header =  brando_option('brando_enable_header');
    if( $brando_header_layout == 'headertype4' && $brando_enable_header != 0){
        echo '<div class="sidebar-wrapper personal">';
    }