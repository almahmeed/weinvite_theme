<?php
/**
 * WeInvite Events Theme Functions
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme Setup
 */
function weinvite_theme_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Register navigation menus
    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'weinvite' ),
        'footer'    => __( 'Footer Menu', 'weinvite' ),
    ) );

    // Add image sizes
    add_image_size( 'event-thumbnail', 300, 200, true );
    add_image_size( 'event-medium', 600, 400, true );
    add_image_size( 'event-large', 1200, 800, true );
}
add_action( 'after_setup_theme', 'weinvite_theme_setup' );

/**
 * Enqueue Styles and Scripts
 */
function weinvite_enqueue_scripts() {
    // Main stylesheet (compiled from SCSS)
    wp_enqueue_style(
        'weinvite-main',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/style.css' )
    );

    // jQuery (WordPress default)
    wp_enqueue_script( 'jquery' );

    // Firebase SDK
    wp_enqueue_script(
        'firebase-app',
        'https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js',
        array(),
        '9.22.0',
        true
    );

    wp_enqueue_script(
        'firebase-auth',
        'https://www.gstatic.com/firebasejs/9.22.0/firebase-auth-compat.js',
        array( 'firebase-app' ),
        '9.22.0',
        true
    );

    // Custom JavaScript modules
    wp_enqueue_script(
        'weinvite-firebase-auth',
        get_template_directory_uri() . '/assets/js/firebase-auth.js',
        array( 'firebase-app', 'firebase-auth' ),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'weinvite-api-client',
        get_template_directory_uri() . '/assets/js/api-client.js',
        array( 'weinvite-firebase-auth' ),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'weinvite-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'jquery', 'weinvite-api-client' ),
        '1.0.0',
        true
    );

    // Localize script with data
    wp_localize_script( 'weinvite-main', 'weinviteData', array(
        'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
        'apiUrl'        => esc_url_raw( rest_url( 'weinvite/v1' ) ),
        'homeUrl'       => esc_url( home_url( '/' ) ),
        'loginUrl'      => esc_url( home_url( '/login' ) ),
        'dashboardUrl'  => esc_url( home_url( '/dashboard' ) ),
        'nonce'         => wp_create_nonce( 'wp_rest' ),
        'firebaseConfig' => array(
            'apiKey'            => get_option( 'weinvite_firebase_api_key', '' ),
            'authDomain'        => get_option( 'weinvite_firebase_auth_domain', '' ),
            'projectId'         => get_option( 'weinvite_firebase_project_id', '' ),
            'storageBucket'     => get_option( 'weinvite_firebase_storage_bucket', '' ),
            'messagingSenderId' => get_option( 'weinvite_firebase_messaging_sender_id', '' ),
            'appId'             => get_option( 'weinvite_firebase_app_id', '' ),
        ),
        'currentUser'   => is_user_logged_in() ? wp_get_current_user()->ID : null,
    ) );
}
add_action( 'wp_enqueue_scripts', 'weinvite_enqueue_scripts' );

/**
 * Add WebP Support
 */
function weinvite_add_webp_support( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'mime_types', 'weinvite_add_webp_support' );

/**
 * Add Lazy Loading to Images
 */
function weinvite_add_lazy_loading( $content ) {
    if ( is_single() || is_page() ) {
        $content = preg_replace( '/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content );
    }
    return $content;
}
add_filter( 'the_content', 'weinvite_add_lazy_loading' );

/**
 * Register Widget Areas
 */
function weinvite_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'weinvite' ),
        'id'            => 'footer-widgets',
        'description'   => __( 'Appears in the footer section', 'weinvite' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'weinvite_widgets_init' );

/**
 * Custom Excerpt Length
 */
function weinvite_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'weinvite_excerpt_length' );

/**
 * Custom Excerpt More
 */
function weinvite_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'weinvite_excerpt_more' );

/**
 * Handle Contact Form Submission
 * Integrates with WeInvite Core plugin if available
 */
