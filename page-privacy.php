<?php
/**
 * Template Name: Privacy Policy
 * Template Post Type: page
 *
 * Privacy Policy page.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main legal-page privacy-page">

    <!-- Page Hero -->
    <section class="hero hero-page">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Privacy Policy</h1>
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
                                At WeInvite, we take your privacy seriously. This Privacy Policy explains how
                                we collect, use, disclose, and safeguard your information when you use our
                                platform and services.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>1. Information We Collect</h2>

                            <h3>1.1 Information You Provide</h3>
                            <p>
                                We collect information you provide directly to us, including:
                            </p>
                            <ul>
                                <li><strong>Account Information:</strong> Phone number, name, email address (optional)</li>
                                <li><strong>Event Information:</strong> Event details, dates, locations, descriptions</li>
                                <li><strong>Guest Information:</strong> Names and contact information of people you invite</li>
                                <li><strong>Payment Information:</strong> Processed securely by our payment providers</li>
                                <li><strong>Communications:</strong> Messages sent through our platform</li>
                                <li><strong>Guardian Relationships:</strong> Parent/guardian connections for minor accounts</li>
                            </ul>

                            <h3>1.2 Information Collected Automatically</h3>
                            <p>
                                When you use WeInvite, we automatically collect:
                            </p>
                            <ul>
                                <li><strong>Usage Data:</strong> Features used, actions taken, time spent</li>
                                <li><strong>Device Information:</strong> Device type, operating system, browser type</li>
                                <li><strong>Location Data:</strong> Approximate location based on IP address</li>
                                <li><strong>Log Data:</strong> Access times, pages viewed, errors encountered</li>
                                <li><strong>Cookies:</strong> Small data files stored on your device</li>
                            </ul>

                            <h3>1.3 Information from Third Parties</h3>
                            <p>
                                We may receive information from:
                            </p>
                            <ul>
                                <li>Firebase Authentication services</li>
                                <li>Payment processors</li>
                                <li>Analytics providers</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>2. How We Use Your Information</h2>
                            <p>
                                We use collected information to:
                            </p>
                            <ul>
                                <li>Provide, maintain, and improve our services</li>
                                <li>Process your transactions and manage your account</li>
                                <li>Send invitations and notifications on your behalf</li>
                                <li>Communicate with you about your account and our services</li>
                                <li>Enforce our Guardian Approval system for minor safety</li>
                                <li>Analyze usage patterns and improve user experience</li>
                                <li>Detect and prevent fraud and abuse</li>
                                <li>Comply with legal obligations</li>
                                <li>Send marketing communications (with your consent)</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>3. How We Share Your Information</h2>

                            <h3>3.1 With Your Consent</h3>
                            <p>
                                We share information when you direct us to, such as:
                            </p>
                            <ul>
                                <li>Sending invitations to guests you specify</li>
                                <li>Sharing event details with attendees</li>
                                <li>Guardian approval notifications</li>
                            </ul>

                            <h3>3.2 Service Providers</h3>
                            <p>
                                We share information with trusted service providers who help us operate,
                                including:
                            </p>
                            <ul>
                                <li>Firebase for authentication and data storage</li>
                                <li>Payment processors for transaction handling</li>
                                <li>SMS/Email providers for sending invitations</li>
                                <li>Analytics services for usage insights</li>
                            </ul>

                            <h3>3.3 Legal Requirements</h3>
                            <p>
                                We may disclose information if required by law or to:
                            </p>
                            <ul>
                                <li>Comply with legal process or government requests</li>
                                <li>Enforce our Terms of Service</li>
                                <li>Protect rights, property, or safety</li>
                                <li>Investigate fraud or security issues</li>
                            </ul>

                            <h3>3.4 Business Transfers</h3>
                            <p>
                                If WeInvite is involved in a merger, acquisition, or sale, your information
                                may be transferred to the new owner.
                            </p>

                            <h3>3.5 What We Don't Do</h3>
                            <p>
                                We will never:
                            </p>
                            <ul>
                                <li>Sell your personal information to third parties</li>
                                <li>Share your data for third-party marketing without consent</li>
                                <li>Use your guest lists for our own purposes</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>4. Guardian Approval and Minor Privacy</h2>
                            <p>
                                We take the privacy and safety of minors seriously:
                            </p>
                            <ul>
                                <li>Users under 13 may not create accounts</li>
                                <li>Users aged 13-17 require parental consent</li>
                                <li>Guardian Approval system helps parents monitor children's event participation</li>
                                <li>Parents can view and manage their children's invitations</li>
                                <li>We don't collect more information from minors than necessary</li>
                                <li>Parents can request deletion of their child's information</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>5. Data Security</h2>
                            <p>
                                We implement security measures to protect your information:
                            </p>
                            <ul>
                                <li>Encryption of data in transit (HTTPS/TLS)</li>
                                <li>Encryption of data at rest</li>
                                <li>Firebase Authentication for secure login</li>
                                <li>Regular security audits and updates</li>
                                <li>Access controls and authentication</li>
                                <li>Secure payment processing (PCI-compliant)</li>
                            </ul>
                            <p>
                                However, no system is 100% secure. We cannot guarantee absolute security
                                but continuously work to improve our protections.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>6. Data Retention</h2>
                            <p>
                                We retain your information for as long as:
                            </p>
                            <ul>
                                <li>Your account is active</li>
                                <li>Needed to provide services</li>
                                <li>Required by law or for legitimate business purposes</li>
                            </ul>
                            <p>
                                After account deletion, we retain some information for:
                            </p>
                            <ul>
                                <li>Fraud prevention and security</li>
                                <li>Legal compliance</li>
                                <li>Resolving disputes</li>
                            </ul>
                            <p>
                                Most personal data is deleted within 30 days of account deletion.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>7. Your Rights and Choices</h2>

                            <h3>7.1 Access and Update</h3>
                            <p>
                                You can access and update your information through your account settings.
                            </p>

                            <h3>7.2 Delete Your Account</h3>
                            <p>
                                You can delete your account at any time. This will permanently delete most
                                of your personal information within 30 days.
                            </p>

                            <h3>7.3 Marketing Communications</h3>
                            <p>
                                You can opt out of marketing emails by clicking "unsubscribe" in any
                                marketing email or updating your preferences.
                            </p>

                            <h3>7.4 Cookies</h3>
                            <p>
                                You can control cookies through your browser settings. Note that disabling
                                cookies may affect functionality.
                            </p>

                            <h3>7.5 Data Portability</h3>
                            <p>
                                You can request a copy of your data in a machine-readable format.
                            </p>

                            <h3>7.6 Rights Under Data Protection Laws</h3>
                            <p>
                                Depending on your location, you may have additional rights, including:
                            </p>
                            <ul>
                                <li>Right to know what information we collect</li>
                                <li>Right to access your information</li>
                                <li>Right to correct inaccurate information</li>
                                <li>Right to delete your information</li>
                                <li>Right to restrict or object to processing</li>
                                <li>Right to data portability</li>
                                <li>Right to withdraw consent</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>8. Children's Privacy (COPPA)</h2>
                            <p>
                                WeInvite complies with the Children's Online Privacy Protection Act (COPPA):
                            </p>
                            <ul>
                                <li>We don't knowingly collect information from children under 13</li>
                                <li>If we discover we've collected such information, we delete it immediately</li>
                                <li>Parents can review and request deletion of their child's information</li>
                                <li>The Guardian Approval system helps parents supervise teen accounts (13-17)</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>9. International Data Transfers</h2>
                            <p>
                                Your information may be transferred to and processed in countries other than
                                your own. These countries may have different data protection laws. We ensure
                                appropriate safeguards are in place for such transfers.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>10. Third-Party Links and Services</h2>
                            <p>
                                WeInvite may contain links to third-party websites or services. We are not
                                responsible for the privacy practices of these third parties. We encourage
                                you to review their privacy policies.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>11. California Privacy Rights (CCPA)</h2>
                            <p>
                                California residents have specific rights under the California Consumer
                                Privacy Act (CCPA):
                            </p>
                            <ul>
                                <li>Right to know what personal information is collected</li>
                                <li>Right to know if personal information is sold or disclosed</li>
                                <li>Right to say no to the sale of personal information</li>
                                <li>Right to access your personal information</li>
                                <li>Right to delete your personal information</li>
                                <li>Right to equal service and price</li>
                            </ul>
                            <p>
                                <strong>Note:</strong> WeInvite does not sell personal information.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>12. European Privacy Rights (GDPR)</h2>
                            <p>
                                If you're in the European Economic Area (EEA), you have rights under the
                                General Data Protection Regulation (GDPR):
                            </p>
                            <ul>
                                <li>Legal basis for processing (consent, contract, legitimate interests)</li>
                                <li>Right to access your data</li>
                                <li>Right to rectification</li>
                                <li>Right to erasure ("right to be forgotten")</li>
                                <li>Right to restrict processing</li>
                                <li>Right to data portability</li>
                                <li>Right to object</li>
                                <li>Right to lodge a complaint with supervisory authority</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h2>13. Changes to This Privacy Policy</h2>
                            <p>
                                We may update this Privacy Policy from time to time. We will notify you of
                                significant changes by:
                            </p>
                            <ul>
                                <li>Posting the new Privacy Policy on this page</li>
                                <li>Updating the "Last Updated" date</li>
                                <li>Sending an email notification (for material changes)</li>
                            </ul>
                            <p>
                                Continued use of the Service after changes constitutes acceptance of the
                                updated Privacy Policy.
                            </p>
                        </div>

                        <div class="legal-section">
                            <h2>14. Contact Us</h2>
                            <p>
                                If you have questions about this Privacy Policy or our privacy practices,
                                please contact us:
                            </p>
                            <ul>
                                <li><strong>Email:</strong> privacy@weinvite.com</li>
                                <li><strong>Support:</strong> support@weinvite.com</li>
                                <li><strong>Website:</strong> <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Page</a></li>
                            </ul>
                            <p>
                                For data subject requests (access, deletion, etc.), please email
                                privacy@weinvite.com with "Privacy Request" in the subject line.
                            </p>
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
                    <a href="<?php echo esc_url(home_url('/terms')); ?>" class="btn btn-outline-primary">
                        Terms of Service
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
