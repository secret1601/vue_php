<?php
/**
 * Theme Register Style Js.
 *
 * @package Brando
 */
?>
<?php 
/*
 * Enqueue scripts and styles.
 */

function brando_register_style_js() {
    /*
     * Load our brando theme main and other required stylesheets.
     */

    wp_register_style( 'bootstrap', BRANDO_THEME_CSS_URI . '/bootstrap.min.css', null, '3.3.4' );
    wp_register_style( 'animate', BRANDO_THEME_CSS_URI . '/animate.css', null, '1.0' );
    wp_register_style( 'et-line-icons', BRANDO_THEME_CSS_URI . '/et-line-icons.css', null, '1.0' );
    wp_register_style( 'brando-font-awesome', BRANDO_THEME_CSS_URI . '/font-awesome.min.css', null, '5.15.3' );
    wp_register_style( 'magnific-popup', BRANDO_THEME_CSS_URI . '/magnific-popup.css', null, '1.0' );
    wp_register_style( 'owl-carousel', BRANDO_THEME_CSS_URI . '/owl.carousel.css', null, '2.3.4' );
    wp_register_style( 'pull-menu-sideslide', BRANDO_THEME_CSS_URI . '/pull-menu-sideslide.css', null, '1.0' );
    wp_register_style( 'brando-style', get_stylesheet_uri(), null, BRANDO_THEME_VERSION );
    wp_register_style( 'brando-responsive', BRANDO_THEME_CSS_URI . '/responsive.css', null, BRANDO_THEME_VERSION );

    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'animate' );
    wp_enqueue_style( 'et-line-icons' );
    wp_enqueue_style( 'brando-font-awesome' );
    wp_enqueue_style( 'magnific-popup' );
    wp_enqueue_style( 'owl-carousel' );
    wp_enqueue_style( 'pull-menu-sideslide' );
    wp_enqueue_style( 'brando-style' );
    wp_enqueue_style( 'brando-responsive' );
    

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'brando-ie9', BRANDO_THEME_CSS_URI.'/style-ie9.css', array( 'brando-style' ), BRANDO_THEME_VERSION );
    wp_style_add_data( 'brando-ie9', 'conditional', 'IE 9' );
    
    
    // Load the html5 shiv.
    wp_register_script( 'brando-html5', BRANDO_THEME_JS_URI.'/html5shiv.js', array(), BRANDO_THEME_VERSION );
    brando_script_add_data( 'brando-html5', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'brando-html5' );


    /*
     * Load our brando theme main and other required jquery files.
     */
    
    wp_register_script( 'modernizr', BRANDO_THEME_JS_URI.'/modernizr.js', array( 'jquery' ), '3.3.1', true );
    wp_register_script( 'bootstrap', BRANDO_THEME_JS_URI.'/bootstrap.min.js', array( 'jquery' ), '3.3.4', true );
    wp_register_script( 'jquery-easing', BRANDO_THEME_JS_URI.'/jquery.easing.js', array( 'jquery' ), '1.3', true );
    wp_register_script( 'skrollr', BRANDO_THEME_JS_URI.'/skrollr.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'smooth-scroll', BRANDO_THEME_JS_URI.'/smooth-scroll.js', array( 'jquery' ), '2.2.0', true );
    wp_register_script( 'wow', BRANDO_THEME_JS_URI.'/wow.min.js', array( 'jquery' ), '1.1.3', true );
    wp_register_script( 'jquery-parallax', BRANDO_THEME_JS_URI.'/jquery.parallax.js', array( 'jquery' ), '1.1.3', true );
    wp_register_script( 'owl-carousel', BRANDO_THEME_JS_URI.'/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
    wp_register_script( 'jquery-magnific-popup', BRANDO_THEME_JS_URI.'/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
    wp_register_script( 'counter', BRANDO_THEME_JS_URI.'/counter.js', array( 'jquery' ), '2.0.4', true );
    wp_register_script( 'jquery-fitvids', BRANDO_THEME_JS_URI.'/jquery.fitvids.js', array( 'jquery' ), '1.1', true );
    wp_register_script( 'imagesloaded-pkgd', BRANDO_THEME_JS_URI.'/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.4', true );
    wp_register_script( 'jquery-appear', BRANDO_THEME_JS_URI.'/jquery.appear.js', array( 'jquery' ), '0.3.6', true );
    wp_register_script( 'classie', BRANDO_THEME_JS_URI.'/classie.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'isotope-pkgd', BRANDO_THEME_JS_URI.'/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
    wp_register_script( 'jquery-countTo', BRANDO_THEME_JS_URI.'/jquery.countTo.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'jquery-nav', BRANDO_THEME_JS_URI.'/jquery.nav.js', array( 'jquery' ), '3.0.0', true );
    wp_register_script( 'infinite-scroll', BRANDO_THEME_JS_URI.'/infinite-scroll.js', array( 'jquery' ), '2.1.0', true );
    wp_register_script( 'background-srcset', BRANDO_THEME_JS_URI.'/background-srcset.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'brandomain', BRANDO_THEME_JS_URI.'/main.js', array( 'jquery' ), BRANDO_THEME_VERSION, true );
    
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'jquery-easing' );
    wp_enqueue_script( 'skrollr' );
    wp_enqueue_script( 'smooth-scroll' );
    wp_enqueue_script( 'jquery-appear' );
    wp_enqueue_script( 'jquery-nav' );
    wp_enqueue_script( 'wow' );
    wp_enqueue_script( 'jquery-countTo' );
    wp_enqueue_script( 'jquery-parallax' );
    wp_enqueue_script( 'jquery-magnific-popup' );
    wp_enqueue_script( 'isotope-pkgd' );
    wp_enqueue_script( 'imagesloaded-pkgd' );
    wp_enqueue_script( 'classie' );
    wp_enqueue_script( 'counter' );
    wp_enqueue_script( 'jquery-fitvids' ); 
    wp_enqueue_script( 'owl-carousel' );
    wp_enqueue_script( 'infinite-scroll' );
    wp_enqueue_script( 'background-srcset' );
    wp_enqueue_script( 'brandomain' );
     /*
     * Defind ajaxurl and wp_localize
     */

    wp_localize_script('brandomain', 'brandoajaxurl', 
        array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'themeurl' => get_template_directory_uri(),
            'loading_image' => BRANDO_THEME_IMAGES_URI.'/ajax-loader.gif'
    ) );
    
    wp_localize_script( 'brandomain', 'brando_infinite_scroll_message', array(
            'message' => esc_attr__( 'All Post Loaded', 'brando' )
        ) ); 

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'brando_register_style_js',99 );

function brando_load_vc_iframe_js() {
    wp_register_script( 'modernizr-js', BRANDO_THEME_JS_URI.'/modernizr.js', array( 'jquery' ), '3.3.1', true );
    wp_register_script( 'bootstrap-js', BRANDO_THEME_JS_URI.'/bootstrap.min.js', array( 'jquery' ), '3.3.4', true );
    wp_register_script( 'jquery-easing-js', BRANDO_THEME_JS_URI.'/jquery.easing.js', array( 'jquery' ), '1.3', true );
    wp_register_script( 'skrollr-js', BRANDO_THEME_JS_URI.'/skrollr.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'smooth-scroll-js', BRANDO_THEME_JS_URI.'/smooth-scroll.js', array( 'jquery' ), '2.2.0', true );
    wp_register_script( 'wow-js', BRANDO_THEME_JS_URI.'/wow.min.js', array( 'jquery' ), '1.1.3', true );
    wp_register_script( 'jquery-parallax-js', BRANDO_THEME_JS_URI.'/jquery.parallax.js', array( 'jquery' ), '1.1.3', true );
    wp_register_script( 'owl-carousel-js', BRANDO_THEME_JS_URI.'/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
    wp_register_script( 'jquery-magnific-popup-js', BRANDO_THEME_JS_URI.'/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
    wp_register_script( 'counter-js', BRANDO_THEME_JS_URI.'/counter.js', array( 'jquery' ), '2.0.4', true );
    wp_register_script( 'jquery-fitvids-js', BRANDO_THEME_JS_URI.'/jquery.fitvids.js', array( 'jquery' ), '1.1', true );
    wp_register_script( 'imagesloaded-pkgd-js', BRANDO_THEME_JS_URI.'/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.4', true );
    wp_register_script( 'jquery-appear-js', BRANDO_THEME_JS_URI.'/jquery.appear.js', array( 'jquery' ), '0.3.6', true );
    wp_register_script( 'classie-js', BRANDO_THEME_JS_URI.'/classie.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'isotope-pkgd-js', BRANDO_THEME_JS_URI.'/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
    wp_register_script( 'jquery-countTo-js', BRANDO_THEME_JS_URI.'/jquery.countTo.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'jquery-nav-js', BRANDO_THEME_JS_URI.'/jquery.nav.js', array( 'jquery' ), '3.0.0', true );
    wp_register_script( 'infinite-scroll-js', BRANDO_THEME_JS_URI.'/infinite-scroll.js', array( 'jquery' ), '2.1.0', true );
    wp_register_script( 'background-srcset-js', BRANDO_THEME_JS_URI.'/background-srcset.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'brandomain-js', BRANDO_THEME_JS_URI.'/main.js', array( 'jquery' ), BRANDO_THEME_VERSION, true );

    wp_enqueue_script( 'modernizr-js' );
    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_script( 'jquery-easing-js' );
    wp_enqueue_script( 'skrollr-js' );
    wp_enqueue_script( 'smooth-scroll-js' );
    wp_enqueue_script( 'jquery-appear-js' );
    wp_enqueue_script( 'jquery-nav-js' );
    wp_enqueue_script( 'wow-js' );
    wp_enqueue_script( 'jquery-countTo-js' );
    wp_enqueue_script( 'jquery-parallax-js' );
    wp_enqueue_script( 'jquery-magnific-popup-js' );
    wp_enqueue_script( 'isotope-pkgd-js' );
    wp_enqueue_script( 'imagesloaded-pkgd-js' );
    wp_enqueue_script( 'classie-js' );
    wp_enqueue_script( 'counter-js' );
    wp_enqueue_script( 'jquery-fitvids-js' ); 
    wp_enqueue_script( 'owl-carousel-js' );
    wp_enqueue_script( 'infinite-scroll-js' );
    wp_enqueue_script( 'background-srcset-js' );
    wp_enqueue_script( 'brandomain-js' );

    wp_localize_script('brandomain-js', 'brandoajaxurl', 
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'themeurl' => get_template_directory_uri(),
            'loading_image' => BRANDO_THEME_IMAGES_URI.'/ajax-loader.gif'
        )
    );
    
    wp_localize_script( 'brandomain-js', 'brando_infinite_scroll_message', array(
        'message' => esc_attr__( 'All Post Loaded', 'brando' )
    ) );
}
add_action( 'admin_enqueue_scripts', 'brando_load_vc_iframe_js' ); 
add_action( 'vc_load_iframe_jscss', 'brando_load_vc_iframe_js' );