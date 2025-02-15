<?php
/**
 *
 * @package UnderStrap
 */
defined( 'ABSPATH' ) || exit;
get_header(); 
$bgimage = get_field('banner_image');
$bottomSection = get_field('bottom_two_column_section');

if($bottomSection) {
    if($bottomSection['image']) {
        $btColumnImg = $bottomSection['image'];
    } else {
        $btColumnImg = $bgimage;
    }
}


 // Grid box system query Display list of taxonomies 

 $term_name = '' . get_field('location_track') . '';
 $terms = get_terms( array(
     'taxonomy' => 'location-track',
     'hide_empty' => false,
     'include' => $term_name,
 ) );
 foreach($terms as $term) {
     $arcResult =  $term->term_id;
 }
 $args = array(
     'post_type'  => 'loc-practice-area',  
    //  'post_parent__not_in' => array(0),
     'post_parent'    => $post->ID,
     'meta_query' => array(
         array(
             'key'     => 'location_track',
             'value'   => $arcResult,  
             'compare' => '='   
         ),
     ),
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


<?php if(get_field('banner_title')) : ?>
<div class="container-fluid site--banner py-4 position-relative"
    style="background-image:url('<?php echo $bgimage; ?>')">
    <h1 class="text-center mx-auto py-5 text-white position-relative"><?php the_field('banner_title'); ?></h1>
</div>
<?php endif; ?>

<div class="container-fluid py-4 site--content position-relative gap-3 d-flex justify-content-center flex-wrap">
    <a href="tel:1-800-411-7246" class="btn btn-primary py-3 px-4">Call for a free consultation</a>
    <a href="<?php echo site_url( ); ?>/#ContactUs" class="btn btn-primary py-3 px-4">Request a free consultation</a>
</div>


<!-- grid box system -->
<?php if($total_posts && !wp_get_post_parent_id(get_the_ID())) : ?>
<div class="container-fluid py-5 site--content">

    <div class="row">
        <div class="col-md-12">
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



<?php if(get_field('highlight_heading')) : ?>
<div class="container-fluid py-5 site--content">
    <div class="row">
        <div class="col-lg-8 site--description pe-lg-5">
            <h2 class="heading-highlight"><?php echo get_field('highlight_heading'); ?></h2>
            <?php the_field('top_content'); ?>
        </div>
        <div class="col-lg-4 ">
            <?php echo do_shortcode('[gravityform id="1" title="true" description="false"]'); ?>
        </div>
    </div>
</div>
<?php endif; ?>


<!-- FAQ's -->

<?php if(get_field('faq_section_title')) : ?>
<div class="container-fluid py-5 site--content faq--section">
    <div class="row">
        <div class="col-md-12">
            <h2 class="pb-5"><?php the_field('faq_section_title'); ?></h2>
            <div class="accordion" id="accordionExample">
                <?php if( have_rows('faqs') ): ?>
                <?php $i = 0;  while( have_rows('faqs') ): the_row(); 
                    $title = get_sub_field('question');
                    $content = get_sub_field('answer');
                    $i++; $tCount = $i;
                ?>

                <div class="accordion-item my-2 border-0">
                    <h2 class="accordion-header" id="heading-<?php echo $tCount; ?>">
                        <button class="accordion-button collapsed py-4" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-<?php echo $tCount; ?>" aria-expanded="true"
                            aria-controls="collapse-<?php echo $tCount; ?>">
                            <?php echo $title; ?>
                        </button>
                    </h2>
                    <div id="collapse-<?php echo $tCount; ?>" class="accordion-collapse collapse"
                        aria-labelledby="heading-<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>



<!-- Blog Post Section -->

<?php if(get_field('show_latest_blog') && get_field('select_post_category')) : ?>
<div class="container-fluid p-5 my-3 site--content post-secton">

    <div class="row">
        <div class="col text-center pb-5">
            <h4 class="heading-highlight">LEARN MORE</h4>
            <h2>Recent Blog Posts</h2>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
        <?php
            $catPost = get_field('select_post_category');
            $args = array(
                'post_type' => 'post',
                'cat' => $catPost, 
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post(); ?>

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
                    <?php the_excerpt(); ?>
                </div>
                <div class="card-footer bg-white border-0 pt-0 pb-3">
                    <a href="<?php the_permalink(); ?>" class="read-more-link text-decoration-none">Read More →</a>
                </div>
            </div>
        </div>

        <?php  } 
            
            wp_reset_postdata(); 
            } else {
                echo 'No posts found';
            }
        ?>
    </div>
</div>
<?php endif; ?>


<!-- bottom two column content 6 / 6-->

<?php if($bottomSection) : ?>
<?php if($bottomSection['content']) : ?>
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
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>