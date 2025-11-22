<?php
/**
 * The 404 error template
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main error-404" role="main">
    <div class="container">
        <div class="error-404-content">
            <h1 class="page-title"><?php esc_html_e( '404', 'weinvite' ); ?></h1>
            <h2 class="error-title"><?php esc_html_e( 'Page Not Found', 'weinvite' ); ?></h2>
            <p class="error-message">
                <?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'weinvite' ); ?>
            </p>
            <div class="error-actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                    <?php esc_html_e( 'Go to Homepage', 'weinvite' ); ?>
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
