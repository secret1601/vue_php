<?php

if ( ! function_exists( 'brando_set_header' ) ) :
    function brando_set_header( $brando_id )
    {
        if(get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio')){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }
    
        if($brando_enable_ajax == '1'){
            remove_all_actions('wp_head');
            // Add VC default action for wp_head
            if ( class_exists('Vc_Base') ) {
                $brando_vc_base_class = new Vc_Base();
                add_action( 'wp_head', array( $brando_vc_base_class,'addFrontCss'), 1000 );
                add_action( 'wp_head', array( $brando_vc_base_class,'addNoScript'), 1000 );
                add_action( 'wp_head', array( $brando_vc_base_class,'addMetaData') );
            }
        }
    }
endif;

if ( ! function_exists( 'brando_set_footer' ) ) :
    function brando_set_footer( $brando_id ){
        if(get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio')){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }

        if($brando_enable_ajax == '1'){
            remove_all_actions('wp_footer');
            add_action('wp_footer','brando_hook_for_ajax_page');
            if( function_exists( 'brando_generate_custom_css' ) ) {
                add_action('wp_footer','brando_generate_custom_css');
            }
            if( function_exists( 'brando_addons_text_align_css' ) ) {
                add_action( 'wp_footer', 'brando_addons_text_align_css' );
            }
        }
    }
endif;

if ( ! function_exists( 'brando_add_ajax_page_div_header' ) ) {
    function brando_add_ajax_page_div_header( $brando_id ){
        if( get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio') ){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }
        
        if($brando_enable_ajax == '1'){
            echo '<div class="bg-white">';
            echo '<button title="Close (Esc)" type="button" class="mfp-close mfp-footer-close">×</button>';
        }
    }
}

if ( ! function_exists( 'brando_add_ajax_page_div_footer' ) ) {
    function brando_add_ajax_page_div_footer( $brando_id ){
        if(get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio')){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }

        if($brando_enable_ajax == '1'){
            echo '</div>';
        }
    }
}

// For Title Tag
if( ! function_exists( 'brando_title_tag' ) ) : 
    function brando_title_tag( $brando_title ) {
        if ( ! defined('WPSEO_VERSION') ) {
            if ( $brando_title ) {
            } else {
                $brando_title = get_bloginfo( 'name' );
            }
        }
        return $brando_title;
    }
    add_filter( 'wp_title', 'brando_title_tag' );
endif;

if ( ! function_exists( 'brando_post_meta' ) ) :
    function brando_post_meta( $brando_option ){
        global $post;
        $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
        return $brando_value;
    }
endif;

// Get the Post Tags

if ( ! function_exists( 'brando_single_post_meta_tag' ) ) :
function brando_single_post_meta_tag() 
{
    ?>
        <div class="margin-six-bottom">
          <?php                          
            $brando_tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'brando' ) );
            if ( $brando_tags_list ) 
            {
                printf( '%1$s %2$s',
                    _x( '<h5 class="alt-font text-extra-large dark-gray-text no-margin font-weight-600">Tags</h5>', 'Used before tag names.', 'brando' ),
                    $brando_tags_list
                );
            }
            ?>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'brando_single_portfolio_meta_tag' ) ) :

    function brando_single_portfolio_meta_tag() 
    {
        global $post;
        $brando_portfolio_tag_list = get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="alt-font text-extra-large dark-gray-text">Tags</h5>', ', ', '');
        if($brando_portfolio_tag_list):
            $output = '<div class="margin-six-bottom">';
                $output .= get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="alt-font text-extra-large dark-gray-text no-margin font-weight-600">Tags</h5>', ', ', '');
            $output .= '</div>';
            return $output;
        endif;
       
    }
endif;

add_filter( "term_links-post_tag", 'brando_add_tag_class');
if ( ! function_exists( 'brando_add_tag_class' ) ) {
    function brando_add_tag_class($brando_links) 
    {
        return str_replace('<a href="', '<a class="text-small text-uppercase alt-font" href="', $brando_links);
    }
}

if ( ! function_exists( 'brando_option_url' ) ) {
    function brando_option_url($brando_option) {
        $brando_image = brando_option($brando_option);
        if (is_array($brando_image) && isset($brando_image['url']) && !empty($brando_image['url'])) {
            return $brando_image['url'];
        }
        return false;
    }
}

if ( ! function_exists( 'brando_option' ) ) :
    function brando_option( $brando_option )
    {
        global $brando_theme_settings, $post;
        $brando_single = false;
        if(is_singular()){
            $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
            $brando_single = true;
        }

        if($brando_single == true){
            if (is_string($brando_value) && (strlen($brando_value) > 0 || is_array($brando_value)) && $brando_value != 'default') {
                return $brando_value;
            }
        }
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            return $brando_option_value;
        }
        return false;
    }
endif;


if ( ! function_exists( 'brando_option_post' ) ) {
    function brando_option_post( $brando_option ){
        global $brando_theme_settings, $post;
        $brando_option_post = '';
        $brando_single = false;
        if(is_singular()){
            $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
            $brando_single = true;
        }

        if($brando_single == true){
            if (is_string($brando_value) && (strlen($brando_value) > 0 || is_array($brando_value)) && ($brando_value != 'default')  ) {
                return $brando_value;
            }
        }
        $brando_option_post = $brando_option.'_post';
        if(isset($brando_theme_settings[$brando_option_post]) && $brando_theme_settings[$brando_option_post] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option_post];
            return $brando_option_value;
        }
        return false;
    }
}

if ( ! function_exists( 'brando_option_portfolio' ) ) {
    function brando_option_portfolio( $brando_option ){
        global $brando_theme_settings, $post;
        $brando_option_post = '';
        $brando_single = false;

        if(is_singular()){
            $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
            $brando_single = true;
        }

        if($brando_single == true){
            if (is_string($brando_value) && (strlen($brando_value) > 0 || is_array($brando_value)) && ($brando_value != 'default')  ) {
                return $brando_value;
            }
        }
        $brando_option_post = $brando_option.'_portfolio';
        if(isset($brando_theme_settings[$brando_option_post]) && $brando_theme_settings[$brando_option_post] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option_post];
            return $brando_option_value;
        }
        return false;
    }
}

