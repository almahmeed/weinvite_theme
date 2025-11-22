<?php
/**
 * Template Name: Terms of Service
 * Template Post Type: page
 *
 * Terms of Service page.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main legal-page terms-page">

    <!-- Page Hero -->
    <section class="hero hero-page">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Terms of Service</h1>
                <p class="hero-description">
                    Last Updated: <?php echo date('F j, Y'); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Legal Content Section -->
    <section class="section section-legal-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">

                    <div class="legal-content">

                        <div class="legal-intro">
                            <p class="lead">
                                Welcome to WeInvite! These Terms of Service ("Terms") govern your use of the
                                WeInvite platform and services. By accessing or using WeInvite, you agree to
                                be bound by these Terms.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>1. Acceptance of Terms</h2>
                            <p>
                                By creating an account, accessing, or using WeInvite ("Service"), you agree
                                to comply with and be bound by these Terms of Service. If you do not agree
                                to these Terms, you may not use the Service.
                            </p>
                            <p>
                                We reserve the right to update these Terms at any time. Continued use of the
                                Service after changes constitutes acceptance of the updated Terms.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>2. User Accounts</h2>
                            <h3>2.1 Account Creation</h3>
                            <p>
                                To use WeInvite, you must create an account using a valid phone number.
                                You agree to:
                            </p>
                            <ul>
                                <li>Provide accurate and complete information</li>
                                <li>Maintain the security of your account</li>
                                <li>Notify us immediately of any unauthorized access</li>
                                <li>Be responsible for all activities under your account</li>
                            </ul>

                            <h3>2.2 Age Requirements</h3>
                            <p>
                                You must be at least 13 years old to use WeInvite. Users under 18 require
                                parental or guardian consent. The Guardian Approval system helps enforce
                                this requirement for event participation.
                            </p>

                            <h3>2.3 Account Termination</h3>
                            <p>
                                We reserve the right to suspend or terminate accounts that violate these
                                Terms, engage in fraudulent activity, or misuse the Service.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>3. Credits and Payment</h2>
                            <h3>3.1 Credit Purchase</h3>
                            <p>
                                WeInvite operates on a credit-based system. You purchase credits in packages
                                to use various features. Credit pricing is displayed clearly on our Pricing page.
                            </p>

                            <h3>3.2 Credit Usage</h3>
                            <p>
                                Credits are consumed when you:
                            </p>
                            <ul>
                                <li>Create an event (10 credits)</li>
                                <li>Send invitations (5 credits per invitation)</li>
                                <li>Send reminders (2 credits per reminder)</li>
                                <li>Send update notifications (3 credits per notification)</li>
                            </ul>

                            <h3>3.3 Credit Expiration</h3>
                            <p>
                                Credits purchased through WeInvite never expire and remain in your account
                                until used.
                            </p>

                            <h3>3.4 Refunds</h3>
                            <p>
                                We offer a 30-day money-back guarantee on credit purchases. Refunds are
                                issued for unused credits only. To request a refund, contact our support
                                team within 30 days of purchase.
                            </p>

                            <h3>3.5 Pricing Changes</h3>
                            <p>
                                We reserve the right to change our pricing at any time. Price changes will
                                not affect credits already purchased.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>4. Use of Service</h2>
                            <h3>4.1 Acceptable Use</h3>
                            <p>
                                You agree to use WeInvite only for lawful purposes. You may not:
                            </p>
                            <ul>
                                <li>Use the Service for spam, harassment, or illegal activities</li>
                                <li>Upload malicious code or viruses</li>
                                <li>Attempt to gain unauthorized access to our systems</li>
                                <li>Interfere with other users' use of the Service</li>
                                <li>Impersonate others or provide false information</li>
                                <li>Violate intellectual property rights</li>
                            </ul>

                            <h3>4.2 Content Guidelines</h3>
                            <p>
                                You are responsible for the content you create and share through WeInvite,
                                including event details, invitations, and communications. Content must not:
                            </p>
                            <ul>
                                <li>Contain illegal, offensive, or inappropriate material</li>
                                <li>Infringe on others' intellectual property rights</li>
                                <li>Contain false, misleading, or deceptive information</li>
                                <li>Violate any applicable laws or regulations</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>5. Guardian Approval System</h2>
                            <p>
                                The Guardian Approval system allows parents/guardians to approve events
                                for minors (under 18). By using this feature:
                            </p>
                            <ul>
                                <li>Event hosts can require guardian approval for minor attendees</li>
                                <li>Guardians receive notifications and can approve/decline invitations</li>
                                <li>Minors cannot RSVP without guardian approval when enabled</li>
                                <li>Guardians are responsible for monitoring their child's account activity</li>
                            </ul>
                            <p>
                                WeInvite provides tools for safety but is not responsible for supervising
                                minors' event attendance. Parents and guardians are solely responsible for
                                their children's safety and activities.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>6. Privacy and Data</h2>
                            <p>
                                Your privacy is important to us. Our collection, use, and protection of your
                                personal information is governed by our
                                <a href="<?php echo esc_url(home_url('/privacy')); ?>">Privacy Policy</a>,
                                which is incorporated into these Terms by reference.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>7. Intellectual Property</h2>
                            <h3>7.1 Our Rights</h3>
                            <p>
                                WeInvite and all related trademarks, logos, and content are owned by us or
                                our licensors. You may not use, copy, or distribute our intellectual property
                                without written permission.
                            </p>

                            <h3>7.2 Your Content</h3>
                            <p>
                                You retain ownership of content you create using WeInvite. By using the Service,
                                you grant us a limited license to store, display, and transmit your content as
                                necessary to provide the Service.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>8. Limitation of Liability</h2>
                            <p>
                                TO THE MAXIMUM EXTENT PERMITTED BY LAW:
                            </p>
                            <ul>
                                <li>WeInvite is provided "AS IS" without warranties of any kind</li>
                                <li>We are not liable for indirect, incidental, or consequential damages</li>
                                <li>Our total liability is limited to the amount you paid in the last 12 months</li>
                                <li>We are not responsible for third-party services or content</li>
                            </ul>
                            <p>
                                Some jurisdictions do not allow certain liability limitations, so some of
                                these limitations may not apply to you.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>9. Indemnification</h2>
                            <p>
                                You agree to indemnify and hold harmless WeInvite and its affiliates from any
                                claims, damages, or expenses arising from:
                            </p>
                            <ul>
                                <li>Your use of the Service</li>
                                <li>Your violation of these Terms</li>
                                <li>Your violation of any third-party rights</li>
                                <li>Content you create or share</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>10. Termination</h2>
                            <p>
                                We may terminate or suspend your account at any time for:
                            </p>
                            <ul>
                                <li>Violation of these Terms</li>
                                <li>Fraudulent or illegal activity</li>
                                <li>Requests from law enforcement</li>
                                <li>Extended inactivity</li>
                            </ul>
                            <p>
                                Upon termination, your right to use the Service ceases immediately. Unused
                                credits may be forfeited depending on the reason for termination.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>11. Dispute Resolution</h2>
                            <h3>11.1 Governing Law</h3>
                            <p>
                                These Terms are governed by the laws of [Your Jurisdiction], without regard
                                to conflict of law provisions.
                            </p>

                            <h3>11.2 Arbitration</h3>
                            <p>
                                Most disputes can be resolved through negotiation. For disputes that cannot
                                be resolved, you agree to binding arbitration in accordance with [Arbitration Rules].
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>12. Changes to Terms</h2>
                            <p>
                                We may update these Terms from time to time. We will notify users of significant
                                changes via email or in-app notification. Continued use of the Service after
                                changes constitutes acceptance of the updated Terms.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>13. Contact Information</h2>
                            <p>
                                If you have questions about these Terms, please contact us:
                            </p>
                            <ul>
                                <li><strong>Email:</strong> legal@weinvite.com</li>
                                <li><strong>Support:</strong> support@weinvite.com</li>
                                <li><strong>Website:</strong> <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Page</a></li>
                            </ul>
                        </div>

                        <div class="legal-footer">
                            <p class="text-sm text-secondary">
                                <strong>Last Updated:</strong> <?php echo date('F j, Y'); ?><br>
                                <strong>Effective Date:</strong> <?php echo date('F j, Y'); ?>
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Related Links Section -->
    <section class="section section-related-links bg-secondary">
        <div class="container">
            <div class="text-center">
                <h3 class="h4 mb-4">Related Documents</h3>
                <div class="related-links">
                    <a href="<?php echo esc_url(home_url('/privacy')); ?>" class="btn btn-outline-primary">
                        Privacy Policy
                    </a>
                    <a href="<?php echo esc_url(home_url('/faq')); ?>" class="btn btn-outline-primary">
                        FAQ
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
