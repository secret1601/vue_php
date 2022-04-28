<?php
/**
 * Defind Class 
 */
    
if( !class_exists( 'Brando_Licence_Activation' ) ) {

  	class Brando_Licence_Activation {

		// Construct
		public function __construct() {
		  	add_action( 'admin_menu', array( $this, 'brando_licence_activation_page' ), 5 );
		  	add_action( 'wp_ajax_brando_active_theme_licence', array( $this, 'brando_active_theme_licence' ) );
		}

		public function brando_licence_activation_page() {
		    add_theme_page(
		        esc_html__( 'Theme Licence', 'brando' ), // page title
		        esc_html__( 'Theme Licence', 'brando' ), // menu title
		        'manage_options',                   // capability
		        'brando-licence-activation',          // menu slug
		        array( $this, 'brando_licence_activation_callback' )  // callback function
		    );
		}

		// Add new submenu for demo data install in Admin panel > Appereance
		public function brando_licence_activation_callback() {
			
		    global $title;

		    /* Check current user permission */
		    if( !current_user_can( 'manage_options' ) ) {
		        wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'brando' ) );
		    }
		    /* Gets a WP_Theme object for a theme. */
		    $brando_theme = wp_get_theme();

		    echo '<div class="wrap">';
		        echo '<h1>'.esc_attr( $title ).'</h1>';
		        echo '<div class="brando-header-licence">';
		            echo '<div class="display_header">';
		                if( $brando_theme->get( 'Name' ) ) :
		                    echo '<h2>'.$brando_theme->get( 'Name' ).'</h2>';
		                endif;
		                if( $brando_theme->get( 'Version' ) ) :
		                    echo '<span>'.$brando_theme->get( 'Version' ).'</span>';
		                endif;
		            echo '</div>';
		            echo '<div class="brando-head-right">';
		                echo '<a target="_blank" href="'.$brando_theme->get( 'ThemeURI' ).'/documentation/">'.esc_html__( 'Online Documentation', 'brando' ).'</a><span class="link_sep">|</span><a target="_blank" href="'.$brando_theme->get( 'AuthorURI' ).'/support/">'.esc_html__( 'Support Center', 'brando' ).'</a></div>';
		            echo '<div class="clear"></div>';
		        echo '</div>';
		        echo '<div class="licence-content">';
			        echo '<div class="licence-content-top">';
                        echo '<div class="header-licence-top">';
                            echo '<div class="header-licence-top-left">';
                                echo '<a target="_blank" href="'.$brando_theme->get( 'ThemeURI' ).'"><img src="'.BRANDO_THEME_IMAGES_URI.'/licence-logo.png" alt="Brando logo" ></a>';
                            echo '</div>';
                            echo '<div class="header-licence-top-right">';
                                echo '<h4>'.esc_html__( 'Welcome to Brando - Responsive and Multipurpose OnePage WordPress Theme', 'brando' ).'</h4>';
                            echo '</div>';
                        echo '</div>';
                        $class = '';
                        echo '<div class="licence-content-bottom">';    
                            echo '<div class="licence-thankyou-message 	licence-added-success">';
                                echo esc_html__( 'Welcome to Brando WordPress theme. Please activate your Brando theme license copy and enjoy premium features.','brando' );
                            echo '</div>';
                            $brando_is_theme_licence_active = brando_is_theme_licence_active();

                            if( $brando_is_theme_licence_active ) {
                                echo '<div class="licence-activated-success"><i class="far fa-check-circle"></i><span>'.esc_html__( 'Awesome! Your Brando WordPress theme license is activated already. Enjoy premium features of Brando.', 'brando' ).'</span></div>';
                                $class = ' hide-licence-button"';
                            } else {
                                if( isset( $_GET['token'] ) && isset( $_GET['response'] ) ) {
                                    $brando_get_transient = get_transient( 'brando_licence_token' );
                                   	if( $_GET['token'] == $brando_get_transient ) {
                                        if( $_GET['response'] == 'true' && isset( $_GET['msg']) ) {
                                           	echo '<div class="licence-activated-success"><i class="far fa-check-circle"></i><span>'.esc_attr( $_GET['msg'] ).'</span></div>';
                                                $class = ' hide-licence-button"';
                                                brando_theme_active_licence( 'yes' );
                                        }
                                        if( $_GET['response'] == 'false' && isset( $_GET['msg']) ) {
                                          	echo '<div class="licence-activated-failed"><i class="far fa-times-circle"></i><span>'.esc_attr( $_GET['msg'] ).'</span></div>';
                                        }
                                        if( $_GET['response'] == 'access_denied' && isset( $_GET['msg']) ) {
                                          	echo '<div class="licence-activated-access-denied"><i class="far fa-info-circle"></i><span>'.esc_attr( $_GET['msg'] ).'</span></div>';
                                        }
                                    }
                                }
                            }

                            echo '<a class="brando-licence'.$class.'" href="javascript:void(0);">'.esc_html__( 'Activate Brando WordPress Theme License', 'brando' ).'</a>';
                            echo '<img src="'.BRANDO_THEME_IMAGES_URI.'/spin.gif" class="brando-licence-spinner" alt="spinner" width="25" height="25">';
                            echo '<div class="licence-description">'.esc_html__( 'Activate your Brando theme license using above button to unlock Brando premium features like demo data import. Please note that you will need to login to your ThemeForest account from which you have purchased Brando theme and allow the access to verify your theme purchase. ', 'brando' );
                                echo '<a target="_blank" href="'.$brando_theme->get( 'ThemeURI' ).'/documentation/how-to-activate-brando-theme-license/">'.esc_html__( 'For more details please check this article.', 'brando' ).'</a>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="licence-support-content-bottom">';
                        	echo '<div class="license-documentation">';
                        		echo '<a href="'.$brando_theme->get( 'ThemeURI' ).'/documentation/" target="_blank"><img src="'.BRANDO_THEME_IMAGES_URI.'/online-documentation.png" /><span>'.esc_html__( 'Online Documentation','brando').'</span></a>';
                        	echo '</div>';
                        	echo '<div class="license-support">';
                        		echo '<a href="'.$brando_theme->get( 'AuthorURI' ).'/support/" target="_blank"><img src="'.BRANDO_THEME_IMAGES_URI.'/support-center.png" /><span>'.esc_html__( 'Support Center','brando').'</span></a>';
                        	echo '</div>';
                        	echo '<div class="license-video">';
                        		echo '<a href="'.$brando_theme->get( 'ThemeURI' ).'/documentation/general-information/video-tutorials/" target="_blank"><img src="'.BRANDO_THEME_IMAGES_URI.'/video-tutorials.png" /><span>'.esc_html__( 'Video Tutorials','brando').'</span></a>';
                        	echo '</div>';
                        echo '</div>';    
			        echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}
		    
		public function brando_active_theme_licence() {
		    $BrandoResponse = array(
		        'status' => true,
		        'url' => brando_generate_theme_licence_activation_url(),
		    );
		    die( json_encode( $BrandoResponse ) );
		}

	} // end of class
	$Brando_Licence_Activation = new Brando_Licence_Activation();
  
} // end of class_exists