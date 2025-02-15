<?php
/**
 *
 * @package UnderStrap
 */

 defined( 'ABSPATH' ) || exit;

get_header(); 


?>

<?php if(get_the_title( )) : ?>
<div class="container-fluid site--banner py-4 position-relative"
    style="background-image:url('<?php bloginfo('url'); ?>/wp-content/uploads/2024/07/newbuckeyeheader-2880w.jpg')">
    <h1 class="text-center mx-auto py-5 text-white position-relative">
        <?php the_title(); ?>
    </h1>
</div>
<?php endif; ?>

<div class="container-fluid py-5 mt-4 site--content">
    <div class="row">
        <div class="col-lg-8 site--description pe-lg-5">
            <h2><?php echo get_field('name'); ?></h2>
            <?php if( get_field('position') ): ?>
            <h4 class="heading-highlight pb-4"><?php echo get_field('position'); ?></h4>
            <?php endif; ?>
            <?php the_field('description'); ?>

            <?php 
                $images = get_field('logos');
                if( $images ): ?>
            <div class="gallary-box pb-5">
                <div id="lightgallery">
                    <?php foreach( $images as $image ): ?>

                    <a href="<?php echo esc_url($image); ?>">
                        <img src="<?php echo esc_url($image); ?>" alt="gallery-images" />
                    </a>

                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>


            <div class="contact--details">

                <?php if( have_rows('contact_list') ): ?>
                <?php

                    $post_id = get_the_ID(); 
                    $taxonomy = 'team-division'; 
                    $terms = wp_get_post_terms($post_id, $taxonomy);
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            if($term->name == 'Attorneys') {
                                echo "<h3>Attorney Contact</h3>";
                            } else {
                                echo "<h3>Administration Contact</h3>";
                            }
                        }
                    }

                ?>
                <div class="contact_list">
                    <?php while( have_rows('contact_list') ): the_row(); 
                    
                    $filter_email = get_sub_field('email');
                    $email_parts = explode('|', $filter_email);

                    ?>
                    <div class="cnt-lists">
                        <?php if(get_sub_field('title')) : ?>
                        <span class="cnt--head"><?php echo get_sub_field('title'); ?></span>
                        <?php endif; ?>
                        <?php if(get_sub_field('name')) : ?>
                        <span class="cnt-name"><?php echo get_sub_field('name'); ?></span>
                        <?php endif; ?>
                        <?php if(get_sub_field('office')) : ?>
                        <span class="cnt-office">Office: <?php echo get_sub_field('office'); ?></span>
                        <?php endif; ?>
                        <?php if(get_sub_field('direct')) : ?>
                        <span class="cnt-direct">Direct: <?php echo get_sub_field('direct'); ?></span>
                        <?php endif; ?>
                        <?php if(get_sub_field('cell')) : ?>
                        <span class="cnt-cell">Cell: <?php echo get_sub_field('cell'); ?></span>
                        <?php endif; ?>
                        <?php if(get_sub_field('phone')) : ?>
                        <span class="cnt-phone">Phone: <?php echo get_sub_field('phone'); ?></span>
                        <?php endif; ?>
                        <?php if(get_sub_field('fax')) : ?>
                        <span class="cnt-fax">Fax: <?php echo get_sub_field('fax'); ?></span>
                        <?php endif; ?>
                        <?php if(get_sub_field('email')) : ?>
                        <span class="cnt-email">
                            Email:
                            <?php foreach($email_parts as $email_part) { ?>

                            <a href="mailto:<?php echo $email_part; ?>">
                                <?php echo $email_part; ?>
                            </a> <span>or</span>

                            <?php } ?>

                        </span>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="col-lg-4 ">

            <?php if(get_field('hover_image')) : ?>
            <style>
            .profile--image:hover {
                background-image: url('<?php the_field('hover_image'); ?>') !important;
            }
            </style>
            <?php endif; ?>
            <?php if(get_field('main_image')) : ?>
            <div class="profile--image" style="background-image: url('<?php the_field('main_image'); ?>');"></div>
            <?php endif; ?>


            <?php if( have_rows('point_lists') ): ?>
            <div class="col-md-12 bg-black mt-4 p-4"><i class="fa-light fa-plus"></i>
                <div class="accordion team-single-acc" id="accordionExample">

                    <?php $i = 0;  while( have_rows('point_lists') ): the_row(); 
                                $title = get_sub_field('highlight_heading');
                                $content = get_sub_field('highlight_content');
                                $i++; $tCount = $i;
                            ?>

                    <div class="accordion-item my-2 border-0">
                        <h3 class="accordion-header bg-black" id="heading-<?php echo $tCount; ?>">
                            <button
                                class="accordion-button <?php echo ($tCount == 1) ? '' : 'collapsed'; ?> py-4 bg-black text-white shadow-none"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-<?php echo $tCount; ?>" aria-expanded="true"
                                aria-controls="collapse-<?php echo $tCount; ?>">
                                <?php echo $title; ?>
                            </button>
                        </h3>
                        <div id="collapse-<?php echo $tCount; ?>"
                            class="accordion-collapse collapse <?php echo ($tCount == 1) ? 'show' : ''; ?>"
                            aria-labelledby="heading-<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-black text-white">
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; ?>

                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php if(get_field('video_intro')) : ?>
<div class="container-fluid py-5 mb-4 site--content">
    <div class="row">
        <div class="col-md-12">
            <div class="embed-container">
                <?php the_field('video_intro'); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php get_footer(); ?>