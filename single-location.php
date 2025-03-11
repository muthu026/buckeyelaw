<?php

/**
 *
 * @package UnderStrap
 */
defined('ABSPATH') || exit;
get_header();
$bgimage = get_field('banner_image');
$bottomSection = get_field('bottom_two_column_section');
$claiPagesList = get_field('clai_pages_list');
$claiSectionTitle = get_field('clai_section_title') ? get_field('clai_section_title') : "Choose the Type of Personal Injury Lawyer Legal Support You Need:";

if ($bottomSection) {
    if ($bottomSection['image']) {
        $btColumnImg = $bottomSection['image'];
    } else {
        $btColumnImg = $bgimage;
    }
}

?>

<style>

    .clai-pages-grid-container {
        padding: 10em;
        margin-bottom: 1em;
    }

    .clai-pages-grid-container h2 {
        text-align: center;
    }

    .clai-pages-grid > ul {
        margin-top: 2em;
        margin-bottom: 1em;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(315px, 1fr));
    }

    @media only screen and (max-width: 600px) {
        .clai-pages-grid-container {
            padding: 2em;
        }
        .clai-pages-grid > ul {
            grid-template-columns: auto;
        }
    }
</style>

<?php if (get_field('banner_title')) : ?>
    <div class="container-fluid site--banner py-4 position-relative"
        style="background-image:url('<?php echo $bgimage; ?>')">
        <h1 class="text-center mx-auto py-5 text-white position-relative"><?php the_field('banner_title'); ?></h1>
    </div>
<?php endif; ?>

<div class="container-fluid py-4 site--content position-relative gap-3 d-flex justify-content-center flex-wrap">
    <a href="tel:1-800-411-7246" class="btn btn-primary py-3 px-4">Call for a free consultation</a>
    <a href="<?php echo site_url(); ?>/#ContactUs" class="btn btn-primary py-3 px-4">Request a free consultation</a>
</div>

<div class="container-fluid py-5 site--content location-content">
    <div class="row">
        <div class="col-lg-8 site--description pe-lg-4">
            <?php the_field('location_content'); ?>
        </div>
        <div class="col-lg-4 location--details">
            <h4 class="heading-highlight"><?php the_field('state'); ?> Location</h4>
            <h2 class="pb-3"><?php the_field('business_name'); ?></h2>

            <span class="office--address">
                <?php the_field('address'); ?>
            </span>
            <?php if (get_field('city')) : ?>
                <span class="office-city-code">
                    <?php the_field('city'); ?>,
                    <?php the_field('state_short'); ?>
                    <?php the_field('zip_code'); ?>
                </span>
            <?php endif; ?>
            <span class="office--number">
                <a href="tel:<?php the_field('phone_number'); ?>">
                    <?php the_field('phone_number'); ?>
                </a>
            </span>

            <div class="location--map py-5">
                <?php echo get_field('map_iframe'); ?>
            </div>


        </div>
    </div>
</div>

<!-- grid box system -->

<div class="container-fluid py-5 mb-5 site--content">
    <div class="row py-5">
        <div class="col">
            <h2 class="text-center text-black"><?php the_field('business_name'); ?> Practice Areas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <?php

            // Display list of taxonomies 

            $term_name = '' . get_field('business_name') . '';

            $terms = get_terms(array(
                'taxonomy' => 'location-track',
                'hide_empty' => false,
                'name__like' => $term_name,
            ));

            foreach ($terms as $term) {
                $arcResult =  $term->term_id;
            }
            $args = array(
                'post_type'  => 'loc-practice-area',
                'post_parent' => 0,
                'meta_query' => array(
                    array(
                        'key'     => 'location_track',
                        'value'   => $arcResult,
                        'compare' => '='
                    ),
                ),
            );

            $query = new WP_Query($args);

            $total_posts = $query->found_posts;

            if ($total_posts === 1 || $total_posts === 2 || $total_posts === 3 || $total_posts === 5) {
                $columns = 3;
            } elseif ($total_posts === 4 || $total_posts === 6 || $total_posts === 7 || $total_posts === 8) {
                $columns = 4;
            } else {
                $columns = 5;
            }


            ?>

            <div class="grid-wrapper columns-<?php echo $columns; ?>"
                style="grid-template-columns: repeat(<?php echo $columns; ?>, minmax(250px, 1fr));">

                <?php
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();

                        if (has_post_thumbnail()) {
                            $bgImage = get_the_post_thumbnail_url();
                        } else {
                            $bgImage = get_field('banner_image');
                        }
                ?>
                        <div class="card g-items position-relative overflow-hidden rounded-0">
                            <div class="bg-image-attached h-100 w-100" style="background-image:url('<?php echo $bgImage; ?>')">
                            </div>
                            <div class="card-img-overlay p-0 rounded-0">
                                <a class="h-100 w-100 position-relative text-white text-decoration-none align-items-center d-flex justify-content-center p-4 p-md-2 text-center"
                                    href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>

                            </div>
                        </div>
                <?php }
                    wp_reset_postdata();
                } ?>
            </div>

        </div>
    </div>
</div>



<!-- bottom two column content 5 / 7-->

<?php if ($bottomSection) : ?>
    <?php if ($bottomSection['content']) : ?>
        <div class="container-fluid bottom-two-column">
            <div class="row">
                <div class="col-12 col-lg-6 left--image" style="background-image:url('<?php echo $btColumnImg; ?>')"></div>
                <div class="col-12 col-lg-6 right--content px-2 py-5">
                    <div class="content--right-area m-auto">
                        <?php echo $bottomSection['content']; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($claiPagesList) { ?>
                <div class="container-fluid py-5 site--content location-content clai-pages-grid-container">
                    <h2><?php echo $claiSectionTitle; ?></h2>
                    <div class="clai-pages-grid">
                        <?php echo $claiPagesList; ?>
                    </div>
                </div>
        <?php 
        } ?>

    <?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>