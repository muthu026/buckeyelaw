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
                        class="text-white btn btn-primary"><?php echo get_field('phone_number', 'options'); ?></a></span>
                
            </div>
        </div>
    </div>
</div>

<nav id="main-nav" class="navbar navbar-expand-xl navbar-dark py-2 " aria-labelledby="main-nav-label">

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