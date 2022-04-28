<?php
/**
 * displaying content for portfolio category page layout
 *
 * @package Brando
 */
?>
<?php
$output = $brando_portfolio_classes = '';
$brando_options = get_option( 'brando_theme_setting' );
$brando_no_image = (isset($brando_options['brando_no_image']) && !empty($brando_options['brando_no_image'])) ? $brando_options['brando_no_image'] : '';
$brando_portfolio_style = (isset($brando_options['brando_portfolio_cat_style'])) ? $brando_options['brando_portfolio_cat_style'] : '';
$brando_portfolio_type = (isset($brando_options['brando_portfolio_cat_type'])) ? ' '.$brando_options['brando_portfolio_cat_type'] : '';
$brando_portfolio_srcset_data = (isset($brando_options['brando_portfolio_cat_srcset_data'])) ? $brando_options['brando_portfolio_cat_srcset_data'] : '';
switch ($brando_portfolio_style) {
    case 'portfolio-style-2':
        $brando_portfolio_classes .= ' work-with-title gutter transparent-figcaption';
    break;
}
$brando_portfolio_cat_columns_settings = (isset($brando_options['brando_portfolio_cat_columns_settings'])) ? $brando_options['brando_portfolio_cat_columns_settings'] : '';
$brando_portfolio_columns = ( $brando_portfolio_cat_columns_settings ) ? 'work-'.$brando_portfolio_cat_columns_settings.'col' : '';
$brando_post_classes = '';
ob_start();
    post_class();
    $brando_post_classes .= ob_get_contents();