if( ! function_exists( 'brando_script_add_data' ) ) :

function brando_script_add_data( $brando_handle, $brando_key, $brando_value ) {
    global $wp_scripts;
    return $wp_scripts->add_data( $brando_handle, $brando_key, $brando_value );
}

endif; // ! function_exists( 'brando_script_add_data' )

/* Filter For the_post_thumbnail function attributes */
if( ! function_exists( 'brando_filter_the_post_thumbnail_atts' ) ) :
    function brando_filter_the_post_thumbnail_atts( $atts, $attachment ) {

        global $brando_theme_settings;

        if( isset( $brando_theme_settings['enable_image_alt'] ) && $brando_theme_settings['enable_image_alt'] != '' ) {
            if( $brando_theme_settings['enable_image_alt'] == '1' ) {
                $brando_image_alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
                $atts['alt'] = $brando_image_alt_text;
            } else {
                $atts['alt'] = '';
            }
        }

        if( isset( $brando_theme_settings['enable_image_title'] ) && $brando_theme_settings['enable_image_title'] != '' ) {
            if( $brando_theme_settings['enable_image_title'] == 1 && $attachment->post_title ){
                $atts['title'] = esc_attr( $attachment->post_title );
            }
        }
        return $atts;
    }
endif;
add_filter( 'wp_get_attachment_image_attributes', 'brando_filter_the_post_thumbnail_atts', 10, 2 );

