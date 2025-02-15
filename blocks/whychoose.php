<?php

defined( 'ABSPATH' ) || exit;
$id = 'column_' . $block['id'];

$image = get_field('section_bg_image');

?>

<div id="<?php echo esc_attr($id); ?>" class="container-fluid why--choose p-5 position-relative"
    style="background-image:url('<?php echo $image; ?>')">

    <?php if(get_field('main_heading')) : ?>
    <div class="row pt-5">
        <div class="col text-center pb-5 position-relative">
            <h4 class="heading-highlight"><?php the_field('highlight_heading'); ?></h4>
            <h2 class="h1 text-white"><?php the_field('main_heading'); ?></h2>
        </div>
    </div>
    <?php endif; ?>

    <?php 
        $images = get_field('lists');
        if( $images ) { ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 pb-4">
        <?php foreach( $images as $image ): ?>
        <div class="col text-center position-relative">
            <span class="svg--icon"><?php echo $image['svg_code']; ?></span>
            <p class="py-2 m-0 text-white"><?php echo $image['title']; ?></p>
        </div>
        <?php endforeach; ?>

    </div>
    <?php } ?>


</div>