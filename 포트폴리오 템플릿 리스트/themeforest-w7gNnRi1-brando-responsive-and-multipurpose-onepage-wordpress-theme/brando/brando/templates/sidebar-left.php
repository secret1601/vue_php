<?php
/**
 * displaying left sidebar for pages
 *
 * @package Brando
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$brando_layout_left_sidebar = $output = $brando_layout_right_sidebar = $brando_layout_settings = '';

$brando_layout_settings_inner = brando_option('brando_layout_settings');

$brando_layout_settings = $brando_layout_settings_inner;
$brando_layout_left_sidebar = brando_option('brando_layout_left_sidebar');
$brando_layout_right_sidebar = brando_option('brando_layout_right_sidebar');
switch ($brando_layout_settings) 
{
	case 'brando_layout_left_sidebar':
        echo '<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-ten-bottom pull-right xs-pull-none">';
    break;

	case 'brando_layout_right_sidebar':
        echo '<div class="col-md-8 col-sm-8 col-xs-12">';
    break;

	case 'brando_layout_both_sidebar':
        echo '<div class="col-sm-12 both-content-center sm-margin-seven-top post-center sm-no-padding-lr">';
    break;

	case 'brando_layout_full_screen':
    break;
}