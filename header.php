<?php
/**
 * The header template
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="header-inner">

                <!-- Logo -->
                <div class="site-branding">
                    <?php
                    if ( has_custom_logo() ) :
                        the_custom_logo();
                    else :
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo">
                        </a>
                        <?php
                    endif;
                    ?>
                </div>

                <!-- Primary Navigation -->
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-icon"></span>
                        <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'weinvite' ); ?></span>
                    </button>

                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'container'      => 'div',
                        'container_class' => 'menu-container',
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </nav>

                <!-- User Actions -->
                <div class="header-actions">
                    <!-- Credit Balance (if authenticated) -->
                    <div class="credit-badge auth-required" style="display: none;">
                        <i class="icon icon-coin"></i>
                        <span class="credit-amount">0</span>
                    </div>

                    <!-- User Dropdown (if authenticated) -->
                    <div class="user-dropdown auth-required" style="display: none;">
                        <button class="user-dropdown-toggle" aria-expanded="false">
                            <img src="" alt="User Avatar" class="user-avatar">
                            <span class="user-name"></span>
                        </button>
                        <div class="user-dropdown-menu">
                            <a href="<?php echo esc_url( home_url( '/dashboard' ) ); ?>"><?php esc_html_e( 'Dashboard', 'weinvite' ); ?></a>
                            <a href="<?php echo esc_url( home_url( '/profile' ) ); ?>"><?php esc_html_e( 'Profile', 'weinvite' ); ?></a>
                            <a href="<?php echo esc_url( home_url( '/my-events' ) ); ?>"><?php esc_html_e( 'My Events', 'weinvite' ); ?></a>
                            <a href="#" class="logout-link"><?php esc_html_e( 'Logout', 'weinvite' ); ?></a>
                        </div>
                    </div>

                    <!-- Login/Register (if not authenticated) -->
                    <div class="header-auth-links auth-hidden">
                        <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="btn btn-outline btn-sm"><?php esc_html_e( 'Login', 'weinvite' ); ?></a>
                        <a href="<?php echo esc_url( home_url( '/register' ) ); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Get Started', 'weinvite' ); ?></a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="mobile-menu-inner">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'mobile-menu',
                'menu_class'     => 'mobile-nav-menu',
                'container'      => 'nav',
                'container_class' => 'mobile-navigation',
                'fallback_cb'    => false,
            ) );
            ?>

            <div class="mobile-menu-actions">
                <!-- Login/Register (if not authenticated) -->
                <div class="mobile-auth-links auth-hidden">
                    <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'Login', 'weinvite' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/register' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Get Started', 'weinvite' ); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="site-content">
