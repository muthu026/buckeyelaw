<?php

    defined( 'ABSPATH' ) || exit;

    $id = 'banner_' . $block['id'];
 
    if( !empty($block['align']) ) {
        $className = ' align' . $block['align'];
    } else {
        $className = 'container';
    }

    $image = get_field('banner_image');
    if( $image ) {
        echo wp_get_attachment_image( $image, 'full' );
    } 

    $type = get_field('type');

    
    
?>

<div id="<?php echo esc_attr($id); ?>"
    class="site--banner py-4 position-relative <?php echo esc_attr($className); ?> <?php echo $type; ?>"
    style="background-image:url('<?php echo $image; ?>')">

    <?php if($type != 'type2') : ?>
    <h1 class="text-center mx-auto py-5 my-3 text-white position-relative"><?php the_field('banner_title'); ?></h1>
    <?php endif; ?>

    <?php if($type == 'type2') : ?>
    <div class="container">
        <div class="inner-div-banner py-5 my-3 text-white position-relative">
            <?php the_field('description'); ?>
            <?php 
                $link = get_field('button_link');
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="home-button" href="<?php echo esc_url( $link_url ); ?>"
                target="<?php echo esc_attr( $link_target ); ?>">
                <?php echo esc_html( $link_title ); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<div class="container-fluid py-4 site--content position-relative gap-3 d-flex justify-content-center flex-wrap">
    <a href="tel:1-800-411-7246" class="btn btn-primary py-3 px-4">Call for a free consultation</a>
    <a href="<?php echo site_url( ); ?>/#ContactUs" class="btn btn-primary py-3 px-4">Request a free consultation</a>
</div>