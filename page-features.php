<?php
/**
 * Template Name: Features Page
 * Template Post Type: page
 *
 * Detailed features page showcasing all WeInvite capabilities.
 *
 * @package WeInvite_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main features-page">

    <!-- Page Hero -->
    <section class="hero hero-page">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Powerful Features for Every Event</h1>
                <p class="hero-description text-lg">
                    Everything you need to plan, manage, and host successful events from start to finish
                </p>
            </div>
        </div>
    </section>

    <!-- Core Features Section -->
    <section class="section section-features">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Core Features</h2>
                <p class="section-subtitle">Essential tools for successful event management</p>
            </div>

            <!-- Feature: Digital Invitations -->
            <div class="feature-detail">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="feature-content">
                            <span class="badge badge-soft-primary">Invitations</span>
                            <h3 class="h2 mt-3">Beautiful Digital Invitations</h3>
                            <p class="text-lg">
                                Create stunning, professional invitations that make a great first impression.
                                Choose from customizable templates or design your own.
                            </p>
                            <ul class="feature-list">
                                <li>📱 SMS invitation delivery</li>
                                <li>📧 Email invitation with rich formatting</li>
                                <li>🔗 Shareable invitation links</li>
                                <li>🎨 Customizable templates and themes</li>
                                <li>🖼️ Upload custom cover photos</li>
                                <li>✏️ Rich text event descriptions</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/feature-invitations.png'); ?>"
                                 alt="Digital Invitations Feature"
                                 class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature: RSVP Management -->
            <div class="feature-detail">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-12 col-lg-6">
                        <div class="feature-content">
                            <span class="badge badge-soft-success">RSVP</span>
                            <h3 class="h2 mt-3">Smart RSVP Tracking</h3>
                            <p class="text-lg">
                                Know exactly who's coming to your event with real-time RSVP tracking and management.
                            </p>
                            <ul class="feature-list">
                                <li>✓ Real-time response tracking</li>
                                <li>⏱️ Track attending, declined, and pending</li>
                                <li>👥 Plus-one management</li>
                                <li>📊 Response rate analytics</li>
                                <li>🔔 Automatic reminder notifications</li>
                                <li>✏️ Easy RSVP editing for guests</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/feature-rsvp.png'); ?>"
                                 alt="RSVP Tracking Feature"
                                 class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature: Guest Management -->
            <div class="feature-detail">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="feature-content">
                            <span class="badge badge-soft-info">Guests</span>
                            <h3 class="h2 mt-3">Effortless Guest Management</h3>
                            <p class="text-lg">
                                Keep your guest list organized and up-to-date with powerful management tools.
                            </p>
                            <ul class="feature-list">
                                <li>📋 Import contacts from phone/email</li>
                                <li>✏️ Manual guest entry with validation</li>
                                <li>👨‍👩‍👧‍👦 Family and group management</li>
                                <li>🏷️ Custom guest categories and tags</li>
                                <li>📊 Guest list filtering and sorting</li>
                                <li>📤 Export guest data (CSV, Excel)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/feature-guests.png'); ?>"
                                 alt="Guest Management Feature"
                                 class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Unique Features Section -->
    <section class="section section-unique-features bg-secondary">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">What Makes Us Different</h2>
                <p class="section-subtitle">Unique features you won't find elsewhere</p>
            </div>

            <!-- Feature: Guardian Approval -->
            <div class="feature-detail">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-12 col-lg-6">
                        <div class="feature-content">
                            <span class="badge badge-soft-warning">Safety First</span>
                            <h3 class="h2 mt-3">Guardian Approval System</h3>
                            <p class="text-lg">
                                Industry-first feature for events involving minors. Parents must approve before
                                their children can RSVP to events.
                            </p>
                            <ul class="feature-list">
                                <li>🛡️ Parent/guardian approval required</li>
                                <li>📱 Approval notifications via SMS</li>
                                <li>👨‍👩‍👧 Link minors to guardian accounts</li>
                                <li>✅ Approve or decline invitations</li>
                                <li>📋 View all child's invitations</li>
                                <li>🔒 Privacy and safety controls</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/feature-guardian.png'); ?>"
                                 alt="Guardian Approval Feature"
                                 class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature: Credit System -->
            <div class="feature-detail">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="feature-content">
                            <span class="badge badge-soft-primary">Flexible Pricing</span>
                            <h3 class="h2 mt-3">Fair Credit-Based System</h3>
                            <p class="text-lg">
                                Pay only for what you use. No subscriptions, no hidden fees. Just simple,
                                transparent credit-based pricing.
                            </p>
                            <ul class="feature-list">
                                <li>💳 Buy credits in packages</li>
                                <li>📊 Real-time credit balance</li>
                                <li>💰 Credits never expire</li>
                                <li>🧮 Credit calculator for planning</li>
                                <li>📈 Usage history and reports</li>
                                <li>🎁 Bonus credits with larger packages</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/feature-credits.png'); ?>"
                                 alt="Credit System Feature"
                                 class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Analytics Features -->
    <section class="section section-analytics">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Powerful Analytics & Insights</h2>
                <p class="section-subtitle">Make data-driven decisions for your events</p>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-elevated text-center">
                        <div class="card-body">
                            <div class="analytics-icon">📊</div>
                            <h4>Real-time Dashboard</h4>
                            <p>See all your event metrics at a glance with live updates</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-elevated text-center">
                        <div class="card-body">
                            <div class="analytics-icon">👁️</div>
                            <h4>Invitation Views</h4>
                            <p>Track who opened your invitations and when</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-elevated text-center">
                        <div class="card-body">
                            <div class="analytics-icon">📈</div>
                            <h4>Response Trends</h4>
                            <p>Visualize RSVP patterns over time</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-elevated text-center">
                        <div class="card-body">
                            <div class="analytics-icon">📤</div>
                            <h4>Export Reports</h4>
                            <p>Download detailed reports for record-keeping</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- For Different Users Section -->
    <section class="section section-user-types bg-secondary">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Perfect For Everyone</h2>
                <p class="section-subtitle">Tailored features for different event types and users</p>
            </div>

            <div class="card-grid">
                <!-- Event Hosts -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="user-type-icon">🎉</div>
                        <h3 class="h4">Event Hosts</h3>
                        <p>Perfect for birthdays, weddings, parties, and celebrations of all sizes.</p>
                        <ul class="feature-list-compact">
                            <li>Easy invitation creation</li>
                            <li>Guest list management</li>
                            <li>RSVP tracking</li>
                            <li>Event reminders</li>
                        </ul>
                    </div>
                </div>

                <!-- Corporate Events -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="user-type-icon">💼</div>
                        <h3 class="h4">Corporate Events</h3>
                        <p>Professional tools for business meetings, conferences, and corporate gatherings.</p>
                        <ul class="feature-list-compact">
                            <li>Professional templates</li>
                            <li>Attendance tracking</li>
                            <li>Detailed analytics</li>
                            <li>Team collaboration</li>
                        </ul>
                    </div>
                </div>

                <!-- Parents & Guardians -->
                <div class="card card-elevated">
                    <div class="card-body">
                        <div class="user-type-icon">👨‍👩‍👧</div>
                        <h3 class="h4">Parents & Guardians</h3>
                        <p>Keep your children safe with approval controls and visibility into all events.</p>
                        <ul class="feature-list-compact">
                            <li>Guardian approval system</li>
                            <li>View all child invitations</li>
                            <li>Safety controls</li>
                            <li>Communication with hosts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-cta">
        <div class="container">
            <div class="cta-box text-center">
                <h2 class="h1">Experience All Features Free</h2>
                <p class="text-lg">
                    Start creating amazing events today. No credit card required to get started.
                </p>
                <div class="cta-actions">
                    <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-primary btn-lg">
                        Get Started Free
                    </a>
                    <a href="<?php echo esc_url(home_url('/pricing')); ?>" class="btn btn-outline-primary btn-lg">
                        View Pricing
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