function weinvite_handle_contact_form() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'weinvite_contact_form' ) ) {
        wp_send_json_error( array(
            'message' => 'Security check failed. Please refresh the page and try again.'
        ) );
    }

    // Sanitize input
    $name = sanitize_text_field( $_POST['name'] ?? '' );
    $email = sanitize_email( $_POST['email'] ?? '' );
    $phone = sanitize_text_field( $_POST['phone'] ?? '' );
    $subject = sanitize_text_field( $_POST['subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );
    $newsletter = isset( $_POST['newsletter'] ) ? 1 : 0;

    // Validate required fields
    if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_send_json_error( array(
            'message' => 'Please fill in all required fields.'
        ) );
    }

    // Validate email
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array(
            'message' => 'Please enter a valid email address.'
        ) );
    }

    // Get settings (from plugin if available, otherwise use defaults)
    $recipient_email = get_option( 'weinvite_contact_recipient_email', get_option( 'admin_email' ) );
    $subject_prefix = get_option( 'weinvite_contact_subject_prefix', get_bloginfo( 'name' ) );
    $enable_autoreply = get_option( 'weinvite_contact_enable_autoreply', 1 );
    $save_to_db = get_option( 'weinvite_contact_save_to_db', 1 );

    // Email subject map
    $subject_map = array(
        'general'     => 'General Inquiry',
        'support'     => 'Technical Support',
        'billing'     => 'Billing Question',
        'feature'     => 'Feature Request',
        'partnership' => 'Partnership Opportunity',
        'other'       => 'Other',
    );

    $subject_label = $subject_map[ $subject ] ?? 'Contact Form';

    // Prepare email to admin
    $email_subject = sprintf( '[%s] New %s from %s', $subject_prefix, $subject_label, $name );

    $email_message = "You have received a new contact form submission:\n\n";
    $email_message .= "Name: $name\n";
    $email_message .= "Email: $email\n";
    if ( ! empty( $phone ) ) {
        $email_message .= "Phone: $phone\n";
    }
    $email_message .= "Subject: $subject_label\n";
    $email_message .= "Newsletter Signup: " . ( $newsletter ? 'Yes' : 'No' ) . "\n\n";
    $email_message .= "Message:\n$message\n\n";
    $email_message .= "---\n";
    $email_message .= "This email was sent from the contact form on " . home_url();

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $subject_prefix . ' <' . $recipient_email . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    // Send email
    $sent = wp_mail( $recipient_email, $email_subject, $email_message, $headers );

    if ( $sent ) {
        // Send auto-reply to user if enabled
        if ( $enable_autoreply ) {
            $user_subject = sprintf( 'Thank you for contacting %s', $subject_prefix );
            $user_message = "Hi $name,\n\n";
            $user_message .= "Thank you for reaching out to us! We have received your message and will respond as soon as possible.\n\n";
            $user_message .= "Your message:\n$message\n\n";
            $user_message .= "Best regards,\n";
            $user_message .= "$subject_prefix Team";

            $user_headers = array(
                'Content-Type: text/plain; charset=UTF-8',
                'From: ' . $subject_prefix . ' <' . $recipient_email . '>',
            );

            wp_mail( $email, $user_subject, $user_message, $user_headers );
        }

        // Save to database if enabled and table exists
        if ( $save_to_db ) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'weinvite_contact_submissions';

            // Check if table exists (created by WeInvite Core plugin)
            if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) === $table_name ) {
                $wpdb->insert(
                    $table_name,
                    array(
                        'name'       => $name,
                        'email'      => $email,
                        'phone'      => $phone,
                        'subject'    => $subject,
                        'message'    => $message,
                        'newsletter' => $newsletter,
                        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
                        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                    ),
                    array( '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s' )
                );
            }
        }

        wp_send_json_success( array(
            'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.'
        ) );
    } else {
        wp_send_json_error( array(
            'message' => 'Sorry, there was an error sending your message. Please try again or email us directly.'
        ) );
    }
}
add_action( 'wp_ajax_weinvite_contact_form', 'weinvite_handle_contact_form' );
add_action( 'wp_ajax_nopriv_weinvite_contact_form', 'weinvite_handle_contact_form' );

/**
 * =============================================
 * PHASE 7: PUBLIC EVENT PAGES
 * Sprint 3 Implementation - November 2025
 * =============================================
 */

