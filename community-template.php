<?php
/**
 * Template Name: Community Page Template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );


$args = array(
    'post_type' 		=> 'event',        
    'post_status' 		=> 'publish',
    'orderby'           => 'ID',
    'order'				=> 'ASC',
    'posts_per_page'    => -1
);

$post_query = new WP_Query($args);

?>

<style>

#community-header-div {
  background-image: url("https://buckeyelaw.wpenginepowered.com/wp-content/uploads/2024/07/pexels-photo-1963622.jpeg");
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background-position: 50% 50% !important;
  position: relative;
  height: 585px;
  background-attachment: fixed;
}

.community-page-wrapper {
  margin-top: 50px;
}


.community-overlay {
  background-color: rgba(0, 0, 0, 0.5);
  height: 585px;
  display: flex;
  align-items: center;
}

.header-community {
  display: flex;
  align-items: center;
}

.community-header {
  float: none !important;
  top: 0 !important;
  left: 0 !important;
  width: calc(100% - 300px) !important;
  position: relative !important;
  height: auto !important;
  padding-top: 2px !important;
  padding-left: 0 !important;
  padding-bottom: 2px !important;
  margin-right: auto !important;
  margin-left: auto !important;
  max-width: 813px !important;
  margin-top: 8px !important;
  margin-bottom: 8px !important;
  padding-right: 0 !important;
  min-width: 25px !important;
  display: block !important;
}


@media (max-width: 992px) {
  .community-flex {
    flex-direction: column;
  }

}

@media (max-width: 576px) {
  .community-page-wrapper {
    margin-left: 25px;
    margin-right: 25px;
    width: 85%;
  }
}

</style>

<div class="wrapper p-0" id="page-wrapper">

    <div id="community-header-div" class="row footer--top">
    <div class="community-overlay">
    <div class="col-12 text-white text-center position-relative header-community">
                <h2 class="community-header">Buckeye Law Group Proudly Serves Ohio As A Personal Injury Law Firm</h2>
</div>
</div>
</div>

    <div class="container p-0 community-page-wrapper" id="content" tabindex="-1">

        <div class="row">

            <?php
			// Do the left sidebar check and open div#primary.
			get_template_part( 'global-templates/left-sidebar-check' );
			?>

            <main class="site-main" id="main" style="padding-top: 15px; padding-bottom: 75px;">

                <div style="display: flex;" class="community-flex">
                    <div class="col-lg-8 col-md-12">
                        <?php the_content(); ?>

                        <div class="event-section">
                        <?php foreach($post_query->posts as $key=>$r) : ?>
                        <div class="event">
                            <h3><?php echo $r->event_title; ?></h3>
                            <?php if( $r->event_date) { ?><h4><?php echo $r->event_date; ?></h4><?php } ?>
                            <?php if( $r->event_time) { ?><h4><?php echo $r->event_time; ?></h4><?php } ?>
                            <?php if( $r->event_address) { ?><p><?php echo $r->event_address; ?></p><?php } ?>
                            <?php if( $r->event_description) { ?><p><?php echo $r->event_description; ?></p><?php } ?>
                            <?php if( $r->event_image) { ?><img src="<?php  echo get_field('event_image', $r->ID); ?>" style="width: 450px; height: auto;" /><?php } ?>
                            <?php if( $r->event_link) { ?><a href="<?php echo $r->event_link; ?>"><p>Learn More</p></a><?php } ?>
                        </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                    <?php get_template_part('global-templates/community-sidebar'); ?>
                </div>



            </main>

            <?php
			// Do the right sidebar check and close div#primary.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();