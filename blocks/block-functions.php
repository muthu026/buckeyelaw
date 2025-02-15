<?php
/**
 * Understrap Child Theme block functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


function my_custom_block_categories( $categories, $post ) {
    // Add a custom category
    $new_category = array(
        array(
            'slug'  => 'pageblocks',
            'title' => __( 'Page Blocks', 'understrap' ),
        ),
    );

    // Merge the custom category at the beginning of the existing categories
    return array_merge( $new_category, $categories );
}
add_filter( 'block_categories_all', 'my_custom_block_categories', 10, 2 );




function my_acf_init() {
    // Check if function exists and hook into setup.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'page-banner',
            'title'             => __('Page Banner'),
            'description'       => __('A custom block for page banner.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'cover-image',
            'keywords'          => array( 'banner', 'custom', 'block' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => array('wide', 'full'),
            ),
            'attributes' => array(
                'align' => array(
                    'default' => 'full'
                ),
            ),
			'example'           => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'banner_title'        => "Title Here",
                        'banner_image' => "http://buckeyelaw.local/wp-content/uploads/2024/07/pexels-photo-258187-1920w.jpeg",
						'is_preview'   => true
					)
				)
			)
        ));

        acf_register_block_type(array(
            'name'              => 'page-faq',
            'title'             => __('FAQ'),
            'description'       => __('A custom block for faq section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'archive',
            'keywords'          => array( 'faq', 'custom', 'block' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => array('wide', 'full'),
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'team',
            'title'             => __('Team'),
            'description'       => __('A custom block for team section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'groups',
            'keywords'          => array( 'team', 'custom', 'block' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => array('wide', 'full'),
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'gridbox',
            'title'             => __('Grid Box'),
            'description'       => __('A custom block for gridbox section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'screenoptions',
            'keywords'          => array( 'gridbox', 'custom', 'block' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => false,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'recentblog',
            'title'             => __('Recent Blog'),
            'description'       => __('A custom block for recentblog section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'admin-post',
            'keywords'          => array( 'recentblog', 'custom', 'block', 'blog' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => false,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'locationsbox',
            'title'             => __('Locations'),
            'description'       => __('A custom block for locations box section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'location',
            'keywords'          => array( 'locationsbox', 'custom', 'block', 'locations' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => false,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'twocolumn',
            'title'             => __('Two Column'),
            'description'       => __('A custom block for two column section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'columns',
            'keywords'          => array( 'twocolumn', 'custom', 'block', 'column' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => false,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'logocarousel',
            'title'             => __('Logo Carousel'),
            'description'       => __('A custom block for logo carousel section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'images-alt',
            'keywords'          => array( 'logo', 'custom', 'block', 'carousel' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => false,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'whychoose',
            'title'             => __('Why Choose'),
            'description'       => __('A custom block for why choose section.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'pageblocks',
            'icon'              => 'sticky',
            'keywords'          => array( 'why', 'custom', 'block', 'choose' ),
			'mode'				=> 'edit',
            'supports'           => array(
                'align' => false,
            ),
        ));

        

    }
}
add_action('acf/init', 'my_acf_init');


function my_acf_block_render_callback( $block ) {
    $slug = str_replace('acf/', '', $block['name']);
    
    if( file_exists( get_theme_file_path("/blocks/{$slug}.php") ) ) {
        include( get_theme_file_path("/blocks/{$slug}.php") );
    }
	
}