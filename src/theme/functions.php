<?php
/**
 * Hope for Justice 2021 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hope_for_Justice_2021
 */

if ( ! function_exists( 'hope_for_justice_2021_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hope_for_justice_2021_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Hope for Justice 2020, use a find and replace
		 * to change 'hope-for-justice-2020' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hope-for-justice-2021', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'uk-primary' => esc_html__( 'uk-primary', 'hope-for-justice-2021' ),
			'uk-secondary' => esc_html__( 'uk-secondary', 'hope-for-justice-2021' ),
      'uk-footer-a' => esc_html__( 'uk-footer-a', 'hope-for-justice-2021' ),
      'uk-footer-b' => esc_html__( 'uk-footer-b', 'hope-for-justice-2021' ),
      'uk-footer-c' => esc_html__( 'uk-footer-c', 'hope-for-justice-2021' ),
      'uk-footer-d' => esc_html__( 'uk-footer-d', 'hope-for-justice-2021' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hope_for_justice_2021_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hope_for_justice_2021_setup' );

/**
 * Enqueue scripts and styles.
 */
function hope_for_justice_2021_scripts() {
	global $wp_styles;


	wp_enqueue_style( 'hope-for-justice-2021-style', get_stylesheet_uri(), array(), '202270' );

	wp_enqueue_script('jquery'); 
	// wp_enqueue_script( 'justice-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.modal.js', array(), '202270', true );


    wp_enqueue_script( 'hopeforjustice-2021-footer', get_template_directory_uri() . '/assets/js/footer.js', array(), '202270', true );


}

/**
 * Remove admin bumb*/
add_action('get_header', 'my_filter_head');
function my_filter_head() {
remove_action('wp_head', '_admin_bar_bump_cb');
}


add_action( 'wp_enqueue_scripts', 'hope_for_justice_2021_scripts', 1 );

/**
 * Enqueue page specific scripts in a centrally maintained location
 */
function page_scripts() {
    global $post;

    wp_register_script( 'plugins', get_template_directory_uri() . '/assets/js/pages/plugins.js', array('jquery'), '202270', true);

    wp_register_script( 'homepage', get_template_directory_uri() . '/assets/js/pages/homepage.js', array('jquery'), '202270', true);

    wp_register_script( 'donate', get_template_directory_uri() . '/assets/js/pages/donate.js', array('jquery'), '202270', true);

    wp_register_script( 'donate-new', get_template_directory_uri() . '/assets/js/pages/donate-new.js', array('jquery'), '202270', true);

    wp_register_script( 'donate-thankyou', get_template_directory_uri() . '/assets/js/pages/donate-thankyou.js', array('jquery'), '202270', true);

    wp_register_script( 'donorfy-stripe', get_template_directory_uri() . '/assets/js/pages/donorfy-stripe.js', array('jquery'), '202270', true);

    wp_register_script( 'regular-uk', get_template_directory_uri() . '/assets/js/pages/regular-uk.js', array('jquery'), '202270', true);

    wp_register_script( 'donorfy-gocardless', get_template_directory_uri() . '/assets/js/pages/donorfy-gocardless.js', array('jquery'), '202270', true);

    wp_register_script( 'donorfy-donate', get_template_directory_uri() . '/assets/js/pages/donorfy-donate.js', array('jquery'), '202270', true);

    wp_register_script( 'one-off-uk', get_template_directory_uri() . '/assets/js/pages/one-off-uk.js', array('jquery'), '202270', true);

    wp_register_script( 'one-off-usa', get_template_directory_uri() . '/assets/js/pages/one-off-usa.js', array('jquery'), '202270', true);

    wp_register_script( 'one-off-norway', get_template_directory_uri() . '/assets/js/pages/one-off-norway.js', array('jquery'), '202270', true);


    wp_register_script( 'donorfy-webhooks', get_template_directory_uri() . '/assets/js/pages/donorfy-webhooks.js', array('jquery'), '202270', true);

    wp_register_script( 'church-partnerships', get_template_directory_uri() . '/assets/js/pages/church-partnerships.js', array('jquery'), '202270', true);

    wp_register_script( 'training', get_template_directory_uri() . '/assets/js/pages/training.js', array('jquery'), '202270', true);

    wp_register_script( 'freedom-run', get_template_directory_uri() . '/assets/js/pages/freedom-run.js', array('jquery'), '202270', true);

    wp_register_script( 'men-are-victims', get_template_directory_uri() . '/assets/js/pages/men-are-victims.js', array('jquery'), '202270', true);


    $themeVars = array( 'template_directory_uri' => get_template_directory_uri() );

    if ( is_page() ) {
      wp_enqueue_script('plugins');
    } 
    if (is_front_page()) {
      wp_enqueue_script('homepage');
    }
    if (is_page('donate') || is_page_template('templates/page-basic-campaign.php')) {
     	wp_enqueue_script('donate');
    }
    if (is_page_template('templates/page-training.php')) {
      wp_enqueue_script('training');
    }
    if (is_page_template('templates/page-freedom-run.php')) {
      wp_enqueue_script('freedom-run');
    }
    if (is_page_template('templates/page-donation-thank-you.php')) {
      wp_enqueue_script('donate-thankyou');
    }
    if (is_page_template('templates/page-guardian-usa.php')) {
      wp_enqueue_script('donorfy-stripe');
      wp_enqueue_script('one-off-usa');
      wp_enqueue_script('donorfy-donate');
    }
    if (is_page_template('templates/page-one-off-uk.php')) {
      wp_enqueue_script('donorfy-stripe');
      wp_enqueue_script('one-off-uk');
      wp_enqueue_script('donorfy-donate');
    }
    if (is_page_template('templates/page-one-off-usa.php')) {
      wp_enqueue_script('donorfy-stripe');
      wp_enqueue_script('one-off-usa');
      wp_enqueue_script('donorfy-donate');
    }
    if (is_page_template('templates/page-one-off-norway.php')) {
      wp_enqueue_script('donorfy-stripe');
      wp_enqueue_script('one-off-norway');
      wp_enqueue_script('donorfy-donate');
    }
    if (is_page_template('templates/page-guardian-uk.php')) {
      wp_enqueue_script('regular-uk');
      wp_enqueue_script('donorfy-gocardless');
      wp_enqueue_script('donorfy-donate');
    }
    if (is_page_template('templates/page-donorfy-webhooks.php')) {
      wp_enqueue_script('donorfy-webhooks');
    }
    if (is_page_template('templates/page-donate-new.php')) {
      wp_enqueue_script('donate-new');
    }
    if (is_page_template('templates/page-men-are-victims.php')) {
      wp_enqueue_script('men-are-victims');
      wp_enqueue_style( 'men-are-victims', get_template_directory_uri() . '/men-are-victims.css', array(), '202270' );
    }
    if (is_page_template('templates/page-goats-milk.php')) {
      wp_enqueue_script('donate-new');
      wp_enqueue_style( 'goats-milk', get_template_directory_uri() . '/goats-milk.css', array(), '202270' );
    }
    if (is_page_template('templates/page-church-partnerships.php')) {
      wp_enqueue_script('church-partnerships');
      wp_enqueue_style( 'church-partnerships', get_template_directory_uri() . '/church-partnerships.css', array(), '202270' );
    }


}

add_action('wp_enqueue_scripts', 'page_scripts',1);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Gravity Wiz // Gravity Forms Unrequire Required Fields for Testing
 *
 * When bugs pop up on your forms, it can be really annoying to have to fill out all the required fields for every test
 * submission. This snippet saves you that hassle by unrequiring all required fields so you don't have to fill them out.
 *
 * @version	  1.0
 * @author    David Smith <david@gravitywiz.com>
 * @license   GPL-2.0+
 * @link      http://gravitywiz.com/speed-up-gravity-forms-testing-unrequire-required-fields/
 * @copyright 2013 Gravity Wiz
 *
 * @wordpress-plugin
 * Plugin Name:       Gravity Forms Unrequire
 * Plugin URI:        http://gravitywiz.com/speed-up-gravity-forms-testing-unrequire-required-fields/
 * Description:       When bugs pop up on your forms, it can be really annoying to have to fill out all the required fields for every test submission. This snippet saves you that hassle by unrequiring all required fields so you don't have to fill them out.
 * Version:           1.0
 * Author:            Gravity Wiz
 * Author URI:        http://gravitywiz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gwu
 */

class GWUnrequire {
    
    var $_args = null;
    
    public function __construct( $args = array() ) {
        
        $this->_args = wp_parse_args( $args, array(
            'admins_only' => true,
            'require_query_param' => true
        ) );
        
        add_filter( 'gform_pre_validation', array( $this, 'unrequire_fields' ) );
        
    }
    
    function unrequire_fields( $form ) {

        // if( $this->_args['admins_only'] && ! current_user_can( 'activate_plugins' ) )
        //     return $form;

        if( $this->_args['require_query_param'] && ! isset( $_GET['gwunrequire'] ) )
            return $form;
        
        foreach( $form['fields'] as &$field ) {
            $field['isRequired'] = false;
        }
        
        return $form;
    }
        
}

# Basic Usage
#   requires that the user be logged in as an administrator and that a 'gwunrequire' parameter be added to the query string
#   http://youurl.com/your-form-page/?gwunrequire=1

new GWUnrequire();

/**
 * Remove stripe error rate limit on Gravity Forms
 */
add_filter( 'gform_stripe_enable_rate_limits', '__return_false' );


function news_page_scripts() {
	global $wp_styles;
	if (is_page_template('category-news-template.php') || is_page_template('all-categories.php') || is_category('blogs_and_opinion_editorials') || is_category('top_news') || is_category('videos') || is_single() || is_category('in_the_headlines') || is_page('search-news-results') || is_page('careers') || is_page('governance-policies-funding') || is_page('resources-template') || is_page('volunteering-opportunities') || is_page('events') || is_singular('events') || is_page('stories-and-case-studies') || is_singular('stories-and-case-studies')){
		// style files
		//wp_deregister_script('justice-bootstrap');
		// if(is_page('volunteering-opportunities') || is_page('events') || is_singular('events')) {
			
		// }
		
		
		
	
		// wp_enqueue_style( 'news-page-css', get_template_directory_uri() . '/assets/css/news-page.css' );
		// wp_enqueue_style( 'gov-pol-fund-css', get_template_directory_uri() . '/assets/css/gov-pol-fund.css' );
		// wp_enqueue_style( 'resources-template-css', get_template_directory_uri() . '/assets/css/resources-template.css' );
		// wp_enqueue_style( 'volunteering-opportunities-css', get_template_directory_uri() . '/assets/css/volunteering-opportunities.css' );
		// wp_enqueue_style( 'events-css', get_template_directory_uri() . '/assets/css/events.css' );
    //     wp_enqueue_style( 'case-studies-css', get_template_directory_uri() . '/assets/css/case-studies.css' );
		// js files
		// wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/assets/js/popper.min.js', ['jquery-core'] );
		// wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', ['jquery-core'] );
		
		wp_enqueue_script( 'news-page-js', get_template_directory_uri() . '/assets/js/news-page.js', ['jquery-core'] );
		wp_localize_script('news-page-js', 'ajax_object', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		) );
	}
}

add_action( 'wp_enqueue_scripts', 'news_page_scripts', 1 );





function custom_excerpt_length( $length ) {
    return 14;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// add_action( 'wp_ajax_nopriv_ajax_news_video',  'ajax_news_video' );
// add_action( 'wp_ajax_ajax_news_video','ajax_news_video' );
// function ajax_news_video() {
// 	$src = $_POST['src'];
// 	$iframe = '<iframe class="video" src="'.$src.'?autoplay=1"  width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
	
// 	echo $iframe;
//     exit();
// }
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_60bf926dc01e0',
		'title' => 'News Post',
		'fields' => array(
			array(
				'key' => 'field_60bf928245fd0',
				'label' => 'Enter Vimeo Link',
				'name' => 'upload_video',
				'type' => 'oembed',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'width' => '',
				'height' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_category',
					'operator' => '==',
					'value' => 'category:videos',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

endif;



function process_news_form() {
	// die(print_r($_POST));
    if(isset($_POST['action']) && $_POST['action'] == 'news_search' && wp_verify_nonce($_POST['news_nonce'], 'news-search-nonce')) {
    	$redirect = add_query_arg(array('search' => $_POST['search-posts'],'category' => $_POST['category']), $_POST['redirect'] );
    	wp_redirect($redirect); exit;
       
    }
}
add_action( 'init', 'process_news_form' );


function title_filter($where, $wp_query) {

    global $wpdb;

    if ($search_term = $wp_query->get('search_news_title')) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
    }
    return $where;
}
add_filter( 'single_template', function ( $single_template ) {

    $parent     = '6'; //Change to your category ID
    $categories = get_categories( 'child_of=' . $parent );
    $cat_names  = wp_list_pluck( $categories, 'name' );

    if ( has_category( 'videos' )) {
        $single_template = dirname( __FILE__ ) . '/single-videos.php';
    }
    return $single_template;
     
}, PHP_INT_MAX, 2 );


/**
 * Gravity Forms scroll top
 */
add_filter( 'gform_confirmation_anchor', function() {
    return 0;
} );

/**
 * better excerpt ending
 */
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function gpf_create_post_type() {

  register_post_type( 'gov_pol_fund',
    array(
      'labels' => array(
        'name' => __( 'GPF Modules' ),
        'singular_name' => __( 'GPF Module' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array(
        'slug' => 'gov_pol_fund',
        'with_front' => FALSE
      ),
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-text-page',
      'supports' => array( 'thumbnail','title','editor' )

    )
  );
  register_post_type( 'resources_template',
    array(
      'labels' => array(
        'name' => __( 'Resources ' ),
        'singular_name' => __( 'Resources ' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array(
        'slug' => 'resources',
        'with_front' => FALSE
      ),
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-media-text',
      'supports' => array( 'thumbnail','title','editor' )

    )
  );
  register_post_type( 'vol_opp',
    array(
      'labels' => array(
        'name' => __( 'Volunteering Opportunities ' ),
        'singular_name' => __( 'Volunteering Opportunity ' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array(
        'slug' => 'vol_opp',
        'with_front' => FALSE
      ),
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-media-document',
      'supports' => array('title')

    )
  );
  // register_post_type( 'events',
  //   array(
  //     'labels' => array(
  //       'name' => __( 'Events' ),
  //       'singular_name' => __( 'Event' )
  //     ),
  //     'public' => true,
  //     'has_archive' => true,
  //     'rewrite' => array('slug' => 'event'),
  //     'show_in_rest' => true,
  //     'menu_icon' => 'dashicons-groups',
  //     'supports' => array('thumbnail','title','editor')

  //   )
  // );
  register_post_type( 'stories_case_studies',
    array(
      'labels' => array(
        'name' => __( 'Stories and Case Studies' ),
        'singular_name' => __( 'Story and Case Study' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array(
        'slug' => 'stories_case_studies',
        'with_front' => FALSE
      ),
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-clipboard',
      'supports' => array('thumbnail','title','editor')

    )
  );
}
add_action( 'init', 'gpf_create_post_type' );

function add_custom_taxonomies() {



  register_taxonomy('categories', 'gov_pol_fund', array(



    'hierarchical' => true,


    'labels' => array(

      'name' => _x( 'Categories', 'taxonomy general name' ),

      'singular_name' => _x( 'Category', 'taxonomy singular name' ),

      'search_items' =>  __( 'Search Category' ),

      'all_items' => __( 'All Categories' ),

      'parent_item' => __( 'Parent' ),

      'parent_item_colon' => __( 'Parent:' ),

      'edit_item' => __( 'Edit Category' ),

      'update_item' => __( 'Update Category' ),

      'add_new_item' => __( 'Add New Category' ),

      'new_item_name' => __( 'New Category' ),

      'menu_name' => __( 'Category' ),

    ),

    'show_in_nav_menus' => false,

    // Control the slugs used for this taxonomy

    'rewrite' => array(

    'slug' => 'gpf_category', // This controls the base slug that will display before each term

    'with_front' => false, // Don't display the category base before "/locations/"

    'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"

    ),

  ));

}

add_action( 'init', 'add_custom_taxonomies', 0 );


// function update_featured_events() {

//   global $posts;
//   global $post;
  
//   // Get other post marked as featured
//   $posts = get_posts([
//   // Array of posts to check  
//   'post_type' => ['events'],
//   'meta_key' => 'pin_event',
//   'meta_value' => 1,
//   'post__not_in' => [$post->ID]
//   ]);

//   // Remove previous featured posts
//   if ( get_field( 'pin_event' ) ) {
//   	foreach( $posts as $p ) {

//   		update_field('pin_event', 0, $p->ID);
//     }
//   } return;

// }
// add_action('acf/save_post', 'update_featured_events', 20);


/**
 *  The multi-step form template and the donor dashboard load in an iframe, which prevents theme styles from interfering with their styles.
 *  To style them, use this PHP snippet to add a custom stylesheet that styles the form or the donor dashboard.
 *  
 *  Make sure you create the givewp-iframes-styles.css file with the CSS styles you'll use.
 */


// function my_custom_override_iframe_template_styles() {
//     wp_enqueue_style(
//         'givewp-iframes-styles',
//         get_template_directory_uri() . '/givewp-iframes-styles.css',
//         /**
//          *  Below, use give-sequoia-template-css to style the multi-step donation form
//          *  or use give-donor-dashboards-app to style the donor dashboard
//          */
//         'give-sequoia-template-css'
//     );
// }

//remove block scripts
function remove_block_css(){
  wp_dequeue_style( 'wp-block-library' );
  }
  add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );


add_action('wp_print_styles', 'my_custom_override_iframe_template_styles', 10);

//acf issue updating fix
add_filter( 'https_ssl_verify', '__return_false' );

if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page();
  
}

//shortcodes
include('custom-shortcodes.php');
add_shortcode('dropdown', 'dropdown_function');


/**
 * AUTO-POPULATE AMOUNT, NAME, and EMAIL FROM URL STRING
 *
 * This jQuery snippet will auto-populate the Give form amount,
 * first and last name, and email address from a URL you provide
 * EXAMPLE: https://example.com/donations/give-form/?amount=46.00&first=Peter&last=Joseph&email=testing@givewp.com
 *
 * Hooking into the single form view.
 *
 * CAVEATS:
 * -- Your form must support custom amounts
 * -- This snippet only supports one form per page as-is
 */
function my_custom_give_populate_amount_name_email() {
    ?>
    <script>
        ( function( window, document, $, undefined ) {
            'use strict';
    var giveCustom = {};

    giveCustom.init = function() {

        // Are we passed a form ID?
        var form_id = giveCustom.getQueryVariable( 'form_id' ) !== false ? decodeURI( giveCustom.getQueryVariable( 'form_id' ) ) : '';

        if ( form_id !== '' ) {
            // Make to jQuery object.
            var giveForm = $( '.give-form' + giveCustom.getQueryVariable( 'form_id' ) )
        } else {
            // Fallback.
            giveForm = $( '.give-form' );
        }

        // Get the amount from the URL
        var amount = giveCustom.getQueryVariable( 'amount' ) !== false ? decodeURI( giveCustom.getQueryVariable( 'amount' ) ) : '';

        // Update the amount
        var formattedAmount = Give.fn.formatCurrency( amount, {
            symbol: Give.form.fn.getInfo( 'currency_symbol', giveForm ),
            position: Give.form.fn.getInfo( 'currency_position', giveForm )
        }, giveForm );

        // Unformatted amount (for data).
        var unformattedAmount = Give.fn.unFormatCurrency( amount, Give.form.fn.getInfo( 'decimal_separator', giveForm ) );

        // Update the total amount.
        if ( amount ) {
            giveForm.find( '.give-final-total-amount' ).attr( 'data-total', unformattedAmount )
                .text( formattedAmount );
            giveForm.find( '.give-amount-top' ).val(unformattedAmount);
        }

        // Fill personal info fields.

        var firstNamePassedVal = giveCustom.getQueryVariable( 'first' ) !== false ? decodeURIComponent( giveCustom.getQueryVariable( 'first' ) ) : '';
        var lastNamePassedVal = giveCustom.getQueryVariable( 'last' ) !== false ? decodeURIComponent( giveCustom.getQueryVariable( 'last' ) ) : '';
        var emailPassedVal = giveCustom.getQueryVariable( 'email' ) !== false ? decodeURIComponent( giveCustom.getQueryVariable( 'email' ) ) : '';
        var campaignPassedVal = decodeURIComponent( getCookie("wordpress_hfjcampaign").replace(/\+/g, '%20'));

        var firstNameInput = giveForm.find( '#give-first-name-wrap input.give-input' );
        var lastNameInput = giveForm.find( '#give-last-name-wrap input.give-input' );
        var emailInput = giveForm.find( '#give-email-wrap input.give-input' );

        //UK

        //campaigns reg/once
        var campaignInput = giveForm.find( "#give-campaign-1069-14" );
        var campaignInput2 = giveForm.find( "#give-campaign-314-13" );
        //recruitment campaign reg/once
        var campaignInput3 = giveForm.find( "#give-recruitment_campaign-1069-20" );
        var campaignInput4 = giveForm.find( "#give-recruitment_campaign-314-19" );

        //US

        //campaigns reg/once
        var campaignInput5 = giveForm.find( "#give-campaign-1098-6" );
        var campaignInput6 = giveForm.find( "#give-campaign-1062-6" );
        //recruitment campaigns reg/once
        var campaignInput7 = giveForm.find( "#give-recruitment_campaign-1098-12" );
        var campaignInput8 = giveForm.find( "#give-recruitment_campaign-1062-12" );
        
        //Norway

        //once only recruitment campaign and campaign
        var campaignInput9 = giveForm.find( "#give-campaign-1119-11" );
        var campaignInput10 = giveForm.find( "#give-recruitment_campaign-1119-17" );

        //AU - not yet

        //local give-campaign-334-13 once
        //var campaignInput11 = giveForm.find( "#give-campaign-334-13" );

        if ( firstNamePassedVal !== false && firstNameInput.length > 0 ) {
            firstNameInput.val( firstNamePassedVal );
        }
        if ( lastNamePassedVal !== false && lastNameInput.length > 0 ) {
            lastNameInput.val( lastNamePassedVal );
        }
        if ( emailPassedVal !== false && emailInput.length > 0 ) {
            emailInput.val( emailPassedVal );
        }
        if ( campaignPassedVal !== false) {
            campaignInput.val( campaignPassedVal );
            campaignInput2.val( campaignPassedVal );
            campaignInput3.val( campaignPassedVal );
            campaignInput4.val( campaignPassedVal );
            campaignInput5.val( campaignPassedVal );
            campaignInput6.val( campaignPassedVal );
            campaignInput7.val( campaignPassedVal );
            campaignInput8.val( campaignPassedVal );
            campaignInput9.val( campaignPassedVal );
            campaignInput10.val( campaignPassedVal );
            //campaignInput11.val( campaignPassedVal );
        }
    };

    /**
     * Get Query Variable from URL.
     *
     * @param variable
     * @returns {string|boolean}
     */
    giveCustom.getQueryVariable = function( variable ) {
        var query = window.location.search.substring( 1 );
        var vars = query.split( '&' );
        for ( var i = 0; i < vars.length; i ++ ) {
            var pair = vars[ i ].split( '=' );
            if ( pair[ 0 ] == variable ) {
                return pair[ 1 ];
            }
        }
        return false;
    };

    // get cookie
    function getCookie(cname) {
      let name = cname + "=";
      let decodedCookie = decodeURIComponent(document.cookie);
      let ca = decodedCookie.split(';');
      for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return false;
    }

    giveCustom.init();

        } )( window, document, jQuery );
    </script>
    <?php
}

add_action( 'give_post_form_output', 'my_custom_give_populate_amount_name_email' );

/**
 * A local translation snippet for making text changes to only one of the forms.
 * Change 'YOUR TEXT HERE' to your desired text, and the "964" to the form ID you'd like to modify.
 *
 * Also, ensure that all functions here have unique names to avoid conflicts.
 *
 * @param $translations
 * @param $text
 * @param $domain
 *
 * @return mixed|string
 */
function my_give_picky_text_switcher( $translations, $text, $domain ) {

    // Only for the 'give' text domain.
    if ( $domain == 'give' && $text == 'First Name' ) {
        return __( 'Fornavn', 'give' );
    }

    if ( $domain == 'give' && $text == 'Last Name' ) {
        return __( 'Etternavn', 'give' );
    }

    if ( $domain == 'give' && $text == 'Email Address' ) {
        return __( 'E-post', 'give' );
    }

    if ( $domain == 'give' && $text == 'Card Number' ) {
        return __( 'Kortnummer', 'give' );
    }

    if ( $domain == 'give' && $text == 'Cardholder Name' ) {
        return __( 'Kortholders navn', 'give' );
    }

    if ( $domain == 'give' && $text == 'Secure Donation' ) {
        return __( 'Sikker Donasjon', 'give' );
    }

    if ( $domain == 'give' && $text == 'This is a secure SSL encrypted payment.' ) {
        return __( 'Sikker Donasjon', 'give' );
    }

    if ( $domain == 'give' && $text == 'Share on Facebook' ) {
        return __( 'Del p?? Facebook', 'give' );
    }

    if ( $domain == 'give' && $text == 'Share on Twitter' ) {
        return __( 'Del p?? Twitter', 'give' );
    }

    if ( $domain == 'give' && $text == 'Add your information' ) {
        return __( 'Legg til din informasjon', 'give' );
    }

    if ( $domain == 'give' && $text == 'A great big thank you' ) {
        return __( 'Tusen takk', 'give' );
    }

    if ( $domain == 'give' && $text == 'Choose an amount' ) {
        return __( 'Velg et bel??p', 'give' );
    }

    if ( $domain == 'give' && $text == 'Continue' ) {
        return __( 'Neste', 'give' );
    }

    if ( $domain == 'give' && $text == 'Donation Details' ) {
        return __( 'Donordetaljer', 'give' );
    }

    if ( $domain == 'give' && $text == 'Donor name' ) {
        return __( 'Navn p?? donor', 'give' );
    }

    if ( $domain == 'give' && $text == 'EMAIL ADDRESS' ) {
        return __( 'E-mailadresse', 'give' );
    }

    if ( $domain == 'give' && $text == 'PAYMENT METHOD' ) {
        return __( 'Betalingsmetode', 'give' );
    }

    if ( $domain == 'give' && $text == 'PAYMENT STATUS' ) {
        return __( 'Status p?? betaling', 'give' );
    }

    if ( $domain == 'give' && $text == 'Complete' ) {
        return __( 'Gjennomf??rt', 'give' );
    }

    if ( $domain == 'give' && $text == 'DONATION AMOUNT' ) {
        return __( 'Donasjonsbel??p', 'give' );
    }

    if ( $domain == 'give' && $text == 'DONATION TOTAL' ) {
        return __( 'Donasjoner totalt', 'give' );
    }


    return $translations;
    
}

/**
 * Conditional for gettext.
 *
 * @param $form_id
 */
function my_give_confirm_form( $form_id ) {

    // Customize form title here or remove conditional for all forms.
    if ( $form_id == 1119 || $form_id == 2341) {
        add_filter( 'gettext', 'my_give_picky_text_switcher', 10, 3 );
    }
}

add_action( 'give_pre_form_output', 'my_give_confirm_form', 10, 1 );


/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 */

function acf_responsive_image($image_id,$image_size,$max_width){

  // check the image ID is not blank
  if($image_id != '') {

    // set the default src image size
    $image_src = wp_get_attachment_image_url( $image_id, $image_size );

    // set the srcset with various image sizes
    $image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

    // generate the markup for the responsive image
    echo 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';

  }
}

add_filter( 'max_srcset_image_width', 'awesome_acf_max_srcset_image_width', 10 , 2 );

// set the max image width 
function awesome_acf_max_srcset_image_width() {
  return 2560;
} 
