<?php
/**
 *
 * @package UnderStrap
 */

get_header(); 

?>

<div class="container-fluid site--banner py-4 position-relative archive-page"
    style="background-image:url('<?php bloginfo('url'); ?>/wp-content/uploads/2024/07/newbuckeyeheader-2880w.jpg')">

    <h1 class="py-5 text-white position-relative text-center mx-auto">
        Locations
    </h1>
</div>

<div class="container-fluid py-5 site--content">
    <div class="row py-5">
        <div class="col">
            <h2 class="text-center h1 position-relative text-black">The Buckeye Law Group Locations</h2>
            <p class="text-center pt-4">The Buckeye Law Group is proud to represent clients throughout the entire state
                of Ohio. If you’ve been
                injured in an accident, don’t hesitate to contact one of our Ohio personal injury offices.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 text-center g-5">


                <?php
            $args = array(
                'post_type' => 'location',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) { while ($query->have_posts()) { $query->the_post(); ?>

                <div class="col mb-5">
                    <?php echo get_field('map_iframe'); ?>
                    <h3 class="pt-4"><?php echo get_field('business_name'); ?></h3>
                    <div class="loc-address mt-4">
                        <p><?php echo get_field('address'); ?></p>
                        <p>
                            <?php echo get_field('city'); ?>,
                            <?php echo get_field('state_short'); ?>
                            <?php echo get_field('zip_code'); ?></p>
                        <p>
                            <a href="tel:<?php echo get_field('phone_number'); ?>">
                                <?php echo get_field('phone_number'); ?>
                            </a>
                        </p>
                    </div>
                    <a href=""
                        class="bg-primary text-white px-5 py-2 special--btn text-uppercase text-decoration-none mt-4">See
                        Location</a>
                </div>

                <?php }   wp_reset_postdata();  } ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>