/* For Image Alt Text */
if ( ! function_exists( 'brando_option_image_alt' ) ) {
    function brando_option_image_alt( $brando_attachment_id ){
        global $brando_theme_settings;
        $brando_img_info = '';
        $brando_option = 'enable_image_alt';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_img_info = array(
                    'alt' => get_post_meta( $brando_attachment_id, '_wp_attachment_image_alt', true ),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Image Title */
if ( ! function_exists( 'brando_option_image_title' ) ) {
    function brando_option_image_title( $brando_attachment_id ){
        global $brando_theme_settings;
        $brando_img_info = '';
        $brando_option = 'enable_image_title';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_attachment = get_post( $brando_attachment_id );
                $brando_img_info = array(
                    'title' => esc_attr($brando_attachment->post_title),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Image Caption */
if ( ! function_exists( 'brando_option_image_caption' ) ) {
    function brando_option_image_caption( $brando_attachment_id ){
        global $brando_theme_settings;
        $brando_img_info = '';
        $brando_option = 'enable_lightbox_caption';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_attachment = get_post( $brando_attachment_id );
                $brando_img_info = array(
                    'caption' => esc_attr($brando_attachment->post_excerpt),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Lightbox Image Title */
if ( ! function_exists( 'brando_option_lightbox_image_title' ) ) {
    function brando_option_lightbox_image_title( $brando_attachment_id ){
        global $brando_theme_settings, $post;
        $brando_img_info = '';
        $brando_option = 'enable_lightbox_title';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_attachment = get_post( $brando_attachment_id );
                $brando_img_info = array(
                    'title' => esc_attr($brando_attachment->post_title),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* page title option for individual pages*/
if ( ! function_exists( 'brando_get_title_part' ) ) :
    function brando_get_title_part(){
        
        $brando_enable_head =  brando_option('brando_enable_header');
        if($brando_enable_head == '1' || $brando_enable_head == 'defalut'){
            $brando_enable_header =  brando_option('brando_enable_header');
            $brando_header_layout =  brando_option('brando_header_layout');
            
            if($brando_enable_head == 'default'){
                $brando_options = get_option( 'brando_theme_setting' );
                $brando_enable_header = (isset($brando_options['brando_enable_header'])) ? $brando_options['brando_enable_header'] : '';
            }
            
        }

        $brando_enable_title = brando_option('brando_enable_title_wrapper');
        if($brando_enable_title == 'default'){
            $brando_options = get_option( 'brando_theme_setting' );
            $brando_enable_title = (isset($brando_options['brando_enable_title_wrapper'])) ? $brando_options['brando_enable_title_wrapper'] : '';
        }
        if($brando_enable_title == 0 || is_404())
            return;
        
        $brando_page_title = get_the_title();

        $output = '';
        $brando_page_title_image = brando_option('brando_title_background');
        if(is_array($brando_page_title_image))
                $brando_page_title_image =  $brando_page_title_image['url'];

        $brando_title_parallax_effect = brando_option('brando_title_parallax_effect');
        $brando_page_subtitle = brando_option('brando_header_subtitle');

        echo '<section class="'.esc_attr($brando_title_parallax_effect).' parallax-fix no-padding brando-page-title">';
        if( $brando_page_title_image ){
            echo '<img class="parallax-background-img" src="'.esc_url($brando_page_title_image).'" alt="background-img" />';
        }
            echo '<div class="opacity-full-dark bg-deep-blue3"></div>';
            echo '<div class="container position-relative">';
                echo '<div class="row">';
                    echo '<div class="page-title">';
                        echo '<div class="col-text-middle-main">';
                            echo '<div class="col-text-middle">';
                                echo '<div class="col-md-12 col-sm-12 text-center">';
                                    if( $brando_page_title ){
                                        echo '<h1 class="alt-font white-text font-weight-700 xs-title-extra-large no-margin entry-title brando-title-text">'.esc_attr( $brando_page_title ).'</h1>';
                                    }
                                    if( $brando_page_subtitle ){
                                        echo '<div class="alt-font font-weight-600 title-small xs-text-large white-text text-uppercase margin-one-top display-block brando-subtitle-text">'.esc_attr( $brando_page_subtitle ).'</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</section>';
    }
endif;

/* Hook For ajax page */
if ( ! function_exists( 'brando_hook_for_ajax_page' ) ) :
    function brando_hook_for_ajax_page() {
        
        echo "<script>
        'use strict';
        ( function( $ ) {
        $(document).ready(function () {
            $('.owl-dots > .owl-dot').click(function (e) {
                if ($(e.target).is('.mfp-close')){
                    return;
                }else{
                    $(this).trigger('to.owl.carousel', [$(this).index(), 300]);
                    return false;
                }
            });
            $('.owl-nav > .owl-prev').click(function (e) {
                if ($(e.target).is('.mfp-close'))
                    return;
                return false;
            });
            $('.owl-nav > .owl-next').click(function (e) {
                if ($(e.target).is('.mfp-close'))
                    return;
                return false;
            });
            $('.single-page-social-icon > a').click(function (e) {
                if ($(e.target).is('.mfp-close'))
                    return;
                return false;
            });

            SetResizeContent();
            $('.fit-videos').fitVids();
            });

            function SetResizeContent() {
                var minheight = $(window).height();
                $('.full-screen').css('min-height', minheight);
            }
            })( jQuery );
            </script>";
    }
endif;

add_action( 'wp_before_admin_bar_render', 'brando_remove_customizer_adminbar' ); 

if ( ! function_exists( 'brando_remove_customizer_adminbar' ) ) {
    function brando_remove_customizer_adminbar()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('customize');
    }
}

if( ! function_exists( 'brando_remove_wpautop' ) ) :
  function brando_remove_wpautop( $content, $force_br = true ) {
    if ( $force_br ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
endif;

/* For enqueue media for file upload */
if( is_admin() && ! empty ( $_SERVER['PHP_SELF'] ) && 'upload.php' !== basename( $_SERVER['PHP_SELF'] ) ) {
    function brando_load_styles_and_scripts() {
        wp_enqueue_media();
    }
    add_action( 'admin_enqueue_scripts', 'brando_load_styles_and_scripts' );
}

// Check if Brando-addons Plugin active or not.
if(!class_exists('Brando_Addons')){
    if ( ! function_exists( 'brando_get_simple_likes_button' ) ) :
        function brando_get_simple_likes_button( $id ) {
            return;
        }
    endif;
}

if ( ! function_exists( 'brando_get_the_excerpt_theme' ) ) :
    function brando_get_the_excerpt_theme($brando_length)
    {
        return brando_Excerpt::brando_get_by_length($brando_length);
    }
endif;

if ( ! function_exists( 'brando_registered_sidebars_array' ) ) :
function brando_registered_sidebars_array() {
    global $wp_registered_sidebars;
    if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ){ 
        $brando_sidebar_array = array();
        $brando_sidebar_array['default'] = 'Default';
        foreach( $wp_registered_sidebars as $sidebar ){
            $brando_sidebar_array[$sidebar['id']] = $sidebar['name'];
        }
    }
    return $brando_sidebar_array;
}
endif;

add_filter('wp_list_categories', 'brando_add_new_class_list_categories');
if ( ! function_exists( 'brando_add_new_class_list_categories' ) ) :
    function brando_add_new_class_list_categories($brando_list) {
        $brando_list = str_replace('cat-item ', 'cat-item category-list ', $brando_list); 
        return $brando_list;
    }
endif;

if ( ! function_exists( 'brando_tag_cloud_filter' ) ):
    function brando_tag_cloud_filter($return, $args)
    {
      return '<div class="widget-body tags">'.$return.'</div>';
    }
endif;
add_filter('wp_tag_cloud','brando_tag_cloud_filter', 10, 2);


/* Add custom field in tag */

add_action( 'post_tag_add_form_fields', 'brando_post_tag_add_new_meta_field', 10, 2 );

if ( ! function_exists( 'brando_post_tag_add_new_meta_field' ) ) :
    function brando_post_tag_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_post_tag_edit_meta_field' ) ) :
    function brando_post_tag_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_post_tag_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary" value="Remove Image">
            </td>
        </tr>
    <?php
    }
endif;
add_action( 'post_tag_edit_form_fields', 'brando_post_tag_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_post_tag_custom_meta' ) ) :
    function brando_save_post_tag_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_post_tag_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_post_tag_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_post_tag', 'brando_save_post_tag_custom_meta', 10, 2 );  
add_action( 'create_post_tag', 'brando_save_post_tag_custom_meta', 10, 2 );

/* Add custom field in category */

add_action( 'category_add_form_fields', 'brando_taxonomy_add_new_meta_field', 10, 2 );
if ( ! function_exists( 'brando_taxonomy_add_new_meta_field' ) ) :
    function brando_taxonomy_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_taxonomy_edit_meta_field' ) ) :
    function brando_taxonomy_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_taxonomy_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
            </td>
        </tr>
            
    <?php
    }
endif;

add_action( 'category_edit_form_fields', 'brando_taxonomy_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_taxonomy_custom_meta' ) ) :
    function brando_save_taxonomy_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_taxonomy_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_taxonomy_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_category', 'brando_save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_category', 'brando_save_taxonomy_custom_meta', 10, 2 );


/* Add custom field in portfolio tag */

add_action( 'portfolio-tags_add_form_fields', 'brando_portfolio_tag_add_new_meta_field', 10, 2 );

if ( ! function_exists( 'brando_portfolio_tag_add_new_meta_field' ) ) :
    function brando_portfolio_tag_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_portfolio_tag_edit_meta_field' ) ) :
    function brando_portfolio_tag_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_portfolio_tag_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary" value="Remove Image">
            </td>
        </tr>
    <?php
    }
endif;
add_action( 'portfolio-tags_edit_form_fields', 'brando_portfolio_tag_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_portfolio_tag_custom_meta' ) ) :
    function brando_save_portfolio_tag_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_portfolio_tag_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_portfolio_tag_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_portfolio-tags', 'brando_save_portfolio_tag_custom_meta', 10, 2 );  
add_action( 'create_portfolio-tags', 'brando_save_portfolio_tag_custom_meta', 10, 2 );


/* Add custom field in portfolio category */

add_action( 'portfolio-category_add_form_fields', 'brando_portfolio_taxonomy_add_new_meta_field', 10, 2 );
if ( ! function_exists( 'brando_portfolio_taxonomy_add_new_meta_field' ) ) :
    function brando_portfolio_taxonomy_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_portfolio_taxonomy_edit_meta_field' ) ) :
    function brando_portfolio_taxonomy_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_portfolio_taxonomy_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
            </td>
        </tr>
            
    <?php
    }
endif;

add_action( 'portfolio-category_edit_form_fields', 'brando_portfolio_taxonomy_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_portfolio_taxonomy_custom_meta' ) ) :
    function brando_save_portfolio_taxonomy_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_portfolio_taxonomy_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_portfolio_taxonomy_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_portfolio-category', 'brando_save_portfolio_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_portfolio-category', 'brando_save_portfolio_taxonomy_custom_meta', 10, 2 );

add_action('admin_enqueue_scripts', 'brando_admin_script_loader');
if ( ! function_exists( 'brando_admin_script_loader' ) ) :
    function brando_admin_script_loader() {
        if (is_admin()) {
            wp_register_script('brando-admin-custom-js', get_template_directory_uri().'/assets/js/custom.js', array('jquery'));
            wp_enqueue_script('brando-admin-custom-js');
            wp_localize_script( 'brando-admin-custom-js', 'brando_licence_messages', array( 'response_failed' => esc_attr__( 'Failed to get response from server. Please try again.', 'brando' ) ) );
            // Enqueue ET-Line Style For WP Admin.
            wp_enqueue_style( 'brando-line-icons-style', BRANDO_THEME_CSS_URI . '/et-line-icons.css',null, BRANDO_THEME_VERSION);
            if ( class_exists( 'ReduxFramework' ) ){
                // Enqueue elusive webfont Style For WP Admin.
                wp_enqueue_style( 'redux-elusive-icon', ReduxFramework::$_url . 'assets/css/vendor/elusive-icons/elusive-icons.css');
            }
            // Register Style For WP Admin.
            wp_register_style( 'brando_custom_wp_admin_css', BRANDO_THEME_CSS_URI . '/custom-admin-style.css', false, BRANDO_THEME_VERSION );
            // Enqueue Style For WP Admin.
            wp_enqueue_style( 'brando_custom_wp_admin_css' );
            wp_register_style( 'brando-font-awesome-style', BRANDO_THEME_CSS_URI . '/font-awesome.min.css',null, '5.15.3');
            wp_enqueue_style( 'brando-font-awesome-style' );
            
        }
    }
endif;

/* Dequeue VC font awesome style */
if ( ! function_exists( 'brando_dequeue_vc_style' ) ) :
    function brando_dequeue_vc_style() {
       wp_dequeue_style( 'font-awesome' );
    }
endif;
add_action( 'wp_print_scripts', 'brando_dequeue_vc_style', 100 );


/* For Wordpress4.4 move comment textarea bottom */
if ( ! function_exists( 'brando_move_comment_field_to_bottom' ) ) {
    function brando_move_comment_field_to_bottom( $brando_fields ) {
        $brando_comment_field = $brando_fields['comment'];
        $brando_cookies = $brando_fields['cookies'];
        unset( $brando_fields['comment'] );
        unset( $brando_fields['cookies'] );
        $brando_fields['comment'] = $brando_comment_field;
        $brando_fields['cookies'] = $brando_cookies;
        return $brando_fields;
    }
}
add_filter( 'comment_form_fields', 'brando_move_comment_field_to_bottom' );

if ( ! function_exists( 'brando_theme_comment' ) ) {
    function brando_theme_comment($comment, $args, $depth) {
        
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        

    ?>

     <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? 'blog-comment' : 'blog-comment parent' ) ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        <div class="blog-comment-main xs-no-padding-top">
          <div class="blog-comment">
            <div class="comment-avtar">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] );   ?>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'brando' ); ?></em>
                <br />
            <?php endif; ?>
            <div class="comment-text overflow-hidden position-relative">
              <div class="comment-meta commentmetadata">  
                    <a class="blog-comment-name alt-font text-uppercase text-medium dark-gray-text" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php printf( esc_html__( '%s ', 'brando' ), get_comment_author_link() ); ?>
                    </a> 
                    <span class="alt-font text-medium dark-gray-text">
                    <?php
                    /* translators: 1: date, 2: time */
                    printf( esc_html__('%1$s','brando'), get_comment_date(),  get_comment_time() ); 
                    ?>
                    </span>
              </div>
               
                <div class="margin-three-tb"><?php comment_text(); ?></div>
             <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );  ?>
            </div>
        </div>
    </div>

        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <?php endif; ?>
        
    <?php
    }
}