/**
 * Add custom rewrite rules for public event pages
 * URL formats:
 *   - weinvite.com/event/{TOKEN} (SEO-friendly, descriptive)
 *   - weinvite.com/e/{TOKEN} (short URL for sharing)
 * Token formats:
 *   - Production: 8-character uppercase alphanumeric (e.g., 0C35A7AA, ABC123D4)
 *   - Test: pub_ prefix + 24 lowercase hex characters (e.g., pub_09f74fadf915c7217448f696)
 * Sprint 5 - Phase 7: Support both formats during testing phase
 */
function weinvite_public_event_rewrite_rules() {
    // PRODUCTION FORMAT: 8-character uppercase alphanumeric tokens
    // Long URL: /event/{TOKEN} (SEO-friendly)
    add_rewrite_rule(
        '^event/([A-Z0-9]{8})/?$',
        'index.php?weinvite_public_event=$matches[1]',
        'top'
    );

    // Short URL: /e/{TOKEN} (for sharing)
    add_rewrite_rule(
        '^e/([A-Z0-9]{8})/?$',
        'index.php?weinvite_public_event=$matches[1]',
        'top'
    );

    // TEST FORMAT: pub_ prefix + flexible characters (alphanumeric, underscores, hyphens)
    // Examples: pub_09f74fadf915c7217448f696, pub_test2_capacity_hidden_456
    // Long URL: /event/{TOKEN}
    add_rewrite_rule(
        '^event/(pub_[a-zA-Z0-9_-]+)/?$',
        'index.php?weinvite_public_event=$matches[1]',
        'top'
    );

    // Short URL: /e/{TOKEN}
    add_rewrite_rule(
        '^e/(pub_[a-zA-Z0-9_-]+)/?$',
        'index.php?weinvite_public_event=$matches[1]',
        'top'
    );
}
add_action( 'init', 'weinvite_public_event_rewrite_rules', 5 ); // Priority 5 to load before post types (default 10)

/**
 * Add query var for event token
 */
function weinvite_public_event_query_vars( $vars ) {
    $vars[] = 'weinvite_public_event';
    return $vars;
}
add_filter( 'query_vars', 'weinvite_public_event_query_vars', 10, 1 );

/**
 * Load custom template for public event pages
 */
function weinvite_public_event_template_redirect() {
    $event_token = get_query_var( 'weinvite_public_event' );

    if ( $event_token ) {
        // Validate token format - Support both production and test formats
        // Production: 8-character uppercase alphanumeric (e.g., 0C35A7AA)
        // Test: pub_ + flexible characters (e.g., pub_09f74fadf915c7217448f696, pub_test2_capacity_hidden_456)
        $is_production_format = preg_match( '/^[A-Z0-9]{8}$/', $event_token );
        $is_test_format = preg_match( '/^pub_[a-zA-Z0-9_-]+$/', $event_token );

        if ( ! $is_production_format && ! $is_test_format ) {
            wp_die(
                '<h1>Invalid Event Link</h1><p>The event link you followed is not valid. Please check the URL and try again.</p>',
                'Invalid Event Link',
                array( 'response' => 400 )
            );
        }

        // Load the public event template
        $template = locate_template( 'template-public-event.php' );
        if ( $template ) {
            include $template;
            exit;
        } else {
            wp_die(
                '<h1>Template Not Found</h1><p>The public event template is not available. Please contact support.</p>',
                'Template Error',
                array( 'response' => 500 )
            );
        }
    }
}
add_action( 'template_redirect', 'weinvite_public_event_template_redirect' );

/**
 * Enqueue styles for public event pages
 */
