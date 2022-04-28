<?php
/**
 * Generate css.
 *
 * @package Brando
 */
?>
<?php

global $brando_theme_settings;

$bg_nav_menu = ( isset( $brando_theme_settings['bg_nav_menu'] ) && $brando_theme_settings['bg_nav_menu'] ) ? $brando_theme_settings['bg_nav_menu'] : '';
$bg_nav_menu_opacity = ( isset( $brando_theme_settings['bg_nav_menu_opacity'] ) && $brando_theme_settings['bg_nav_menu_opacity'] ) ? $brando_theme_settings['bg_nav_menu_opacity'] : '';

$bg_center_logo_nav_menu = ( isset( $brando_theme_settings['bg_center_logo_nav_menu'] ) && $brando_theme_settings['bg_center_logo_nav_menu'] ) ? $brando_theme_settings['bg_center_logo_nav_menu'] : '';
$bg_center_logo_nav_menu_opacity = ( isset( $brando_theme_settings['bg_center_logo_nav_menu_opacity'] ) && $brando_theme_settings['bg_center_logo_nav_menu_opacity'] ) ? $brando_theme_settings['bg_center_logo_nav_menu_opacity'] : '';

$bg_white_nav_menu = ( isset( $brando_theme_settings['bg_white_nav_menu'] ) && $brando_theme_settings['bg_white_nav_menu'] ) ? $brando_theme_settings['bg_white_nav_menu'] : '';
$bg_white_nav_menu_opacity = ( isset( $brando_theme_settings['bg_white_nav_menu_opacity'] ) && $brando_theme_settings['bg_white_nav_menu_opacity'] ) ? $brando_theme_settings['bg_white_nav_menu_opacity'] : '';

$bg_without_border_nav_menu = ( isset( $brando_theme_settings['bg_without_border_nav_menu'] ) && $brando_theme_settings['bg_without_border_nav_menu'] ) ? $brando_theme_settings['bg_without_border_nav_menu'] : '';
$bg_without_border_nav_menu_opacity = ( isset( $brando_theme_settings['bg_without_border_nav_menu_opacity'] ) && $brando_theme_settings['bg_without_border_nav_menu_opacity'] ) ? $brando_theme_settings['bg_without_border_nav_menu_opacity'] : '';

$bg_dropdown_menu = ( isset( $brando_theme_settings['bg_dropdown_menu'] ) && $brando_theme_settings['bg_dropdown_menu'] ) ? $brando_theme_settings['bg_dropdown_menu'] : '';
$bg_dropdown_menu_opacity = ( isset( $brando_theme_settings['bg_dropdown_menu_opacity'] ) && $brando_theme_settings['bg_dropdown_menu_opacity'] ) ? $brando_theme_settings['bg_dropdown_menu_opacity'] : '';

$brando_bg_page_title_opacity = ( isset( $brando_theme_settings['brando_bg_page_title_opacity'] ) && $brando_theme_settings['brando_bg_page_title_opacity'] ) ? $brando_theme_settings['brando_bg_page_title_opacity'] : '';
?>

<?php if( $bg_nav_menu == 'transparent' && $bg_nav_menu_opacity ) : ?>
/* Transparent default header */
nav.transparent-navbar-default.shrink { background: <?php echo esc_html( $bg_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_nav_menu && !$bg_nav_menu_opacity ) : ?>
/* Transparent default header */
nav.transparent-navbar-default.shrink { background: <?php echo esc_html( $bg_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_nav_menu && $bg_nav_menu_opacity ) : ?>
/* Transparent default header with opacity */
nav.transparent-navbar-default.shrink { background: <?php echo esc_html( brando_hex2rgb( $bg_nav_menu, $bg_nav_menu_opacity ) ); ?>; }
<?php endif; ?>

<?php if( $bg_center_logo_nav_menu == 'transparent' && $bg_center_logo_nav_menu_opacity ) : ?>
/* Center logo header */
.center-logo-header, .shrink.center-logo-header { background: <?php echo esc_html( $bg_center_logo_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_center_logo_nav_menu && !$bg_center_logo_nav_menu_opacity ) : ?>
/* Center logo header */
.center-logo-header, .shrink.center-logo-header { background: <?php echo esc_html( $bg_center_logo_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_center_logo_nav_menu && $bg_center_logo_nav_menu_opacity ) : ?>
/* Center logo header with opacity */
.center-logo-header, .shrink.center-logo-header { background: <?php echo esc_html( brando_hex2rgb( $bg_center_logo_nav_menu, $bg_center_logo_nav_menu_opacity ) ); ?>; }
<?php endif; ?>

<?php if( $bg_white_nav_menu == 'transparent' && $bg_white_nav_menu_opacity ) : ?>
/* White header */
.header-white, .header-white.shrink { background: <?php echo esc_html( $bg_white_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_white_nav_menu && !$bg_white_nav_menu_opacity ) : ?>
/* White header */
.header-white, .header-white.shrink { background: <?php echo esc_html( $bg_white_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_white_nav_menu && $bg_white_nav_menu_opacity ) : ?>
/* White header with opacity */
.header-white, .header-white.shrink { background: <?php echo esc_html( brando_hex2rgb( $bg_white_nav_menu, $bg_white_nav_menu_opacity ) ); ?>; }
<?php endif; ?>

<?php if( $bg_without_border_nav_menu == 'transparent' && $bg_without_border_nav_menu_opacity ) : ?>
/* Without border header */
nav.without-border.shrink { background: <?php echo esc_html( $bg_without_border_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_without_border_nav_menu && !$bg_without_border_nav_menu_opacity ) : ?>
/* Without border header */
nav.without-border.shrink { background: <?php echo esc_html( $bg_without_border_nav_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_without_border_nav_menu && $bg_without_border_nav_menu_opacity ) : ?>
/* Without border header with opacity */
nav.without-border.shrink { background: <?php echo esc_html( brando_hex2rgb( $bg_without_border_nav_menu, $bg_without_border_nav_menu_opacity ) ); ?>; }
<?php endif; ?>

<?php if( $bg_dropdown_menu == 'transparent' && $bg_dropdown_menu_opacity ) : ?>
/* Submenu header */
.navbar-nav li ul li, .pull-menu .navbar-nav li > ul li, .center-logo-header .navbar-nav li > ul li, .sidebar-nav .navbar-nav li > ul li { background: <?php echo esc_html( $bg_dropdown_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_dropdown_menu && !$bg_dropdown_menu_opacity ) : ?>
/* Submenu header */
.navbar-nav li ul li, .pull-menu .navbar-nav li > ul li, .center-logo-header .navbar-nav li > ul li, .sidebar-nav .navbar-nav li > ul li { background: <?php echo esc_html( $bg_dropdown_menu ); ?>; }
<?php endif; ?>

<?php if( $bg_dropdown_menu && $bg_dropdown_menu_opacity ) : ?>
/* Submenu header with opacity */
.navbar-nav li ul li, .pull-menu .navbar-nav li > ul li, .center-logo-header .navbar-nav li > ul li, .sidebar-nav .navbar-nav li > ul li { background: <?php echo esc_html( brando_hex2rgb( $bg_dropdown_menu, $bg_dropdown_menu_opacity ) ); ?>; }
<?php endif; ?>

<?php if( $brando_bg_page_title_opacity ) : ?>
/* Page title opacity */
.brando-page-title .opacity-full-dark { opacity: <?php echo esc_html( $brando_bg_page_title_opacity ); ?>; }
<?php endif; ?>