// filter to replace class on reply text
if ( ! function_exists( 'brando_reply_to_comment_link' ) ):
    function brando_reply_to_comment_link( $link, $args, $comment ) {
        $link = str_replace( 'comment-reply-link', 'comment-reply-link btn-black btn btn-very-small no-margin inner-link', $link );

        $link = str_replace( '>' . $args['reply_text']  . '<', '>' . esc_html( 'Post Reply', 'brando'  ) . '<', $link );
        return $link;
    }
endif;
add_filter( 'comment_reply_link', 'brando_reply_to_comment_link', 10, 3 );

/* For Customize archive post settings */

if ( ! function_exists( 'brando_posts_customize' ) ):
    function brando_posts_customize($query) {
        $brando_options = get_option( 'brando_theme_setting' );
        if( !is_admin() && $query->is_main_query()):
            if ((is_category() || is_archive() || is_author() || is_tag())) {
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $brando_item_per_page = (isset($brando_options['brando_general_item_per_page'])) ? $brando_options['brando_general_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
                $query->set('paged', $paged);
            }
            if( is_home() ){
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $brando_item_per_page = (isset($brando_options['brando_blog_page_item_per_page'])) ? $brando_options['brando_blog_page_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
                $query->set('paged', $paged);
            }
            
            if(is_search()):
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $brando_item_per_page = (isset($brando_options['brando_general_item_per_page'])) ? $brando_options['brando_general_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
                $query->set('paged', $paged);
                $brando_search_content = (isset($brando_options['brando_general_search_content_settings'])) ? $brando_options['brando_general_search_content_settings'] : '';

                if( !empty($brando_search_content)){
                    $query->set('post_type', $brando_search_content);
                }
                
            endif;
            if(is_tax('portfolio-category') || is_tax('portfolio-tags') || is_post_type_archive('portfolio')):
                $brando_item_per_page = (isset($brando_options['brando_portfolio_cat_item_per_page'])) ? $brando_options['brando_portfolio_cat_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
            endif;
        endif;
    } 
endif;
add_action('pre_get_posts', 'brando_posts_customize');


// Post excerpt
add_filter('the_content', 'brando_trim_excerpts');
if ( ! function_exists( 'brando_trim_excerpts' ) ) {
    function brando_trim_excerpts($content = false) {
        global $post;
        if( !is_singular() && !is_admin() ){
            $content = $post->post_excerpt;
            // If an excerpt is set in the Optional Excerpt box
            if($content) :
                $content = apply_filters('the_excerpt', $content);

            // If no excerpt is set
            else :
                $content = $post->post_content;
            endif;
        }
        // Make sure to return the content
        return $content;
    }
}


if ( ! function_exists( 'brando_widgets' ) ) {
    function brando_widgets() {
        $brando_custom_sidebars = brando_option('sidebar_creation');
        if (is_array($brando_custom_sidebars)) {
            foreach ($brando_custom_sidebars as $sidebar) {

                if (empty($sidebar)) {
                    continue;
                }

                register_sidebar ( array (
                    'name' => $sidebar,
                    'id' => sanitize_title ( $sidebar ),
                    'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title'  => '<h5 class="sidebar-title">',
                    'after_title'   => '</h5>',
                ) );
            }
        }
    }
}
add_action( 'widgets_init', 'brando_widgets' );


if ( ! function_exists( 'brando_get_sidebar' ) ) {
    function brando_get_sidebar($brando_sidebar_name="0"){
        if($brando_sidebar_name != "0"){
            dynamic_sidebar($brando_sidebar_name);
        }else{
            dynamic_sidebar('sidebar-1');
        }
    }
}

if ( ! function_exists( 'brando_login_logo' ) ) :
// To Change Admin Panel Logo.
    function brando_login_logo() { 
        $brando_admin_logo = brando_option('brando_header_logo');
        if( $brando_admin_logo['url'] ):
        ?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo esc_url($brando_admin_logo['url']);?>  ) !important;
                background-size: contain !important;
                height: 48px !important;
                width: 100% !important;
            }
        </style>
        <?php 
        endif;
    }
endif;
add_action( 'login_enqueue_scripts', 'brando_login_logo' );

// To Change Admin Panel Logo Url.
if ( ! function_exists( 'brando_login_logo_url' ) ) :
    function brando_login_logo_url() {
        return home_url('/');
    }
endif;
add_filter( 'login_headerurl', 'brando_login_logo_url' );

// To Change Admin Panel Logo Title.
if ( ! function_exists( 'brando_login_logo_url_title' ) ) :
    function brando_login_logo_url_title() {
        $brando_text = get_bloginfo('name').' | '.get_bloginfo('description');
        return $brando_text;
    }
endif;
if ( version_compare( $GLOBALS['wp_version'], '5.2.0', '<' ) ) {
    add_filter( 'login_headertitle', 'brando_login_logo_url_title' );
} else {
    add_filter( 'login_headertext', 'brando_login_logo_url_title' );
}

// To remove deprecated notice for old functions
add_filter('deprecated_constructor_trigger_error', '__return_false');

// Remove VC redirection
if(class_exists('Vc_Manager')){
    remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect');
    remove_action( 'admin_init', 'vc_page_welcome_redirect');
}

// Body background
if ( ! function_exists( 'brando_body_background' ) ) {
    function brando_body_background(){
        $brando_body_background = '';
        $brando_body_image = brando_option('brando_background_image');
        $brando_body_color = brando_option('brando_top_color');
        $brando_body_image_repeat = ( brando_option('brando_bg_image_repeat')) ? ' '.brando_option('brando_bg_image_repeat') : '';

        $brando_body_top_color = ( $brando_body_color ) ? ' top '.esc_attr($brando_body_color) : '';
        if( !is_array( $brando_body_image ) ):
            $brando_body_background = ' style="background:url('.esc_url($brando_body_image).')'.esc_attr($brando_body_top_color).esc_attr($brando_body_image_repeat).'"';
        elseif( !empty($brando_body_image['url']) ):
            $brando_body_background = ' style="background:url('.esc_url($brando_body_image['url']).')'.esc_attr($brando_body_top_color).esc_attr($brando_body_image_repeat).'"';
        elseif( !empty($brando_body_color) ):
            $brando_body_background = ' style="background:'.esc_attr($brando_body_color).esc_attr($brando_body_image_repeat).'"';
        endif;
        
        echo wp_kses($brando_body_background, wp_kses_allowed_html( 'post' ));
    }
}

if( !function_exists( 'brando_admin_footer' ) ) {
    function brando_admin_footer() {

        if(!empty( $_REQUEST['page'] ) && $_REQUEST['page'] == 'brando_theme_settings') {

            $brando_theme_import_option = get_option('brando_theme_import_option');
            $brando_default_checked = empty($brando_theme_import_option) ? ' checked="checked "' : '';
            $brando_mailchimp_form = '';
            if(class_exists('MC4WP_Admin')){
                $brando_mailchimp_form = '<li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="mail_chimp" >' . esc_html__( 'Mail Chimp Form', 'brando' ) . '</label>
                                </li>';
            }

            // Popup code for Import options
            echo '<div class="brando-popup hidden brando-import-data-popup" data-popup="brando-popup">
                <div class="brando-popup-inner">
                    <form id="export-filters" method="get">
                        <fieldset>
                            <legend class="screen-reader-text">' . esc_html__( 'Content to export', 'brando' ) . '</legend>
                            <h3>Import <span class="brando-demo-option-name"></span>Demo Content</h3>
                            <ul class="brando-import-choice-all">
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox-all" value="all" >' . esc_html__( 'All Content', 'brando' ) . '</label>
                                    <span class="description">' . esc_html__( 'This will contain all of your posts, pages, portfolio & media.', 'brando' ) . '</span>
                                </li>
                            </ul>
                            <ul class="brando-import-choice">
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="posts" >' . esc_html__( 'Posts', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="pages" >' . esc_html__( 'Pages', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="portfolio" >' . esc_html__( 'Portfolio', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="nav_menu_item" >' . esc_html__( 'Navigation Menu', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="attachment" >' . esc_html__( 'Media', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="contact_form" >' . esc_html__( 'Contact Form', 'brando' ) . '</label>
                                </li>
                                '.$brando_mailchimp_form.'
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="options" >' . esc_html__( 'Options', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="widgets" >' . esc_html__( 'Widgets', 'brando' ) . '</label>
                                </li>
                            </ul>
                            <p class="submit">
                                <input type="hidden" name="brando_demo_setup_key" id="brando_demo_setup_key" />
                                <input type="button" value="' . esc_html__( 'Import', 'brando' ) . '" class="button button-primary" id="brando_demo_setup_submit" name="submit">
                            </p>
                        </fieldset>
                    </form>
                    <a class="brando-popup-close" data-popup-close="brando-popup" href="#">x</a>
                </div>
            </div>';

        }
    }
    add_action('admin_footer', 'brando_admin_footer');
}

if ( ! function_exists( 'brando_enqueue_fonts_url' ) ) :

function brando_enqueue_fonts_url() {
    $brando_fonts_url = '';
    $brando_fonts     = array();
    $brando_main_font_weight = array();
    $brando_alt_font_weight = array();
    $brando_font_subsets = array();
    global $brando_theme_settings;
    
    /* For Main Font Weight */
    $brando_main_font_weight_array = ( isset( $brando_theme_settings['main_font_weight'] ) ) ? $brando_theme_settings['main_font_weight'] : '';
    if( !empty( $brando_main_font_weight_array ) ) {
        foreach ($brando_main_font_weight_array as $key => $value) {
            if( $value == 1 ){
                $brando_main_font_weight[] = $key;
            }
        }
    }

    if( !empty( $brando_main_font_weight ) ) {
        $brando_main_font_weight = implode( ',', $brando_main_font_weight );
    } else {
        $brando_main_font_weight = '100,300,400,500,700,900';
    }

    if( $brando_theme_settings['main_font']['font-family']){
        $brando_fonts[] = $brando_theme_settings['main_font']['font-family'].':'.$brando_main_font_weight;
    }else{
        $brando_fonts[] = 'Roboto:100,300,400,500,700,900';
    }

    /* For Alt Font Weight */
    $brando_alt_font_weight_array = ( isset( $brando_theme_settings['alt_font_weight'] ) ) ? $brando_theme_settings['alt_font_weight'] : '';
    if( !empty( $brando_alt_font_weight_array ) ) {
        foreach ($brando_alt_font_weight_array as $key => $value) {
            if( $value == 1 ){
                $brando_alt_font_weight[] = $key;
            }
        }
    }

    if( !empty( $brando_alt_font_weight ) ) {
        $brando_alt_font_weight = implode( ',', $brando_alt_font_weight );
    } else {
        $brando_alt_font_weight = '100,200,300,400,500,600,700,800,900';
    }
    if( $brando_theme_settings['alt_font']['font-family']){
        $brando_fonts[] = $brando_theme_settings['alt_font']['font-family'].':'.$brando_alt_font_weight;
    }else{
        $brando_fonts[] = 'Montserrat:100,200,300,400,500,600,700,800,900';
    }

    /* For Font Subsets */
    $brando_main_font_subsets = ( isset( $brando_theme_settings['main_font_languages'] ) ) ? $brando_theme_settings['main_font_languages'] : '' ;
    if( !empty( $brando_main_font_subsets ) ) {
        foreach ($brando_main_font_subsets as $key => $value) {
            if( $value == 1 ){
                $brando_font_subsets[] = $key;
            }
        }
    }
    if( !empty( $brando_font_subsets ) ) {
        $brando_main_font_subsets = implode( ',',  $brando_font_subsets );
    } else {
        $brando_main_font_subsets = '';
    }

    if ( $brando_fonts ) {
        $brando_fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $brando_fonts ) ),
            'subset' => urlencode( $brando_main_font_subsets ),
        ), '//fonts.googleapis.com/css' );
    }
    return $brando_fonts_url;
}
endif;

