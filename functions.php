<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_localize_script('jquery', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('my_nonce') // Example nonce if needed
    ));
	
    wp_enqueue_script('lightGallery', 'https://cdn.jsdelivr.net/npm/lightgallery.js/dist/js/lightgallery.min.js');
    
	wp_enqueue_script('slickSlider', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js', array(), NULL, true );
    wp_enqueue_style('slickStyle', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
	wp_enqueue_style('slickStyletheme', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

    wp_enqueue_style('googleFontPlayfair', '//fonts.googleapis.com/css2?family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap');
    wp_enqueue_style('googleFontLato', '//fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

    wp_enqueue_style('lightGallery', 'https://cdn.jsdelivr.net/npm/lightgallery.js/dist/css/lightgallery.min.css');
    
    wp_enqueue_style('customStyle', get_stylesheet_directory_uri() . '/custom-style.css');

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );


add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
		$path = get_stylesheet_directory() . '/acf-json';
		return $path;
}


// Location Practice Area

function my_location_practice_area_column($columns) {
	$columns['location_tracked'] =  'Location Tracker';
	return $columns;
}

add_filter('manage_loc-practice-area_posts_columns', 'my_location_practice_area_column');


function my_location_practice_area_custom_column($column, $post_id) {
	if($column === 'location_tracked') {
		$term_id = get_post_meta($post_id, 'location_track', true);
		$term = get_term($term_id);
		echo '<p class="badge-location ' . esc_html( $term->slug ) .'">' . esc_html( $term->slug ) .'</p>';
	}
}

add_action( 'manage_loc-practice-area_posts_custom_column', 'my_location_practice_area_custom_column', 10, 2);



// custom column header for all custom post type

function my_last_column_edit($columns) {
	$columns['last_modification'] =  'Last Modification';
	return $columns;
}
// Display content for custom column
function my_last_custom_column_edit($column, $post_id) {
	if($column === 'last_modification') {
		$last_modified_user_id = get_post_meta($post_id, '_edit_last', true);
        $user_info = get_userdata($last_modified_user_id);
        echo esc_html($user_info->display_name);
	}
}

function apply_custom_columns_to_all_cpt() {
    $post_types = get_post_types(['_builtin' => false], 'names');
    foreach ($post_types as $post_type) {
        add_filter("manage_{$post_type}_posts_columns", 'my_last_column_edit');
        add_action("manage_{$post_type}_posts_custom_column", 'my_last_custom_column_edit', 10, 2);
    }
}
add_action('admin_init', 'apply_custom_columns_to_all_cpt');



// custom column header for Pages
function custom_page_columns($columns) {
    $columns['last_modifications'] =  'Last Modification';
    return $columns;
}
add_filter('manage_pages_columns', 'custom_page_columns');

// Display content for custom column
function custom_page_column_content($column_name, $post_id) {
    if ($column_name === 'last_modifications') {
        $last_modified_user_id = get_post_meta($post_id, '_edit_last', true);
        $user_info = get_userdata($last_modified_user_id);
        echo esc_html($user_info->display_name);
    }
}
add_action('manage_pages_custom_column', 'custom_page_column_content', 10, 2);



// Location Track Filter
add_action('restrict_manage_posts', 'filter_by_acf_location_track');

function filter_by_acf_location_track() {
    global $typenow;
    $post_type = 'loc-practice-area'; // Custom post type
    $acf_field_name = 'location-track-value'; // ACF custom field

    if ($typenow == $post_type) {
        $selected = isset($_GET[$acf_field_name]) ? $_GET[$acf_field_name] : '';

        echo '<select name="' . $acf_field_name . '">';
        echo '<option value="">' . __('All Locations', 'your-text-domain') . '</option>';

        // Get terms from the taxonomy associated with location-track
        $terms = get_terms(array(
            'taxonomy' => 'location-track', // Replace with your taxonomy name
            'hide_empty' => false,
        ));

        foreach ($terms as $term) {
            printf(
                '<option value="%s"%s>%s</option>',
                $term->term_id,
                $term->term_id == $selected ? ' selected="selected"' : '',
                $term->name
            );
        }

        echo '</select>';
    }
}

add_filter('pre_get_posts', 'perform_acf_location_track_filtering');

function perform_acf_location_track_filtering($query) {
    global $pagenow;
    $post_type = 'loc-practice-area'; // Custom post type
    $acf_field_name = 'location-track-value'; // ACF custom field

    if ($pagenow == 'edit.php' && isset($_GET[$acf_field_name]) && $_GET[$acf_field_name] != '' && $query->is_main_query()) {
        $meta_query = array(
            array(
                'key' => 'location_track',
                'value' => $_GET[$acf_field_name],
                'compare' => '=', // Change the comparison operator if needed
            ),
        );
        $query->set('meta_query', $meta_query);
    }
}


// Hide the description box on custom taxonomies
add_action('admin_head', 'remove_taxonomy_description_field');

function remove_taxonomy_description_field() {
    $taxonomies = array('team-division', 'practice-division'); 

    $screen = get_current_screen();
    foreach ($taxonomies as $taxonomy) {
        if ($screen->id === 'edit-' . $taxonomy || $screen->id === $taxonomy) {
            echo '<style>
                .term-description-wrap {
                    display: none;
                }
            </style>';
            break;
        }
    }

    echo '<style>
            .badge-location {
                
                display: inline;
                color: #fff !important;
                padding: 3px 5px;
                border-radius: 5px;
                text-transform: uppercase;
                font-size: 10px !important;
                font-weight: bold;
                letter-spacing: 0.5px;
            }
            .cleveland {
            background: red;
            }
            .columbus {
            background: green;
            }
            .cincinnati {
            background: orange;
            }
            .dayton {
            background: blue;
            }
            .toledo {
            background: pink;
            }
            .akron {
            background: black;
            }
        </style>';
}

// post excerpt length define
function understrap_all_excerpts_get_more_link( $post_excerpt ) {

        $excerpt_word_count = 30; // Adjust this number as needed

        $words = explode( ' ', $post_excerpt );

        if ( count( $words ) > $excerpt_word_count ) {
            $words = array_slice( $words, 0, $excerpt_word_count );
            $post_excerpt = implode( ' ', $words );
        }

	return $post_excerpt;
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );


// page blocks templates
if( file_exists( get_theme_file_path("/blocks/block-functions.php") ) ) {
    include( get_theme_file_path("/blocks/block-functions.php") );
}


// single post pagination
function understrap_post_nav() {
    $previous = get_previous_post();
    $next = get_next_post();

    if ( ! $next && ! $previous ) {
        return;
    }
    ?>
<nav class="navigation post-navigation py-5" role="navigation">
    <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'understrap' ); ?></h2>
    <div class="nav-links d-flex justify-content-between">
        <?php if ( $previous ) : ?>
        <div class="nav-previous">
            <a href="<?php echo esc_url( get_permalink( $previous->ID ) ); ?>" rel="prev">
                <?php echo esc_html__( '<Older Post', 'understrap' ); ?>
            </a>
        </div>
        <?php endif; if ( $next ) : ?>
        <div class="nav-next">
            <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" rel="next">
                <?php echo esc_html__( 'Newer Post>', 'understrap' ); ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</nav>
<?php }



// Load more action function
add_action('wp_footer', 'my_post_loadmore');

function my_post_loadmore() { 
    $posts_per_page = get_option('posts_per_page');
    $post_count_direct = wp_count_posts();
    $total_posts = $post_count_direct->publish;
?>
<script type="text/javascript">
jQuery(document).ready(function($) {



    var post_count_direct = <?php echo $total_posts; ?>;
    var currentposts = <?php echo $posts_per_page; ?>;
    var page = 2;
    var post_count = Math.ceil(post_count_direct / currentposts);
    // var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';


    if (post_count_direct < currentposts) {
        jQuery('#load_more').hide();
    }

    jQuery('#load_more').click(function() {
        var data = {
            'action': 'my_action',
            'page': page,
        };
        jQuery.post(ajax_object.ajax_url, data, function(response) {

            jQuery('#posts_grid').append(response);
            if (post_count == page) {
                jQuery('#load_more').hide();
            }

            page++
        });

    });

});
</script>
<?php }

add_action('wp_ajax_my_action', 'my_action');
add_action('wp_ajax_nopriv_my_action', 'my_action');
function my_action() {
$args = array(
    'post_type' => 'post',
    'paged' => $_POST['page'],
    
);

$query = new WP_Query($args); ?>
<?php  if ($query->have_posts()) { while ($query->have_posts()) { $query->the_post(); ?>
<div class="col">
    <div class="card overflow-hidden shadow h-100">
        <a href="<?php the_permalink(); ?>" class="blog-post-ht overflow-hidden">
            <div class="bg-image-attached h-100 w-100"
                style="background-image:url('<?php the_post_thumbnail_url(); ?>')"></div>
        </a>
        <div class="card-body">
            <h5 class="card-title pb-2">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                    <?php the_title(); ?>
                </a>
            </h5>
            <p class="authorBar pb-4">
                <small>
                    By <?php the_author_meta('display_name', $post->post_author); ?> •
                    <?php echo get_the_date( ); ?>
                </small>
            </p>
            <?php the_excerpt(); ?>
        </div>
        <div class="card-footer bg-white border-0 pt-0 pb-3">
            <a href="<?php the_permalink(); ?>" class="read-more-link text-decoration-none text-primary"><strong>Read
                    More →</strong></a>
        </div>
    </div>
</div>
<?php  } wp_reset_postdata();  } wp_die( ); }