ob_end_clean();
echo'<div class="'.esc_attr($brando_portfolio_columns).esc_attr($brando_portfolio_classes).'">';
    switch ($brando_portfolio_style) {
        case 'portfolio1':
            echo'<div class="grid-gallery grid-style1 overflow-hidden'.esc_attr($brando_portfolio_type).'">';
                echo'<div class="tab-content">';
                    echo'<ul class="masonry-items grid">';
                        
                        while ( have_posts() ) : the_post();

                            echo'<li '.$brando_post_classes.'>';
                                echo'<figure>';
                                    $brando_portfolio_subtitle = brando_post_meta('brando_subtitle');
                                    $portfolio_external_url = brando_post_meta('brando_external_url');
                                    $brando_ajax_popup_class = '';
                                    $brando_link_type = brando_post_meta('brando_enable_ajax_popup');
                                    if( $brando_link_type == 1 ){
                                        $brando_ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                    }
                                    $brando_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $brando_portfolio_srcset_data );
                                    $brando_url = $brando_thumb['0'];
                                    if($brando_url):
                                        echo '<div class="gallery-img">';
                                            if( $portfolio_external_url != '' ){
                                                echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                            }else{
                                                echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                            }
                                                echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID() ), $brando_portfolio_srcset_data );
                                            echo '</a>';
                                        echo '</div>';
                                    else : 
                                        if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                            echo '<div class="gallery-img">';
                                                if( $portfolio_external_url != '' ){
                                                    echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                }else{
                                                    echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                }
                                                    echo wp_get_attachment_image( $brando_no_image['id'], 'full' );
                                                echo '</a>';
                                            echo '</div>';
                                        }
                                    endif;

                                    echo'<figcaption>';
                                    if( get_the_title() ):
                                        echo'<h3 class="alt-font text-uppercase xs-no-padding-lr entry-title">'.get_the_title().'</h3>';
                                    endif;
                                        echo'<div class="grid-style1-border"></div>';
                                        if( $brando_portfolio_subtitle ){
                                            $output .= '<p>'.$brando_portfolio_subtitle.'</p>';
                                        }
                                    echo'</figcaption>';
                                            
                                echo'</figure>';
                            echo'</li>';
                        endwhile;
                        wp_reset_postdata();
                    echo'</ul>';
                echo'</div>';
            echo'</div>';
        break;

        case 'portfolio2':
            echo'<div class="grid-gallery grid-style3 overflow-hidden work-with-title gutter transparent-figcaption'.esc_attr($brando_portfolio_type).'">';
                echo'<div class="tab-content">';
                    echo'<ul class="masonry-items grid">';
                        
                        while ( have_posts() ) : the_post();
                            
                            echo'<li '.$brando_post_classes.'>';
                                echo'<figure>';
                                    $brando_portfolio_subtitle = brando_post_meta('brando_subtitle');
                                    $portfolio_external_url = brando_post_meta('brando_external_url');
                                    $brando_ajax_popup_class = '';
                                    $brando_link_type = brando_post_meta('brando_enable_ajax_popup');
                                    if( $brando_link_type == 1 ){
                                        $brando_ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                    }
                                    $brando_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $brando_portfolio_srcset_data );
                                    $brando_url = $brando_thumb['0'];
                                    if($brando_url):
                                        echo '<div class="gallery-img">';
                                            if( $portfolio_external_url != '' ){
                                                echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                            }else{
                                                echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                            }
                                                echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID() ), $brando_portfolio_srcset_data );
                                            echo '</a>';
                                        echo '</div>';
                                    else:
                                        if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                            echo '<div class="gallery-img">';
                                                if( $portfolio_external_url != '' ){
                                                    echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                }else{
                                                    echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                }
                                                    echo wp_get_attachment_image( $brando_no_image['id'], 'full' );
                                                echo '</a>';
                                            echo '</div>';
                                        }
                                    endif;

                                    echo'<figcaption>';
                                        if( get_the_title() ):
                                            if ( $portfolio_external_url != '' ) {
                                                echo '<a href="'.$portfolio_external_url.'" '.$brando_ajax_popup_class.'><h3 class="text-large alt-font text-uppercase"'.$brando_title_color.'>'.get_the_title().'</h3></a>';
                                            }else{
                                                echo '<a href="'.get_permalink().'" '.$brando_ajax_popup_class.'><h3 class="text-large alt-font text-uppercase entry-title">'.get_the_title().'</h3></a>';
                                            }
                                        endif;
                                        if( $brando_portfolio_subtitle ):
                                            echo'<span class="text-small alt-font text-uppercase font-weight-400 display-block light-gray-text">'.esc_attr($brando_portfolio_subtitle).'</span>';
                                        endif;
                                        if ( $portfolio_external_url != '' ) {
                                            echo '<div class="explore-now bg-deep-orange text-uppercase alt-font"><a href="'.$portfolio_external_url.'" '.$brando_ajax_popup_class.'>'.esc_html__('Continue','brando').'</a></div>';
                                        }else{
                                            echo '<div class="explore-now bg-deep-orange text-uppercase alt-font"><a href="'.get_permalink().'" '.$brando_ajax_popup_class.'>'.esc_html__('Continue','brando').'</a></div>';
                                        }
                                    echo'</figcaption>';
                                echo'</figure>';
                            echo'</li>';
                        endwhile;
                        wp_reset_postdata();
                    echo'</ul>';
                echo'</div>';
            echo'</div>';
        break;

        case 'portfolio3':
            echo'<div class="grid-gallery grid-style2 overflow-hidden'.esc_attr($brando_portfolio_type).'">';
                echo'<div class="tab-content">';
                    echo'<ul class="masonry-items grid">';
                        
                        while ( have_posts() ) : the_post();

                            echo'<li '.$brando_post_classes.'>';
                                echo'<figure>';
                                    $brando_portfolio_subtitle = brando_post_meta('brando_subtitle');
                                    $portfolio_external_url = brando_post_meta('brando_external_url');
                                    $brando_ajax_popup_class = '';
                                    $brando_link_type = brando_post_meta('brando_enable_ajax_popup');
                                    if( $brando_link_type == 1 ){
                                        $brando_ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                    }
                                    $brando_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $brando_portfolio_srcset_data );
                                    $brando_url = $brando_thumb['0'];
                                    if($brando_url):
                                        echo '<div class="gallery-img">';
                                            if( $portfolio_external_url != '' ){
                                                echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                            }else{
                                                echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                            }
                                                echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID() ), $brando_portfolio_srcset_data );
                                            echo '</a>';
                                        echo '</div>';
                                    else:
                                        if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                            echo '<div class="gallery-img">';
                                                if( $portfolio_external_url != '' ){
                                                    echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                }else{
                                                    echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                }
                                                    echo wp_get_attachment_image( $brando_no_image['id'], 'full' );
                                                echo '</a>';
                                            echo '</div>';
                                        }
                                    endif;

                                    echo'<figcaption>';
                                        if( get_the_title() ):
                                            echo'<h3 class="text-large alt-font text-uppercase entry-title">'.get_the_title().'</h3>';
                                        endif;
                                        if( $brando_portfolio_subtitle ):
                                            echo'<span class="text-small alt-font text-uppercase font-weight-400">'.esc_attr($brando_portfolio_subtitle).'</span>';
                                        endif;
                                    echo'</figcaption>';
                                echo'</figure>';
                            echo'</li>';
                        endwhile;
                        wp_reset_postdata();
                    echo'</ul>';
                echo'</div>';
            echo'</div>';
        break;

        case 'portfolio4':
            echo'<div class="grid-gallery grid-style4 overflow-hidden'.esc_attr($brando_portfolio_type).'">';
                echo'<div class="tab-content">';
                    echo'<ul class="masonry-items grid">';
                        
                        while ( have_posts() ) : the_post();

                            $brando_cat_slug = '';
                            $brando_cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                            foreach ($brando_cat as $key => $c) {
                                $brando_cat_slug .= $c->slug." ";
                            }
                            echo'<li '.$brando_post_classes.'>';
                                echo'<figure class="overflow-hidden">';
                                    $brando_portfolio_subtitle = brando_post_meta('brando_subtitle');
                                    $portfolio_external_url = brando_post_meta('brando_external_url');
                                    $brando_ajax_popup_class = '';
                                    $brando_link_type = brando_post_meta('brando_enable_ajax_popup');
                                    if( $brando_link_type == 1 ){
                                        $brando_ajax_popup_class .= 'class="simple-ajax-popup-align-top"';
                                    }
                                    $brando_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $brando_portfolio_srcset_data );
                                    $brando_url = $brando_thumb['0'];
                                    if( $brando_url ):
                                        echo '<div class="gallery-img bg-fast-blue-green-gradiant">';
                                            if( $portfolio_external_url != '' ){
                                                echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                            }else{
                                                echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                            }
                                                echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID() ), $brando_portfolio_srcset_data );
                                            echo '</a>';
                                        echo '</div>';
                                    else:
                                        if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                            echo '<div class="gallery-img">';
                                                if( $portfolio_external_url != '' ){
                                                    echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                }else{
                                                    echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                }
                                                    echo wp_get_attachment_image( $brando_no_image['id'], 'full' );
                                                echo '</a>';
                                            echo '</div>';
                                        }
                                    endif;

                                     echo'<figcaption>';
                                        if( get_the_title() ):
                                            if ( $portfolio_external_url != '' ) {
                                                echo '<a href="'.$portfolio_external_url.'" '.$brando_ajax_popup_class.'><h3 class="alt-font text-uppercase entry-title">'.get_the_title().'</h3></a>';
                                            }else{
                                                echo '<a href="'.get_permalink().'" '.$brando_ajax_popup_class.'><h3 class="alt-font text-uppercase entry-title">'.get_the_title().'</h3></a>';
                                            }
                                        endif;
                                        if( $brando_portfolio_subtitle ){
                                            $output .= '<p>'.$brando_portfolio_subtitle.'</p>';
                                        }
                                    echo'</figcaption>';      
                                echo'</figure>';
                            echo'</li>';
                        endwhile;
                        wp_reset_postdata();
                    echo'</ul>';
                echo'</div>';
            echo'</div>';
        break;

        case 'portfolio5':
            echo'<div>';
                echo'<div class="grid-gallery grid-style1 overflow-hidden'.esc_attr($brando_portfolio_type).'">';
                    echo'<div class="tab-content">';
                        echo'<ul class="masonry-items grid">';
                            
                            while ( have_posts() ) : the_post();

                                $brando_cat_slug = '';
                                $brando_cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                foreach ($brando_cat as $key => $c) {
                                    $brando_cat_slug .= $c->slug." ";
                                }
                                echo'<li '.$brando_post_classes.'>';
                                    echo'<figure>';
                                        $brando_portfolio_subtitle = brando_post_meta('brando_subtitle');
                                        $portfolio_external_url = brando_post_meta('brando_external_url');
                                        $brando_ajax_popup_class = '';
                                        $brando_link_type = brando_post_meta('brando_enable_ajax_popup');
                                        if( $brando_link_type == 1 ){
                                            $brando_ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                        }
                                        $brando_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $brando_portfolio_srcset_data );
                                        $brando_url = $brando_thumb['0'];
                                        if($brando_url):
                                            echo '<div class="gallery-img">';
                                                if( $portfolio_external_url != '' ){
                                                    echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                }else{
                                                    echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                }
                                                    echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID() ), $brando_portfolio_srcset_data );
                                                echo '</a>';
                                            echo '</div>';
                                        else:
                                            if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                echo '<div class="gallery-img">';
                                                    if( $portfolio_external_url != '' ){
                                                        echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                    }else{
                                                        echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                    }
                                                        echo wp_get_attachment_image( $brando_no_image['id'], 'full' );
                                                    echo '</a>';
                                                echo '</div>';
                                            }
                                        endif;

                                        echo'<figcaption>';
                                            if( get_the_title() || $brando_portfolio_subtitle ):
                                                echo '<h3 class="text-large alt-font xs-margin-two xs-no-margin-lr text-uppercase md-no-padding sm-no-padding entry-title">'.get_the_title().'';
                                                if( $brando_portfolio_subtitle ):
                                                    echo '<span class="text-small gray-text alt-font text-uppercase display-block">'.esc_attr($brando_portfolio_subtitle).'</span>';
                                                endif;
                                            echo '</h3>';
                                            endif;
                                        echo'</figcaption>'; 
                                    echo'</figure>';
                                echo'</li>';
                            endwhile;
                            wp_reset_postdata();
                        echo'</ul>';
                    echo'</div>';
                echo'</div>';
            echo'</div>';
        break;

        case 'portfolio6':
            echo'<div class="grid-gallery grid-style5 overflow-hidden'.esc_attr($brando_portfolio_type).'">';
                echo'<div class="tab-content">';
                    echo'<ul class="masonry-items grid">';
                        
                        while ( have_posts() ) : the_post();
                            
                            $brando_cat_slug = '';
                            $brando_cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                            foreach ($brando_cat as $key => $c) {
                                $brando_cat_slug .= $c->slug." ";
                            }
                            echo'<li '.$brando_post_classes.'>';
                                echo'<figure>';
                                    $brando_portfolio_subtitle = brando_post_meta('brando_subtitle');
                                    $portfolio_external_url = brando_post_meta('brando_external_url');
                                    $brando_ajax_popup_class = '';
                                    $brando_link_type = brando_post_meta('brando_enable_ajax_popup');
                                    if( $brando_link_type == 1 ){
                                        $brando_ajax_popup_class .= 'class="simple-ajax-popup-align-top"';
                                    }
                                    $brando_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $brando_portfolio_srcset_data );
                                    $brando_url = $brando_thumb['0'];
                                    if($brando_url):
                                        echo '<div class="gallery-img">';
                                            if( $portfolio_external_url != '' ){
                                                echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                            }else{
                                                echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                            }
                                                echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID() ), $brando_portfolio_srcset_data );
                                            echo '</a>';
                                        echo '</div>';
                                    else:
                                        if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                            echo '<div class="gallery-img">';
                                                if( $portfolio_external_url != '' ){
                                                    echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                }else{
                                                    echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                }
                                                    echo wp_get_attachment_image( $brando_no_image['id'], 'full' );
                                                echo '</a>';
                                            echo '</div>';
                                        }
                                    endif;

                                    echo'<figcaption>';
                                            echo'<div class="separator-line-thick margin-lr-auto bg-crimson-red no-margin-bottom"></div>';
                                        if( get_the_title() ){
                                            if ( $portfolio_external_url != '' ) {
                                                echo '<a href="'.$portfolio_external_url.'" '.$brando_ajax_popup_class.'><h3 class="alt-font text-uppercase white-text entry-title">'.get_the_title().'</h3></a>';
                                            }else{
                                                echo '<a href="'.get_permalink().'" '.$brando_ajax_popup_class.'><h3 class="alt-font text-uppercase white-text entry-title">'.get_the_title().'</h3></a>';
                                            }
                                        }
                                        if( $brando_portfolio_subtitle ){
                                            echo'<span class="text-small alt-font text-uppercase light-gray-text">'.esc_attr($brando_portfolio_subtitle).'</span>';
                                        }
                                    echo'</figcaption>';
                                echo'</figure>';
                            echo'</li>';
                        endwhile;
                        wp_reset_postdata();
                    echo'</ul>';
                echo'</div>';
            echo'</div>';
        break;

        case 'portfolio7':
            echo'<div class="grid-gallery grid-style6 overflow-hidden'.esc_attr($brando_portfolio_type).'">';
                echo'<div class="tab-content">';
                    echo'<ul class="masonry-items grid">';
                        
                        while ( have_posts() ) : the_post();
                            
                            $brando_cat_slug = '';
                            $brando_cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                            foreach ($brando_cat as $key => $c) {
                                $brando_cat_slug .= $c->slug." ";
                            }
                            echo'<li '.$brando_post_classes.'>';
                                echo'<figure class="overflow-hidden">';
                                    $brando_portfolio_subtitle = brando_post_meta('brando_subtitle');
                                    $portfolio_external_url = brando_post_meta('brando_external_url');
                                    $brando_ajax_popup_class = '';
                                    $brando_link_type = brando_post_meta('brando_enable_ajax_popup');
                                    if( $brando_link_type == 1 ){
                                        $brando_ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                    }
                                    $brando_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $brando_portfolio_srcset_data );
                                    $brando_url = $brando_thumb['0'];
                                    if($brando_url):
                                        
                                        echo '<div class="gallery-img bg-dark-gray">';
                                            if( $portfolio_external_url != '' ){
                                                echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                            }else{
                                                echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                            }
                                                echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID() ), $brando_portfolio_srcset_data );
                                            echo '</a>';
                                        echo '</div>';
                                    else:
                                        if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                            echo '<div class="gallery-img bg-dark-gray">';
                                                if( $portfolio_external_url != '' ){
                                                    echo '<a href="'.$portfolio_external_url.'"'.$brando_ajax_popup_class.'>';
                                                }else{
                                                    echo '<a href="'.get_permalink().'"'.$brando_ajax_popup_class.'>';
                                                }
                                                    echo wp_get_attachment_image( $brando_no_image['id'], 'full' );
                                                echo '</a>';
                                            echo '</div>';
                                        }
                                    endif;

                                    echo'<figcaption>';
                                        if( get_the_title() ){
                                            if ( $portfolio_external_url != '' ) {
                                                echo '<a href="'.$portfolio_external_url.'" '.$brando_ajax_popup_class.'><h3 class="alt-font text-uppercase width-80 margin-lr-auto entry-title">'.get_the_title().'</h3></a>';
                                            }else{
                                                echo '<a href="'.get_permalink().'" '.$brando_ajax_popup_class.'><h3 class="alt-font text-uppercase width-80 margin-lr-auto entry-title">'.get_the_title().'</h3></a>';
                                            }
                                        }
                                    echo'</figcaption>';
                                echo'</figure>';
                            echo'</li>';
                        endwhile;
                        wp_reset_postdata();
                    echo'</ul>';
                echo'</div>';
            echo'</div>';
        break;
    }
echo '</div>';
if( $wp_query->max_num_pages > 1 ){
    echo '<div class="col-md-12 col-sm-12 col-xs-12 pagination text-center">';
        echo paginate_links( array(
            'base'         => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
            'format'       => '',
            'add_args'     => '',
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'total'        => $wp_query->max_num_pages,
            'prev_text'    => '<i class="fas fa-angle-left title-medium font-weight-600 no-border"></i>',
            'next_text'    => '<i class="fas fa-angle-right title-medium font-weight-600"></i>',
            'type'         => 'plain',
            'end_size'     => 1,
            'mid_size'     => 4
        ) );
    echo '</div>';
}