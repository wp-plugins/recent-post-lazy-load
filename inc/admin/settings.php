<?php
/**
 * Register Settings
*/
        function rp_options_each( $key ) {
        
            $rp_options = get_option( 'rp_all_options' );
        
             /* Define the array of defaults */ 
            $defaults = array(
                'catname'     	=> '',
                'byposts'     	=> '',
                'lmore'         => '',
                'noofpost'      => '',
                'featureimg'    => '',
                'imgwidth'      => '',
                'imgheight'     => ''
                		
            );
        
            $rp_options = wp_parse_args( $rp_options, $defaults );
        
            if( isset( $rp_options[$key] ) )
                 return $rp_options[$key];
        
            return false;
        }


        function rp_admin_menu() {
            add_menu_page( 'Recent Posts Settings', 'RP Lazy Load', 'manage_options', 'rp_all_options', 'rp_render_settings_page',
                         RP_PLUGIN_URL.'/inc/img/rp.jpg' ); 
        }
        add_action( 'admin_menu', 'rp_admin_menu' );



function rp_render_settings_page( $active_tab = '' ) {
	ob_start(); ?>

	<div class="wrap">
	
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'RP Lazy Load', 'rp' ); ?> (V.1.0)</h2> 
 <p><?php _e( 'Developed By:', 'rp' ); ?> <a href="http://www.sksphpdev.com"><?php _e( 'SKSPHPDEV!', 'rp' ); ?></a></p>
		<p><?php _e( 'Do you like the plugin?', 'rp' ); ?> <a href="https://profiles.wordpress.org/contact4sajid/"><?php _e( 'Please rate it at wordpress.org!', 'rp' ); ?></a></p>

		<?php settings_errors(); ?>
		
		<?php if ( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = $_GET[ 'tab' ];
		} else {
			$active_tab = 'dirpay_options';
		}

		?>
		
		
		<form method="post" action="options.php">
			<?php
			if ( $active_tab == 'dirpay_options' ) {
				settings_fields( 'rp_all_options' );
				do_settings_sections( 'rp_all_options' );
			}

			submit_button();
	
	echo ob_get_clean();	
}


function rp_initialize_theme_options() {

	// If the theme options don't exist, create them.
	if ( false == get_option( 'rp_all_options' ) )
		add_option( 'rp_all_options' );

	// First, we register a section.
	add_settings_section(
		'general_settings_section',
		__( 'Settings', 'rp' ),
		'rp_general_options_callback',
		'rp_all_options'
	);

	
    add_settings_field(	
		'byposts',						
		__( 'Posts show by',	'rp' ),						
		'rp_byposts_callback',	
		'rp_all_options',	
		'general_settings_section'			
	);
    
     add_settings_field(	
		'catname',						
		__( 'Category Name (Option)',	'rp' ),						
		'rp_catname_callback',	
		'rp_all_options',	
		'general_settings_section'			
	);
     add_settings_field(	
		'noofpost',						
		__( 'Number of posts',	'rp' ),						
		'rp_noofpost_callback',	
		'rp_all_options',	
		'general_settings_section'			
	);
    
    add_settings_field(	
		'imgwidth',						
		__( 'Width',	'rp' ),						
		'rp_imgwidth_callback',	
		'rp_all_options',	
		'general_settings_section'			
	);

     add_settings_field(	
		'imgheight',						
		__( 'Height',	'rp' ),						
		'rp_imgheight_callback',	
		'rp_all_options',	
		'general_settings_section'			
	);
   
      add_settings_field(	
		'lmore',						
		__( 'Load more button',	'rp' ),						
		'rp_loadmore_callback',	
		'rp_all_options',	
		'general_settings_section'			
	);
    
   
        
    add_settings_field(	
		'featureimg',						
		__( 'Featured Image',	'rp' ),						
		'rp_featureimg_callback',	
		'rp_all_options',	
		'general_settings_section'			
	);
    
     
	// Finally, we register the fields with WordPress
	register_setting(
		'rp_all_options',
		'rp_all_options',
		'rp_sanitize_posts_options'
	);


} // end rp_initialize_theme_options
add_action( 'admin_init', 'rp_initialize_theme_options' );


function rp_general_options_callback() {
	echo '<p>';
	_e( 'Add Option for recent posts below using this shortcode <strong> [rp]</strong> on post/page. Show post by category or bydefault recent post with number of posts show.', 'rp' );
   echo '</p>';
    echo '<p>';
    _e( 'You use own custom recent post by category name like example shortcode:<strong> [rpcustom catname="News" loadmorebtn="show" image="show" noofpost="5" width="100" height="100"] </strong>', 'rp' );
    echo '</p>';
} // end rp_general_options_callback



