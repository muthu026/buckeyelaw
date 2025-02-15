<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="top-header-section bg-dark py-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-7 text-center text-sm-start header-top-left align-self-center">
                <?php echo get_field('call_to_action', 'options'); ?>
            </div>
            <div class="col-12 col-sm-5 text-center text-sm-end header-top-right">
                <span><a href="tel:1-800-411-7246"
                        class="text-white"><?php echo get_field('phone_number', 'options'); ?></a></span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70" id="1924055123" class="svg u_1924055123"
                    data-icon-name="wp-mobile_phone_chat_thin">
                    <g>
                        <path d="M27,16h4c0.6,0,1-0.4,1-1s-0.4-1-1-1h-4c-0.6,0-1,0.4-1,1S26.4,16,27,16z"></path>
                        <path d="M31,54h-4c-0.6,0-1,0.4-1,1s0.4,1,1,1h4c0.6,0,1-0.4,1-1S31.6,54,31,54z"></path>
                        <path d="M57,31c0-7.2-5.2-13.3-12-14.7V13c0-1.7-1.3-3-3-3H16c-1.7,0-3,1.3-3,3v44c0,1.7,1.3,3,3,3h26c1.7,0,3-1.3,3-3V45.7
		C51.8,44.3,57,38.2,57,31z M16,12h26c0.6,0,1,0.4,1,1v3.1c-0.3,0-0.7-0.1-1-0.1c-2.7,0-5.3,0.7-7.5,2H15v-5C15,12.4,15.4,12,16,12z
		 M42,58H16c-0.6,0-1-0.4-1-1v-5h28v5C43,57.6,42.6,58,42,58z M43,50H15V20h16.8c-3,2.7-4.8,6.7-4.8,11c0,2.8,0.8,5.5,2.2,7.9
		l-2.2,5.8c-0.1,0.4,0,0.8,0.2,1.1c0.2,0.2,0.4,0.3,0.7,0.3c0.1,0,0.2,0,0.4-0.1l5.8-2.2c2.4,1.5,5.1,2.2,7.9,2.2c0.3,0,0.7,0,1-0.1
		V50z M42,44c-2.6,0-5.1-0.8-7.2-2.2c-0.2-0.1-0.4-0.2-0.6-0.2c-0.1,0-0.2,0-0.4,0.1l-4.2,1.6l1.6-4.2c0.1-0.3,0.1-0.6-0.1-0.9
		C29.8,36.1,29,33.6,29,31c0-7.2,5.8-13,13-13c7.2,0,13,5.8,13,13S49.2,44,42,44z"></path>
                        <circle cx="35.5" cy="31.5" r="1.5"></circle>
                        <circle cx="42.5" cy="31.5" r="1.5"></circle>
                        <circle cx="49.5" cy="31.5" r="1.5"></circle>
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>

<nav id="main-nav" class="navbar navbar-expand-xl navbar-dark py-2" aria-labelledby="main-nav-label">

    <h2 id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
    </h2>


    <div class="<?php echo esc_attr( $container ); ?> header-nav">

        <!-- Your site branding in the menu -->
        <?php get_template_part( 'global-templates/navbar-branding' ); ?>

        <button class=" navbar-toggler bg-dark" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdownMobile" aria-controls="navbarNavDropdownMobile" aria-expanded="false"
            aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- The WordPress Menu goes here -->
        <?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse w-75 ps-3 text-xl-center',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav ms-auto',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 3,
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
        <div class="container d-xl-none">
            <?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse w-100 mt-3',
				'container_id'    => 'navbarNavDropdownMobile',
				'menu_class'      => 'navbar-nav',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 3,
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
        </div>
    </div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->