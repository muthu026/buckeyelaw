<?php 

get_header();  

$args = array(
    'post_type' => 'post',
    'paged' => 1,
    
);
$query = new WP_Query($args); ?>

<div class="container-fluid site--banner py-4 position-relative"
    style="background-image:url('<?php bloginfo( 'url' ); ?>/wp-content/uploads/2024/07/newbuckeyeheader-2880w.jpg')">
    <h1 class="text-center mx-auto py-5 text-white position-relative">Blog</h1>
</div>

<div class="container py-5 my-5 px-5 site--content post-secton">
    <div id="posts_grid" class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        <?php  if ($query->have_posts()) {
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
                    <p class="authorBar pb-4">
                        <small>
                            By <?php the_author_meta('display_name', $post->post_author); ?> •
                            <?php echo get_the_date( ); ?>
                        </small>
                    </p>
                    <?php the_excerpt(); ?>
                </div>
                <div class="card-footer bg-white border-0 pt-0 pb-3">
                    <a href="<?php the_permalink(); ?>"
                        class="read-more-link text-decoration-none text-primary"><strong>Read
                            More →</strong></a>
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
    <div class="row text-center pt-5">
        <div class="col-md-12">
            <span id="load_more" class="bg-primary text-white px-5 py-2 special--btn">More Posts</span>
        </div>
    </div>

</div>



<?php get_footer(); ?>