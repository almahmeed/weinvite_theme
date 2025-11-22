<?php
/**
 * Minimal Test Template - Public Event Page
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get event token from URL
$event_token = get_query_var( 'weinvite_public_event' );

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Event Page</title>
</head>
<body>
    <h1>Public Event Page Test</h1>
    <p>Event Token: <?php echo esc_html($event_token); ?></p>
    <p>If you see this, the rewrite rules are working!</p>
</body>
</html>
<?php
exit;
