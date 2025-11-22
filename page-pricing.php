<?php
/**
 * Template Name: Pricing Page
 * Template Post Type: page
 *
 * Pricing page displaying credit packages and detailed pricing information.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main pricing-page">

    <!-- Page Hero -->
    <section class="hero hero-page">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Simple, Transparent Pricing</h1>
                <p class="hero-description text-lg">
                    Pay only for what you use. No subscriptions, no hidden fees. Credits never expire.
                </p>
            </div>
        </div>
    </section>

    <!-- Pricing Packages Section -->
    <section class="section section-pricing-packages">
        <div class="container">
            <div class="row justify-content-center">

                <!-- Starter Package -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="package-card">
                        <div class="package-header">
                            <h3 class="package-name">Starter</h3>
                            <div class="package-price">
                                <span class="currency">$</span>9.99
                            </div>
                            <div class="package-credits">100 Credits</div>
                            <div class="package-price-per">$0.10 per credit</div>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>Perfect for small events</li>
                                <li>~20 guests per event</li>
                                <li>Digital invitations</li>
                                <li>RSVP tracking</li>
                                <li>Basic analytics</li>
                                <li>Email support</li>
                            </ul>
                            <div class="package-cta">
                                <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-outline-primary btn-block">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Package -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="package-card package-popular">
                        <div class="package-header">
                            <h3 class="package-name">Popular</h3>
                            <div class="package-price">
                                <span class="currency">$</span>24.99
                            </div>
                            <div class="package-credits">300 Credits</div>
                            <div class="package-price-per">$0.083 per credit</div>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>Great for medium events</li>
                                <li>~60 guests per event</li>
                                <li>All Starter features</li>
                                <li>Priority support</li>
                                <li>Advanced analytics</li>
                                <li><strong>Save 17%</strong></li>
                            </ul>
                            <div class="package-cta">
                                <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-primary btn-block">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pro Package -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="package-card">
                        <div class="package-header">
                            <h3 class="package-name">Pro</h3>
                            <div class="package-price">
                                <span class="currency">$</span>49.99
                            </div>
                            <div class="package-credits">700 Credits</div>
                            <div class="package-price-per">$0.071 per credit</div>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>Ideal for large events</li>
                                <li>~140 guests per event</li>
                                <li>All Popular features</li>
                                <li>Premium support</li>
                                <li>Custom branding</li>
                                <li><strong>Save 29%</strong></li>
                            </ul>
                            <div class="package-cta">
                                <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-outline-primary btn-block">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enterprise Package -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="package-card">
                        <div class="package-header">
                            <h3 class="package-name">Enterprise</h3>
                            <div class="package-price">
                                <span class="currency">$</span>99.99
                            </div>
                            <div class="package-credits">1,500 Credits</div>
                            <div class="package-price-per">$0.067 per credit</div>
                        </div>
                        <div class="package-body">
                            <ul class="package-features">
                                <li>For multiple large events</li>
                                <li>~300 guests per event</li>
                                <li>All Pro features</li>
                                <li>Dedicated support</li>
                                <li>API access</li>
                                <li><strong>Save 33%</strong></li>
                            </ul>
                            <div class="package-cta">
                                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline-primary btn-block">
                                    Contact Sales
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- How Credits Work Section -->
    <section class="section section-credits-explained bg-secondary">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">How Credits Work</h2>
                <p class="section-subtitle">Simple and transparent - you only pay for what you use</p>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="credit-cost-card text-center">
                        <div class="credit-icon">🎫</div>
                        <h4>Create Event</h4>
                        <div class="credit-amount">10 credits</div>
                        <p class="text-sm">One-time cost per event</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="credit-cost-card text-center">
                        <div class="credit-icon">📧</div>
                        <h4>Send Invitation</h4>
                        <div class="credit-amount">5 credits</div>
                        <p class="text-sm">Per invitation sent</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="credit-cost-card text-center">
                        <div class="credit-icon">🔔</div>
                        <h4>Send Reminder</h4>
                        <div class="credit-amount">2 credits</div>
                        <p class="text-sm">Per reminder notification</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="credit-cost-card text-center">
                        <div class="credit-icon">✏️</div>
                        <h4>Update Event</h4>
                        <div class="credit-amount">3 credits</div>
                        <p class="text-sm">Per update notification</p>
                    </div>
                </div>
            </div>

            <div class="credit-calculator-box mt-5">
                <h3 class="text-center mb-4">Credit Calculator</h3>
                <div class="card card-elevated">
                    <div class="card-body">
                        <form id="credit-calculator" class="credit-calculator-form">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Number of Guests</label>
                                        <input type="number"
                                               class="form-control"
                                               id="calc-guests"
                                               value="50"
                                               min="1"
                                               max="1000">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Reminder Messages</label>
                                        <input type="number"
                                               class="form-control"
                                               id="calc-reminders"
                                               value="1"
                                               min="0"
                                               max="10">
                                    </div>
                                </div>
                            </div>
                            <div class="calculator-result">
                                <div class="result-breakdown">
                                    <div class="result-item">
                                        <span>Event Creation:</span>
                                        <span id="result-event">10 credits</span>
                                    </div>
                                    <div class="result-item">
                                        <span>Invitations:</span>
                                        <span id="result-invitations">250 credits</span>
                                    </div>
                                    <div class="result-item">
                                        <span>Reminders:</span>
                                        <span id="result-reminders">100 credits</span>
                                    </div>
                                    <div class="result-total">
                                        <span><strong>Total Credits Needed:</strong></span>
                                        <span id="result-total" class="text-primary"><strong>360 credits</strong></span>
                                    </div>
                                </div>
                                <div class="recommended-package mt-4 text-center">
                                    <p class="text-secondary">Recommended Package:</p>
                                    <p id="recommended-package" class="h4 text-primary">Popular Pack (300 credits)</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Comparison Table -->
    <section class="section section-comparison">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Compare Features</h2>
                <p class="section-subtitle">All packages include core features - larger packages add more value</p>
            </div>

            <div class="comparison-table-wrapper">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Starter</th>
                            <th>Popular</th>
                            <th>Pro</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Credits Included</td>
                            <td>100</td>
                            <td>300</td>
                            <td>700</td>
                            <td>1,500</td>
                        </tr>
                        <tr>
                            <td>Digital Invitations</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>RSVP Tracking</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Guest Management</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Guardian Approval</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Basic Analytics</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Advanced Analytics</td>
                            <td>-</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Priority Support</td>
                            <td>-</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Custom Branding</td>
                            <td>-</td>
                            <td>-</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>API Access</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Dedicated Support</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>✓</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Pricing FAQ Section -->
    <section class="section section-pricing-faq bg-secondary">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Pricing FAQs</h2>
                <p class="section-subtitle">Common questions about our pricing</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="faq-list">

                        <div class="faq-item">
                            <h4 class="faq-question">Do credits expire?</h4>
                            <p class="faq-answer">
                                No! Credits never expire. Purchase once and use them whenever you need,
                                whether that's today or a year from now.
                            </p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">Can I buy more credits later?</h4>
                            <p class="faq-answer">
                                Absolutely! You can purchase additional credit packages at any time.
                                Your credits accumulate, so you'll never lose what you've already purchased.
                            </p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">What if I run out of credits during an event?</h4>
                            <p class="faq-answer">
                                Don't worry! You can purchase more credits instantly and continue managing
                                your event without any interruption.
                            </p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">Are there any hidden fees?</h4>
                            <p class="faq-answer">
                                No hidden fees whatsoever. The credit packages are all you pay.
                                No monthly subscriptions, no setup fees, no surprises.
                            </p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">Can I get a refund?</h4>
                            <p class="faq-answer">
                                We offer a 30-day money-back guarantee on all credit packages.
                                If you're not satisfied, contact us for a full refund of unused credits.
                            </p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">Do you offer discounts for large purchases?</h4>
                            <p class="faq-answer">
                                Yes! Larger packages offer better per-credit pricing. For enterprise needs
                                (5,000+ credits), contact our sales team for custom pricing.
                            </p>
                        </div>

                    </div>

                    <div class="text-center mt-4">
                        <a href="<?php echo esc_url(home_url('/faq')); ?>" class="btn btn-link">
                            View All FAQs →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-cta">
        <div class="container">
            <div class="cta-box text-center">
                <h2 class="h1">Ready to Get Started?</h2>
                <p class="text-lg">
                    Create your account now and get started with your first event.
                    No credit card required to sign up.
                </p>
                <div class="cta-actions">
                    <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-primary btn-lg">
                        Create Free Account
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline-primary btn-lg">
                        Contact Sales
                    </a>
                </div>
                <p class="text-sm text-secondary mt-3">
                    No credit card required • Credits never expire • 30-day money-back guarantee
                </p>
            </div>
        </div>
    </section>

</main>

<script>
// Simple credit calculator
(function() {
    const calcForm = document.getElementById('credit-calculator');
    if (!calcForm) return;

    const guestsInput = document.getElementById('calc-guests');
    const remindersInput = document.getElementById('calc-reminders');

    function calculateCredits() {
        const guests = parseInt(guestsInput.value) || 0;
        const reminders = parseInt(remindersInput.value) || 0;

        const eventCost = 10;
        const invitationCost = guests * 5;
        const reminderCost = guests * reminders * 2;
        const total = eventCost + invitationCost + reminderCost;

        document.getElementById('result-event').textContent = eventCost + ' credits';
        document.getElementById('result-invitations').textContent = invitationCost + ' credits';
        document.getElementById('result-reminders').textContent = reminderCost + ' credits';
        document.getElementById('result-total').textContent = total + ' credits';

        // Recommend package
        let recommended = 'Starter Pack (100 credits)';
        if (total > 100 && total <= 300) {
            recommended = 'Popular Pack (300 credits)';
        } else if (total > 300 && total <= 700) {
            recommended = 'Pro Pack (700 credits)';
        } else if (total > 700) {
            recommended = 'Enterprise Pack (1,500 credits)';
        }
        document.getElementById('recommended-package').textContent = recommended;
    }

    guestsInput.addEventListener('input', calculateCredits);
    remindersInput.addEventListener('input', calculateCredits);
    calculateCredits(); // Initial calculation
})();
</script>

<?php
get_footer();
