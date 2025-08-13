<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package klsTheme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php $type = get_field('home-bg');
		$video_bg = $type['home-video'];
		?>
    <section class="hero" data-url="<?php echo $type['home-img']; ?>">

			<?php if ( $video_bg ) : ?>
        <div class="hero__clip">
          <video
                  src="<?php echo $video_bg; ?>"
                  playsinline
                  muted
                  autoplay
                  loop
                  class="hero__video"></video>
        </div>
			<?php endif; ?>

      <div class="hero__container">
				<?php $head = get_field('home-head'); ?>
        <h1 class="hero__head"><?php echo $head['home-title']; ?></h1>
      </div><!-- /.hero__container -->
    </section><!-- /.hero -->


	</main><!-- #main -->

<?php
get_footer();
