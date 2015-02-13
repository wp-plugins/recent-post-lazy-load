<?php 
/*
Plugin Name: Recent Post Lazy Load
Plugin URI: http://sksphpdev.com/plugins/
Description: The Widget with some options. This plugin is based on the well-known WordPress default widget 'Recent Posts' and enhanced to display thumbnails of the posts. The thumbnails will be built from the featured image of a post content. If there is neither a featured image nor a content image then you can hide the thumbnail. The thumbnails appears left-aligned to the post titles. You can set the width and heigth of the thumbnails in the list. The widget and shortcode is available. You can insert through widget on any sidebar any where easily.
Tags: shortcodes, shortcode, thumbnails, thumb, thumbs, thumbnail, featured images, featured, image, images, recent posts, widgets, widget
Author: Contact4sajid
Author URI: http://sksphpdev.com
Version: 1.0
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/**** CONSTANTS ****/

// Plugin Folder Path
if ( !defined( 'RP_PLUGIN_DIR' ) ) {
	define( 'RP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Plugin Folder URL
if ( !defined( 'RP_PLUGIN_URL' ) ) {
	define( 'RP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Plugin Version
if ( !defined( 'RP_VERSION' ) ) {
	define( 'RP_VERSION', '1.0' );
}


/**** REGISTER & ENQUEUE SCRIPTS/STYLES *****/

function rp_load_scripts() {
    
        /********** Load JS File *****************/
        wp_enqueue_script( 'jquery' );
        wp_register_script( 'rp-script', plugins_url( 'inc/js/custom.js', __FILE__ ), array( 'jquery' ) );
        wp_enqueue_script( 'rp-script' );
        
       /********** Load CSS File *****************/                    
        wp_register_style( 'rp-styles',  RP_PLUGIN_URL . 'inc/css/custom.css', array(  ),RP_VERSION );
        wp_enqueue_style( 'rp-styles' );	
}
add_action( 'wp_enqueue_scripts', 'rp_load_scripts' );


/*********** Settings Link *******/

function rp_settings_link( $link, $file ) {
	static $this_plugin;
	
	if ( !$this_plugin )
		$this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ) {
		$settings_link = '<a href="' . admin_url( 'options-general.php?page=rp_all_options' ) . '">' . __( 'Settings', 'rp' ) . '</a>';
		array_unshift( $link, $settings_link );
	}
	
	return $link;
}
add_filter( 'plugin_action_links', 'rp_settings_link', 10, 2 );

    /**
     * Set up post entry meta.
     *
     **/
    if ( ! function_exists( 'rp_entry_meta' ) ) :
    
            function rp_entry_meta() {
                // Translators: used between list items, there is a space after the comma.
                $categories_list = get_the_category_list( __( ', ', 'rp' ) );
            
                // Translators: used between list items, there is a space after the comma.
                $tag_list = get_the_tag_list( '', __( ', ', 'rp' ) );
            
                $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
                    esc_url( get_permalink() ),
                    esc_attr( get_the_time() ),
                    esc_attr( get_the_date( 'c' ) ),
                    esc_html( get_the_date() )
                );
            
                $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    esc_attr( sprintf( __( 'View all posts by %s', 'rp' ), get_the_author() ) ),
                    get_the_author()
                );
            
                // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
                if ( $tag_list ) {
                    $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'rp' );
                } elseif ( $categories_list ) {
                    $utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'rp' );
                } else {
                    $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'rp' );
                }
            
                printf(
                    $utility_text,
                    $categories_list,
                    $tag_list,
                    $date,
                    $author
                );
            }
    endif;


/* Admin Scripts */
include_once( RP_PLUGIN_DIR . 'inc/admin/settings.php' );

/******* Widget **************/
include_once(RP_PLUGIN_DIR . 'inc/widget/widget.php' );

/* Front End Scripts */
include_once( RP_PLUGIN_DIR . 'inc/front-end/template.php' );
include_once( RP_PLUGIN_DIR . 'inc/front-end/shortcode.php' );