// byposts Callback
function rp_byposts_callback() {
	
	$options = get_option( 'rp_all_options' );
	$byposts = '';

	if( isset( $options['byposts'] ) ) {
		$byposts = $options['byposts'];
	} // end if
	
	// Render the output
	echo '<input type="radio" id="byposts" name="rp_all_options[byposts]" value="posts"'; if($byposts == 'posts'){ echo 'checked';} echo ' /> Post &nbsp;';
    // Render the output
	echo ' <input type="radio" id="byposts" name="rp_all_options[byposts]" value="category"';if($byposts == 'category'){ echo 'checked';} echo ' /> Category';
	
} // end rp_type_callback


// Load More Callback
function rp_loadmore_callback() {
	
	$options = get_option( 'rp_all_options' );
	$lmore = '';

	if( isset( $options['lmore'] ) ) {
		$lmore = $options['lmore'];
	} // end if
	
	// Render the output
	echo '<input type="radio" id="lmore" name="rp_all_options[lmore]" value="show"'; if($lmore == 'show'){ echo 'checked';} echo ' /> Show &nbsp;';
    // Render the output
	echo ' <input type="radio" id="lmore" name="rp_all_options[lmore]" value="hide"';if($lmore == 'hide'){ echo 'checked';} echo ' /> Hide';
	
} // end rp_Load More_callback



// featureimg Callback
function rp_featureimg_callback() {
	
	$options = get_option( 'rp_all_options' );
	$featureimg = '';

	if( isset( $options['featureimg'] ) ) {
		$featureimg = $options['featureimg'];
	} // end if
	
	// Render the output
	echo '<input type="radio" id="featureimg" name="rp_all_options[featureimg]" value="show"'; if($featureimg == 'show'){ echo 'checked';} echo ' /> Show &nbsp;';
    // Render the output
	echo ' <input type="radio" id="featureimg" name="rp_all_options[featureimg]" value="hide"';if($featureimg == 'hide'){ echo 'checked';} echo ' /> Hide';
	
} // end rp_featureimg_callback

// imgwidth Callback
function rp_imgwidth_callback() {
	
	$options = get_option( 'rp_all_options' );
    $imgwidth = '';

	if( isset( $options['imgwidth'] ) ) {
		$imgwidth = $options['imgwidth'];
	} // end if
	
	// Render the output
	echo '<input type="text" id="imgwidth" name="rp_all_options[imgwidth]" value="' . $imgwidth . '" />';
	
} // end rp_imgwidth_callback


// imgheight Callback
function rp_imgheight_callback() {
	
	$options = get_option( 'rp_all_options' );
    $imgheight = '';

	if( isset( $options['imgheight'] ) ) {
		$imgheight = $options['imgheight'];
	} // end if
	
	// Render the output
	echo '<input type="text" id="imgheight" name="rp_all_options[imgheight]" value="' . $imgheight . '" />';
	
} // end rp_imgheight_callback


// catname Callback
function rp_catname_callback() {
	
	$options = get_option( 'rp_all_options' );
    $catname = '';

	if( isset( $options['catname'] ) ) {
		$catname = $options['catname'];
	} // end if
	
	// Render the output
	echo '<input type="text" id="catname" name="rp_all_options[catname]" value="' . $catname . '" />';
	
} // end rp_catname_callback


// noofpost Callback
function rp_noofpost_callback() {
	
	$options = get_option( 'rp_all_options' );
    $noofpost = '';

	if( isset( $options['noofpost'] ) ) {
		$noofpost = $options['noofpost'];
	} // end if
	
	// Render the output
	echo '<input type="text" id="noofpost" name="rp_all_options[noofpost]" value="' . $noofpost . '" />';
	
} // end rp_noofpost_callback




/**** Setting Options ***/ 

function rp_sanitize_posts_options( $input ) {
	
	// Define the array for the updated options
	$output = array();

	// Loop through each of the options sanitizing the data
	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] =  strip_tags( stripslashes( $input[$key] ) );
		} // end if	
	
	} // end foreach
	
	// Return the new collection
	return apply_filters( 'rp_sanitize_posts_options', $output, $input );

} // end sandbox_theme_sanitize_social_options*/