function weinvite_public_event_enqueue_styles() {
    if ( get_query_var( 'weinvite_public_event' ) ) {
        // Design system variables
        wp_enqueue_style(
            'weinvite-design-system',
            get_template_directory_uri() . '/assets/css/weinvite-design-system.css',
            array(),
            '1.0.0'
        );

        // Component library
        wp_enqueue_style(
            'weinvite-components',
            get_template_directory_uri() . '/assets/css/weinvite-components.css',
            array( 'weinvite-design-system' ),
            '1.0.0'
        );

        // Public event page styles
        wp_enqueue_style(
            'weinvite-public-event',
            get_template_directory_uri() . '/assets/css/weinvite-public-event.css',
            array( 'weinvite-components' ),
            '1.0.0'
        );

        // Responsive styles
        wp_enqueue_style(
            'weinvite-responsive',
            get_template_directory_uri() . '/assets/css/weinvite-responsive.css',
            array( 'weinvite-public-event' ),
            '1.0.0'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'weinvite_public_event_enqueue_styles', 20 );

/**
 * Enqueue scripts for public event pages
 */
function weinvite_public_event_enqueue_scripts() {
    if ( get_query_var( 'weinvite_public_event' ) ) {
        // RSVP flow JavaScript
        wp_enqueue_script(
            'weinvite-rsvp-flow',
            get_template_directory_uri() . '/assets/js/weinvite-rsvp-flow.js',
            array(), // No jQuery dependency - vanilla JS
            '1.0.0',
            true // Load in footer
        );

        // Animation utilities
        wp_enqueue_script(
            'weinvite-animations',
            get_template_directory_uri() . '/assets/js/weinvite-animations.js',
            array(),
            '1.0.0',
            true
        );

        // Pass PHP data to JavaScript
        wp_localize_script( 'weinvite-rsvp-flow', 'weinvitePublicEvent', array(
            'apiUrl'     => esc_url_raw( rest_url( 'weinvite/v1/' ) ),
            'eventToken' => get_query_var( 'weinvite_public_event' ),
            'nonce'      => wp_create_nonce( 'wp_rest' ),
            'homeUrl'    => esc_url( home_url( '/' ) ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'weinvite_public_event_enqueue_scripts', 20 );

/**
 * Validate event token helper function
 */
function weinvite_validate_event_token( $token ) {
    // Support both production and test token formats
    // Production: 8-character uppercase alphanumeric (e.g., 0C35A7AA)
    // Test: pub_ + flexible characters (e.g., pub_09f74fadf915c7217448f696, pub_test2_capacity_hidden_456)

    $is_production_format = preg_match( '/^[A-Z0-9]{8}$/', $token );
    $is_test_format = preg_match( '/^pub_[a-zA-Z0-9_-]+$/', $token );

    return ( $is_production_format || $is_test_format );
}

/**
 * Get event data for SEO meta tags
 * Sprint 4 - Task 4.1: Fetches event data from API for server-side SEO
 *
 * @param string $token Event token
 * @return array Event data or empty array if not found
 */
function weinvite_get_event_data_for_seo( $token ) {
    // Cache key for transient (cache for 5 minutes)
    $cache_key = 'weinvite_seo_event_' . $token;

    // Check transient cache first
    $cached_data = get_transient( $cache_key );
    if ( false !== $cached_data ) {
        return $cached_data;
    }

    // Use internal REST API request instead of external HTTP call
    // This avoids DNS resolution issues in Local/development environments
    $request = new WP_REST_Request( 'GET', '/weinvite/v1/events/' . $token );
    $server = rest_get_server();
    $response = $server->dispatch( $request );
    $data = $response->get_data();

    // Extract relevant data - API returns data under 'event' key
    if ( ! empty( $data ) && is_array( $data ) && isset( $data['event'] ) ) {
        $event = $data['event'];

        // Parse location to extract city (format: "Venue Name, City, Country")
        $location_parts = explode( ',', $event['location'] ?? '' );
        $location_name = isset( $location_parts[0] ) ? trim( $location_parts[0] ) : '';
        $location_city = isset( $location_parts[1] ) ? trim( $location_parts[1] ) : 'Bahrain';

        $event_data = array(
            'event_name'      => $event['title'] ?? '',
            'description'     => $event['description'] ?? '',
            'event_date'      => $event['date'] ?? '',
            'event_time'      => $event['time'] ?? '',
            'location_name'   => $location_name,
            'location_city'   => $location_city,
            'host_name'       => $event['host']['name'] ?? '',
            'image_url'       => $event['image_url'] ?? '',
        );

        // Cache for 5 minutes
        set_transient( $cache_key, $event_data, 5 * MINUTE_IN_SECONDS );

        return $event_data;
    }

    return array();
}

/**
 * Include Additional Files
 */
// require_once get_template_directory() . '/includes/theme-setup.php';
// require_once get_template_directory() . '/includes/custom-post-types.php';
// require_once get_template_directory() . '/includes/widgets.php';
// require_once get_template_directory() . '/includes/shortcodes.php';
// require_once get_template_directory() . '/includes/helpers.php';
// require_once get_template_directory() . '/includes/api-integration.php';
