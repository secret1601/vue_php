<?php
/**
 * The template for displaying Portfolio category
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brando
 */

get_header(); 
?>
<?php
    $brando_layout_settings = $brando_enable_container_fluid = $brando_class_main_section = $brando_section_class = $brando_title = $output = '';
    $brando_layout_settings_inner = brando_option('brando_portfolio_cat_settings');
    $brando_options = get_option( 'brando_theme_setting' );
    
    $brando_layout_settings = $brando_layout_settings_inner;
    $brando_enable_container_fluid = brando_option('brando_portfolio_cat_enable_container_fluid');
    
    switch ($brando_layout_settings) {
        case 'brando_portfolio_cat_full_screen':
            $brando_section_class .= ' no-padding';
            if(isset($brando_enable_container_fluid) && $brando_enable_container_fluid == '1'){
                $brando_class_main_section .= 'container-fluid';
            }else{
                $brando_class_main_section .= 'container';
            }
        break;

        case 'brando_portfolio_cat_both_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col3-layout';
        break;

        case 'brando_portfolio_cat_left_sidebar':
        case 'brando_portfolio_cat_right_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col2-layout';
        break;

        default:
            $brando_section_class .= '';
            $brando_class_main_section .= 'container';
        break;
    }

$brando_title = (isset($brando_options['brando_portfolio_cat_title'])) ? $brando_options['brando_portfolio_cat_title'] : '';
$brando_enable_title = (isset($brando_options['brando_enable_title_wrapper_portfolio'])) ? $brando_options['brando_enable_title_wrapper_portfolio'] : '';
$brando_page_title_image = (isset($brando_options['brando_title_background_portfolio'])) ? $brando_options['brando_title_background_portfolio'] : '';
$brando_title_parallax_effect = (isset($brando_options['brando_title_parallax_effect_portfolio'])) ? $brando_options['brando_title_parallax_effect_portfolio'] : '';
$brando_page_subtitle = (isset($brando_options['brando_header_subtitle_portfolio'])) ? $brando_options['brando_header_subtitle_portfolio'] : '';

if( $brando_enable_title == 1 ){
    $brando_post_class ='';
    $brando_post_class_list = array();
    $brando_post_class_list[] = esc_attr($brando_title_parallax_effect).' parallax-fix no-padding';
    ob_start();
        post_class($brando_post_class_list);
    $brando_post_class .= ob_get_contents();  
    ob_end_clean(); 
    echo '<section '.$brando_post_class.'>';
        
        if( $brando_page_title_image ){
            echo wp_get_attachment_image( $brando_page_title_image['id'], "full", "", array( "class" => "parallax-background-img" ) );
        }
        echo '<div class="opacity-full-dark bg-deep-blue3"></div>';
        echo '<div class="container position-relative">';
            echo '<div class="row">';
                echo '<div class="page-title">';
                    echo '<div class="col-text-middle-main">';
                        echo '<div class="col-text-middle">';
                            echo '<div class="col-md-12 col-sm-12 text-center">';
                                echo '<h1 class="alt-font white-text font-weight-600 xs-title-extra-large no-margin">'.esc_attr($brando_title).'</h1>';
                                echo '<div class="alt-font title-small xs-text-large white-text text-uppercase margin-one-top display-block">'.$brando_page_subtitle.'</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</section>';
}
?>
<?php
$output = '';  
$brando_enable_breadcrumb = brando_option('brando_enable_breadcrumb');
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
    echo '<div class="breadcrumb alt-font brando-breadcrumb">';
        echo '<div class="container"> '; 
            echo '<ul>';
                echo wp_kses($brando_breadcrumb->display(), wp_kses_allowed_html( 'post' ));
            echo'</ul>'; 
        echo'</div>'; 
    echo'</div>';
} 		
?>
<section class="parent-section<?php echo esc_attr($brando_section_class); ?>">
    <div class="<?php echo esc_attr($brando_class_main_section); ?>">
        <div class="row">
            <?php get_template_part('templates/portfolio-cat-left'); ?>
                <?php 
                    get_template_part('templates/portfolio-content/content');
                ?>
            <?php get_template_part('templates/portfolio-cat-right'); ?>
        </div>
    </div>
</section>
<?php get_footer();