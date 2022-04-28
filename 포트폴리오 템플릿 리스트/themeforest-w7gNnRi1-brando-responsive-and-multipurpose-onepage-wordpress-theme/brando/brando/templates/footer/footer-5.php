<?php
/**
 * Displaying footer type 5 section
 *
 * @package Brando
 */
?>
<?php
$brando_classes = $brando_footer_bottom_class = $brando_footer_bg_image = '';

$brando_enable_footer = brando_option('brando_enable_page_footer');
$brando_options = get_option( 'brando_theme_setting' );
if($brando_enable_footer == 1 || $brando_enable_footer == 'default'){
    
    $brando_footer_bg = brando_option('brando_footer_bg_image');
    if( is_array($brando_footer_bg) ){
        $brando_footer_bg_image = $brando_footer_bg['url'];
    }else{
        $brando_footer_bg_image = $brando_footer_bg;
    }

    if($brando_footer_bg_image):
            $brando_footer_bg_image =  'style="background-image:url('.esc_url($brando_footer_bg_image).')"';
            $brando_classes .= 'cover-background';
    else:
            $brando_classes .= 'bg-white border-top footer-border';
            $brando_footer_bottom_class = 'bg-gray';
    endif;

    $brando_footer_sidebar = brando_option('brando_footer_sidebar');
    $brando_enable_footer_copyright = brando_option('brando_enable_footer_copyright');
    $brando_footer_copyright = brando_option('brando_footer_copyright');
    $brando_enable_scrolltotop_button = brando_option('brando_enable_scrolltotop_button');

    $brando_set_policy_page = false;
    $brando_policy_page_id = (int) get_option( 'wp_page_for_privacy_policy' );
    if ( ! empty( $brando_policy_page_id ) && get_post_status( $brando_policy_page_id ) === 'publish' ) {                   
        $brando_set_policy_page = true;
    }     
?>
<footer class="brando-footer padding-four-tb <?php echo esc_attr($brando_classes); ?>" <?php echo wp_kses($brando_footer_bg_image, wp_kses_allowed_html( 'post' )); ?>>
    <div class="container">
        <div class="row">
            <!-- social media link -->
            <?php if( !empty($brando_footer_sidebar) ){ ?>
                <div class="col-md-12 col-sm-12 text-center">
                    <?php dynamic_sidebar($brando_footer_sidebar); ?>
                </div>
            <?php } 
            if( $brando_set_policy_page ){
                if( $brando_enable_footer_copyright == 1 ){
                    the_privacy_policy_link( '<div class="col-md-6 col-sm-6 text-left xs-text-center"><span class="text-uppercase alt-font text-extra-small display-block medium-gray-text brando-footer-text margin-one-top">', '</span></div>' );
                }else{
                    the_privacy_policy_link( '<div class="col-md-12 col-sm-12 text-center"><span class="text-uppercase alt-font text-extra-small display-block medium-gray-text brando-footer-text margin-one-top">', '</span></div>' );
                }
                if( $brando_footer_copyright && $brando_enable_footer_copyright == 1 ){
                    ?>
                    <div class="col-md-6 col-sm-6 text-right xs-text-center">
                        <span class="text-uppercase alt-font text-extra-small display-block medium-gray-text brando-footer-text margin-one-top"><?php echo wp_kses($brando_footer_copyright, wp_kses_allowed_html( 'post' )); ?></span>
                    </div>
                <?php
                }
            }else{
                if( $brando_footer_copyright && $brando_enable_footer_copyright == 1 ){ ?>
                    <div class="col-md-12 col-sm-12 text-center">
                        <span class="text-uppercase alt-font text-extra-small display-block medium-gray-text brando-footer-text margin-one-top"><?php echo wp_kses($brando_footer_copyright, wp_kses_allowed_html( 'post' )); ?></span>
                    </div>
                <?php } 
            }
            ?>
            <!-- end social media link -->
        </div>
    </div>
</footer>
<?php 
}
if( 'portfolio' === get_post_type( get_the_ID() ) && is_singular( 'portfolio' ) ) {
    $brando_enable_ajax = get_post_meta( get_the_ID(), 'brando_enable_ajax_popup_single', true );
} else {
    $brando_enable_ajax = '';
}

$brando_enable_scrolltotop_button_position = ( isset( $brando_options['brando_enable_scrolltotop_button_position'] )  && $brando_options['brando_enable_scrolltotop_button_position'] == 1 ) ? ' scrolltotop-position-right' : ' scrolltotop-position-left';
$brando_enable_scrolltotop_mobile_device = ( isset( $brando_options['brando_enable_scrolltotop_mobile_device'] )  && $brando_options['brando_enable_scrolltotop_mobile_device'] == 0 ) ? ' xs-display-none' : '';
if ( $brando_enable_scrolltotop_button == 1 && $brando_enable_ajax != 1 ) { ?>
<a class="scrollToTop<?php echo esc_attr( $brando_enable_scrolltotop_button_position ); ?><?php echo esc_attr( $brando_enable_scrolltotop_mobile_device ); ?>" href="javascript:void(0);"><i class="fas fa-angle-up"></i></a>
<?php }