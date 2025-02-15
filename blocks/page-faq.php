<?php

    defined( 'ABSPATH' ) || exit;

    $id = 'faq_' . $block['id'];
 
    if( !empty($block['align']) ) {
        $className = ' align' . $block['align'];
    } else {
        $className = 'container';
    }
    
?>

<div id="<?php echo esc_attr($id); ?>" class="py-5 site--content faq--section <?php echo esc_attr($className); ?>">
    <div class="row">
        <div class="col-md-12 gx-0">
            <?php if(get_field('faq_section_title')) : ?>
            <h2 class="section-heading position-relative text-center pb-5">
                <?php the_field('faq_section_title'); ?>
            </h2>
            <?php endif; ?>
            <div class="accordion" id="accordionExample">
                <?php if( have_rows('faqs') ): ?>
                <?php $i = 0;  while( have_rows('faqs') ): the_row(); 
                    $title = get_sub_field('question');
                    $content = get_sub_field('answer');
                    $i++; $tCount = $i;
                ?>

                <div class="accordion-item my-2 border-0">
                    <h2 class="accordion-header" id="heading-<?php echo $tCount; ?>">
                        <button class="accordion-button collapsed py-4" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-<?php echo $tCount; ?>" aria-expanded="true"
                            aria-controls="collapse-<?php echo $tCount; ?>">
                            <?php echo $title; ?>
                        </button>
                    </h2>
                    <div id="collapse-<?php echo $tCount; ?>" class="accordion-collapse collapse"
                        aria-labelledby="heading-<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>