if ( ! function_exists( 'brando_font_scripts' ) ) :
    function brando_font_scripts() {
        $disable_google_fonts = brando_option( 'disable_google_fonts' );
        if( $disable_google_fonts != 1 ) {
            wp_enqueue_style( 'brando-fonts', brando_enqueue_fonts_url(), array(), null );
        }
    }
endif;
add_action( 'wp_enqueue_scripts', 'brando_font_scripts' );


if ( ! function_exists( 'brando_add_site_favicon' ) ) :
    function brando_add_site_favicon() {
        if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
            $brando_favicon_meta_tags = array();
            if( brando_option( 'default_favicon' ) ) {
                $default_favicon = brando_option_url( 'default_favicon' );
                if ( esc_url( $default_favicon ) ) {
                    $brando_favicon_meta_tags[] = sprintf( '<link rel="shortcut icon" href="%s" />', esc_url( $default_favicon ) );
                }
            }
            if( brando_option( 'apple_iPhone_favicon' ) ) {
                $apple_iPhone_favicon = brando_option_url( 'apple_iPhone_favicon' );
                if ( esc_url( $apple_iPhone_favicon ) ) {
                    $brando_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" href="%s" />', esc_url( $apple_iPhone_favicon ) );
                }
            }
            if( brando_option( 'apple_iPad_favicon' ) ) {
                $apple_iPad_favicon = brando_option_url( 'apple_iPad_favicon' );
                if ( esc_url( $apple_iPad_favicon ) ) {
                    $brando_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="72x72" href="%s" />', esc_url( $apple_iPad_favicon ) );
                }
            }
            if( brando_option( 'apple_iPhone_retina_favicon' ) ) {
                $apple_iPhone_retina_favicon = brando_option_url( 'apple_iPhone_retina_favicon' );
                if ( esc_url( $apple_iPhone_retina_favicon ) ) {
                    $brando_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="114x114" href="%s" />', esc_url( $apple_iPhone_retina_favicon ) );
                }
            }
            if( brando_option( 'apple_iPad_retina_favicon' ) ) {
                $apple_iPad_retina_favicon = brando_option_url( 'apple_iPad_retina_favicon' );
                if ( esc_url( $apple_iPad_retina_favicon ) ) {
                    $brando_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="149x149" href="%s" />', esc_url( $apple_iPad_retina_favicon ) );
                }
            }
            
            if( count( $brando_favicon_meta_tags ) >= 1 ) {
                foreach ( $brando_favicon_meta_tags as $brando_favicon_meta_tag ) {
                    echo "$brando_favicon_meta_tag\n";
                }
            }
        }
    }
