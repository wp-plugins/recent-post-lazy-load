<?php
/**
  Create Shortcode to Display Social Links
  Shortcode is "rp"
*/


// Shortcode
function rp_icons_shortcode( $atts, $content = null ) {
	
	ob_start();
	rp_show_template();
	$output = ob_get_clean();

	return $output;

}
add_shortcode( 'rp', 'rp_icons_shortcode' );



// Shortcode
function rp_custom_shortcode( $atts, $content = null ) {
	
	ob_start();
	  $array_rp =  shortcode_atts( array( 'catname' => '', 'postshow' => '', 'loadmorebtn' => '', 'noofpost' => '', 'image' => '', 'width' => '', 'height'=>'', ), $atts );

    ?>

	<div class="rp">
            <?php 

            $catname = $array_rp['catname'];
            $byposts = $array_rp['postshow'];
            $lmore = $array_rp['loadmorebtn'];
            $noofpost = $array_rp['noofpost'];
            $featureimg = $array_rp['image'];
            $imgwidth = $array_rp['width'];
            $imgheight = $array_rp['height'];

            /********************************/
           
                $args = array(
                    'posts_per_page'   => $noofpost,
                    'offset'           => 0,
                    'category'         => '',
                    'category_name'    => $catname,
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'include'          => '',
                    'exclude'          => '',
                    'meta_key'         => '',
                    'meta_value'       => '',
                    'post_type'        => 'post',
                    'post_mime_type'   => '',
                    'post_parent'      => '',
                    'post_status'      => 'publish',
                    'suppress_filters' => true 
                );


        $size 	= array( $imgwidth, $imgheight );


            $r = new WP_Query( $args );

		if ( $r->have_posts()) :
        ?>
	
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
        
        <article class="post loaderpost">
                      <?php // look for featured image
						  if ( has_post_thumbnail() && $featureimg == 'show') : 
                                 // if there is featured image then show featured image
                                echo wp_get_attachment_image( get_post_thumbnail_id(), $size );
                          endif;
                          ?>
                          
                     <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php  the_title();?></a></h2>
                     <div class="entry-content">
                     <?php  the_excerpt();?>
                     </div>
                     <?php rp_entry_meta();?>
                    
		</article>
           
		<?php endwhile; ?>
        
                    <?php if($lmore == 'show'){ ?>
                    <a href="#" id="load"  class="myButton">Load More</a>
                    <?php }?>
        
		<?php
        
        wp_reset_postdata();

		endif;
        
         ?>	
    
	</div><!-- rp -->

	<?php

	$output = ob_get_clean();

	return $output;

}
add_shortcode( 'rpcustom', 'rp_custom_shortcode' );

