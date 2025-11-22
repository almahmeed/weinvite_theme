<?php
/**
 * Template Name: Public Event Page
 * Description: Public event registration page with OTP verification
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 * Phase 7 - Sprint 3 Implementation
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get event token from URL
$event_token = get_query_var( 'weinvite_public_event' );

// Validate token
if ( ! weinvite_validate_event_token( $event_token ) ) {
    wp_die(
        '<h1>Invalid Event Link</h1><p>The event link you followed is not valid.</p>',
        'Invalid Event Link',
        array( 'response' => 400 )
    );
}

// Fetch event data for SEO meta tags (Sprint 4 - Task 4.1)
$event_data = weinvite_get_event_data_for_seo( $event_token );

// Set default values if event data not available
$event_name = $event_data['event_name'] ?? 'Event Invitation';
$event_description = $event_data['description'] ?? 'You\'re invited to an event! Respond to see event details.';
$event_date = $event_data['event_date'] ?? '';
$event_time = $event_data['event_time'] ?? '';
$event_location_name = $event_data['location_name'] ?? 'Event Location';
$event_location_city = $event_data['location_city'] ?? 'Bahrain';
$event_host_name = $event_data['host_name'] ?? 'Event Host';
$event_image_url = ! empty( $event_data['image_url'] ) ? $event_data['image_url'] : get_template_directory_uri() . '/assets/images/og-default.png';
$event_public_url = home_url( '/e/' . $event_token );

// Format datetime for Schema.org
$event_datetime_iso = '';
if ( ! empty( $event_date ) && ! empty( $event_time ) ) {
    $datetime = strtotime( $event_date . ' ' . $event_time );
    if ( $datetime ) {
        $event_datetime_iso = date( 'c', $datetime );
    }
}

// Trim description for meta tags (max 160 chars for SEO)
$event_description_short = wp_trim_words( $event_description, 25, '...' );
if ( strlen( $event_description_short ) > 160 ) {
    $event_description_short = substr( $event_description_short, 0, 157 ) . '...';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Preconnect to API -->
    <link rel="preconnect" href="<?php echo esc_url( rest_url() ); ?>">

    <!-- Sprint 4 - Task 4.1: SEO Meta Tags -->
    <!-- Primary Meta Tags -->
    <title><?php echo esc_html( $event_name ); ?> | WeInvite Events</title>
    <meta name="title" content="<?php echo esc_attr( $event_name ); ?> | WeInvite Events">
    <meta name="description" content="<?php echo esc_attr( $event_description_short ); ?>">
    <meta name="keywords" content="event, registration, <?php echo esc_attr( $event_location_city ); ?>, invitation, <?php echo esc_attr( $event_name ); ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url( $event_public_url ); ?>">

    <!-- Robots Meta -->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">

    <!-- Sprint 4 - Task 4.2: Open Graph / Facebook / WhatsApp / LinkedIn -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( $event_public_url ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $event_name ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $event_description_short ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $event_image_url ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr( $event_name ); ?>">
    <meta property="og:site_name" content="WeInvite Events">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo esc_url( $event_public_url ); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr( $event_name ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $event_description_short ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $event_image_url ); ?>">
    <meta name="twitter:site" content="@weinviteapp">

    <?php if ( ! empty( $event_datetime_iso ) ) : ?>
    <!-- Schema.org Event Markup (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Event",
      "name": <?php echo wp_json_encode( $event_name ); ?>,
      "description": <?php echo wp_json_encode( $event_description_short ); ?>,
      "startDate": <?php echo wp_json_encode( $event_datetime_iso ); ?>,
      "eventStatus": "https://schema.org/EventScheduled",
      "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
      "location": {
        "@type": "Place",
        "name": <?php echo wp_json_encode( $event_location_name ); ?>,
        "address": {
          "@type": "PostalAddress",
          "addressLocality": <?php echo wp_json_encode( $event_location_city ); ?>,
          "addressCountry": "BH"
        }
      },
      "organizer": {
        "@type": "Person",
        "name": <?php echo wp_json_encode( $event_host_name ); ?>
      },
      "offers": {
        "@type": "Offer",
        "url": <?php echo wp_json_encode( $event_public_url ); ?>,
        "price": "0",
        "priceCurrency": "BHD",
        "availability": "https://schema.org/InStock"
      },
      "image": <?php echo wp_json_encode( $event_image_url ); ?>
    }
    </script>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class( 'weinvite-public-event-body' ); ?>>

<div id="weinvite-public-event-page" class="weinvite-public-event-page" data-event-token="<?php echo esc_attr( $event_token ); ?>">

    <!-- Loading State -->
    <div id="loading-screen" class="loading-screen" role="status" aria-live="polite" aria-label="Loading event">
        <div class="loading-spinner" aria-hidden="true"></div>
        <p>Loading event details...</p>
    </div>

    <!-- Error State (Hidden by default) -->
    <div id="error-screen" class="error-screen" role="alert" aria-live="assertive" style="display: none;">
        <div class="error-content">
            <div class="error-icon" aria-hidden="true">⚠️</div>
            <h1 id="error-title">Event Not Found</h1>
            <p id="error-message">The event you're looking for could not be found. It may have been cancelled or the link may be invalid.</p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" aria-label="Return to homepage">
                Go to Homepage
            </a>
        </div>
    </div>

    <!-- Main Event Content (Hidden until loaded) -->
    <div id="event-content" class="event-content" style="display: none;">

        <!-- Desktop Layout: Two-Column (800px + 400px) -->
        <div class="event-layout-desktop">

            <!-- Left Column: Event Content -->
            <div class="event-content-column">

                <!-- Hero Image Section -->
                <div id="hero-section" class="hero-section">
                    <!-- Hero image will be dynamically loaded here -->
                </div>

                <!-- Event Details Section -->
                <div id="event-details" class="event-details-section">
                    <!-- Event details will be dynamically loaded here -->
                </div>

                <!-- Privacy Message (Before Registration) -->
                <div id="privacy-message" class="privacy-message">
                    <div class="privacy-icon">🔒</div>
                    <p><strong>Privacy Protected:</strong> Location and host details will be revealed after you respond.</p>
                </div>

                <!-- Revealed Content (After Registration) -->
                <div id="revealed-content" class="revealed-content" style="display: none;">
                    <!-- Location, host, parking details revealed after registration -->
                </div>

            </div>

            <!-- Right Column: Response Sidebar (Sticky) -->
            <div class="event-sidebar-column">
                <div class="event-sidebar-sticky">

                    <!-- Response Card (Before Registration) -->
                    <div id="rsvp-card" class="rsvp-card">
                        <!-- Response form will be dynamically loaded here -->
                    </div>

                    <!-- Confirmation Card (After Registration) -->
                    <div id="confirmation-card" class="confirmation-card" style="display: none;">
                        <!-- Confirmation details will be shown here after registration -->
                    </div>

                </div>
            </div>

        </div>

        <!-- Mobile Layout: Single-Column -->
        <div class="event-layout-mobile">

            <!-- Mobile Hero Image Section -->
            <div class="mobile-hero-wrapper">
                <!-- Hero image will be dynamically loaded here (mobile copy) -->
            </div>

            <!-- Mobile Event Details Section -->
            <div class="mobile-event-details">
                <!-- Event details will be dynamically loaded here (mobile copy) -->
            </div>

            <!-- Mobile Privacy Message (Before Registration) -->
            <div class="mobile-privacy-message">
                <!-- Privacy message will be shown here before RSVP -->
            </div>

            <!-- Mobile Revealed Content (After Registration) -->
            <div class="mobile-revealed-content" style="display: none;">
                <!-- Location, host, parking details revealed after registration -->
            </div>

            <!-- Mobile Response Card (Before Registration) -->
            <div class="mobile-rsvp-card">
                <!-- Response form will be dynamically loaded here (mobile copy) -->
            </div>

            <!-- Mobile Confirmation Card (After Registration) -->
            <div class="mobile-confirmation-card" style="display: none;">
                <!-- Confirmation details will be shown here after registration -->
            </div>

        </div>

    </div>

    <!-- Response Modal (OTP Verification) -->
    <div id="rsvp-modal" class="modal" role="dialog" aria-modal="true" aria-labelledby="rsvp-modal-title" style="display: none;">
        <div class="modal-backdrop" aria-hidden="true"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="rsvp-modal-title">Verify Your Phone Number</h2>
                <button type="button" class="modal-close" aria-label="Close modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- OTP verification steps will be dynamically loaded here -->
            </div>
        </div>
    </div>

    <!-- Bottom Sheet (Mobile Registration) -->
    <div id="bottom-sheet" class="bottom-sheet" role="dialog" aria-modal="true" aria-labelledby="bottom-sheet-title" style="display: none;">
        <div class="bottom-sheet-backdrop" aria-hidden="true"></div>
        <div class="bottom-sheet-content">
            <div class="bottom-sheet-handle" aria-hidden="true"></div>
            <div class="bottom-sheet-body">
                <!-- Mobile registration content here -->
            </div>
        </div>
    </div>

    <!-- Sticky Bottom CTA (Mobile) -->
    <div id="sticky-cta-mobile" class="sticky-cta-mobile" style="display: none;">
        <button type="button" class="btn btn-primary btn-block" id="mobile-rsvp-btn" aria-label="Open response form">
            Respond Now
        </button>
    </div>

</div>

<?php wp_footer(); ?>

<!-- Phase 7 Public Event JavaScript will be loaded via wp_enqueue_script -->

</body>
</html>
