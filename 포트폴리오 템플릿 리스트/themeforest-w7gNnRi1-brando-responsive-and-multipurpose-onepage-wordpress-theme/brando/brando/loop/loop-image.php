<?php
/**
 * displaying featured image for blog
 *
 * @package Brando
 */
?>
<?php
$brando_options = get_option( 'brando_theme_setting' );
if( is_category() || is_archive() || is_author() || is_tag() ){
	$brando_srcset_data = (isset($brando_options['brando_general_srcset_data'])) ? $brando_options['brando_general_srcset_data'] : '';
}else{
	$brando_srcset_data = (isset($brando_options['brando_blog_srcset_data'])) ? $brando_options['brando_blog_srcset_data'] : '';
}

echo '<div class="blog-image"><a href="'.get_permalink().'">';
    if ( has_post_thumbnail() ) {
        echo get_the_post_thumbnail( get_the_ID(), $brando_srcset_data );
    }
echo '</a></div>';