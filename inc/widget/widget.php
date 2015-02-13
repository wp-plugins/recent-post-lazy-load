<?php 

/**
 * Widget for the Display Recent Posts
*/


class rp_widget extends WP_Widget {

// constructor
function rp_widget() {
// Give widget name here
parent::WP_Widget(false, $name = __('RP Lazy Load Widget', 'rp_widget_plugin') );

}


// widget form creation

function form($instance) {

// Check values
if( $instance) {
$title = esc_attr($instance['title']);

    $byshowpost = $instance['byshowpost'];
       $catname = $instance['catname'];
      $noofpost = $instance['noofpost'];
      $imgwidth = $instance['imgwidth'];
     $imgheight = $instance['imgheight'];
    $featureimg = $instance['featureimg'];
   $loadmorebtn = $instance['loadmorebtn'];
         $pbchk = $instance['pbchk'];
    $hide_title = $instance['hide_title'];
     

} else {
         $title = '';
    $byshowpost = '';
       $catname = '';
      $noofpost = '';
      $imgwidth = '';
     $imgheight = '';
    $featureimg = '';
   $loadmorebtn = '';
         $pbchk = '';
    $hide_title = '';
}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label for="byshowpost"><?php _e('Show posts by', 'rp_widget_plugin'); ?></label><br>
<label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Post', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('post'); ?>" name="<?php echo $this->get_field_name('byshowpost'); ?>" type="radio" value="post" <?php if($byshowpost == 'post'){ ?> checked <?php }?> />
<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('byshowpost'); ?>" type="radio" value="cat" <?php if($byshowpost == 'cat'){ ?> checked <?php }?> />
</p>
<p>
<label for="<?php echo $this->get_field_id('catname'); ?>"><?php _e('Category Name (Optional)', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('catname'); ?>" name="<?php echo $this->get_field_name('catname'); ?>" type="text" value="<?php echo $catname; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('noofpost'); ?>"><?php _e('Number of posts', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('noofpost'); ?>" name="<?php echo $this->get_field_name('noofpost'); ?>" type="text" value="<?php echo $noofpost; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('imgwidth'); ?>"><?php _e('Image Width', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('imgwidth'); ?>" name="<?php echo $this->get_field_name('imgwidth'); ?>" type="text" value="<?php echo $imgwidth; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('imgheight'); ?>"><?php _e('Image Height', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('imgheight'); ?>" name="<?php echo $this->get_field_name('imgheight'); ?>" type="text" value="<?php echo $imgheight; ?>" />
</p>


<p>
<label for="featureimage"><?php _e('Featured Image', 'rp_widget_plugin'); ?></label><br>

<label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Show', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('featureimg'); ?>" type="radio" value="show" <?php if($featureimg == 'show'){ ?> checked <?php }?> />
<label for="<?php echo $this->get_field_id('hide'); ?>"><?php _e('Hide', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('hide'); ?>" name="<?php echo $this->get_field_name('featureimg'); ?>" type="radio" value="hide" <?php if($featureimg == 'hide'){ ?> checked <?php }?> />
</p>

<p>
<label for="loadmorebutton"><?php _e('Load More Button', 'rp_widget_plugin'); ?></label><br>

<label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Show', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('loadmorebtn'); ?>" type="radio" value="show" <?php if($loadmorebtn == 'show'){ ?> checked <?php }?> />
<label for="<?php echo $this->get_field_id('hide'); ?>"><?php _e('Hide', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('hide'); ?>" name="<?php echo $this->get_field_name('loadmorebtn'); ?>" type="radio" value="hide" <?php if($loadmorebtn == 'hide'){ ?> checked <?php }?> />
</p>




<p>
<label for="<?php echo $this->get_field_id('hide_title'); ?>"><?php _e('Do not show title on frontend', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('hide_title'); ?>" name="<?php echo $this->get_field_name('hide_title'); ?>" 
type="checkbox" <?php if($hide_title){ ?> checked <?php }?> />
</p>
<p>
<label for="<?php echo $this->get_field_id('pbchk'); ?>"><?php _e('Developed by hide from frontend', 'rp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('pbchk'); ?>" name="<?php echo $this->get_field_name('pbchk'); ?>" 
type="checkbox" <?php if($pbchk){ ?> checked <?php }?> />
</p>
  <p><?php _e( 'Developed By:', 'rp' ); ?> <a href="http://www.sksphpdev.com"><?php _e( 'SKSPHPDEV!', 'rp' ); ?></a></p>
		<p><?php _e( 'Do you like the plugin?', 'rp' ); ?> <a href="https://profiles.wordpress.org/contact4sajid/"><?php _e( 'Please rate it at wordpress.org!', 'rp' ); ?></a></p>

<?php
}


function update($new_instance, $old_instance) {
$instance = $old_instance;

    // Fields
         $instance['title'] = strip_tags($new_instance['title']);
    $instance['byshowpost'] = strip_tags($new_instance['byshowpost']);
       $instance['catname'] = strip_tags($new_instance['catname']);
      $instance['noofpost'] = strip_tags($new_instance['noofpost']);
      $instance['imgwidth'] = strip_tags($new_instance['imgwidth']);
     $instance['imgheight'] = strip_tags($new_instance['imgheight']);
    $instance['featureimg'] = strip_tags($new_instance['featureimg']);
   $instance['loadmorebtn'] = strip_tags($new_instance['loadmorebtn']);
         $instance['pbchk'] = strip_tags($new_instance['pbchk']);
    $instance['hide_title'] = strip_tags($new_instance['hide_title']);
         
         

return $instance;
}


// dirpay widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = apply_filters('widget_title', $instance['title']);

    $byshowpost = $instance['byshowpost'];
       $catname = $instance['catname'];
      $noofpost = $instance['noofpost'];
      $imgwidth = $instance['imgwidth'];
     $imgheight = $instance['imgheight'];
    $featureimg = $instance['featureimg'];
   $loadmorebtn = $instance['loadmorebtn'];
         $pbchk = $instance['pbchk'];
    $hide_title = $instance['hide_title'];

echo $before_widget;

ob_start(); ?>

    <div class="widget white-block clearfix">
    
  <?php 
  
    if ( $hide_title =='' ) {
 
                // Check if title is set
                if ( $title ) {
                echo $before_title. $title . $after_title ;
                }
        
        }
?>

<ul class="list-unstyled no-top-padding">

            <?php 
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
        <li class="post loaderpost">
        <?php // look for featured image
						  if ( has_post_thumbnail() &&  $featureimg == 'show') : 
                                 // if there is featured image then show featured image
                                echo '<div class="widget-image-thumb">'.wp_get_attachment_image( get_post_thumbnail_id(), $size ).'</div>';
                          endif;
                          ?>	
								<div class="widget-text">
									<h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php  the_title();?></a></h5>
                                   
                                     <?php  the_excerpt();?>
                                    
								</div><br>
                                <span> <?php echo get_the_date().' | '. get_comments_number(  $r->the_ID ). ' Comments';?></span>
								
                                <div class="clearfix"></div>
                               
							</li>
           
		<?php endwhile; ?>
        
                    <?php if($loadmorebtn == 'show'){ ?>
                   <p> <a href="#" id="load" class="myButton">Load More</a></p>
                    <?php }?>
        
		<?php
        
        wp_reset_postdata();

		endif;
        
         ?>	
     </ul>
     
        <?php if ( $pbchk =='' ) { ?>	
    <p><?php _e( 'Developed By:', 'rp' ); ?> <a href="http://www.sksphpdev.com"><?php _e( 'SKSPHPDEV!', 'rp' ); ?></a></p>
    
    <p><?php _e( 'Do you like the plugin?', 'rp' ); ?> <a href="https://profiles.wordpress.org/contact4sajid/"><?php _e( 'Please rate it at wordpress.org!', 'rp' ); ?></a></p>
    <?php } ?>
     </div>     



	
	<?php
		echo ob_get_clean();



echo $after_widget;
}

}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("rp_widget");'));