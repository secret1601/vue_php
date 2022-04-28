<?php
/**
 * displaying in gallery for blog
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
$brando_blog_lightbox_gallery = brando_post_meta('brando_lightbox_image');
$brando_blog_gallery = brando_post_meta('brando_gallery');
$brando_gallery = explode(",",$brando_blog_gallery);
$brando_popup_id = 'blog-'.get_the_ID();
if($brando_blog_lightbox_gallery == 1){
	echo '<div class="blog-image lightbox-gallery clearfix margin-ten no-margin-lr no-margin-top">';
	if(is_array($brando_gallery)){
		foreach ($brando_gallery as $key => $value) {
			/* Image Alt, Title, Caption */
			$brando_img_lightbox_caption = brando_option_image_caption($value);
			$brando_img_lightbox_title = brando_option_lightbox_image_title($value);
			$brando_image_lightbox_caption = ( isset($brando_img_lightbox_caption['caption']) && !empty($brando_img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.esc_attr($brando_img_lightbox_caption['caption']).'"' : '' ;
			$brando_image_lightbox_title = ( isset($brando_img_lightbox_title['title']) && !empty($brando_img_lightbox_title['title']) ) ? ' title="'.esc_attr($brando_img_lightbox_title['title']).'"' : '' ; 
			$brando_full_image = wp_get_attachment_image_src( $value, 'full' );
			if($brando_full_image[0]){
                echo '<div class="col-md-4 col-sm-6 col-xs-12 no-padding">';
                    echo '<a class="lightboxgalleryitem" data-group="'.esc_attr($brando_popup_id).'" '.$brando_image_lightbox_title.$brando_image_lightbox_caption.' href="'.$brando_full_image[0].'">';
                    	echo wp_get_attachment_image( $value, $brando_srcset_data );
                    echo '</a>';
                echo '</div>';
            }
		}
	}
    echo '</div>';
}else{
	echo '<div class="blog-image">';
        echo '<div id="owl-demo" class="owl-slider-full owl-carousel owl-theme light-pagination light-navigation">';
			if( is_array( $brando_gallery ) ){
				foreach ($brando_gallery as $key => $value) {
					if( $value ) {
			            echo '<div class="item">';
			            	echo wp_get_attachment_image( $value, $brando_srcset_data );
			            echo '</div>';
		        	}
				}
			}
		echo '</div>';
    echo '</div>';    
}