endif;
add_action( 'wp_head', 'brando_add_site_favicon' ); //front end
add_action( 'admin_head', 'brando_add_site_favicon' ); //admin end

if ( ! function_exists( 'brando_add_default_cursor' ) ) :
    function brando_add_default_cursor() {
        
        $brando_custom_css = '';
        $brando_options = get_option( 'brando_theme_setting' );

        $brando_show_default_cursor_image =  (isset($brando_options['brando_show_default_cursor_image']) && !empty($brando_options['brando_show_default_cursor_image'])) ? $brando_options['brando_show_default_cursor_image'] : '';

        if( $brando_show_default_cursor_image != 1 ) {
            $brando_custom_css .= ".grid figure:hover img, .grid-gallery .grid figcaption h3, .grid-gallery .grid figcaption h3 a { cursor: pointer !important }";
            $brando_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container, .mfp-auto-cursor .mfp-content { cursor: pointer !important }";
        } else {
            /* For Open Cursor */
            $brando_default_open_cursor_image = (isset($brando_options['brando_default_open_cursor_image']) && !empty($brando_options['brando_default_open_cursor_image'])) ? $brando_options['brando_default_open_cursor_image'] : '';
            if( isset( $brando_default_open_cursor_image['url'] ) && !empty( $brando_default_open_cursor_image['url'] ) ){
                $brando_custom_css .= ".grid figure:hover img, .grid-gallery .grid figcaption h3, .grid-gallery .grid figcaption h3 a { cursor: url('".$brando_default_open_cursor_image['url']."'), pointer !important }";
            }

            /* For Close Cursor */
            $brando_default_close_cursor_image = (isset($brando_options['brando_default_close_cursor_image']) && !empty($brando_options['brando_default_close_cursor_image'])) ? $brando_options['brando_default_close_cursor_image'] : '';
            if( isset( $brando_default_close_cursor_image['url'] ) && !empty( $brando_default_close_cursor_image['url'] ) ){
                $brando_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container, .mfp-auto-cursor .mfp-content { cursor: url('".$brando_default_close_cursor_image['url']."'), pointer !important }";
            }
        }
        wp_add_inline_style( 'magnific-popup', $brando_custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'brando_add_default_cursor', 99 );

add_filter( 'body_class', 'brando_add_body_class' );
if ( ! function_exists( 'brando_add_body_class' ) ) :
    function brando_add_body_class( $classes ) {

        $brando_options = get_option( 'brando_theme_setting' );

        $brando_popup_on_click_close =  (isset($brando_options['brando_popup_on_click_close']) && !empty($brando_options['brando_popup_on_click_close'])) ? $brando_options['brando_popup_on_click_close'] : '';
        if( $brando_popup_on_click_close != 1 ) {
            $classes[] = 'brando-custom-popup-close';
        }           

        return $classes;
    }
endif;

if ( ! function_exists( 'brando_theme_active_licence' ) ) :
    function brando_theme_active_licence( $value ='no' ) {
        $brando_option_name = 'brando_theme_active' ;
        if ( get_option( $brando_option_name ) !== false ) {
            update_option( $brando_option_name, $value );
        } else {
            $deprecated = null;
            $autoload = 'no';
            add_option( $brando_option_name, $value, $deprecated, $autoload );
        }
    }
endif;

if ( ! function_exists( 'brando_is_theme_licence_active' ) ) :
    function brando_is_theme_licence_active() {
        $brando_theme_active = get_option( 'brando_theme_active' );
        if( $brando_theme_active == 'yes' || defined('ENVATO_HOSTED_SITE') ){
            return true;
        } else {
            return false;
        }
    }
endif;

if ( ! function_exists( 'brando_theme_activate' ) ) :
    function brando_theme_activate() {
        global $pagenow;

        if( is_admin() && 'themes.php' == $pagenow && isset( $_GET[ 'activated' ] ) ) {
            wp_redirect( admin_url( 'themes.php?page=brando-licence-activation' ) );
            exit;
        }

    }
endif;
add_action( 'after_setup_theme', 'brando_theme_activate', 11 );

if ( ! function_exists( 'brando_get_host' ) ) :
    function brando_get_host() {
        $brando_api_host = 'http://api.themezaa.com';
        return $brando_api_host;
    }
endif;

if ( ! function_exists( 'brando_random_string' ) ) :
    function brando_random_string( $length = 20 ) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $len = strlen( $characters );
        $str = '';
        for ( $i = 0; $i < $length; $i ++ ) {
            $str .= $characters[ rand( 0, $len - 1 ) ];
        }

        return $str;
    }
