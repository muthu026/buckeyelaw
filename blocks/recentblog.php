<?php

    defined( 'ABSPATH' ) || exit;

    $id = 'gridbox_' . $block['id'];

?>



<!-- Blog Post Section -->

<div id="<?php echo esc_attr($id); ?>" class="container-fluid p-5 my-3 site--content post-secton">

    <div class="row">
        <div class="col text-center pb-5">
            <h4 class="heading-highlight">LEARN MORE</h4>
            <h2>Recent Blog Posts</h2>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
        <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
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
    <div class="row">
        <div class="col-md-12 py-5 text-center">
            <?php 
            $link = get_field('button_link');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="special--btn py-3 bg-primary text-white text-decoration-none text-center text-uppercase"
                href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                <strong><?php echo esc_html( $link_title ); ?></strong>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>