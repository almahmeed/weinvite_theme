<?php
/**
 * Template Name: Debug Token Value
 *
 * Place this file in the theme root and temporarily modify template_redirect to use it
 */

get_header();

$event_token = get_query_var( 'weinvite_public_event' );

?>

<div style="padding: 40px; font-family: monospace; background: #f5f5f5;">
    <h1>Debug Token Value</h1>

    <h2>Token from get_query_var():</h2>
    <pre style="background: white; padding: 20px; border: 1px solid #ccc;">
<?php
echo "Raw value: ";
var_dump($event_token);
echo "\n";

if ($event_token) {
    echo "String value: " . $event_token . "\n";
    echo "Length: " . strlen($event_token) . "\n";
    echo "Type: " . gettype($event_token) . "\n";

    // Character breakdown
    echo "\nCharacter breakdown:\n";
    for ($i = 0; $i < strlen($event_token); $i++) {
        printf("[%2d] %s (ASCII: %3d)\n", $i, $event_token[$i], ord($event_token[$i]));
    }

    // Test patterns
    echo "\n\nPattern tests:\n";
    $is_production = preg_match( '/^[A-Z0-9]{8}$/', $event_token );
    $is_test = preg_match( '/^pub_[a-f0-9]{24}$/', $event_token );

    echo "Production pattern (/^[A-Z0-9]{8}$/): " . ($is_production ? "MATCH" : "NO MATCH") . "\n";
    echo "Test pattern (/^pub_[a-f0-9]{24}$/): " . ($is_test ? "MATCH" : "NO MATCH") . "\n";

    if (!$is_production && !$is_test) {
        echo "\n❌ WOULD BE REJECTED\n";
    } else {
        echo "\n✅ WOULD BE ACCEPTED\n";
    }
}
?>
    </pre>
</div>

<?php
get_footer();
