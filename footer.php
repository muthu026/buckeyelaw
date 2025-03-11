<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
$bgimage = get_field('footer_top_bg_image', 'option');
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper p-0" id="wrapper-footer">

    <div class="<?php echo esc_attr( $container ); ?>">

        <!-- Footer Top Section -->





        <div class="row footer--top py-5" style="background-image:url('<?php echo $bgimage; ?>')">
            <div class="col-12 text-white text-center position-relative">
                <div class="inner--div mx-auto">
                    <h4 class="heading-highlight py-1">
                        <?php echo get_field('footer_top_heading_highlight', 'option'); ?>
                    </h4>
                    <h2>
                        <?php echo get_field('footer_top_section_heading', 'option'); ?>
                    </h2>

                    <div class="location--call py-4">
                        <?php
					
						$query = new WP_Query( array(
							'post_type' => 'location',
							'orderby' => 'menu_order',
							'order' => 'ASC'
						) );

						if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>

                        <?php if(get_field('phone_number')) : ?>
                        <a href="tel:<?php echo get_field('phone_number'); ?>">
                            <?php echo get_field('business_name'); ?> : <?php echo get_field('phone_number'); ?>
                        </a>
                        <?php endif; ?>

                        <?php } } wp_reset_postdata(); ?>

                    </div>

                </div>
            </div>
        </div>

        <!-- Footer Review Section -->

        <div class="row bg-dark">
        
            <div style="margin: 75px auto 0 !important; width: calc(100% - 146px) !important; max-width: 1081px !important; padding-top: 50px; padding-bottom: 50px;">

                <?php echo do_shortcode('[trustindex no-registration=google]'); ?>

                <?php echo do_shortcode('[trustindex no-registration=yelp]') ?>
                <div style="border-top: 1px solid #666; text-align: left;">
                    <a href="https://www.yelp.com/biz/buckeye-law-group-cleveland?adjust_creative=-kscCX6kKc10Dv_LWKDeaw&amp;utm_campaign=yelp_api_v3&amp;utm_medium=api_v3_business_lookup&amp;utm_source=-kscCX6kKc10Dv_LWKDeaw" style="color: #463939 !important; text-decoration: none !important;">Read more on Yelp.com >></a>
                </div>
            </div>
        </div>


        <!-- End Footer Review Section -->

        <!-- Footer Bottom Section -->

        <div class="row footer--bottom bg-dark">

            <!-- Footer Column 1 -->

            <div class="col-12 col-xl-4 left-column text-white pb-4 pb-xl-0">
                <?php 
					$image = get_field('footer_logo', 'option');
					if( $image ) {
						echo wp_get_attachment_image( $image, 'full' );
					}
				?>
                <?php echo get_field('footer_description', 'option'); ?>
                <p class="copy-right pt-5 d-none d-xl-block text-white">
                    © <?php echo date('Y'); ?> All Rights Reserved | The Buckeye Law Group Inc.
                    <a href="/privacy-policy">Privacy Policy</a>
					<a href="/sitemap_index.xml">Sitemap</a>
                </p>

            </div>


            <!-- Footer Column 2 -->


            <div class="col-12 col-xl-6 middle-column text-white pb-4 pb-xl-0">
                <h4 class="footer--title">Office Locations</h4>

                <div class="row">
                    <div class="col-sm-6">

                        <?php
						$featured_posts = get_field('footer_left_column_office_list', 'option');
						if( $featured_posts ): ?>
                        <ul class="pt-2">
                            <?php foreach( $featured_posts as $data ): ?>
                            <li>
                                <span class="office--name">
                                    <?php echo get_field('business_name', $data); ?> Office
                                </span>
                                <span class="office--address">
                                    <?php echo get_field('address', $data); ?>
                                </span>
                                <?php if (get_field('city', $data)) : ?>
                                <span class="office-city-code">
                                    <?php echo get_field('city', $data); ?>,
                                    <?php echo get_field('state_short', $data); ?>
                                    <?php echo get_field('zip_code', $data); ?>
                                </span>
                                <?php endif; ?>
                                <span class="office--number">
                                    <a href="tel:<?php echo get_field('phone_number', $data); ?>">
                                        <?php echo get_field('phone_number', $data); ?>
                                    </a>
                                </span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php wp_reset_postdata(); endif; ?>


                    </div>


                    <div class="col-sm-6">

                        <?php
						$featured_posts = get_field('footer_right_column_office_list', 'option');
						if( $featured_posts ): ?>
                        <ul>
                            <?php foreach( $featured_posts as $data ): ?>
                            <li>
                                <span class="office--name">
                                    <?php echo get_field('business_name', $data); ?> Office
                                </span>
                                <span class="office--address">
                                    <?php echo get_field('address', $data); ?>
                                </span>
                                <?php if (get_field('city', $data)) : ?>
                                <span class="office-city-code">
                                    <?php echo get_field('city', $data); ?>,
                                    <?php echo get_field('state_short', $data); ?>
                                    <?php echo get_field('zip_code', $data); ?>
                                </span>
                                <?php endif; ?>
                                <span class="office--number">
                                    <a href="tel:<?php echo get_field('phone_number', $data); ?>">
                                        <?php echo get_field('phone_number', $data); ?>
                                    </a>
                                </span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php wp_reset_postdata(); endif; ?>

                    </div>


                </div>
            </div>


            <!-- Footer Column 3 -->


            <div class="col-12 col-xl-2 right-column text-white">

                <h4 class="footer--title">Contact Us</h4>

                <span class="ph-footer py-2 d-flex">
                    <?php echo get_field('phone_number', 'options'); ?>
                </span>

                <div class="social-icons pt-3">
                    <?php if(get_field('facebook', 'options')) : ?>
                    <a href="<?php echo get_field('facebook', 'options'); ?>" class="facebook-icons" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <?php endif; ?>

                    <?php if(get_field('twitter', 'options')) : ?>
                    <a href="<?php echo get_field('twitter', 'options'); ?>" class="twitter-icons" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" fill="#fff" viewBox="0 0 256 256">
                            <path
                                d="M214.75,211.71l-62.6-98.38,61.77-67.95a8,8,0,0,0-11.84-10.76L143.24,99.34,102.75,35.71A8,8,0,0,0,96,32H48a8,8,0,0,0-6.75,12.3l62.6,98.37-61.77,68a8,8,0,1,0,11.84,10.76l58.84-64.72,40.49,63.63A8,8,0,0,0,160,224h48a8,8,0,0,0,6.75-12.29ZM164.39,208,62.57,48h29L193.43,208Z">
                            </path>
                        </svg>
                    </a>
                    <?php endif; ?>

                    <?php if(get_field('instagram', 'options')) : ?>
                    <a href="<?php echo get_field('instagram', 'options'); ?>" class="instagram-icons" target="_blank">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                    <?php endif; ?>

                    <?php if(get_field('tiktok', 'options')) : ?>
                    <a href="<?php echo get_field('tiktok', 'options'); ?>" class="tiktok-icons" target="_blank">
                        <svg width="20px" height="20px" viewBox="0 0 512 512" fill="#fff" id="icons"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M412.19,118.66a109.27,109.27,0,0,1-9.45-5.5,132.87,132.87,0,0,1-24.27-20.62c-18.1-20.71-24.86-41.72-27.35-56.43h.1C349.14,23.9,350,16,350.13,16H267.69V334.78c0,4.28,0,8.51-.18,12.69,0,.52-.05,1-.08,1.56,0,.23,0,.47-.05.71,0,.06,0,.12,0,.18a70,70,0,0,1-35.22,55.56,68.8,68.8,0,0,1-34.11,9c-38.41,0-69.54-31.32-69.54-70s31.13-70,69.54-70a68.9,68.9,0,0,1,21.41,3.39l.1-83.94a153.14,153.14,0,0,0-118,34.52,161.79,161.79,0,0,0-35.3,43.53c-3.48,6-16.61,30.11-18.2,69.24-1,22.21,5.67,45.22,8.85,54.73v.2c2,5.6,9.75,24.71,22.38,40.82A167.53,167.53,0,0,0,115,470.66v-.2l.2.2C155.11,497.78,199.36,496,199.36,496c7.66-.31,33.32,0,62.46-13.81,32.32-15.31,50.72-38.12,50.72-38.12a158.46,158.46,0,0,0,27.64-45.93c7.46-19.61,9.95-43.13,9.95-52.53V176.49c1,.6,14.32,9.41,14.32,9.41s19.19,12.3,49.13,20.31c21.48,5.7,50.42,6.9,50.42,6.9V131.27C453.86,132.37,433.27,129.17,412.19,118.66Z">
                            </path>
                        </svg>
                    </a>
                    <?php endif; ?>

                    <?php if(get_field('linkedin', 'options')) : ?>
                    <a href="<?php echo get_field('linkedin', 'options'); ?>" class="linkedin-icons" target="_blank">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <?php endif; ?>
                </div>
				
<div class="marketed-by pt-2">
 
</div>
            </div>
            <div class="col-12 d-block d-xl-none">
                <p class="copy-right pt-5 text-white">
                    © <?php echo date('Y'); ?> All Rights Reserved | The Buckeye Law Group Inc.
                    <a href="/privacy-policy">Privacy Policy</a>
					<a href="/sitemap_index.xml">Sitemap</a>
                </p>
            </div>

        </div><!-- .row -->

    </div><!-- .container(-fluid) -->

</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    lightGallery(document.getElementById('lightgallery'), {
        thumbnail: true
    });
    lightGallery(document.getElementById('lightgallery2'), {
        thumbnail: true,
        selector: '.pic',
    });
});
</script>
<?php wp_footer(); ?>

</body>

</html>