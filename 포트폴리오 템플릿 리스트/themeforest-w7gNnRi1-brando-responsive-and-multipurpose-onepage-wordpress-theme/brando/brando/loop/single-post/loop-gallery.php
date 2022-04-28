<?php
/**
 * displaying single posts in gallery for blog
 *
 * @package Brando
 */

$brando_blog_lightbox_gallery = brando_post_meta('brando_lightbox_image');
$brando_blog_gallery = brando_post_meta('brando_gallery');
$brando_gallery = explode(",",$brando_blog_gallery);
$brando_popup_id = 'blog-'.get_the_ID();
$brando_image_srcset = brando_option('brando_srcset_data');
if($brando_blog_lightbox_gallery == 1)
{
	echo '<div class="blog-image lightbox-gallery clearfix margin-ten no-margin-lr no-margin-top">';
		if(is_array($brando_gallery)):
			foreach ($brando_gallery as $key => $value) 
			{
				$brando_thumb = wp_get_attachment_image_src( $value, 'full' );
				if($brando_thumb[0]){
	                echo '<div class="col-md-4 col-sm-6 col-xs-12 no-padding">';
	                    echo '<a title="'.get_the_title().'" href="'.esc_url($brando_thumb[0]).'" class="lightboxgalleryitem" data-group="'.esc_attr($brando_popup_id).'">';
	                    	echo wp_get_attachment_image( $value, $brando_image_srcset );
	                    echo '</a>';
	                echo '</div>';
	            }
			}
		endif;
    echo '</div>';
}else{
	echo '<div class="blog-image bg-transparent margin-bottom-30px">';
        echo '<div id="owl-demo" class="owl-slider-full owl-carousel owl-theme dark-pagination">';
			if(is_array($brando_gallery)):
				foreach ($brando_gallery as $key => $value) {
					$brando_thumb = wp_get_attachment_image_src( $value, $brando_image_srcset );
					if($brando_thumb[0]){
			            echo '<div class="item">';
			            	echo wp_get_attachment_image( $value, $brando_image_srcset );
			            echo '</div>';
			        }
				}
			endif;
        echo '</div>';
    echo '</div>';
}

$brando_blog_image=brando_post_meta("brando_featured_image");
if($brando_blog_image == 1)
{
	echo '<div class="blog-image bg-transparent margin-five no-margin-lr">';
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( $brando_image_srcset );
        }
	echo '</div>';
}