<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * Contact page with form and contact information.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main contact-page">

    <!-- Page Hero -->
    <section class="hero hero-page">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Get in Touch</h1>
                <p class="hero-description text-lg">
                    Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Form & Info Section -->
    <section class="section section-contact">
        <div class="container">
            <div class="row">

                <!-- Contact Form -->
                <div class="col-12 col-lg-7">
                    <div class="card card-elevated">
                        <div class="card-body">
                            <h2 class="h3 mb-4">Send Us a Message</h2>

                            <form id="contact-form" class="contact-form" data-validate>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="contact-name" class="form-label">
                                                Name <span class="required">*</span>
                                            </label>
                                            <input type="text"
                                                   id="contact-name"
                                                   name="name"
                                                   class="form-control"
                                                   placeholder="Your full name"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="contact-email" class="form-label">
                                                Email <span class="required">*</span>
                                            </label>
                                            <input type="email"
                                                   id="contact-email"
                                                   name="email"
                                                   class="form-control"
                                                   placeholder="your@email.com"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contact-phone" class="form-label">
                                        Phone <span class="optional">(optional)</span>
                                    </label>
                                    <input type="tel"
                                           id="contact-phone"
                                           name="phone"
                                           class="form-control"
                                           placeholder="+1 (555) 123-4567">
                                </div>

                                <div class="form-group">
                                    <label for="contact-subject" class="form-label">
                                        Subject <span class="required">*</span>
                                    </label>
                                    <select id="contact-subject"
                                            name="subject"
                                            class="form-control"
                                            required>
                                        <option value="">Select a subject...</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="support">Technical Support</option>
                                        <option value="billing">Billing Question</option>
                                        <option value="feature">Feature Request</option>
                                        <option value="partnership">Partnership Opportunity</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="contact-message" class="form-label">
                                        Message <span class="required">*</span>
                                    </label>
                                    <textarea id="contact-message"
                                              name="message"
                                              class="form-control"
                                              rows="6"
                                              maxlength="1000"
                                              placeholder="Tell us how we can help..."
                                              required></textarea>
                                    <div class="char-counter">
                                        <span class="current">0</span> / <span class="max">1000</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox"
                                               id="contact-newsletter"
                                               name="newsletter"
                                               class="form-check-input"
                                               value="yes">
                                        <label for="contact-newsletter" class="form-check-label">
                                            Subscribe to our newsletter for updates and tips
                                        </label>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Send Message
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-12 col-lg-5">

                    <!-- Contact Details Card -->
                    <div class="card card-elevated mb-4">
                        <div class="card-body">
                            <h3 class="h4 mb-4">Contact Information</h3>

                            <div class="contact-detail mb-4">
                                <div class="contact-detail-icon">📧</div>
                                <div class="contact-detail-content">
                                    <h5>Email</h5>
                                    <p>
                                        <a href="mailto:hello@weinvite.com">hello@weinvite.com</a><br>
                                        <a href="mailto:support@weinvite.com">support@weinvite.com</a>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-detail mb-4">
                                <div class="contact-detail-icon">💬</div>
                                <div class="contact-detail-content">
                                    <h5>Live Chat</h5>
                                    <p>
                                        Monday - Friday<br>
                                        9:00 AM - 6:00 PM EST
                                    </p>
                                    <button class="btn btn-sm btn-outline-primary" onclick="alert('Live chat would open here')">
                                        Start Chat
                                    </button>
                                </div>
                            </div>

                            <div class="contact-detail">
                                <div class="contact-detail-icon">📱</div>
                                <div class="contact-detail-content">
                                    <h5>Social Media</h5>
                                    <div class="social-links contact-social-icons">
                                        <?php
                                        $social_links = array(
                                            'facebook' => array(
                                                'url' => get_option( 'weinvite_facebook_url', '#' ),
                                                'label' => 'Facebook',
                                                'svg' => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>'
                                            ),
                                            'twitter' => array(
                                                'url' => get_option( 'weinvite_twitter_url', '#' ),
                                                'label' => 'Twitter',
                                                'svg' => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>'
                                            ),
                                            'instagram' => array(
                                                'url' => get_option( 'weinvite_instagram_url', '#' ),
                                                'label' => 'Instagram',
                                                'svg' => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>'
                                            ),
                                            'linkedin' => array(
                                                'url' => get_option( 'weinvite_linkedin_url', '#' ),
                                                'label' => 'LinkedIn',
                                                'svg' => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>'
                                            ),
                                        );

                                        foreach ( $social_links as $platform => $data ) :
                                            // Skip if URL is just '#' and no setting configured
                                            if ( $data['url'] === '#' && empty( get_option( 'weinvite_' . $platform . '_url' ) ) ) {
                                                continue;
                                            }
                                            ?>
                                            <a href="<?php echo esc_url( $data['url'] ); ?>"
                                               class="social-icon-btn"
                                               aria-label="<?php echo esc_attr( $data['label'] ); ?>"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               title="<?php echo esc_attr( $data['label'] ); ?>">
                                                <?php echo $data['svg']; ?>
                                            </a>
                                            <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Hours Card -->
                    <div class="card card-elevated">
                        <div class="card-body">
                            <h3 class="h4 mb-4">Support Hours</h3>

                            <div class="support-hours">
                                <div class="support-hours-item">
                                    <span class="day">Monday - Friday</span>
                                    <span class="hours">9:00 AM - 6:00 PM EST</span>
                                </div>
                                <div class="support-hours-item">
                                    <span class="day">Saturday</span>
                                    <span class="hours">10:00 AM - 4:00 PM EST</span>
                                </div>
                                <div class="support-hours-item">
                                    <span class="day">Sunday</span>
                                    <span class="hours">Closed</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-secondary">
                                    <strong>Note:</strong> Email support is available 24/7.
                                    We respond to all emails within 24 hours.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- FAQ Quick Links Section -->
    <section class="section section-faq-links bg-secondary">
        <div class="container">
            <div class="text-center">
                <h2 class="h3 mb-3">Looking for Quick Answers?</h2>
                <p class="mb-4">Check our FAQ section for instant answers to common questions</p>
                <a href="<?php echo esc_url(home_url('/faq')); ?>" class="btn btn-outline-primary">
                    Browse FAQs
                </a>
            </div>
        </div>
    </section>

