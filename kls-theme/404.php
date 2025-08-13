<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package klsTheme
 */

get_header();
?>

  <main id="primary" class="site-main main">

    <section class="error-404 not-found">
      <div class="error-404__container">
        <header class="page-header">
          <h1 class="page-title heading"><?php
						esc_html_e( 'Oops! That page can&rsquo;t be found.', 'kls' ); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
          <p><?php
						esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or other page?',
								'kls' ); ?></p>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-reset btn-error" rel="home"><?php _e( 'Go home', 'kls' ); ?></a>

					<?php
					// get_search_form();

					// the_widget( 'WP_Widget_Recent_Posts' );
					?>

        </div><!-- .page-content -->
      </div>
    </section><!-- .error-404 -->

  </main><!-- #main -->

<?php
get_footer();
