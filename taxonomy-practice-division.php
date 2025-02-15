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
$bottomSection = get_field('bottom_two_column_section', 'term_' . $term_id);


if($bottomSection) {
    if($bottomSection['image']) {
        $btColumnImg = $bottomSection['image'];

    } else {
        $btColumnImg = $bgimage;
    }
}

?>

<?php if(get_field('banner_title', 'term_' . $term_id)) : ?>
<div class="container-fluid site--banner py-4 position-relative"
    style="background-image:url('<?php echo $bgimage; ?>')">
    <h1 class="text-center mx-auto py-5 text-white position-relative">
        <?php echo get_field('banner_title', 'term_' . $term_id); ?>
    </h1>
</div>
<?php endif; ?>


<!-- grid box system -->

<?php if($term->count) : ?>
<div class="container-fluid py-5 mb-5 site--content">

    <div class="row pt-5">
        <div class="col-md-12">

            <?php
            
        // Display list of taxonomy posts

        $args = array(
            'post_type' => 'practice-area', // or your custom post type
            'tax_query' => array(
                array(
                    'taxonomy' => 'practice-division', // Replace with your custom taxonomy
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ),
            ),
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        );

        $query = new WP_Query( $args );

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

                    if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); 

                        if(has_post_thumbnail()) {
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
                            href="<?php the_permalink( ); ?>">
                            <?php the_title(); ?>
                        </a>

                    </div>
                </div>
                <?php } wp_reset_postdata(); } ?>
            </div>

        </div>
    </div>
</div>

<?php endif; ?>


<div class="container-fluid py-5 site--content">
    <div class="row">
        <div class="col-lg-8 site--description pe-lg-5">
            <h2 class="heading-highlight pb-0"><?php echo get_field('highlight_heading', 'term_' . $term_id); ?></h2>
            <?php echo get_field('top_content', 'term_' . $term_id); ?>
        </div>
        <div class="col-lg-4">
            <?php echo do_shortcode('[gravityform id="1" title="true" description="false"]'); ?>
        </div>
    </div>
</div>

<!-- bottom two column content 6 / 6-->

<?php if($bottomSection) : ?>
<?php if($bottomSection['content']) : ?>
<div class="container-fluid bottom-two-column">
    <div class="row">
        <div class="col-12 col-lg-6 left--image" style="background-image:url('<?php echo $btColumnImg; ?>')"></div>
        <div class="col-12 col-lg-6 right--content p-5">
            <div class="content--right-area m-auto">
                <?php echo $bottomSection['content']; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>