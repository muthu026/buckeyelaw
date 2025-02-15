<?php

defined( 'ABSPATH' ) || exit;
$id = 'column_' . $block['id'];

?>

<div id="<?php echo esc_attr($id); ?>" class="container-fluid logo--carousel p-5">

    <div class="row px-5">
        <?php 
                $images = get_field('logo_carousel_images');
                if( $images ): ?>
        <div class="logocarousel">
            <?php foreach( $images as $image ): ?>

            <img src="<?php echo esc_url($image); ?>" alt="gallery-images" />

            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

</div>