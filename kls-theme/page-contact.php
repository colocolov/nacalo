<?php
  //Template Name: Contact Page
  get_header();
?>

	<main id="primary" class="site-main main">

    <section class="contact-top">
      <div class="contact-top__container">

        <h2 class="heading contact-top__head"><?php _e( 'Contacts', 'kls' ); ?></h2>

        <div class="contact-top__info">
          <p class="contact-top__text"><?php echo get_field('contact-data-text'); ?></p>

	        <?php $email = get_field('kls-email-kleints', 'options');
          $phones = get_field('kls-phones', 'options'); ?>
          <div class="contact-top__item">
            <div class="contact-top__name"><?php _e( 'email', 'kls' ); ?></div>
            <a href="mailto:<?php echo $email; ?>" class="contact-top__link"><?php echo $email; ?></a>
          </div>
          <div class="contact-top__item">
            <div class="contact-top__name"><?php _e( 'Phone number', 'kls' ); ?></div>
            <a href="tel:&#43;<?php echo str_replace( array( ' ', '-', '+' ), array( '', '', '' ), $phones['kls-phone'] ); ?>" class="contact-top__link">&#43;<?php echo $phones['kls-phone']; ?></a>
          </div>
        </div>

      </div>
    </section>

    <section class="contact-bottom">
      <div class="contact-bottom__container">

        <h2 class="heading contact-top__head"><?php _e( 'Still have questions?', 'kls' ); ?></h2>

        <div class="contact-bottom__wrap">
          <p class="contact-bottom__text"><?php echo get_field('contact-form-head'); ?></p>
          <?php echo get_field('contact-send'); ?>
        </div>

      </div>
    </section>

	</main><!-- #main -->

<?php
get_footer();
