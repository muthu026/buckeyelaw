<?php

defined( 'ABSPATH' ) || exit;
$id = 'column_' . $block['id'];

$alignment = get_field('image_alignment'); // right, left 
$type = get_field('column_type'); // sixbysix, fivebyseven

$order = '';

if($alignment == 'right') {
    $order = 'order-lg-2';
}
?>

<div id="<?php echo esc_attr($id); ?>" class="container-fluid py-5 mb-5 px-0 twoColumn-block">

    <div class="container-fluid bottom-two-column">
        <div class="row">
            <div class="col-12 <?php echo $type == 'fivebyseven' ? 'col-lg-5' : 'col-lg-6'; ?> left--image <?php echo $order; ?>"
                style="background-image:url('<?php the_field('image'); ?>')"></div>
            <div class="col-12 <?php echo $type == 'fivebyseven' ? 'col-lg-7' : 'col-lg-6'; ?> right--content p-5">
                <div class="content--right-area m-auto">
                    <?php the_field('content'); ?>
                </div>
            </div>
        </div>
    </div>

</div>