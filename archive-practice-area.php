<?php
/**
 *
 * @package UnderStrap
 */

get_header(); 

?>

<div class="container-fluid site--banner py-4 position-relative archive-page"
    style="background-image:url('<?php bloginfo('url'); ?>/wp-content/uploads/2024/07/pexels-photo-258187-1920w.jpeg')">

    <h1 class="py-5 text-white position-relative">
        <span class="heading-highlight text-white d-block pb-2">
            SERVING MAJOR OHIO CITIES
        </span>
        Personal Injury Practice Areas
    </h1>
</div>

<div class="container-fluid py-4 site--content position-relative gap-3 d-flex justify-content-center flex-wrap">
    <a href="tel:1-800-411-7246" class="btn btn-primary py-3 px-4">Call for a free consultation</a>
    <a href="<?php echo site_url( ); ?>/#ContactUs" class="btn btn-primary py-3 px-4">Request a free consultation</a>
</div>

<div class="container-fluid py-5 mb-5 site--content">
    <div class="row py-5">
        <div class="col">
            <h2 class="text-center special--title position-relative text-black">Practice Areas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <?php
            
    // Display list of taxonomies

    $terms = get_terms( array(
        'taxonomy' => 'practice-division',
        'hide_empty' => false,
        'posts_per_page' => -1,
        'meta_key' => 'term_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    ) );

    // Train Derailment Removed same as live site
    array_shift($terms);

    if (count($terms) === 1 || count($terms) === 2 || count($terms) === 3 || count($terms) === 5) {
        $columns = 3;
    } elseif (count($terms) === 4 || count($terms) === 6 || count($terms) === 7 || count($terms) === 8) {
        $columns = 4;
    } else {
        $columns = 5;
    }
    
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { ?>

            <div class="grid-wrapper columns-<?php echo $columns; ?>"
                style="grid-template-columns: repeat(<?php echo $columns; ?>, minmax(250px, 1fr));">

                <?php foreach ( $terms as $term ) {  
                    
                        if(get_field('archive_custom_photo', 'term_' . $term->term_id)) {
                            $bgImage = get_field('archive_custom_photo', 'term_' . $term->term_id);
                        } else {
                            $bgImage = get_field('banner_image', 'term_' . $term->term_id);
                        }
                    
                ?>

                <div class="card g-items position-relative overflow-hidden rounded-0">
                    <div class="bg-image-attached h-100 w-100" style="background-image:url('<?php echo $bgImage; ?>')">
                    </div>
                    <div class="card-img-overlay p-0 rounded-0">
                        <a class="h-100 w-100 position-relative text-white text-decoration-none align-items-center d-flex justify-content-center p-4 p-md-2 text-center"
                            href="<?php bloginfo( 'url' ); ?>/practice-areas/<?php echo $term->slug; ?>">
                            <?php echo $term->name; ?>
                        </a>

                    </div>
                </div>

                <?php   }  ?>
            </div>

            <?php  }  ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>