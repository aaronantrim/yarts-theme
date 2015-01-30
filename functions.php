<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

function the_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
   /* if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator"> > </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separator"> > </li><li> ');
            if (is_single()) {
                echo '</li><li class="separator"> > </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif('route' == get_post_type() ) {
       	
                echo '<li><a href="/routes-and-schedules/">Routes & Schedules</a></li><li class="separator">></li><li><strong> '.get_the_title().'</strong></li>';
            
        
        }
        
        elseif('timetable' == get_post_type() ) {
        
        
        }
        
        elseif('alert' == get_post_type() ) {
        	
        	echo 'alert';
        
        }
        
        elseif('route' == get_post_type() ) {
        
        
        }
        elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">/</li>';
                }
                echo $output;
                echo '<strong title="'.$title.'"> '.$title.'</strong>';
            } else {
                echo '<li><strong> '.get_the_title().'</strong></li>';
            }
        } 
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    
    */
    
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator"> > </li>';
    	
    	if(is_archive()) {
    		$post_type = get_post_type();
    		
			if ( $post_type )
			{
			
				$taxonomy = 'alert-zone';
				$taxonomy_terms = get_terms( $taxonomy, array(
					'hide_empty' => 0,
					'fields' => 'ids'
				) );
		
				if(has_term($taxonomy_terms, 'alert-zone')) {
					
					echo 'Alerts';
					
				}	else {
				
					$post_type_data = get_post_type_object( $post_type );
					$post_type_slug = $post_type_data->rewrite['slug'];
					echo $post_type_data->label;

				
				}
			}
    	}
    	
    	elseif (is_single()) {
    	
    		$post_type = get_post_type();
    		
			if ( $post_type )
			{
				$post_type_data = get_post_type_object( $post_type );
				$post_type_slug = $post_type_data->rewrite['slug'];
				echo '<li><a href="'.get_post_type_archive_link( $post_type ).'">';
				 echo $post_type_data->label;
				echo '</a></li>';
			}
    	
           
            
            if (is_single()) {
            
            
            
                echo '</li><li class="separator"> > </li><li>';
                
				
               echo str_replace('>','<span class="route-triangle">&#9654;</span>',get_the_title()); 
                if( $post_type_data = get_post_type_object( $post_type )->rewrite['slug'] == 'routes-and-schedules') {
                
                	echo ' - '.get_field('route_subtitle');
                	
                }
                echo '</li>';
            }
        }
        
        elseif (is_page()) {
        	 echo '</li><li>';
                the_title();
                echo '</li>';
        
        }
    
    echo '<br style="clear: both;" />';
    echo '</ul>';
    
    
    }
    
}

 function slugify($text)
{ 
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'bones_fonts');

/* START TRILLIUM CUSTOM */

function register_my_menus() {
  register_nav_menus(
    array( 
      'main-home-menu' => __( 'Main Home Menu' ), 
      'main-subpage-top-menu' => __( 'Main Subpage Top Menu' ), 

    )
  );
}

// change image name on custom types
add_action('do_meta_boxes', 'change_image_box');
function change_image_box()
{
    remove_meta_box( 'postimagediv', 'route', 'side' );
    add_meta_box('postimagediv', __('Map Image File'), 'post_thumbnail_meta_box', 'route', 'normal', 'high');
}


add_action( 'init', 'register_my_menus' );

class My_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class=" linked-div ' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= '<span class="menu-item-desc">' . $item->description . '</span><br style="clear: both;" />';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class My_SubPage_Walker extends Walker_Nav_Menu
{
	static $menu_count = 0;
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		
		$output .= "<!-- x:".self::$menu_count."-->";
		
       
        
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class=" linked-div ' . esc_attr( $class_names ) . '"';
		
		
		if(self::$menu_count == 5) {
			$output .= '<span id="more-info"><span id="more-info-text">&#x25BC; More <span id="info-text">Info</span></span><span id="more-info-links">';
		}
		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		
		$item_output .= '<a'. $attributes .'><i class="'.slugify($item->title).'"></i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= '';
		$item_output .= $args->after;
		
		
		
		if ( 0 == $depth ) self::$menu_count++;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		
	}
	
	function end_lvl( &$output, $item, $depth ) {
		$output .= '<br style="clear: both;" /></span></span></ul></div>';
	}
}

