<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package klsTheme
 */

?>

	<footer id="colophon" class="site-footer">
		<?php
      $location = get_field('kls-location', 'options');
      $phones = get_field('kls-phones', 'options');
      $schedule = get_field('kls-schedule', 'options');
      $menu = get_field('kls-menu-foot', 'options');
		?>

    <div class="footer__container">

      <div class="footer__part">
        <h3 class="footer__head"><?php _e( 'Services', 'kls' ); ?></h3>
        <ul class="footer__list">
					<?php foreach ($menu as $item) : ?>
            <li class="footer__item"><a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a></li>
					<?php endforeach; ?>
        </ul>
      </div><!-- /.footer__item -->

      <div class="footer__part">

        <h3 class="footer__head"><?php _e( 'Contacts', 'kls' ); ?></h3>
        <div class="footer__list">
          <p class="footer__item"><?php _e('Address', 'kls'); ?>: <a href="<?php echo $location['kls-location-url']; ?>" target="_blank"><?php echo $location['kls-address']; ?></a></p>
          <p class="footer__item"><?php _e('Email', 'kls'); ?>: <a href="mailto:<?php $email = get_field('kls-email-kleints', 'options'); echo $email; ?>"><?php $email = get_field('kls-email-kleints', 'options'); echo $email; ?></a></p>
          <?php
            $clean_number = str_replace(array(' ', '-', '+'), '', $phones['kls-phone']);
            $country_code = '+373';
            $remaining_number = substr($phones['kls-phone'], strlen($country_code));
          ?>
          <p class="footer__item"><?php _e('Phone', 'kls'); ?>: <a href="tel:&#43;<?php echo $clean_number; ?>"><?php echo $remaining_number; ?></a></p>
          <p class="footer__item"><?php _e('Fax', 'kls'); ?>: <a href="tel:&#43;<?php echo str_replace( array( ' ', '-', '+' ), array( '', '', '' ), $phones['kls-fax'] ); ?>">&#43;<?php echo $phones['kls-fax']; ?></a></p>
        </div>
      </div><!-- /.footer__item -->

      <div class="footer__part">
        <h3 class="footer__head"><?php _e( 'Schedule', 'kls' ); ?></h3>
        <div class="footer__list">
          <div class="footer__item"><?php _e('Work schedule', 'kls'); ?>: <?php echo $schedule['kls-schedule-time']; ?></div>
          <div class="footer__item"><?php echo $schedule['kls-schedule-days']; ?></div>
        </div>
      </div><!-- /.footer__item -->

    </div>
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

  </div><!-- /.wrapper -->
</body>
</html>
