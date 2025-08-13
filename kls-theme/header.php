<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package klsTheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="page">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php if ( $args ) :
    body_class( $args['class']);
  else :
    body_class(' page__body');
  endif; ?>>
<?php wp_body_open(); ?>
  <div class="wrapper">

    <header class="header">
      <div class="header__container">

		  <?php
        $phones = get_field('kls-phones','options');
        $socials = get_field('kls-socials', 'options');
        $logos = get_field('kls-logos','options');
        if ($logos['kls-logo-top']) :
          $logo = $logos['kls-logo-top'];
        else :
          $logo = get_template_directory_uri() . '/assets/images/logo.svg';
        endif;
        the_custom_logo();
        if ( is_front_page() || is_home() ) :
		  ?>
        <div class="header__logo">
          <img src="<?php echo $logo; ?>" width="157" height="50" alt="<?php echo get_bloginfo('name'); ?>">
        </div><!-- /.header__logo -->
		  <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo">
          <img src="<?php echo $logo; ?>" width="157" height="50" alt="<?php echo get_bloginfo('name'); ?>">
        </a><!-- /.header__logo -->
      <?php endif; ?>

      <!-- // PHONE-->
      <?php if( !empty($phones['kls-phone']) ) : ?>
        <a href="tel:&#43;<?php echo str_replace( array( ' ', '-', '+' ), array( '', '', '' ), $phones['kls-phone'] ); ?>">&#43;<?php echo $phones['kls-phone']; ?></a>
      <?php endif; ?>

      <!-- // MENU-->
      <nav id="site-navigation" class="main-navigation menu__body" title="Main navigation">
	      <?php
	      wp_nav_menu(
			      array(
					      'theme_location'  => 'menu-top',
					      'container'       => false,
					      'menu_class'      => 'menu__list',
					      'menu_id'         => false,
					      'echo'            => true,
					      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			      )
	      );
	      ?>
      </nav><!-- #site-navigation -->

      <!-- LANG -->
      <div class="language-menu" data-da=".menu__body">
        <?php if ( has_nav_menu( 'menu-lang' ) ) :
          wp_nav_menu( [
              'theme_location'  => 'menu-lang',
              'container'       => false,
              'menu_class'      => 'menu-languages',
              'menu_id'         => false,
              'echo'            => true,
              'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'depth'           => 0,
          ] );
        endif;
        ?>
      </div><!-- /.language-menu -->

      <button type="button" aria-label="Open Menu" aria-expanded="false" class="menu__icon">
        <span></span>
        <span></span>
        <span></span>
      </button>

    </div><!-- /.container -->
  </header><!-- /.header -->