function codex_route_init() {

$labels = array(
		'name'               => _x( 'Board Meetings', 'post type general name' ),
		'singular_name'      => _x( 'board-meeting', 'post type singular name' ),
		'menu_name'          => _x( 'Board Meetings', 'admin menu'),
		'name_admin_bar'     => _x( 'Board Meeting', 'add new on admin bar'),
		'add_new'            => _x( 'Add New meeting', 'board-meeting'),
		'add_new_item'       => __( 'Add New meeting'),
		'new_item'           => __( 'New meeting'),
		'edit_item'          => __( 'Edit meeting'),
		'view_item'          => __( 'View meeting '),
		'all_items'          => __( 'All meetings'),
		'search_items'       => __( 'Search meetings'),
		'parent_item_colon'  => __( 'Parent meeting:'),
		'not_found'          => __( 'No meetings found.'),
		'not_found_in_trash' => __( 'No meetings found in Trash.')
	);

	$args = array(
		'menu_icon' => '',
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'board-meeting' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'revisions', 'thumbnail' )
	);

	register_post_type( 'board-meeting', $args );


	$labels = array(
		'name'               => _x( 'Routes &amp; Schedules', 'post type general name' ),
		'singular_name'      => _x( 'route', 'post type singular name' ),
		'menu_name'          => _x( 'Routes', 'admin menu'),
		'name_admin_bar'     => _x( 'Route', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'route'),
		'add_new_item'       => __( 'Add New route'),
		'new_item'           => __( 'New route'),
		'edit_item'          => __( 'Edit Route'),
		'view_item'          => __( 'View Route'),
		'all_items'          => __( 'All Routes'),
		'search_items'       => __( 'Search Routes'),
		'parent_item_colon'  => __( 'Parent Routes:'),
		'not_found'          => __( 'No routes found.'),
		'not_found_in_trash' => __( 'No routes found in Trash.')
	);

	$args = array(
		'menu_icon' => '',
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'routes-and-schedules' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'revisions', 'thumbnail' )
	);

	register_post_type( 'route', $args );
	
	
	
	$labels = array(
		'name'               => _x( 'Timetables', 'post type general name' ),
		'singular_name'      => _x( 'timetable', 'post type singular name' ),
		'menu_name'          => _x( 'Timetables', 'admin menu'),
		'name_admin_bar'     => _x( 'Timetable', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'timetable'),
		'add_new_item'       => __( 'Add New Timetable'),
		'new_item'           => __( 'New timetable'),
		'edit_item'          => __( 'Edit timetable'),
		'view_item'          => __( 'View timetable '),
		'all_items'          => __( 'All timetables'),
		'search_items'       => __( 'Search timetables'),
		'parent_item_colon'  => __( 'Parent timetable:'),
		'not_found'          => __( 'No timetables found.'),
		'not_found_in_trash' => __( 'No timetables found in Trash.')
	);

	$args = array(
		'menu_icon' => '',
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'timetables' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'revisions','page-attributes' )
		
	);

	register_post_type( 'timetable', $args );
	
	
	$labels = array(
		'name'               => _x( 'Alerts', 'post type general name' ),
		'singular_name'      => _x( 'alert', 'post type singular name' ),
		'menu_name'          => _x( 'Alerts', 'admin menu'),
		'name_admin_bar'     => _x( 'Alert', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'alert'),
		'add_new_item'       => __( 'Add New Alert'),
		'new_item'           => __( 'New Alert'),
		'edit_item'          => __( 'Edit Alert'),
		'view_item'          => __( 'View Alert '),
		'all_items'          => __( 'All Alerts'),
		'search_items'       => __( 'Search Alerts'),
		'parent_item_colon'  => __( 'Parent Alert:'),
		'not_found'          => __( 'No alerts found.'),
		'not_found_in_trash' => __( 'No alerts found in Trash.')
	);

	$args = array(
		'menu_icon' => '',
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'alerts' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'revisions' )
	);

	register_post_type( 'alert', $args );
	
	$labels = array(
		'name'               => _x( 'News', 'post type general name' ),
		'singular_name'      => _x( 'News', 'post type singular name' ),
		'menu_name'          => _x( 'News', 'admin menu'),
		'name_admin_bar'     => _x( 'News', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'news'),
		'add_new_item'       => __( 'Add New News'),
		'new_item'           => __( 'New news'),
		'edit_item'          => __( 'Edit news'),
		'view_item'          => __( 'View news '),
		'all_items'          => __( 'All news'),
		'search_items'       => __( 'Search news'),
		'parent_item_colon'  => __( 'Parent news:'),
		'not_found'          => __( 'No news found.'),
		'not_found_in_trash' => __( 'No news found in Trash.')
	);

	$args = array(
		'menu_icon' => '',
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'news' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'revisions' )
	);

	register_post_type( 'news', $args );
	
	$labels = array(
		'name'               => _x( 'home_slide', 'post type general name' ),
		'singular_name'      => _x( 'Home Slide', 'post type singular name' ),
		'menu_name'          => _x( 'Home Slide', 'admin menu'),
		'name_admin_bar'     => _x( 'Home Slide', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'home_slide'),
		'add_new_item'       => __( 'Add New Home Slide'),
		'new_item'           => __( 'New home slide'),
		'edit_item'          => __( 'Edit home slide'),
		'view_item'          => __( 'View home slide '),
		'all_items'          => __( 'All home slides'),
		'search_items'       => __( 'Search home slide'),
		'parent_item_colon'  => __( 'Parent home slide:'),
		'not_found'          => __( 'No home_slide found.'),
		'not_found_in_trash' => __( 'No home_slide found in Trash.')
	);

	$args = array(
		'menu_icon' => '',
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'home_slide' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'revisions', 'thumbnail' )
	);

	register_post_type( 'home_slide', $args );
	
	
}

add_action( 'init', 'codex_route_init' );

function get_alertCount() {

	$taxonomy = 'alert-zone';
	$taxonomy_terms = get_terms( $taxonomy, array(
		'hide_empty' => 0,
		'fields' => 'ids'
	) );

	$args = array(
				'numberposts' => -1,
				'post_type' => array('alert','news'),
				'tax_query' =>
							array(
								array(
									'taxonomy' => 'alert-zone',
									'field' => 'id',
									'terms' => $taxonomy_terms,
								),
							)
				
			);
 
	
	
	/*$args = array(
				'numberposts' => -1,
				'post_type' => 'alert');*/
	$the_query = new WP_Query( $args );



	$size = sizeof($the_query->posts);

	wp_reset_query();
	return $size;

}

/* DON'T DELETE THIS CLOSING TAG */ ?>
