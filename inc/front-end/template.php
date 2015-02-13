<?php

/**
 * Create Template Structure for the Display of Recent Post
*/

/******* rp_show_template ******************/
function rp_show_template() {
	
	ob_start(); ?>

	<div class="rp">
            <?php 

             $catname = rp_options_each( 'catname' );
             $byposts = rp_options_each( 'byposts' );
             $lmore = rp_options_each( 'lmore' );
             $noofpost = rp_options_each( 'noofpost' );
             $featureimg = rp_options_each( 'featureimg' );
             $imgwidth = rp_options_each( 'imgwidth' );
             $imgheight = rp_options_each( 'imgheight' );

            /********************************/
            if(isset($catname))
            {
                $catname = $catname;
            }
            else
            {
                $catname = 'Uncategorized';
            }
            
            
            /******************************/
            if(isset($noofpost))
            {
                $noofpost =  $noofpost;
            }
            else
            {
                 $noofpost = -1;
            }

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
                    <a href="#" id="load" class="myButton">Load More</a>
                    <?php }?>
        
		<?php
        
        wp_reset_postdata();

		endif;
        
         ?>	
    
	</div><!-- rp -->

	<?php
		echo ob_get_clean();

}