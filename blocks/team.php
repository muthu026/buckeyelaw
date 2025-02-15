<?php

    defined( 'ABSPATH' ) || exit;

    $id = 'team_' . $block['id'];
 
    if( !empty($block['align']) ) {
        $className = ' align' . $block['align'];
    } else {
        $className = 'container';
    }
    
?>

<div id="<?php echo esc_attr($id); ?>" class="py-5 site--content team--section <?php echo esc_attr($className); ?>">
    <div class="row">
        <div class="col-md-12 gx-0">
            <?php if(get_field('title')) : ?>
            <h2 class="section-heading position-relative text-center pb-5">
                <?php the_field('title'); ?>
            </h2>
            <?php endif; ?>

        </div>

        <?php if( have_rows('members') ): ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4 teams-group" id="lightgallery2">
            <?php while( have_rows('members') ): the_row(); 
                $image = get_sub_field('profile_image');
                $name = get_sub_field('name');
                $position = get_sub_field('position');
            ?>
            <div class="col">
                <a class="pic" href="<?php echo $image; ?>" style="background-image:url('<?php echo $image; ?>');"></a>
                <div class="team--profile  text-center">
                    <span class="inner--card position-relative flex-column">
                        <h3 class="text-black"><?php echo $name; ?></h3>
                        <span class="heading-highlight text-uppercase d-block" style="letter-spacing:0px;">
                            <?php echo $position; ?>
                        </span>
                        <?php 
                        $link = get_sub_field('member_link');
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="special--btn bg-primary border-0 py-2 mt-4 text-white text-uppercase text-decoration-none"
                            href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <strong><?php echo esc_html( $link_title ); ?></strong>
                        </a>
                        <?php endif; ?>
                    </span>
                </div>

            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>



    </div>
</div>