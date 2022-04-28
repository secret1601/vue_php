<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Brando
 */

get_header(); 
brando_get_title_part();
$brando_enable_breadcrumb = brando_option('brando_enable_breadcrumb');
$brando_enable_title = brando_option('brando_enable_title_wrapper');
$brando_top_breadcrumb = ( $brando_enable_title != 1 && $brando_enable_title != 'default' ) ? ' page-top-breadcrumb': '';

if( $brando_enable_breadcrumb == 1 ){
    if (class_exists('brando_breadcrumb_navigation_xt')) 
    {
        $brando_breadcrumb = new brando_breadcrumb_navigation_xt;
        $brando_breadcrumb->opt['static_frontpage'] = false;
        $brando_breadcrumb->opt['url_blog'] = '';
        $brando_breadcrumb->opt['title_blog'] = esc_html__('Home','brando');
        $brando_breadcrumb->opt['title_home'] = esc_html__('Home','brando');
        $brando_breadcrumb->opt['separator'] = '';
        $brando_breadcrumb->opt['tag_page_prefix'] = '';
        $brando_breadcrumb->opt['singleblogpost_category_display'] = false;
    } 

    echo '<div class="brando-breadcrumb breadcrumb alt-font'.esc_attr($brando_top_breadcrumb).'">';
        echo '<div class="container">';
            echo '<ul>';
                echo wp_kses($brando_breadcrumb->display(), wp_kses_allowed_html( 'post' ));
            echo '</ul>';
        echo '</div>';
    echo '</div>';
}
		// Start the loop.
while ( have_posts() ) : the_post();

    $brando_layout_settings = $brando_enable_container_fluid = $brando_class_main_section = $brando_section_class = '';
    $brando_layout_settings_inner = brando_option('brando_layout_settings');
    $brando_brando_options = get_option( 'brando_theme_setting' );
    
    $brando_layout_settings = $brando_layout_settings_inner;
    $brando_enable_container_fluid = brando_option('brando_enable_container_fluid');
    
    switch ($brando_layout_settings) {
        case 'brando_layout_full_screen':
            $brando_section_class .= 'no-padding';
            if(isset($brando_enable_container_fluid) && $brando_enable_container_fluid == '1'){
                $brando_class_main_section .= 'container-fluid';
            }else{
                $brando_class_main_section .= 'container';
            }
        break;

        case 'brando_layout_both_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col3-layout';
        break;

        case 'brando_layout_left_sidebar':
        case 'brando_layout_right_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col2-layout';
        break;

        default:
            $brando_section_class .= '';
            $brando_class_main_section .= 'container';
        break;
    }
    $brando_post_classes = '';
    $brando_post_class_list = array();
    $brando_post_class_list[] = 'parent-section '.$brando_section_class.'';
    ob_start();
        post_class( $brando_post_class_list );
        $brando_post_classes .= ob_get_contents();
    ob_end_clean();
    $page_title = ( $brando_enable_title == 1 ) ? '<h2 class="entry-title display-none">'.get_the_title().'</h2>': '';

echo '<section '.$brando_post_classes.'>';
    echo '<div class="'.esc_attr($brando_class_main_section).'">';
        echo '<div class="row">';
            get_template_part('templates/sidebar-left');
                printf("%s", $page_title);
                echo '<div class="entry-content">';
                    the_content();
                echo '</div>';
                    wp_link_pages( array(
                        'before'      => '<div class="page-links default-link-pages"><span class="page-links-title">' . esc_html__( 'Pages:', 'brando' ) . '</span>',
                        'after'       => '</div>',
                        'pagelink'    => '<span class="page-numbers">%</span>',
                    ) );
                    $brando_enable_comment = brando_option('brando_enable_page_comment');

                    if ( $brando_enable_comment == 1 && (comments_open() || get_comments_number()) ) :
                        echo '<section class="border-top">';
                            echo '<div class="container">';
                                echo '<div class="row">';
                                    comments_template();
                                echo '</div>';
                            echo '</div>';
                        echo '</section>';
                    endif;
            get_template_part('templates/sidebar-right');
        echo '</div>';
    echo '</div>';
echo '</section>';
endwhile;
// End the loop.
get_footer();