endif;

if ( ! function_exists( 'brando_generate_theme_licence_activation_url' ) ) :
    function brando_generate_theme_licence_activation_url() {
            
        $brando_licence_api = brando_get_host();

        $brando_token = sha1( current_time( 'timestamp' ) . '|' . brando_random_string(20) );
        $brando_home_url = esc_url( home_url( '/' ) );

        $brando_redirect = admin_url( 'themes.php?page=brando-licence-activation' );
                    
        if ( false === ( $brando_token == get_transient( 'brando_licence_token' ) ) ) {
            set_transient( 'brando_licence_token', $brando_token, HOUR_IN_SECONDS );
        }
        $brando_get_transient = get_transient( 'brando_licence_token' );

        return sprintf( '%s?token=%s&url=%s&redirect=%s&itemid=%s', $brando_licence_api.'/activate-license/', $brando_get_transient, $brando_home_url, $brando_redirect, '17672485' );
    }
endif;

if ( ! function_exists( 'brando_theme_licence_notice' ) ) :
    function brando_theme_licence_notice() {
        
        if( !empty( $_COOKIE['brando_hide_activation_message'] ) || brando_is_theme_licence_active() ) {
            return;
        }

        if( isset( $_GET['response'] ) ) {
            if( $_GET['response'] == 'true' ) {
                return;
            }
        }

        $class = 'notice notice-success brando-license-activation-message is-dismissible';
        $message = esc_html__( 'Please activate your Brando WordPress theme license to unlock Brando premium features.', 'brando' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    }
endif;
add_action( 'admin_notices', 'brando_theme_licence_notice' );

if ( ! function_exists( 'brando_extract_shortcode_contents' ) ) {
    /**
     * Extract text contents from all shortcodes for usage in excerpts
     *
     * @return string The shortcode contents
     **/
    function brando_extract_shortcode_contents( $m ) {
        global $shortcode_tags;

        // Setup the array of all registered shortcodes
        $shortcodes = array_keys( $shortcode_tags );
        $no_space_shortcodes = array( 'dropcap' );
        $omitted_shortcodes  = array( 'slide' );

        // Extract contents from all shortcodes recursively
        if ( in_array( $m[2], $shortcodes ) && ! in_array( $m[2], $omitted_shortcodes ) ) {
            $pattern = get_shortcode_regex();
            // Add space the excerpt by shortcode, except for those who should stick together, like dropcap
            $space = ' ' ;
            if ( in_array( $m[2], $no_space_shortcodes ) ) {
                $space = '' ;
            }
            $content = preg_replace_callback( "/$pattern/s", 'brando_extract_shortcode_contents', rtrim( $m[5] ) . $space );
            return $content;
        }

        // allow [[foo]] syntax for escaping a tag
        if ( $m[1] == '[' && $m[6] == ']' ) {
            return substr( $m[0], 1, -1 );
        }

       return $m[1] . $m[6];
    }
}
/* For checking active plugin */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if( ! function_exists( 'brando_get_intermediate_image_sizes' ) ) :
    function brando_get_intermediate_image_sizes() {
        global $wp_version;
        $image_sizes = array('full', 'thumbnail', 'medium', 'medium_large', 'large'); // Standard sizes
        if( $wp_version >= '4.7.0'){
            $_wp_additional_image_sizes = wp_get_additional_image_sizes();
            if ( ! empty( $_wp_additional_image_sizes ) ) {
                $image_sizes = array_merge( $image_sizes, array_keys( $_wp_additional_image_sizes ) );
            }
            return apply_filters( 'intermediate_image_sizes', $image_sizes );
        }else{
            return $image_sizes;
        }
    }
endif;

if( ! function_exists( 'brando_get_image_sizes' ) ) :
    function brando_get_image_sizes() {
        global $_wp_additional_image_sizes;

        $sizes = array();

        foreach ( get_intermediate_image_sizes() as $_size ) {
            if ( in_array( $_size, array('full', 'thumbnail', 'medium', 'medium_large', 'large') ) ) {
                $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
                $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
                $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
                $sizes[ $_size ] = array(
                    'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
                );
            }
        }
        return $sizes;
    }
endif;

if( ! function_exists( 'brando_get_image_size' ) ) :
        function brando_get_image_size( $size ) {
            $sizes = brando_get_image_sizes();

            if ( isset( $sizes[ $size ] ) ) {
                return $sizes[ $size ];
            }

            return false;
        }
    endif;

if( ! function_exists( 'brando_image_size' ) ) :
    function brando_image_size() {

        $thumbnail_image_sizes = array();

        // Hackily add in the data link parameter.
        $brando_srcset = brando_get_intermediate_image_sizes();

        if(!empty($brando_srcset)) {
            foreach ( $brando_srcset as $value => $label ){
                
                $key = esc_attr( $label );

                $brando_srcset_image_data = brando_get_image_size( $label );
                $width = ( isset( $brando_srcset_image_data['width'] ) && $brando_srcset_image_data['width'] == 0 ) ? esc_html( 'Auto', 'brando' ) : $brando_srcset_image_data['width'].'px';
                $height = ( isset( $brando_srcset_image_data['height'] ) && $brando_srcset_image_data['height'] == 0 ) ? esc_html( 'Auto', 'brando' ) : $brando_srcset_image_data['height'].'px';
                if( $label == 'full' ) {
                    $data = esc_html__( 'Original Full Size', 'brando' );
                } else {
                    $data = ucwords( str_replace( '_', ' ', str_replace( '-', ' ', esc_attr( $label ) ) ) ).' ('.esc_attr( $width ).' X '.esc_attr( $height ).')';
                }

                $thumbnail_image_sizes[$data] = $key;
            }
        }

        return $thumbnail_image_sizes;
    }
endif;

if ( ! function_exists('brando_hex2rgb') ) :
    function brando_hex2rgb( $colour, $opacity ) {
        if( empty( $colour ) )
            return;
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
    }
endif;

/* Generate custom css base on theme settings */
if( ! function_exists( 'brando_generate_themesetting_css' ) ) {
    function brando_generate_themesetting_css() {
        $output_css = '';
            ob_start();
                echo '<style id="brando-themesetting-css" type="text/css">';
                    
                    /* Include navigation css */                    
                    require_once get_template_directory() . '/lib/admin/custom-css.php';
                echo '</style>';
            $output_css = ob_get_contents();
            ob_end_clean();

            // 1. Remove comments.
            // 2. Remove whitespace.
            // 3. Remove starting whitespace.
            $output_css = preg_replace( '#/\*.*?\*/#s', '', $output_css );
            $output_css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $output_css );
            $output_css = preg_replace( '/\s\s+(.*)/', '$1', $output_css );

            printf("%s", $output_css);
    }
}
add_action( 'wp_footer', 'brando_generate_themesetting_css', 998 );