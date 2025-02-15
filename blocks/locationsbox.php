<?php

defined( 'ABSPATH' ) || exit;
$id = 'gridbox_' . $block['id'];
$rows = get_field('box_items');

if( $rows ) { ?>


<div id="<?php echo esc_attr($id); ?>" class="container-fluid py-5 mb-5 px-0 location-block">

    <?php if(get_field('box_title')) : ?>
    <div class="row pt-5">
        <div class="col">
            <h2 class="text-center special--title position-relative text-black">
                <?php the_field('box_title'); ?>
            </h2>
            <?php if(get_field('box_description')) : ?>
            <p class="text-center"><?php the_field('box_description'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="row py-5">
        <div class="col-md-12">

            <div class="grid-wrapper blocktype columns-3" style="grid-template-columns: repeat(3, minmax(250px, 1fr));">

                <?php foreach( $rows as $row ) { ?>

                <div class="card g-items position-relative overflow-hidden rounded-0">

                    <div class="bg-image-attached h-100 w-100"
                        style="background-image:url('<?php echo $row['image']; ?>')">
                    </div>
                    <div class="card-img-overlay p-0 rounded-0">

                        <?php 
                            $link = $row['link'];
                            if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="h-100 w-100 position-relative text-white text-decoration-none align-items-center d-flex justify-content-center p-4 p-md-2 text-center"
                            href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>

                        <?php endif; ?>

                    </div>

                </div>

                <?php }   ?>
            </div>
        </div>
    </div>

</div>

<?php } ?>