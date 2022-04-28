<?php
/**
 * Displaying footer type 1 section
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

    $brando_footer_text = brando_option('brando_footer_text');
    $brando_enable_footer_logo = brando_option('brando_enable_footer_logo');
    $brando_footer_logo = brando_option('brando_footer_logo');
    if(is_array($brando_footer_logo))
            $brando_footer_logo =  $brando_footer_logo['url'];

    $brando_footer_sidebar = brando_option('brando_footer_sidebar');
    $brando_enable_footer_copyright = brando_option('brando_enable_footer_copyright');
    $brando_footer_copyright = brando_option('brando_footer_copyright');
    $brando_enable_scrolltotop_button = brando_option('brando_enable_scrolltotop_button');
    $brando_footer_logo_url = brando_option('brando_footer_logo_url');  

    $brando_set_policy_page = false;
    $brando_policy_page_id = (int) get_option( 'wp_page_for_privacy_policy' );
    if ( ! empty( $brando_policy_page_id ) && get_post_status( $brando_policy_page_id ) === 'publish' ) {                   
        $brando_set_policy_page = true;
    }
?>
<footer class="brando-footer <?php echo esc_attr($brando_classes); ?>" <?php echo wp_kses($brando_footer_bg_image, wp_kses_allowed_html( 'post' )); ?>>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- footer logo -->
                <?php 
                if( !empty($brando_footer_logo) || !empty($brando_footer_text)){
                ?>
                <div class="col-md-12 col-sm-12 text-center margin-three-bottom xs-margin-eight-bottom">
                    <?php if($brando_enable_footer_logo){ ?>
                        <?php
                        if( $brando_footer_logo_url ){
                        ?>
                        <a class="inner-link" href="<?php echo $brando_footer_logo_url; ?>">
                        <?php } ?>
                            <?php if($brando_footer_logo){ ?>
                                <img src="<?php echo esc_url($brando_footer_logo); ?>" alt="footer-logo"/>
                            <?php } ?>
                        <?php
                        if( $brando_footer_logo_url ){
                        ?>
                        </a>
                        <?php } ?>
                    <?php } ?>
                    <?php if($brando_footer_text){ ?>
                        <span class="text-small alt-font text-uppercase margin-one-tb xs-margin-six-top display-block black-text brando-footer-text"><?php echo esc_attr($brando_footer_text); ?></span>
                     <?php } ?>
                </div>
                <?php } ?>
                <!-- end footer logo -->
                <!-- social media link -->
                <?php  if( !empty($brando_footer_sidebar) ){ ?>
                    <div class="col-md-12 col-sm-12 text-center">
                        <?php 
                            dynamic_sidebar($brando_footer_sidebar);
                        ?>
                    </div>
                <?php } ?>
                <!-- end social media link -->
            </div>
        </div>
    </div>
    <?php if( $brando_enable_footer_copyright == 1 || $brando_set_policy_page ){ ?>
    <div class="footer-bottom <?php echo esc_attr($brando_footer_bottom_class); ?>">
        <div class="container">
            <div class="row">
                <?php 
                if( $brando_set_policy_page ){
                    if( $brando_enable_footer_copyright == 1 ){
                        the_privacy_policy_link( '<div class="col-md-6 col-sm-6 text-left xs-text-center"><span class="text-small text-uppercase letter-spacing-1">', '</span></div>' );
                    }else{
                        the_privacy_policy_link( '<div class="col-md-12 col-sm-12 text-center"><span class="text-small text-uppercase letter-spacing-1">', '</span></div>' );
                    }
                    if( $brando_enable_footer_copyright == 1 ){
                        ?>
                        <div class="col-md-6 col-sm-6 text-right xs-text-center">
                            <span class="text-small text-uppercase letter-spacing-1"><?php echo wp_kses($brando_footer_copyright, wp_kses_allowed_html( 'post' )); ?></span>
                        </div>
                    <?php
                    }
                }else{
                    if( $brando_footer_copyright && $brando_enable_footer_copyright == 1 ){ ?>
                        <div class="col-md-12 col-sm-12 text-center">
                            <span class="text-small text-uppercase letter-spacing-1"><?php echo wp_kses($brando_footer_copyright, wp_kses_allowed_html( 'post' )); ?></span>
                        </div>
                    <?php } 
                }
                ?>
            </div>
        </div>
    </div>
    <?php } ?>
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