</main>

<script>
// Contact form submission
(function($) {
    const contactForm = $('#contact-form');
    if (!contactForm.length) return;

    contactForm.on('submit', function(e) {
        e.preventDefault();

        const submitBtn = $(this).find('button[type="submit"]');
        const formData = new FormData(this);

        // Add action and nonce
        formData.append('action', 'weinvite_contact_form');
        formData.append('nonce', '<?php echo wp_create_nonce( "weinvite_contact_form" ); ?>');

        // Show loading state
        WeInvite.showLoading(submitBtn);

        // Submit form via AJAX
        $.ajax({
            url: weinviteData.ajaxUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                WeInvite.hideLoading(submitBtn);

                if (response.success) {
                    WeInvite.showNotification(response.data.message, 'success');
                    contactForm[0].reset();
                    // Reset character counter
                    $('.char-counter .current').text('0');
                } else {
                    WeInvite.showNotification(response.data.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                WeInvite.hideLoading(submitBtn);
                WeInvite.showNotification('An error occurred. Please try again later.', 'error');
                console.error('Contact form error:', error);
            }
        });
    });

    // Character counter for message textarea
    const messageTextarea = $('#contact-message');
    if (messageTextarea.length) {
        const charCounter = messageTextarea.next('.char-counter');
        const currentSpan = charCounter.find('.current');

        messageTextarea.on('input', function() {
            currentSpan.text($(this).val().length);
        });
    }
})(jQuery);
</script>

<?php
get_footer();
