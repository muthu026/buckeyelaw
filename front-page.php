<?php
/**
 *
 * @package UnderStrap
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<?php the_content(); ?>

<div id="contact--section" class="container-fluid contact--form position-relative">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 position-relative">
                <?php echo do_shortcode('[gravityform id="1" title="true" description="false"]'); ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<?php
get_footer(); ?>