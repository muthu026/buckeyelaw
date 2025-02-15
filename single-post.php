<?php

defined( 'ABSPATH' ) || exit;

get_header();

$bgimage = get_the_post_thumbnail_url();

global $post;

?>
<div class="container-fluid site--banner position-relative text-center"
    style="background-image:url('<?php echo $bgimage; ?>')">
    <h1 class="text-center mx-auto text-white position-relative p-0 m-0"><?php the_title( ); ?></h1>
    <span class="auth-and-date text-white mx-auto position-relative pt-5">
    </span>

</div>

<div class="container-fluid py-4 site--content position-relative gap-3 d-flex justify-content-center flex-wrap">
    <a href="tel:1-800-411-7246" class="btn btn-primary py-3 px-4">Call for a free consultation</a>
    <a href="<?php echo site_url( ); ?>/#ContactUs" class="btn btn-primary py-3 px-4">Request a free consultation</a>
</div>

<?php
while ( have_posts() ) {
    the_post(); ?>

<div class="container py-5 my-5 px-5 site--content">
    <div class="row pt-4">
        <div class="col-md-12 pb-3">
            <?php the_post_thumbnail( 'full'); ?>
        </div>
        <div class="col-md-12">
            <?php 
            the_content(); 
            understrap_post_nav();
            ?>
        </div>

        <div id="posts_grid" class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 post-secton">
            <?php
            
            $args = array(
                'post_type' => 'post',
                'paged' => 1,
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
                    <!-- <div class="card-footer bg-white border-0 pt-0 pb-3">
                        <a href="<?php the_permalink(); ?>" class="read-more-link text-decoration-none">Read More →</a>
                    </div> -->
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
    <div class="row text-center pt-5">
        <div class="col-md-12">
            <span id="load_more" class="bg-primary text-white px-5 py-2 special--btn">More Posts</span>
        </div>
    </div>
</div>

<?php } ?>


<?php get_footer(); ?>