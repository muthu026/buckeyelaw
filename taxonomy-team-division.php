<?php
/**
 *
 * @package UnderStrap
 */
defined( 'ABSPATH' ) || exit;
get_header(); 

$term = get_queried_object();
$term_id = $term->term_id;
// echo $term_id;
$bgimage = get_field('banner_image', 'term_' . $term_id);

?>

<?php if(get_field('banner_title', 'term_' . $term_id)) : ?>
<div class="container-fluid site--banner py-4 position-relative"
    style="background-image:url('<?php echo $bgimage; ?>')">
    <h1 class="text-center mx-auto py-5 text-white position-relative">
        <?php echo get_field('banner_title', 'term_' . $term_id); ?>
    </h1>
</div>
<?php endif; ?>

<div class="container-fluid py-4 site--content position-relative gap-3 d-flex justify-content-center flex-wrap">
    <a href="tel:1-800-411-7246" class="btn btn-primary py-3 px-4">Call for a free consultation</a>
    <a href="<?php echo site_url( ); ?>/#ContactUs" class="btn btn-primary py-3 px-4">Request a free consultation</a>
</div>


<div class="container-fluid pt-5 mt-3 site--content">
    <div class="row">
        <div class="col-lg-12 site--description pe-lg-5">
            <h1 class="heading-highlight pb-0"><?php echo get_field('sub_heading', 'term_' . $term_id); ?></h1>
            <h2><?php echo get_field('heading', 'term_' . $term_id); ?></h2>
            <?php echo get_field('description', 'term_' . $term_id); ?>
        </div>
    </div>
</div>


<!-- grid box system -->

<?php if($term->count) : ?>
<div class="container-fluid site--content">

    <div class="row">
        <div class="col-md-12">

            <?php
            
        // Display list of taxonomy posts

        $args = array(
            'post_type' => 'our-team', // or your custom post type
            'tax_query' => array(
                array(
                    'taxonomy' => 'team-division', // Replace with your custom taxonomy
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ),
            ),
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        );

        $query = new WP_Query( $args );
    
        ?>

            <?php 
            
                if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); 

                $full_name = get_field('name');
                $name_parts = explode(' ', $full_name);
                $first_name = $name_parts[0];

            ?>

            <div class="col d-flex flex-column flex-md-row py-5 ps-lg-5">
                <div class="member--image mw-100 mw-sm-0 ps-lg-5">
                    <img src="<?php the_field('main_image'); ?>" alt="<?php the_field('name'); ?>">
                </div>
                <div class="memeber--details d-flex flex-column mw-100 mw-sm-0 justify-content-center">
                    <h2><?php the_field('name'); ?></h2>
                    <h4 class="heading-highlight"><?php the_field('position'); ?></h4>
                    <a class="bg-primary text-white px-5 py-3 special--btn text-uppercase text-decoration-none mt-4"
                        href="<?php the_permalink( ); ?>">
                        <strong>About <?php echo $first_name; ?></strong>
                    </a>
                </div>

            </div>

            <?php } wp_reset_postdata(); } ?>

        </div>
    </div>
</div>

<?php endif; ?>




<!-- bottom two column content 6 / 6-->

<?php if(get_field('bottom_content', 'term_' . $term_id)) : ?>
<div class="container-fluid site--content">
    <div class="row">
        <div class="col-12">
            <div class="content--right-area m-auto">
                <?php echo get_field('bottom_content', 'term_' . $term_id); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php get_footer(); ?>