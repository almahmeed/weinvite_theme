/**
 * ============================================
 * WEINVITE RSVP FLOW JAVASCRIPT
 * Phase 7: Sprint 3 Implementation
 * November 10, 2025
 * Version: 1.0.0
 * DEBUG VERSION: 2025-11-25-BUG013-FIX-V8-TRACE-BEFORE-TRY
 * ============================================
 */

(function() {
  'use strict';

  // Get configuration passed from PHP
  const config = window.weinvitePublicEvent || {};
  const API_URL = config.apiUrl || '/wp-json/weinvite/v1/';
  const EVENT_TOKEN = config.eventToken || '';
  const NONCE = config.nonce || '';

  console.log('🔧 WeInvite RSVP Flow initialized - DEBUG VERSION: 2025-11-25-BUG013-FIX-V3-GLOBAL-ONCLICK', {
    apiUrl: API_URL,
    eventToken: EVENT_TOKEN,
    debugMode: true,
    fix: 'Using global onclick function to bypass scope issues'
  });

  /**
   * ==========================================
   * PHASE 2 IMPLEMENTATION - TO BE BUILT
   * ==========================================
   *
   * Functions to implement:
   *
   * 1. fetchEventData()
   *    - GET /wp-json/weinvite/v1/events/{token}
   *    - Display event details
   *    - Hide/show location based on RSVP status
   *
   * 2. initRSVPForm()
   *    - Phone number input validation
   *    - Plus ones selection
   *    - Submit handler
   *
   * 3. requestOTP(phoneNumber, eventId)
   *    - POST /wp-json/weinvite/v1/rsvp/request-otp
   *    - Show OTP input modal
   *    - Handle errors
   *
   * 4. verifyOTPAndRSVP(phone, otp, eventId, plusOnes)
   *    - POST /wp-json/weinvite/v1/rsvp/verify-otp
   *    - Show success state
   *    - Reveal hidden content
   *
   * 5. updateRSVP()
   *    - POST /wp-json/weinvite/v1/rsvp/update
   *    - Update phone number or plus ones
   *
   * 6. cancelRSVP()
   *    - POST /wp-json/weinvite/v1/rsvp/cancel
   *    - Confirmation modal
   *
   * 7. handleErrors(error)
   *    - Display user-friendly error messages
   *    - Error code handling (event_not_found, event_full, etc.)
   *
   * 8. OTP Input Management
   *    - Auto-advance between digits
   *    - Backspace handling
   *    - Paste handling
   *    - Resend countdown timer
   *
   * 9. Modal Management
   *    - Open/close modals
   *    - Backdrop click handling
   *    - Escape key handling
   *
   * 10. Bottom Sheet (Mobile)
   *     - Touch swipe handling
   *     - Spring animation
   *
   * ==========================================
   */

  // REGISTER GLOBAL FUNCTION IMMEDIATELY (before DOM loads)
  window.WeInviteSubmitRSVP = async function() {
    alert('Step 1: Global function called!');
    console.log('[MOBILE DEBUG] 🎯 GLOBAL FUNCTION CALLED: WeInviteSubmitRSVP');

    const fakeEvent = {
      preventDefault: () => {},
      stopPropagation: () => {},
      target: document.getElementById('rsvp-form')
    };

    alert('Step 2: About to call handleRSVPFormSubmit');

    try {
      await handleRSVPFormSubmit(fakeEvent);
      alert('Step 3: handleRSVPFormSubmit completed!');
    } catch (error) {
      alert('ERROR: ' + error.message);
      console.error('Error in WeInviteSubmitRSVP:', error);
    }
  };
  console.log('[MOBILE DEBUG] ✅ Global WeInviteSubmitRSVP registered EARLY');

  // Page load initialization
  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - Phase 2 implementation active');

    // Show loading screen initially
    showLoadingScreen();

    // Check if user has RSVP'd in this session (BUG #011 FIX)
    const hasRsvpSession = sessionStorage.getItem('weinvite_rsvp_confirmed') === 'true';
    const sessionEventToken = sessionStorage.getItem('weinvite_event_token');

    console.log('[MOBILE DEBUG] SessionStorage check:', {
      hasRsvpSession,
      sessionEventToken,
      currentEventToken: EVENT_TOKEN,
      matches: sessionEventToken === EVENT_TOKEN
    });

    // Set global flag if user has RSVP'd to THIS event
    if (hasRsvpSession && sessionEventToken === EVENT_TOKEN) {
      console.log('[MOBILE DEBUG] User has already RSVP\'d to this event (session storage)');
      console.log('[MOBILE DEBUG] Setting WeInviteRSVPStatus = confirmed');
      window.WeInviteRSVPStatus = 'confirmed';
      window.WeInviteRSVPCode = sessionStorage.getItem('weinvite_rsvp_code') || '';
    } else {
      console.log('[MOBILE DEBUG] User has NOT RSVP\'d yet (or different event)');
    }

    // Fetch event data
    if (EVENT_TOKEN) {
      fetchEventData(EVENT_TOKEN);
    } else {
      showErrorScreen('Invalid Event Link', 'No event token was provided. Please check your link and try again.');
    }
  });

  /**
   * Show loading screen
   */
  function showLoadingScreen() {
    const loadingScreen = document.getElementById('loading-screen');
    if (loadingScreen) {
      loadingScreen.style.display = 'flex';
    }
  }

  /**
   * Hide loading screen
   */
  function hideLoadingScreen() {
    const loadingScreen = document.getElementById('loading-screen');
    if (loadingScreen) {
      loadingScreen.style.display = 'none';
    }
  }

  /**
   * Show error screen
   */
  function showErrorScreen(title, message) {
    hideLoadingScreen();
    const errorScreen = document.getElementById('error-screen');
    const errorTitle = document.getElementById('error-title');
    const errorMessage = document.getElementById('error-message');

    if (errorScreen) {
      errorScreen.style.display = 'flex';
    }
    if (errorTitle) {
      errorTitle.textContent = title;
    }
    if (errorMessage) {
      errorMessage.textContent = message;
    }
  }

  /**
   * Show event content
   */
  function showEventContent() {
    hideLoadingScreen();
    const eventContent = document.getElementById('event-content');
    if (eventContent) {
      eventContent.style.display = 'block';
    }
  }

  /**
   * Fetch event data from API
   */
  async function fetchEventData(token) {
    try {
      const apiEndpoint = `${API_URL}events/public/${token}`;
      console.log('Fetching event from:', apiEndpoint);

      const response = await fetch(apiEndpoint);
      console.log('Response status:', response.status);
      console.log('Response OK:', response.ok);

      // Try to get response text first for debugging
      const responseText = await response.text();
      console.log('Raw response:', responseText.substring(0, 500)); // First 500 chars

      // Parse JSON
      let data;
      try {
        data = JSON.parse(responseText);
      } catch (parseError) {
        console.error('JSON parse error:', parseError);
        console.error('Response was:', responseText);
        throw new Error('Invalid JSON response from server');
      }

      console.log('Parsed data:', data);

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${data.error?.message || response.statusText}`);
      }

      if (!data.success) {
        throw new Error(data.error?.message || 'Failed to load event');
      }

      // Handle different response formats
      // BEDEV's API returns data.event, not data.data
      const eventData = data.event || data.data;

      if (!eventData) {
        throw new Error('No event data returned from API');
      }

      console.log('Event data received:', eventData);

      // Render event data
      renderEventPage(eventData);

    } catch (error) {
      console.error('Error fetching event:', error);
      handleEventFetchError(error);
    }
  }

  /**
   * Render complete event page
   */
  function renderEventPage(event) {
    console.log('Rendering event:', event);

    // Store event data globally for RSVP flow
    window.WeInviteCurrentEvent = event;

    // Check if user has RSVP'd (BUG #011 FIX)
    const hasRsvpd = window.WeInviteRSVPStatus === 'confirmed';

    // Check if event is full
    const capacity = event.capacity_limit || event.rsvp_settings?.invite_limit || 100;
    const rsvpCount = event.rsvp_count || 0;
    const isFull = rsvpCount >= capacity;

    // Show warning banner if event is full
    if (isFull && !hasRsvpd) {
      showEventFullBanner(event);
    }

    // Render left column content
    renderHeroSection(event);
    renderEventDetails(event, isFull);
    renderHostSection(event);

    // Hide privacy message if user has RSVP'd (BUG #011 FIX)
    const privacyMessage = document.getElementById('privacy-message');
    if (privacyMessage) {
      if (hasRsvpd) {
        privacyMessage.style.display = 'none';
      } else {
        privacyMessage.style.display = 'flex';
      }
    }

    // Render right column (BUG #011 FIX: Show confirmation if RSVP'd)
    console.log('[MOBILE DEBUG] Rendering decision:', {
      hasRsvpd,
      isFull,
      rsvpCount,
      capacity,
      WeInviteRSVPStatus: window.WeInviteRSVPStatus
    });

    if (hasRsvpd) {
      console.log('[MOBILE DEBUG] Rendering CONFIRMATION card (user already RSVP\'d)');
      renderConfirmationCard(event);
    } else if (isFull) {
      console.log('[MOBILE DEBUG] Rendering WAITLIST card (event is full)');
      renderWaitlistCard(event);
    } else {
      console.log('[MOBILE DEBUG] Rendering RSVP card (normal flow)');
      renderRSVPCard(event);
    }

    // Show content, hide loading
    hideLoadingScreen();
    showEventContent();
  }

  /**
   * Render hero image section
   */
  function renderHeroSection(event) {
    const imageUrl = event.image_url || 'https://placehold.co/800x450/7B3FF2/FFFFFF/webp?text=Event+Image';

    const heroHTML = `
      <img src="${escapeHtml(imageUrl)}" alt="${escapeHtml(event.title)}" loading="eager">
      <div class="hero-gradient-overlay"></div>
      <div class="hero-logo-overlay">
        <div class="logo-placeholder">WeInvite</div>
      </div>
    `;

    // Render to desktop layout
    const heroSection = document.getElementById('hero-section');
    if (heroSection) {
      heroSection.innerHTML = heroHTML;
    }

    // Render to mobile layout
    const mobileHero = document.querySelector('.mobile-hero-wrapper');
    if (mobileHero) {
      mobileHero.innerHTML = `<div class="hero-section">${heroHTML}</div>`;
    }
  }

  /**
   * Render capacity card with conditional visibility (WEBUX TASK 3)
   * SYSARCH-Approved: Defensive programming - check field existence
   */
  function renderCapacityCard(event, rsvpCount, capacity, spotsAvailable, capacityPercent, isFull) {
    // Check if capacity should be shown to guests
    const showCapacity = event.show_capacity &&
                         event.capacity_limit !== undefined &&
                         event.rsvp_count !== undefined;

    if (showCapacity) {
      // Scenario A: Show exact numbers
      return renderDetailedCapacity(rsvpCount, capacity, spotsAvailable, capacityPercent, isFull);
    } else {
      // Scenario B or C: Show generic message
      return renderGenericCapacity(isFull);
    }
  }

  /**
   * Render detailed capacity (when visible)
   */
  function renderDetailedCapacity(rsvpCount, capacity, spotsAvailable, capacityPercent, isFull) {
    return `
      <div class="info-card ${isFull ? 'info-card-full' : ''}">
        ${isFull ? '<div class="full-badge"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg> FULL</div>' : ''}
        <svg class="info-card-icon ${isFull ? 'icon-error' : ''}" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          ${isFull ? '<circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line>' : '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>'}
        </svg>
        <div class="info-card-label">Capacity</div>
        <div class="info-card-value ${isFull ? 'info-card-value-error' : ''}">${rsvpCount} / ${capacity} spots filled</div>
        ${isFull ? '<div class="info-card-value info-card-value-warning">Join waitlist below</div>' : `<div class="info-card-value info-card-value-success">${spotsAvailable} spots available</div>`}
        ${isFull ? `<div class="capacity-progress-bar"><div class="capacity-progress-fill capacity-progress-full"></div></div>` : ''}
      </div>
    `;
  }

  /**
   * Render generic capacity (when hidden)
   */
  function renderGenericCapacity(isFull) {
    if (isFull) {
      // Scenario C: Event is full + capacity hidden
      return `
        <div class="info-card capacity-hidden capacity-full">
          <svg class="info-card-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F57C00" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
          </svg>
          <div class="info-card-label">Capacity</div>
          <div class="info-card-value">Event is currently full</div>
          <div class="info-card-helper">Join waitlist to be notified if a spot opens</div>
        </div>
      `;
    } else {
      // Scenario B: Capacity available but hidden
      return `
        <div class="info-card capacity-hidden">
          <svg class="info-card-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          <div class="info-card-label">Capacity</div>
          <div class="info-card-value">Limited capacity</div>
          <div class="info-card-helper">Respond soon to secure your spot!</div>
        </div>
      `;
    }
  }

  /**
   * Render event details section
   */
  function renderEventDetails(event, isFull = false) {
    // Check if user has RSVP'd (BUG #011 FIX)
    const hasRsvpd = window.WeInviteRSVPStatus === 'confirmed';

    // Use formatted_date if available, otherwise format it ourselves
    let dateFormatted;
    if (event.formatted_date) {
      dateFormatted = event.formatted_date;
    } else {
      const eventDate = new Date(event.date + 'T' + event.time);
      dateFormatted = eventDate.toLocaleDateString('en-US', {
        weekday: 'short',
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      });
    }

    const timeFormatted = formatTime(event.time);

    // Calculate capacity (use defaults if not provided)
    const capacity = event.capacity_limit || event.rsvp_settings?.invite_limit || 100;
    const rsvpCount = event.rsvp_count || 0;
    const spotsAvailable = capacity - rsvpCount;
    const capacityPercent = Math.round((rsvpCount / capacity) * 100);

    // Get waitlist data from BEDEV's API response
    const waitlistSize = event.waitlist?.count || 0;

    const detailsHTML = `
      <!-- Event Title -->
      <div class="event-title-section">
        <h1 class="event-title">${escapeHtml(event.title)}</h1>
        ${event.tagline ? `<p class="event-tagline">${escapeHtml(event.tagline)}</p>` : ''}
      </div>

      <!-- Quick Info Cards Grid -->
      <div class="event-info-cards">
        <!-- Date & Time Card -->
        <div class="info-card">
          <svg class="info-card-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <div class="info-card-label">Date & Time</div>
          <div class="info-card-value">${dateFormatted}</div>
          <div class="info-card-value">${timeFormatted}</div>
        </div>

        <!-- Location Card (Conditional - BUG #011 FIX) -->
        ${hasRsvpd ? `
        <div class="info-card">
          <svg class="info-card-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          <div class="info-card-label">Location</div>
          <div class="info-card-value">${escapeHtml(event.location?.name || event.location || 'Location Details')}</div>
          ${event.location?.address ? `<div class="info-card-value">${escapeHtml(event.location.address)}</div>` : ''}
        </div>
        ` : `
        <div class="info-card info-card-locked">
          <svg class="info-card-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="5" y="11" width="14" height="10" rx="2" ry="2"></rect>
            <path d="M12 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
            <path d="M8 11V7a4 4 0 0 1 8 0v4"></path>
          </svg>
          <div class="info-card-label">Location</div>
          <div class="info-card-value info-card-value-locked">Hidden until registration</div>
        </div>
        `}

        <!-- Capacity Card (Conditional Visibility) -->
        ${renderCapacityCard(event, rsvpCount, capacity, spotsAvailable, capacityPercent, isFull)}
      </div>

      ${isFull ? `
      <!-- Event Full Alert Box -->
      <div class="event-full-alert">
        <svg class="alert-icon-large" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
          <line x1="12" y1="9" x2="12" y2="13"></line>
          <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>
        <div class="alert-content">
          <div class="alert-title">This Event Is Currently At Full Capacity</div>
          <div class="alert-message">
            All ${capacity} spots have been filled. However, spots may become available if attendees
            cancel their registrations. Join the waitlist below and we'll notify you immediately via
            SMS if a spot opens up.
          </div>
          <div class="waitlist-stats">
            <span class="waitlist-stats-label">Current waitlist:</span>
            <span class="waitlist-stats-value">${waitlistSize} people</span>
          </div>
        </div>
      </div>
      ` : ''}

      <!-- Event Description -->
      <div class="event-description-section">
        <h2 class="section-header">About This Event</h2>
        <div class="event-description">${escapeHtml(event.description || '').replace(/\n/g, '<br>')}</div>
      </div>

      <!-- What to Bring -->
      ${event.what_to_bring ? `
      <div class="what-to-bring-section">
        <h3 class="section-subheader">What to Bring</h3>
        <div class="what-to-bring-list">
          ${event.what_to_bring.split('\n').map(item => `
            <div class="list-item">
              <svg class="list-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              <span class="list-text">${escapeHtml(item)}</span>
            </div>
          `).join('')}
        </div>
      </div>
      ` : ''}

      <!-- Important Information -->
      ${event.important_info ? `
      <div class="important-info-section">
        <h3 class="section-subheader">Important Information</h3>
        <div class="info-alert-box">
          ${event.important_info.split('\n').map(item => `
            <div class="alert-item">
              <svg class="alert-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
              </svg>
              <span class="alert-text">${escapeHtml(item)}</span>
            </div>
          `).join('')}
        </div>
      </div>
      ` : ''}

      ${isFull ? `
      <!-- Waitlist FAQs -->
      <div class="waitlist-faqs-section">
        <h3 class="section-subheader">Waitlist FAQs</h3>
        <div class="faq-container">
          <div class="faq-item">
            <div class="faq-question">
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
              How does the waitlist work?
            </div>
            <div class="faq-answer">
              If someone cancels their registration, the next person on the waitlist will receive an instant SMS notification. You'll have 15 minutes to confirm your spot before we move to the next person.
            </div>
          </div>
          <div class="faq-item">
            <div class="faq-question">
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
              What are my chances of getting off the waitlist?
            </div>
            <div class="faq-answer">
              Historically, about 20-30% of waitlisted attendees get a spot as people's plans change. The earlier you join, the better your chances.
            </div>
          </div>
          <div class="faq-item">
            <div class="faq-question">
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
              Can I leave the waitlist?
            </div>
            <div class="faq-answer">
              Yes, you can remove yourself from the waitlist at any time by clicking the link in your confirmation SMS or returning to this page.
            </div>
          </div>
          <div class="faq-item">
            <div class="faq-question">
              <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
              Will I be charged if I get off the waitlist?
            </div>
            <div class="faq-answer">
              No, this is a free event. There are no charges or fees.
            </div>
          </div>
        </div>
      </div>
      ` : ''}
    `;

    // Render to desktop layout
    const detailsSection = document.getElementById('event-details');
    if (detailsSection) {
      detailsSection.innerHTML = detailsHTML;
    }

    // Render to mobile layout
    const mobileDetails = document.querySelector('.mobile-event-details');
    if (mobileDetails) {
      mobileDetails.innerHTML = `<div class="event-details-section">${detailsHTML}</div>`;
    }
  }

  /**
   * Render host section
   */
  function renderHostSection(event) {
    const detailsSection = document.getElementById('event-details');
    if (!detailsSection) return;

    // Check if user has RSVP'd (BUG #011 FIX)
    const hasRsvpd = window.WeInviteRSVPStatus === 'confirmed';

    let hostHTML;

    if (hasRsvpd) {
      // Show revealed host details
      // Trim whitespace and fallback if empty (API returns " " instead of actual name)
      const rawHostName = event.host?.name || event.host_name || '';
      const hostName = rawHostName.trim() || 'Event Host';
      const hostAvatar = event.host?.avatar || event.host_avatar || '';
      const hostBio = event.host?.bio || '';

      hostHTML = `
        <div class="host-section">
          <h3 class="section-subheader">Your Host</h3>
          <div class="host-card">
            ${hostAvatar ? `
            <div class="host-avatar">
              <img src="${escapeHtml(hostAvatar)}" alt="${escapeHtml(hostName)}">
            </div>
            ` : `
            <div class="host-avatar">
              <svg class="host-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            `}
            <div class="host-info">
              <div class="host-name">${escapeHtml(hostName)}</div>
              ${hostBio ? `<div class="host-bio">${escapeHtml(hostBio)}</div>` : ''}
            </div>
          </div>
        </div>
      `;
    } else {
      // Show locked host card
      hostHTML = `
        <div class="host-section">
          <h3 class="section-subheader">Your Host</h3>
          <div class="host-card">
            <div class="host-avatar host-avatar-locked">
              <svg class="host-lock-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="5" y="11" width="14" height="10" rx="2" ry="2"></rect>
                <path d="M12 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                <path d="M8 11V7a4 4 0 0 1 8 0v4"></path>
              </svg>
            </div>
            <div class="host-info">
              <div class="host-name host-name-locked">Hidden until registration</div>
              <div class="host-privacy-notice">
                <svg class="privacy-icon-small" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="5" y="11" width="14" height="10" rx="2" ry="2"></rect>
                  <path d="M8 11V7a4 4 0 0 1 8 0v4"></path>
                </svg>
                <span class="privacy-text">Host details will be revealed after you respond</span>
              </div>
            </div>
          </div>
        </div>
      `;
    }

    detailsSection.insertAdjacentHTML('beforeend', hostHTML);
  }

  /**
   * Render RSVP card (right sidebar)
   */
  function renderRSVPCard(event) {
    console.log('[MOBILE DEBUG] renderRSVPCard function called with event:', event);

    // Calculate capacity (use defaults if not provided)
    const capacity = event.capacity_limit || event.rsvp_settings?.invite_limit || 100;
    const rsvpCount = event.rsvp_count || 0;
    const spotsAvailable = capacity - rsvpCount;
    const capacityPercent = Math.round((rsvpCount / capacity) * 100);

    // Check if host wants to show capacity numbers
    const showCapacity = event.show_capacity !== false;
    console.log('[MOBILE DEBUG] Capacity calculations:', { capacity, rsvpCount, spotsAvailable, showCapacity });

    const rsvpHTML = `
      <!-- Response Card Header (BUG #003 FIX) -->
      <div class="rsvp-card-header">
        <h2 class="rsvp-card-title">Respond to This Event</h2>
        <p class="rsvp-card-subtitle">Secure your spot with phone verification</p>
      </div>

      <!-- Spots Available Indicator (conditionally show capacity numbers) -->
      ${showCapacity ? `
      <div class="spots-available-indicator">
        <svg class="spots-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <div class="spots-text">${spotsAvailable} Spots Available</div>
        <div class="spots-capacity">Out of ${capacity} total capacity</div>
        <div class="spots-progress-bar">
          <div class="spots-progress-fill" style="width: ${capacityPercent}%"></div>
        </div>
      </div>
      ` : ''}

      <!-- Response Form (BUG #003) -->
      <form id="rsvp-form" class="rsvp-form" onsubmit="return false;">
        <!-- Plus Ones -->
        <div class="form-group">
          <label for="plus-ones" class="form-label">Number of Guests</label>
          <select id="plus-ones" name="plus_ones" class="form-select">
            <option value="0">Just me</option>
            <option value="1">Me + 1 guest</option>
            <option value="2">Me + 2 guests</option>
            <option value="3">Me + 3 guests</option>
          </select>
          <span class="form-helper">Including yourself in the count</span>
        </div>

        <!-- Phone Number (BUG #005 & #006 FIX) -->
        <div class="form-group">
          <label for="phone-number" class="form-label form-label-required">Phone Number</label>
          <input
            type="tel"
            id="phone-number"
            name="phone"
            class="form-input"
            placeholder="+973 3312 3456 or 35353535"
            required
            title="Enter your phone number (8-15 digits)"
            data-error-required="Phone Number cannot be blank"
          >
          <span class="form-helper">We'll send you a verification code</span>
        </div>

        <!-- Submit Button -->
        <button type="button" class="btn btn-primary btn-block" id="rsvp-submit-btn" onclick="alert('V8 - TRACE BEFORE TRY'); window.WeInviteSubmitRSVP && window.WeInviteSubmitRSVP()">
          Get Verification Code
        </button>
      </form>

      <!-- Privacy Notice -->
      <div class="rsvp-privacy-note">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="5" y="11" width="14" height="10" rx="2" ry="2"></rect>
          <path d="M8 11V7a4 4 0 0 1 8 0v4"></path>
        </svg>
        <span>Your phone number is only used for event verification and will not be shared.</span>
      </div>
    `;

    // Render to desktop layout
    const rsvpCard = document.getElementById('rsvp-card');
    if (rsvpCard) {
      rsvpCard.innerHTML = rsvpHTML;
    }

    // Render to mobile layout
    const mobileRsvpCard = document.querySelector('.mobile-rsvp-card');
    if (mobileRsvpCard) {
      mobileRsvpCard.innerHTML = `<div class="rsvp-card">${rsvpHTML}</div>`;
    }

    // Attach button click handler (BUGFIX: Use button instead of form submit)
    console.log('[MOBILE DEBUG] renderRSVPCard: Attaching button click handler...');
    const submitButton = document.getElementById('rsvp-submit-btn');
    console.log('[MOBILE DEBUG] Submit button element:', submitButton ? 'FOUND' : 'NOT FOUND');

    if (submitButton) {
      submitButton.addEventListener('click', async function(e) {
        console.log('[MOBILE DEBUG] Button clicked! Starting RSVP flow...');
        e.preventDefault();
        e.stopPropagation();

        // Create fake event object for handleRSVPFormSubmit
        const fakeEvent = {
          preventDefault: () => {},
          stopPropagation: () => {},
          target: document.getElementById('rsvp-form')
        };

        await handleRSVPFormSubmit(fakeEvent);
      });
      console.log('[MOBILE DEBUG] Click handler attached successfully to button');
    } else {
      console.error('[MOBILE DEBUG] ERROR: Submit button not found! Cannot attach click handler!');
    }
  }

  /**
   * Render Confirmation Card (right sidebar) - after RSVP (BUG #011 FIX)
   */
  function renderConfirmationCard(event) {
    const rsvpCode = sessionStorage.getItem('weinvite_rsvp_code') || 'CONFIRMED';
    const rsvpPhone = sessionStorage.getItem('weinvite_rsvp_phone') || '';

    const confirmationHTML = `
      <!-- Confirmation Card Header -->
      <div class="rsvp-card-header" style="background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%); border-left: 4px solid #4CAF50;">
        <div style="text-align: center; padding: 20px 0;">
          <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" style="margin: 0 auto;">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
          <h2 style="font-size: 24px; font-weight: 700; color: #2E7D32; margin: 16px 0 8px 0;">You're Registered!</h2>
          <p style="font-size: 14px; color: #558B2F; margin: 0;">Your spot is confirmed</p>
        </div>
      </div>

      <!-- Confirmation Details -->
      <div style="padding: 24px; background: white;">
        <div style="margin-bottom: 20px;">
          <div style="font-size: 12px; color: #666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Confirmation Code</div>
          <div style="font-size: 18px; font-weight: 700; color: #1A1A1A; font-family: monospace;">${escapeHtml(rsvpCode)}</div>
        </div>

        ${rsvpPhone ? `
        <div style="margin-bottom: 20px;">
          <div style="font-size: 12px; color: #666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Phone Number</div>
          <div style="font-size: 16px; font-weight: 600; color: #1A1A1A;">${escapeHtml(rsvpPhone)}</div>
        </div>
        ` : ''}

        <!-- Event Actions -->
        <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #E0E0E0;">
          <button type="button" class="btn btn-outline btn-block" style="margin-bottom: 12px;" onclick="alert('Add to Calendar feature coming soon!')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Add to Calendar
          </button>
          <button type="button" class="btn btn-outline btn-block" onclick="alert('Update RSVP feature coming soon!')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            Update RSVP
          </button>
        </div>

        <!-- Help Text -->
        <div style="margin-top: 20px; padding: 16px; background: #F5F5F5; border-radius: 8px; text-align: center;">
          <p style="font-size: 13px; color: #666; margin: 0;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="16" x2="12" y2="12"></line>
              <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            Show your confirmation code at the event
          </p>
        </div>
      </div>
    `;

    // Render to desktop layout
    const rsvpCard = document.getElementById('rsvp-card');
    if (rsvpCard) {
      rsvpCard.innerHTML = confirmationHTML;
    }

    // Render to mobile layout
    const mobileConfirmationCard = document.querySelector('.mobile-confirmation-card');
    if (mobileConfirmationCard) {
      mobileConfirmationCard.innerHTML = `<div class="rsvp-card">${confirmationHTML}</div>`;
      mobileConfirmationCard.style.display = 'block';
    }

    // Hide mobile RSVP card if it exists
    const mobileRsvpCard = document.querySelector('.mobile-rsvp-card');
    if (mobileRsvpCard) {
      mobileRsvpCard.style.display = 'none';
    }
  }

  /**
   * Render Waitlist card (right sidebar) - for full events
   */
  function renderWaitlistCard(event) {
    // Calculate capacity
    const capacity = event.capacity_limit || event.rsvp_settings?.invite_limit || 100;
    const rsvpCount = event.rsvp_count || 0;

    // Get waitlist data from BEDEV's API response
    const waitlistSize = event.waitlist?.count || 0;

    const waitlistHTML = `
      <!-- Waitlist Badge -->
      <div class="waitlist-badge">WAITLIST</div>

      <!-- Waitlist Card Header -->
      <div class="waitlist-card-header">
        <svg class="waitlist-icon" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <h2 class="waitlist-card-title">Join the Waitlist</h2>
        <p class="waitlist-card-subtitle">Be first to know when a spot opens</p>
      </div>

      <!-- Waitlist Position Indicator -->
      <div class="waitlist-position-indicator">
        <svg class="position-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
        <div class="position-text">Current waitlist size:</div>
        <div class="position-number">${waitlistSize} people</div>
        <div class="position-subtext">You'll be #${waitlistSize + 1} on the list</div>
      </div>

      <!-- How It Works Timeline -->
      <div class="how-it-works-timeline">
        <div class="timeline-title">How It Works</div>
        <div class="timeline-steps">
          <div class="timeline-step">
            <div class="step-number">1</div>
            <div class="step-connector"></div>
            <div class="step-content">
              <div class="step-title">Join the Waitlist</div>
              <div class="step-description">Enter your phone number below</div>
            </div>
          </div>
          <div class="timeline-step">
            <div class="step-number">2</div>
            <div class="step-connector"></div>
            <div class="step-content">
              <div class="step-title">Verify with OTP</div>
              <div class="step-description">Confirm your phone via SMS code</div>
            </div>
          </div>
          <div class="timeline-step">
            <div class="step-number">3</div>
            <div class="step-connector"></div>
            <div class="step-content">
              <div class="step-title">Get Notified</div>
              <div class="step-description">Instant SMS when a spot opens</div>
            </div>
          </div>
          <div class="timeline-step">
            <div class="step-number">4</div>
            <div class="step-content">
              <div class="step-title">Confirm in 15 Min</div>
              <div class="step-description">Quick response secures your spot</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Waitlist Signup Form -->
      <form id="waitlist-form" class="waitlist-form">
        <!-- Phone Number (BUG #006 FIX) -->
        <div class="form-group">
          <label for="waitlist-phone" class="form-label form-label-required">Phone Number</label>
          <input
            type="tel"
            id="waitlist-phone"
            name="phone"
            class="form-input"
            placeholder="+973 3312 3456 or 35353535"
            required
            title="Enter your phone number (8-15 digits)"
          >
          <span class="form-helper">📱 We'll only text you if a spot opens</span>
        </div>

        <!-- Terms Checkbox -->
        <div class="form-group-checkbox">
          <label class="checkbox-wrapper">
            <input type="checkbox" id="waitlist-terms" name="terms" required class="checkbox-input">
            <span class="checkbox-custom"></span>
            <span class="checkbox-label">
              I agree to receive waitlist notifications via SMS and accept the <a href="#" class="link-primary">Privacy Policy</a>
            </span>
          </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-waitlist btn-block">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
          </svg>
          Join Waitlist - Get OTP
        </button>
      </form>

      <!-- Waitlist Benefits -->
      <div class="waitlist-benefits">
        <div class="benefits-title">Waitlist Advantages</div>
        <div class="benefit-item">
          <svg class="benefit-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="benefit-text">Instant SMS notification when spot opens</span>
        </div>
        <div class="benefit-item">
          <svg class="benefit-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="benefit-text">No obligation - confirm only if you can attend</span>
        </div>
        <div class="benefit-item">
          <svg class="benefit-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="benefit-text">Priority over walk-ins (if accepted)</span>
        </div>
        <div class="benefit-item">
          <svg class="benefit-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="benefit-text">Free to join, no payment required</span>
        </div>
      </div>
    `;

    // Render to desktop layout
    const rsvpCard = document.getElementById('rsvp-card');
    if (rsvpCard) {
      rsvpCard.innerHTML = waitlistHTML;
    }

    // Render to mobile layout
    const mobileRsvpCard = document.querySelector('.mobile-rsvp-card');
    if (mobileRsvpCard) {
      mobileRsvpCard.innerHTML = `<div class="rsvp-card">${waitlistHTML}</div>`;
    }

    // Attach form submit handler
    const form = document.getElementById('waitlist-form');
    if (form) {
      form.addEventListener('submit', handleWaitlistFormSubmit);
    }
  }

  /**
   * Handle waitlist form submission
   */
  async function handleWaitlistFormSubmit(e) {
    e.preventDefault();

    const phoneInput = document.getElementById('waitlist-phone');
    const termsCheckbox = document.getElementById('waitlist-terms');
    const submitButton = e.target.querySelector('button[type="submit"]');

    if (!phoneInput || !termsCheckbox) return;

    // Check if terms are accepted
    if (!termsCheckbox.checked) {
      showToast('Please accept the terms and conditions to continue.', 'warning');
      return;
    }

    const phone = phoneInput.value.trim();

    // Get current event data and token
    const currentEvent = window.WeInviteCurrentEvent;
    const eventToken = EVENT_TOKEN;

    // Get guest name (for now, use placeholder)
    const guestName = 'Guest'; // TODO: Add name input field

    // Show loading state
    const originalButtonText = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="spinner"></span> Sending Code...';

    try {
      // Step 1: Request OTP (same as RSVP flow)
      const otpResponse = await requestOTP(phone, eventToken, guestName, 0);

      // Step 2: Show OTP modal with waitlist context
      // The modal will call joinWaitlist() instead of verifyOTP() for RSVP
      showOTPModal(phone, guestName, 0, otpResponse, true);
    } catch (error) {
      console.error('Error requesting waitlist OTP:', error);
      showFormError(phoneInput, error.message);
      submitButton.disabled = false;
      submitButton.innerHTML = originalButtonText;
    }
  }

  /**
   * Join waitlist with verified OTP
   */
  async function joinWaitlist(phone, otp, eventToken, guestName, plusOnes) {
    const apiEndpoint = `${API_URL}rsvp/join-waitlist`;
    console.log('Joining waitlist:', { phone, otp: '******', eventToken, guestName, plusOnes });

    const response = await fetch(apiEndpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        phone: phone,
        otp: otp,
        event_token: eventToken,
        name: guestName,
        plus_ones: plusOnes
      })
    });

    const data = await response.json();

    if (!response.ok || !data.success) {
      const errorMessage = data.message || 'Failed to join waitlist';
      throw new Error(errorMessage);
    }

    console.log('Joined waitlist successfully:', data);
    return data;
  }

  /**
   * Handle RSVP form submission
   */
  async function handleRSVPFormSubmit(e) {
    console.log('[MOBILE DEBUG] Form submit handler called');
    e.preventDefault();
    e.stopPropagation(); // BUGFIX: Prevent event bubbling that might cause page reload

    const phoneInput = document.getElementById('phone-number');
    const plusOnesSelect = document.getElementById('plus-ones');
    const submitButton = document.getElementById('rsvp-submit-btn'); // BUGFIX: Get button by ID instead of querySelector

    console.log('[MOBILE DEBUG] Form elements:', { phoneInput: !!phoneInput, plusOnesSelect: !!plusOnesSelect, submitButton: !!submitButton });

    if (!phoneInput || !plusOnesSelect) {
      console.error('[MOBILE DEBUG] Missing form elements!');
      alert('ERROR: Form elements not found!');
      return;
    }

    if (!submitButton) {
      alert('ERROR: Submit button not found!');
      return;
    }

    const phone = phoneInput.value.trim();
    const plusOnes = parseInt(plusOnesSelect.value);
    console.log('[MOBILE DEBUG] Form values:', { phone: phone ? 'present' : 'empty', plusOnes });

    // Validate phone number (BUG #005 & #006 FIX)
    if (phone === '') {
      showFormError(phoneInput, 'Phone Number cannot be blank');
      return;
    }

    // BUG #006 FIX: Improved phone validation
    // Allow: +, digits, spaces, hyphens, parentheses
    // Must have 8-15 digits total (excluding formatting characters)
    const phoneDigitsOnly = phone.replace(/[\s\-\(\)]/g, '');

    // Check for invalid characters (anything other than +, digits, spaces, -, (, ))
    if (!/^[\d\s\+\-\(\)]+$/.test(phone)) {
      showFormError(phoneInput, 'Phone Number contains invalid characters');
      return;
    }

    // Check if it starts with + or digit
    if (!/^[\+\d]/.test(phone)) {
      showFormError(phoneInput, 'Phone Number must start with + or a digit');
      return;
    }

    // Extract digits only (remove + and formatting)
    const digitsOnly = phoneDigitsOnly.replace(/\+/g, '');

    // Check digit count (8-15 digits)
    if (digitsOnly.length < 8) {
      showFormError(phoneInput, 'Phone Number must contain at least 8 digits');
      return;
    }

    if (digitsOnly.length > 15) {
      showFormError(phoneInput, 'Phone Number cannot exceed 15 digits');
      return;
    }

    // Additional validation: ensure it's not obviously invalid patterns
    if (/^0+$/.test(digitsOnly) || /^1+$/.test(digitsOnly)) {
      showFormError(phoneInput, 'Please enter a valid phone number');
      return;
    }

    // Get current event data and token
    const currentEvent = window.WeInviteCurrentEvent;
    const eventToken = EVENT_TOKEN;

    if (!currentEvent || !eventToken) {
      showFormError(phoneInput, 'Event data not available. Please refresh the page.');
      return;
    }

    // Get guest name (for now, use placeholder - can be enhanced later)
    const guestName = 'Guest'; // TODO: Add name input field

    alert('BEFORE TRY BLOCK: About to disable button and call API');

    // Show loading state
    const originalButtonText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="spinner"></span> Sending Code...';
    console.log('[MOBILE DEBUG] Button disabled, calling requestOTP...');

    alert('INSIDE TRY BLOCK: Button disabled, now calling requestOTP');

    try {
      // Call request OTP API
      alert('Step 4: Calling API to request OTP...');
      console.log('[MOBILE DEBUG] Calling requestOTP with:', { phone: phone ? 'present' : 'empty', eventToken, guestName });
      const otpResponse = await requestOTP(phone, eventToken, guestName, plusOnes);
      console.log('[MOBILE DEBUG] requestOTP SUCCESS, response:', otpResponse);
      alert('Step 5: API responded! Now showing OTP modal...');

      // Show OTP modal
      console.log('[MOBILE DEBUG] Calling showOTPModal...');
      showOTPModal(phone, guestName, plusOnes, otpResponse);
      console.log('[MOBILE DEBUG] showOTPModal called successfully');
      alert('Step 6: showOTPModal function completed! Dialog should be visible now.');

    } catch (error) {
      alert('API ERROR: ' + error.message);
      console.error('[MOBILE DEBUG] ERROR in requestOTP catch block:', error);
      console.error('[MOBILE DEBUG] Error details:', {
        message: error.message,
        stack: error.stack,
        toString: error.toString()
      });
      showFormError(phoneInput, error.message || 'Unable to send verification code. Please try again.');

      // Restore button
      submitButton.disabled = false;
      submitButton.textContent = originalButtonText;
      console.log('[MOBILE DEBUG] Button restored after error');
    }
  }

  /**
   * Request OTP from API
   */
  async function requestOTP(phone, eventToken, guestName, plusOnes) {
    const apiEndpoint = `${API_URL}rsvp/request-otp`;
    console.log('[MOBILE DEBUG] requestOTP function started');
    console.log('[MOBILE DEBUG] API endpoint:', apiEndpoint);
    console.log('[MOBILE DEBUG] Request params:', { phone, eventToken, guestName });

    try {
      const response = await fetch(apiEndpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          phone: phone,
          event_token: eventToken,
          name: guestName
        })
      });

      console.log('[MOBILE DEBUG] Fetch completed, response status:', response.status, response.ok);

      const data = await response.json();
      console.log('[MOBILE DEBUG] Response data:', data);

      if (!response.ok || !data.success) {
        const errorMessage = data.message || 'Failed to send verification code';
        console.error('[MOBILE DEBUG] API returned error:', errorMessage);
        throw new Error(errorMessage);
      }

      console.log('[MOBILE DEBUG] OTP requested successfully:', data);

      // Log test OTP if in test mode
      if (data.test_mode && data.otp_for_testing) {
        console.log('🔐 TEST MODE - OTP Code:', data.otp_for_testing);
      }

      // Store data for OTP verification
      window.WeInviteRSVPData = { phone, eventToken, guestName, plusOnes };

      return data;
    } catch (fetchError) {
      console.error('[MOBILE DEBUG] Fetch error in requestOTP:', fetchError);
      throw fetchError;
    }
  }

  /**
   * Show OTP modal
   */
  function showOTPModal(phone, guestName, plusOnes, otpResponse, isWaitlist = false) {
    console.log('[MOBILE DEBUG] showOTPModal function started');
    console.log('[MOBILE DEBUG] Parameters:', { phone: phone ? 'present' : 'missing', guestName, plusOnes, isWaitlist });
    console.log('[MOBILE DEBUG] otpResponse:', otpResponse);

    // Store context for verification
    window.WeInviteOTPContext = {
      phone: phone,
      guestName: guestName,
      plusOnes: plusOnes || 0,
      isWaitlist: isWaitlist
    };
    console.log('[MOBILE DEBUG] OTP context stored in window');

    // Check if modal already exists
    let modal = document.getElementById('otp-modal');
    console.log('[MOBILE DEBUG] Existing modal element:', modal ? 'found' : 'not found');

    if (!modal) {
      // Create modal
      console.log('[MOBILE DEBUG] Creating new modal element');
      modal = document.createElement('div');
      modal.id = 'otp-modal';
      modal.className = 'modal';
      document.body.appendChild(modal);
      console.log('[MOBILE DEBUG] Modal element created and appended to body');
    }

    // Format phone for display (show last 4 digits)
    const maskedPhone = phone.replace(/(\+\d{1,3})\d+(\d{4})/, '$1***$2');
    console.log('[MOBILE DEBUG] Masked phone:', maskedPhone);

    // Check if test mode and get OTP
    const testMode = otpResponse && otpResponse.test_mode;
    const testOTP = testMode ? otpResponse.otp_for_testing : null;
    console.log('[MOBILE DEBUG] Test mode:', testMode, 'Test OTP:', testOTP ? 'present' : 'not present');

    // Button text depends on context
    const buttonText = isWaitlist ? 'Join Waitlist' : 'Verify & Complete RSVP';

    modal.innerHTML = `
      <div class="modal-backdrop"></div>
      <div class="modal-content modal-content-otp">
        <button class="modal-close" aria-label="Close modal">&times;</button>

        <div class="modal-header otp-modal-header">
          <!-- Line 1: Main heading (BUG #008 FIX) -->
          <h2 class="otp-title">Enter Verification Code</h2>

          <!-- Line 2: Subtitle with phone number INLINE (per WEBUX design phase7_test2.15.png) -->
          <p class="otp-subtitle">
            We sent a 6-digit code to <strong class="otp-phone-inline">${escapeHtml(maskedPhone)}</strong>
          </p>

          <!-- Line 3: Edit link (centered below) -->
          <a href="#" id="edit-phone-link" class="otp-edit-link">Edit phone number</a>
        </div>

        <div class="modal-body">
          ${testMode && testOTP ? `
          <!-- Test Mode Alert -->
          <div class="test-mode-alert">
            <strong>🧪 Test Mode</strong><br>
            OTP Code: <code style="font-size: 20px; font-weight: 700; color: #6750A4;">${testOTP}</code><br>
            <small style="color: #666;">No SMS sent - use this code for testing</small>
          </div>
          ` : ''}

          <!-- OTP Input -->
          <div class="otp-input-container">
            <input type="text" maxlength="1" class="otp-digit" data-index="0" aria-label="Digit 1" />
            <input type="text" maxlength="1" class="otp-digit" data-index="1" aria-label="Digit 2" />
            <input type="text" maxlength="1" class="otp-digit" data-index="2" aria-label="Digit 3" />
            <input type="text" maxlength="1" class="otp-digit" data-index="3" aria-label="Digit 4" />
            <input type="text" maxlength="1" class="otp-digit" data-index="4" aria-label="Digit 5" />
            <input type="text" maxlength="1" class="otp-digit" data-index="5" aria-label="Digit 6" />
          </div>

          <!-- Error Message -->
          <div id="otp-error" class="otp-error" style="display: none;"></div>

          <!-- Resend Code -->
          <div class="otp-resend">
            <span>Didn't receive the code?</span>
            <a href="#" id="resend-otp-link" class="link-primary">Resend Code</a>
            <span id="resend-countdown" style="display: none;">Resend in <span id="countdown-timer">60</span>s</span>
          </div>

          <!-- Verify Button -->
          <button type="button" id="verify-otp-button" class="btn btn-primary btn-block" disabled>
            ${buttonText}
          </button>
        </div>
      </div>
    `;

    // Show modal
    console.log('[MOBILE DEBUG] Setting modal display to flex...');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    console.log('[MOBILE DEBUG] Modal displayed! body overflow set to hidden');

    // Initialize OTP input handlers
    console.log('[MOBILE DEBUG] Initializing OTP input handlers...');
    initOTPInput();
    console.log('[MOBILE DEBUG] showOTPModal function completed successfully!');

    // Start countdown
    startResendCountdown(60);

    // Add event listeners
    const closeButton = modal.querySelector('.modal-close');
    const backdrop = modal.querySelector('.modal-backdrop');
    const editPhoneLink = modal.querySelector('#edit-phone-link');
    const resendLink = modal.querySelector('#resend-otp-link');
    const verifyButton = modal.querySelector('#verify-otp-button');

    closeButton.addEventListener('click', closeOTPModal);
    backdrop.addEventListener('click', closeOTPModal);
    editPhoneLink.addEventListener('click', (e) => {
      e.preventDefault();
      closeOTPModal();
    });

    // ESC key support (BUG #009 FIX)
    function handleEscapeKey(e) {
      if (e.key === 'Escape' || e.keyCode === 27) {
        closeOTPModal();
      }
    }
    modal._escapeHandler = handleEscapeKey;
    document.addEventListener('keydown', handleEscapeKey);

    resendLink.addEventListener('click', handleResendOTP);
    verifyButton.addEventListener('click', handleVerifyOTP);

    // Focus first input
    const firstInput = modal.querySelector('.otp-digit[data-index="0"]');
    if (firstInput) {
      setTimeout(() => firstInput.focus(), 100);
    }
  }

  /**
   * Initialize OTP input handlers
   */
  function initOTPInput() {
    const inputs = document.querySelectorAll('.otp-digit');

    inputs.forEach((input, index) => {
      // Input event - auto-advance
      input.addEventListener('input', (e) => {
        const value = e.target.value;

        // Only allow digits
        if (!/^\d$/.test(value)) {
          e.target.value = '';
          return;
        }

        // Auto-advance to next input
        if (value && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }

        // Check if all inputs filled
        checkOTPComplete();
      });

      // Keydown event - handle backspace
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !e.target.value && index > 0) {
          inputs[index - 1].focus();
        }
      });

      // Paste event - handle paste
      input.addEventListener('paste', (e) => {
        e.preventDefault();
        const pastedData = e.clipboardData.getData('text').replace(/\D/g, '');

        if (pastedData.length === 6) {
          inputs.forEach((input, i) => {
            input.value = pastedData[i] || '';
          });
          inputs[5].focus();
          checkOTPComplete();
        }
      });
    });
  }

  /**
   * Check if OTP is complete
   */
  function checkOTPComplete() {
    const inputs = document.querySelectorAll('.otp-digit');
    const values = Array.from(inputs).map(input => input.value);
    const isComplete = values.every(val => val !== '');

    const verifyButton = document.getElementById('verify-otp-button');
    if (verifyButton) {
      verifyButton.disabled = !isComplete;
    }

    return isComplete;
  }

  /**
   * Get OTP value
   */
  function getOTPValue() {
    const inputs = document.querySelectorAll('.otp-digit');
    return Array.from(inputs).map(input => input.value).join('');
  }

  /**
   * Close OTP modal
   */
  function closeOTPModal() {
    const modal = document.getElementById('otp-modal');
    if (modal) {
      modal.style.display = 'none';
      document.body.style.overflow = '';

      // Remove ESC key handler (BUG #009 FIX)
      if (modal._escapeHandler) {
        document.removeEventListener('keydown', modal._escapeHandler);
        delete modal._escapeHandler;
      }

      // Clear countdown
      if (window.WeInviteCountdownInterval) {
        clearInterval(window.WeInviteCountdownInterval);
      }

      // Re-enable submit button
      const submitButton = document.querySelector('#rsvp-form button[type="submit"]');
      if (submitButton) {
        submitButton.disabled = false;
        submitButton.textContent = 'Get Verification Code';
      }
    }
  }

  /**
   * Start resend countdown
   */
  function startResendCountdown(seconds) {
    const resendLink = document.getElementById('resend-otp-link');
    const countdownSpan = document.getElementById('resend-countdown');
    const timerSpan = document.getElementById('countdown-timer');

    if (!resendLink || !countdownSpan || !timerSpan) return;

    let timeLeft = seconds;

    // Hide link, show countdown
    resendLink.style.display = 'none';
    countdownSpan.style.display = 'inline';

    // Clear any existing interval
    if (window.WeInviteCountdownInterval) {
      clearInterval(window.WeInviteCountdownInterval);
    }

    window.WeInviteCountdownInterval = setInterval(() => {
      timeLeft--;
      timerSpan.textContent = timeLeft;

      if (timeLeft <= 0) {
        clearInterval(window.WeInviteCountdownInterval);
        resendLink.style.display = 'inline';
        countdownSpan.style.display = 'none';
      }
    }, 1000);
  }

  /**
   * Handle resend OTP
   */
  async function handleResendOTP(e) {
    e.preventDefault();

    const rsvpData = window.WeInviteRSVPData;
    if (!rsvpData) return;

    const resendLink = document.getElementById('resend-otp-link');
    if (resendLink) {
      resendLink.style.pointerEvents = 'none';
      resendLink.textContent = 'Sending...';
    }

    try {
      await requestOTP(rsvpData.phone, rsvpData.eventToken, rsvpData.guestName, rsvpData.plusOnes);

      // Restart countdown
      startResendCountdown(60);

      if (resendLink) {
        resendLink.style.pointerEvents = '';
        resendLink.textContent = 'Resend Code';
      }

      // Clear OTP inputs
      const inputs = document.querySelectorAll('.otp-digit');
      inputs.forEach(input => { input.value = ''; });
      if (inputs[0]) inputs[0].focus();

    } catch (error) {
      console.error('Error resending OTP:', error);
      showOTPError(error.message || 'Failed to resend code. Please try again.');

      if (resendLink) {
        resendLink.style.pointerEvents = '';
        resendLink.textContent = 'Resend Code';
      }
    }
  }

  /**
   * Handle verify OTP
   */
  async function handleVerifyOTP(e) {
    e.preventDefault();

    const otpValue = getOTPValue();
    const rsvpData = window.WeInviteRSVPData;
    const otpContext = window.WeInviteOTPContext;

    if (!otpValue || otpValue.length !== 6) {
      showOTPError('Please enter the complete 6-digit code');
      return;
    }

    if (!rsvpData) {
      showOTPError('Session expired. Please try again.');
      return;
    }

    const verifyButton = document.getElementById('verify-otp-button');
    if (!verifyButton) return;

    // Show loading
    const originalButtonText = verifyButton.textContent;
    verifyButton.disabled = true;
    verifyButton.innerHTML = '<span class="spinner"></span> Verifying...';

    try {
      let result;

      // Check if this is waitlist or regular RSVP
      if (otpContext && otpContext.isWaitlist) {
        // Join waitlist
        result = await joinWaitlist(
          rsvpData.phone,
          otpValue,
          rsvpData.eventToken,
          rsvpData.guestName,
          otpContext.plusOnes || 0
        );

        // Success! Show waitlist success state
        closeOTPModal();
        showWaitlistSuccessState(result);
      } else {
        // Regular RSVP verification
        result = await verifyOTP(rsvpData.phone, otpValue, rsvpData.eventToken, rsvpData.guestName);

        // Success! Show RSVP success state
        closeOTPModal();
        showSuccessState(result);
      }

    } catch (error) {
      console.error('Error verifying OTP:', error);
      showOTPError(error.message || 'Invalid verification code. Please try again.');

      // Clear inputs and refocus
      const inputs = document.querySelectorAll('.otp-digit');
      inputs.forEach(input => { input.value = ''; });
      if (inputs[0]) inputs[0].focus();

      // Shake animation
      const container = document.querySelector('.otp-input-container');
      if (container && window.WeInviteAnimations) {
        window.WeInviteAnimations.shake(container);
      }

      // Restore button
      verifyButton.disabled = false;
      verifyButton.textContent = originalButtonText;
    }
  }

  /**
   * Verify OTP with API
   */
  async function verifyOTP(phone, otp, eventToken, guestName) {
    const apiEndpoint = `${API_URL}rsvp/verify-otp`;
    console.log('Verifying OTP:', { phone, otp: '******', eventToken, guestName });

    const response = await fetch(apiEndpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        phone: phone,
        otp: otp,
        event_token: eventToken,
        name: guestName
      })
    });

    const data = await response.json();

    if (!response.ok || !data.success) {
      const errorMessage = data.message || 'Verification failed';
      throw new Error(errorMessage);
    }

    console.log('OTP verified successfully:', data);
    return data;
  }

  /**
   * Show OTP error
   */
  function showOTPError(message) {
    const errorDiv = document.getElementById('otp-error');
    if (errorDiv) {
      errorDiv.textContent = message;
      errorDiv.style.display = 'block';

      // Add error state to inputs
      const inputs = document.querySelectorAll('.otp-digit');
      inputs.forEach(input => {
        input.classList.add('error');
      });

      // Auto-hide after 5 seconds
      setTimeout(() => {
        errorDiv.style.display = 'none';
        inputs.forEach(input => {
          input.classList.remove('error');
        });
      }, 5000);
    }
  }

  /**
   * Show success state after RSVP
   */
  function showSuccessState(rsvpData) {
    console.log('RSVP Success:', rsvpData);

    // Store RSVP status in browser (BUG #011 FIX)
    window.WeInviteRSVPStatus = 'confirmed';
    window.WeInviteRSVPCode = rsvpData.rsvp?.code || '';

    // Persist to sessionStorage so page reload shows post-RSVP state
    sessionStorage.setItem('weinvite_rsvp_confirmed', 'true');
    sessionStorage.setItem('weinvite_rsvp_id', rsvpData.rsvp?.id || '');
    sessionStorage.setItem('weinvite_rsvp_code', rsvpData.rsvp?.code || '');
    sessionStorage.setItem('weinvite_rsvp_phone', rsvpData.rsvp?.phone || '');
    sessionStorage.setItem('weinvite_event_token', EVENT_TOKEN);

    // Show success banner first
    showSuccessBanner();

    // Reload page after 2 seconds to show post-RSVP state
    setTimeout(() => {
      console.log('Reloading page to show post-RSVP state...');
      window.location.reload();
    }, 2000);
  }

  /**
   * Show waitlist success state
   */
  function showWaitlistSuccessState(waitlistData) {
    console.log('Waitlist Success:', waitlistData);

    // Store waitlist status
    window.WeInviteWaitlistStatus = 'joined';
    window.WeInviteWaitlistPosition = waitlistData.waitlist?.position || null;

    // Show waitlist success banner
    showWaitlistSuccessBanner(waitlistData);

    // Reload event data to update waitlist count
    setTimeout(() => {
      const eventToken = EVENT_TOKEN;
      if (eventToken) {
        fetchEventData(eventToken);
      }
    }, 300);
  }

  /**
   * Show waitlist success banner
   */
  function showWaitlistSuccessBanner(waitlistData) {
    console.log('showWaitlistSuccessBanner called');

    let banner = document.getElementById('success-banner');

    if (!banner) {
      banner = document.createElement('div');
      banner.id = 'success-banner';
      banner.className = 'success-banner';

      const eventContent = document.getElementById('weinvite-public-event-page');

      if (eventContent) {
        eventContent.insertBefore(banner, eventContent.firstChild);
      } else {
        document.body.insertBefore(banner, document.body.firstChild);
      }
    }

    const position = waitlistData.waitlist?.position || '?';
    const name = waitlistData.waitlist?.name || 'Guest';

    banner.innerHTML = `
      <div class="success-banner-content">
        <svg class="success-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <div class="success-message">
          <div class="success-title">You're on the Waitlist!</div>
          <div class="success-subtitle">Position #${position} - We'll text you if a spot opens up</div>
        </div>
        <button class="success-banner-close" aria-label="Close banner">&times;</button>
      </div>
    `;

    banner.style.display = 'block';

    // Add close button handler
    const closeButton = banner.querySelector('.success-banner-close');
    if (closeButton) {
      closeButton.addEventListener('click', () => {
        banner.style.display = 'none';
      });
    }

    // Auto-dismiss after 15 seconds
    setTimeout(() => {
      if (banner) {
        banner.style.display = 'none';
      }
    }, 15000);

    // Slide down animation
    if (window.WeInviteAnimations) {
      window.WeInviteAnimations.slideDown(banner);
    }
  }

  /**
   * Show event full warning banner
   */
  function showEventFullBanner(event) {
    console.log('showEventFullBanner called');

    // Check if banner already exists
    let banner = document.getElementById('event-full-banner');

    if (banner) {
      banner.style.display = 'flex';
      return;
    }

    // Create banner
    banner = document.createElement('div');
    banner.id = 'event-full-banner';
    banner.className = 'event-full-banner';

    const eventContent = document.getElementById('weinvite-public-event-page');

    if (eventContent) {
      eventContent.insertBefore(banner, eventContent.firstChild);
      console.log('Event full banner inserted into DOM');
    } else {
      console.error('Could not find #weinvite-public-event-page element');
      // Fallback: append to body
      document.body.insertBefore(banner, document.body.firstChild);
      console.log('Event full banner inserted into body (fallback)');
    }

    banner.innerHTML = `
      <div class="event-full-banner-content">
        <svg class="warning-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
          <line x1="12" y1="9" x2="12" y2="13"></line>
          <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>
        <div class="warning-message">
          <div class="warning-title">Event Is Currently Full</div>
          <div class="warning-subtitle">Join the waitlist to be notified if a spot opens up</div>
        </div>
      </div>
    `;

    banner.style.display = 'flex';
    console.log('Event full banner should now be visible');
  }

  /**
   * Show success banner
   */
  function showSuccessBanner() {
    console.log('showSuccessBanner called');

    // Check if banner already exists
    let banner = document.getElementById('success-banner');

    if (!banner) {
      // Create banner
      banner = document.createElement('div');
      banner.id = 'success-banner';
      banner.className = 'success-banner';

      const eventContent = document.getElementById('weinvite-public-event-page');
      console.log('Event content element:', eventContent);

      if (eventContent) {
        eventContent.insertBefore(banner, eventContent.firstChild);
        console.log('Banner inserted into DOM');
      } else {
        console.error('Could not find #weinvite-public-event-page element');
        // Fallback: append to body
        document.body.insertBefore(banner, document.body.firstChild);
        console.log('Banner inserted into body (fallback)');
      }
    }

    banner.innerHTML = `
      <div class="success-banner-content">
        <svg class="success-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <div class="success-message">
          <div class="success-title">You're Registered!</div>
          <div class="success-subtitle">Check your phone for a confirmation SMS with event details</div>
        </div>
        <button class="success-banner-close" aria-label="Close banner">&times;</button>
      </div>
    `;

    banner.style.display = 'block';
    console.log('Banner display set to block');

    // Add close button handler
    const closeButton = banner.querySelector('.success-banner-close');
    if (closeButton) {
      closeButton.addEventListener('click', () => {
        banner.style.display = 'none';
      });
    }

    // Auto-dismiss after 15 seconds
    setTimeout(() => {
      if (banner) {
        banner.style.display = 'none';
        console.log('Banner auto-dismissed after 15 seconds');
      }
    }, 15000);

    // Slide down animation
    if (window.WeInviteAnimations) {
      window.WeInviteAnimations.slideDown(banner);
      console.log('Slide down animation applied');
    }

    console.log('Success banner should now be visible');
  }

  /**
   * Show form error
   */
  function showFormError(input, message) {
    input.classList.add('error');

    // Remove existing error
    const existingError = input.parentElement.querySelector('.form-error');
    if (existingError) {
      existingError.remove();
    }

    // Add new error
    const errorSpan = document.createElement('span');
    errorSpan.className = 'form-error';
    errorSpan.textContent = message;
    input.parentElement.appendChild(errorSpan);

    // Shake animation
    if (window.WeInviteAnimations) {
      window.WeInviteAnimations.shake(input);
    }
  }

  /**
   * Handle event fetch errors
   */
  function handleEventFetchError(error) {
    const errorMessage = error.message || 'Unable to load event';

    if (errorMessage.includes('404') || errorMessage.includes('not found')) {
      showErrorScreen(
        'Event Not Found',
        'The event you\'re looking for could not be found. It may have been cancelled or the link may be invalid.'
      );
    } else if (errorMessage.includes('network') || errorMessage.includes('fetch')) {
      showErrorScreen(
        'Connection Error',
        'Unable to connect to the server. Please check your internet connection and try again.'
      );
    } else {
      showErrorScreen(
        'Error Loading Event',
        errorMessage
      );
    }
  }

  /**
   * Format time string
   */
  function formatTime(timeString) {
    const [hours, minutes] = timeString.split(':');
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? 'PM' : 'AM';
    const hour12 = hour % 12 || 12;
    return `${hour12}:${minutes} ${ampm}`;
  }

  /**
   * Escape HTML to prevent XSS
   */
  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  /**
   * ==========================================
   * MOBILE-SPECIFIC FUNCTIONS
   * Sprint 3 Mobile Implementation (Nov 12, 2025)
   * ==========================================
   */

  /**
   * Detect if device is mobile
   */
  function isMobileDevice() {
    return window.innerWidth <= 767 ||
           /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  }

  /**
   * Initialize bottom sheet for mobile RSVP
   */
  function initBottomSheet() {
    const bottomSheet = document.getElementById('bottom-sheet');
    if (!bottomSheet) return;

    const backdrop = bottomSheet.querySelector('.bottom-sheet-backdrop');
    const content = bottomSheet.querySelector('.bottom-sheet-content');
    const closeBtn = bottomSheet.querySelector('.bottom-sheet-close');

    // Close on backdrop click
    if (backdrop) {
      backdrop.addEventListener('click', function() {
        closeBottomSheet();
      });
    }

    // Close on close button click
    if (closeBtn) {
      closeBtn.addEventListener('click', function() {
        closeBottomSheet();
      });
    }

    // Prevent content click from closing
    if (content) {
      content.addEventListener('click', function(e) {
        e.stopPropagation();
      });
    }

    // Handle swipe down to close (touch devices)
    if (content && 'ontouchstart' in window) {
      let startY = 0;
      let currentY = 0;
      let isDragging = false;

      content.addEventListener('touchstart', function(e) {
        if (e.target.closest('.bottom-sheet-handle')) {
          startY = e.touches[0].clientY;
          isDragging = true;
        }
      });

      content.addEventListener('touchmove', function(e) {
        if (!isDragging) return;

        currentY = e.touches[0].clientY;
        const diff = currentY - startY;

        if (diff > 0) {
          content.style.transform = `translateY(${diff}px)`;
        }
      });

      content.addEventListener('touchend', function() {
        if (!isDragging) return;

        const diff = currentY - startY;

        if (diff > 100) {
          closeBottomSheet();
        } else {
          content.style.transform = '';
        }

        isDragging = false;
      });
    }
  }

  /**
   * Open bottom sheet
   */
  function openBottomSheet() {
    const bottomSheet = document.getElementById('bottom-sheet');
    if (!bottomSheet) return;

    bottomSheet.classList.add('active');
    bottomSheet.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  /**
   * Close bottom sheet
   */
  function closeBottomSheet() {
    const bottomSheet = document.getElementById('bottom-sheet');
    if (!bottomSheet) return;

    const content = bottomSheet.querySelector('.bottom-sheet-content');
    if (content) {
      content.style.transform = '';
    }

    bottomSheet.classList.remove('active');

    setTimeout(() => {
      bottomSheet.style.display = 'none';
      document.body.style.overflow = '';
    }, 300);
  }

  /**
   * Initialize mobile sticky CTA
   */
  function initMobileStickyCTA() {
    const stickyCTA = document.getElementById('sticky-cta-mobile');
    if (!stickyCTA) return;

    const rsvpBtn = stickyCTA.querySelector('#mobile-rsvp-btn');

    if (rsvpBtn) {
      rsvpBtn.addEventListener('click', function() {
        openBottomSheet();
      });
    }

    // Show/hide sticky CTA based on scroll position
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
      const currentScroll = window.pageYOffset;

      // Show CTA when scrolling down, hide when scrolling up
      if (currentScroll > lastScroll && currentScroll > 200) {
        stickyCTA.style.transform = 'translateY(0)';
      } else if (currentScroll < lastScroll) {
        stickyCTA.style.transform = 'translateY(100%)';
      }

      lastScroll = currentScroll;
    });
  }

  /**
   * Initialize success banner close button (mobile)
   */
  function initSuccessBannerMobile() {
    const successBanner = document.querySelector('.success-banner-mobile');
    if (!successBanner) return;

    const closeBtn = successBanner.querySelector('.success-banner-close');

    if (closeBtn) {
      closeBtn.addEventListener('click', function() {
        successBanner.style.animation = 'slideUp 0.3s ease-out';

        setTimeout(() => {
          successBanner.style.display = 'none';
        }, 300);
      });
    }
  }

  /**
   * Handle mobile viewport height (iOS Safari fix)
   */
  function handleMobileViewportHeight() {
    // Fix for iOS Safari viewport height issue
    const setVH = () => {
      const vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty('--vh', `${vh}px`);
    };

    setVH();
    window.addEventListener('resize', setVH);
    window.addEventListener('orientationchange', setVH);
  }

  /**
   * Initialize mobile-specific features
   */
  function initMobileFeatures() {
    if (!isMobileDevice()) return;

    console.log('Initializing mobile-specific features');

    // Initialize mobile components
    initBottomSheet();
    initMobileStickyCTA();
    initSuccessBannerMobile();
    handleMobileViewportHeight();

    // Add mobile class to body
    document.body.classList.add('mobile-device');
  }

  /**
   * Handle responsive layout switching
   */
  function handleResponsiveLayout() {
    const desktopLayout = document.querySelector('.event-layout-desktop');
    const mobileLayout = document.querySelector('.event-layout-mobile');

    if (window.innerWidth <= 1023) {
      // Mobile/tablet view
      if (desktopLayout) desktopLayout.style.display = 'none';
      if (mobileLayout) mobileLayout.style.display = 'block';
    } else {
      // Desktop view
      if (desktopLayout) desktopLayout.style.display = 'grid';
      if (mobileLayout) mobileLayout.style.display = 'none';
    }
  }

  /**
   * Initialize responsive features
   */
  function initResponsiveFeatures() {
    handleResponsiveLayout();

    window.addEventListener('resize', function() {
      handleResponsiveLayout();
    });
  }

  /**
   * Touch-friendly OTP input (mobile optimization)
   */
  function initMobileOTPInput() {
    const otpInputs = document.querySelectorAll('.otp-input-mobile');
    if (otpInputs.length === 0) return;

    otpInputs.forEach((input, index) => {
      // Auto-advance to next input
      input.addEventListener('input', function(e) {
        if (e.target.value.length === 1 && index < otpInputs.length - 1) {
          otpInputs[index + 1].focus();
        }
      });

      // Handle backspace to previous input
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
          otpInputs[index - 1].focus();
        }
      });

      // Prevent non-numeric input on mobile
      input.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
      });
    });

    // Handle paste event for mobile
    if (otpInputs[0]) {
      otpInputs[0].addEventListener('paste', function(e) {
        e.preventDefault();
        const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');

        for (let i = 0; i < Math.min(pastedData.length, otpInputs.length); i++) {
          otpInputs[i].value = pastedData[i];
        }

        const lastFilledIndex = Math.min(pastedData.length - 1, otpInputs.length - 1);
        otpInputs[lastFilledIndex].focus();
      });
    }
  }

  /**
   * Initialize mobile calendar buttons
   */
  function initMobileCalendarButtons() {
    const calendarButtons = document.querySelectorAll('.calendar-button-mobile');

    calendarButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        // Add visual feedback for mobile
        this.style.transform = 'scale(0.98)';

        setTimeout(() => {
          this.style.transform = '';
        }, 150);
      });
    });
  }

  // Initialize mobile features on DOM load
  document.addEventListener('DOMContentLoaded', function() {
    initMobileFeatures();
    initResponsiveFeatures();
    initMobileOTPInput();
    initMobileCalendarButtons();
  });

  /**
   * ==========================================
   * BEDEV ENDPOINT INTEGRATION (Sprint 3 Phase 4)
   * November 12, 2025
   * Endpoints: Update RSVP, Cancel RSVP, QR Code, Calendar Export
   * ==========================================
   */

  /**
   * Update RSVP (plus_ones or name)
   * BEDEV Endpoint: POST /wp-json/weinvite/v1/rsvp/update
   */
  async function updateRSVP(phone, otp, eventToken, plusOnes, name) {
    try {
      const response = await fetch(`${API_URL}rsvp/update`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          phone: phone,
          otp: otp,
          event_token: eventToken,
          plus_ones: plusOnes,
          name: name
        })
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to update RSVP');
      }

      console.log('RSVP updated successfully:', data);
      return data;
    } catch (error) {
      console.error('Error updating RSVP:', error);
      throw error;
    }
  }

  /**
   * Cancel RSVP
   * BEDEV Endpoint: POST /wp-json/weinvite/v1/rsvp/cancel
   */
  async function cancelRSVP(phone, otp, eventToken) {
    try {
      const response = await fetch(`${API_URL}rsvp/cancel`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          phone: phone,
          otp: otp,
          event_token: eventToken
        })
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to cancel RSVP');
      }

      console.log('RSVP cancelled successfully:', data);
      return data;
    } catch (error) {
      console.error('Error cancelling RSVP:', error);
      throw error;
    }
  }

  /**
   * Get QR Code for RSVP
   * BEDEV Endpoint: GET /wp-json/weinvite/v1/rsvp/{phone}/qr-code?event_token={token}
   */
  async function getQRCode(phone, eventToken) {
    try {
      const encodedPhone = encodeURIComponent(phone);
      const url = `${API_URL}rsvp/${encodedPhone}/qr-code?event_token=${eventToken}`;

      const response = await fetch(url);
      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to generate QR code');
      }

      console.log('QR code generated successfully:', data);
      return data;
    } catch (error) {
      console.error('Error generating QR code:', error);
      throw error;
    }
  }

  /**
   * Export event to calendar
   * BEDEV Endpoint: GET /wp-json/weinvite/v1/events/{token}/calendar?format={ics|google}
   */
  async function exportCalendar(eventToken, format) {
    try {
      const url = `${API_URL}events/${eventToken}/calendar?format=${format}`;
      const response = await fetch(url);
      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to export calendar');
      }

      console.log('Calendar export successful:', data);

      // Handle different formats
      if (format === 'ics') {
        // Download ICS file
        downloadICSFile(data.content, data.filename);
      } else if (format === 'google') {
        // Open Google Calendar in new tab
        window.open(data.url, '_blank');
      }

      return data;
    } catch (error) {
      console.error('Error exporting calendar:', error);
      throw error;
    }
  }

  /**
   * Download ICS file
   */
  function downloadICSFile(content, filename) {
    const blob = new Blob([content], { type: 'text/calendar;charset=utf-8' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename || 'event.ics';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
  }

  /**
   * Show QR Code Modal
   */
  function showQRCodeModal(qrData) {
    const modal = document.getElementById('qr-code-modal');
    if (!modal) {
      // Create modal if it doesn't exist
      createQRCodeModal(qrData);
    } else {
      // Update existing modal
      const qrImage = modal.querySelector('.qr-code-image');
      if (qrImage) {
        qrImage.src = qrData.qr_code.url;
      }
      modal.style.display = 'flex';
    }
  }

  /**
   * Create QR Code Modal
   */
  function createQRCodeModal(qrData) {
    const modalHTML = `
      <div id="qr-code-modal" class="modal qr-code-modal" style="display: flex;">
        <div class="modal-backdrop"></div>
        <div class="modal-content qr-code-modal-content">
          <div class="modal-header">
            <h2>Your RSVP Confirmation</h2>
            <button type="button" class="modal-close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="qr-code-container">
              <img src="${qrData.qr_code.url}" alt="RSVP QR Code" class="qr-code-image">
              <p class="qr-code-instructions">Show this QR code at the event entrance</p>
              <div class="qr-code-details">
                <p><strong>Event:</strong> ${escapeHtml(qrData.rsvp.event_title)}</p>
                <p><strong>Guest:</strong> ${escapeHtml(qrData.rsvp.guest_name)}</p>
                <p><strong>Plus Ones:</strong> ${qrData.rsvp.plus_ones}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // Add close handler
    const modal = document.getElementById('qr-code-modal');
    const closeBtn = modal.querySelector('.modal-close');
    const backdrop = modal.querySelector('.modal-backdrop');

    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    backdrop.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  }

  /**
   * Initialize Update RSVP Modal
   */
  function initUpdateRSVPModal() {
    const updateBtn = document.getElementById('update-rsvp-btn');
    if (!updateBtn) return;

    updateBtn.addEventListener('click', async function() {
      // Open bottom sheet with update form
      openBottomSheet();

      // Load update form in bottom sheet
      const bottomSheetBody = document.querySelector('.bottom-sheet-body');
      if (bottomSheetBody) {
        bottomSheetBody.innerHTML = `
          <h3>Update Your RSVP</h3>
          <form id="update-rsvp-form">
            <div class="form-group">
              <label for="update-plus-ones">Number of Plus Ones</label>
              <select id="update-plus-ones" name="plus_ones" class="form-control">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
            <div class="form-group">
              <label for="update-name">Your Name (optional)</label>
              <input type="text" id="update-name" name="name" class="form-control">
            </div>
            <p class="helper-text">You'll need to verify with OTP</p>
            <button type="submit" class="btn btn-primary btn-block">Update RSVP</button>
          </form>
        `;

        // Handle form submission
        const form = document.getElementById('update-rsvp-form');
        form.addEventListener('submit', async function(e) {
          e.preventDefault();

          const plusOnes = parseInt(document.getElementById('update-plus-ones').value);
          const name = document.getElementById('update-name').value;

          // TODO: Get phone and request OTP
          // TODO: Verify OTP
          // TODO: Call updateRSVP()

          console.log('Update RSVP:', { plusOnes, name });
        });
      }
    });
  }

  /**
   * Initialize Cancel RSVP Modal
   */
  function initCancelRSVPModal() {
    const cancelBtn = document.getElementById('cancel-rsvp-btn');
    if (!cancelBtn) return;

    cancelBtn.addEventListener('click', async function() {
      const confirmed = confirm('Are you sure you want to cancel your RSVP?');
      if (!confirmed) return;

      // TODO: Get phone and request OTP
      // TODO: Verify OTP
      // TODO: Call cancelRSVP()

      console.log('Cancel RSVP requested');
    });
  }

  /**
   * Initialize QR Code Button
   */
  function initQRCodeButton() {
    const qrBtn = document.getElementById('show-qr-code-btn');
    if (!qrBtn) return;

    qrBtn.addEventListener('click', async function() {
      try {
        // Show loading
        this.disabled = true;
        this.textContent = 'Generating...';

        // TODO: Get phone and event token from stored data
        const phone = '+97312345678'; // Placeholder
        const eventToken = EVENT_TOKEN;

        const qrData = await getQRCode(phone, eventToken);

        showQRCodeModal(qrData);

        this.disabled = false;
        this.textContent = 'Show QR Code';
      } catch (error) {
        showToast('Failed to generate QR code: ' + error.message, 'error');
        this.disabled = false;
        this.textContent = 'Show QR Code';
      }
    });
  }

  /**
   * Initialize Calendar Export Buttons
   */
  function initCalendarExportButtons() {
    // ICS Download
    const icsBtn = document.getElementById('export-ics-btn');
    if (icsBtn) {
      icsBtn.addEventListener('click', async function() {
        try {
          this.disabled = true;
          this.textContent = 'Downloading...';

          await exportCalendar(EVENT_TOKEN, 'ics');

          this.disabled = false;
          this.textContent = 'Download ICS';
        } catch (error) {
          showToast('Failed to download calendar: ' + error.message, 'error');
          this.disabled = false;
          this.textContent = 'Download ICS';
        }
      });
    }

    // Google Calendar
    const googleBtn = document.getElementById('export-google-btn');
    if (googleBtn) {
      googleBtn.addEventListener('click', async function() {
        try {
          this.disabled = true;
          this.textContent = 'Opening...';

          await exportCalendar(EVENT_TOKEN, 'google');

          this.disabled = false;
          this.textContent = 'Google Calendar';
        } catch (error) {
          showToast('Failed to open Google Calendar: ' + error.message, 'error');
          this.disabled = false;
          this.textContent = 'Google Calendar';
        }
      });
    }
  }

  /**
   * ==========================================
   * PHASE 5 ENHANCEMENTS (Sprint 3)
   * November 12, 2025
   * WEBUX Recommended Accessibility & UX Improvements
   * ==========================================
   */

  /**
   * Task 5.2: Focus Trap for Modals
   * Traps keyboard focus within modal/bottom sheet
   */
  function trapFocus(element) {
    const focusableSelectors = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    const focusableElements = element.querySelectorAll(focusableSelectors);

    if (focusableElements.length === 0) return;

    const firstFocusable = focusableElements[0];
    const lastFocusable = focusableElements[focusableElements.length - 1];

    function handleTabKey(e) {
      if (e.key !== 'Tab') return;

      if (e.shiftKey) {
        // Shift + Tab
        if (document.activeElement === firstFocusable) {
          lastFocusable.focus();
          e.preventDefault();
        }
      } else {
        // Tab
        if (document.activeElement === lastFocusable) {
          firstFocusable.focus();
          e.preventDefault();
        }
      }
    }

    element.addEventListener('keydown', handleTabKey);

    // Store handler for cleanup
    element._focusTrapHandler = handleTabKey;

    // Focus first element
    firstFocusable.focus();
  }

  /**
   * Remove focus trap
   */
  function removeFocusTrap(element) {
    if (element._focusTrapHandler) {
      element.removeEventListener('keydown', element._focusTrapHandler);
      delete element._focusTrapHandler;
    }
  }

  /**
   * Task 5.3: Show Skeleton Loading State
   */
  function showSkeletonLoader() {
    const loadingScreen = document.getElementById('loading-screen');
    if (loadingScreen) {
      loadingScreen.innerHTML = `
        <div class="skeleton-loader">
          <div class="skeleton skeleton-hero"></div>
          <div class="skeleton-content">
            <div class="skeleton skeleton-title"></div>
            <div class="skeleton skeleton-subtitle"></div>
            <div class="skeleton-cards">
              <div class="skeleton skeleton-card"></div>
              <div class="skeleton skeleton-card"></div>
              <div class="skeleton skeleton-card"></div>
            </div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text short"></div>
          </div>
        </div>
      `;
      loadingScreen.style.display = 'flex';
    }
  }

  /**
   * Hide skeleton and show content
   */
  function hideSkeletonLoader() {
    const loadingScreen = document.getElementById('loading-screen');
    if (loadingScreen) {
      loadingScreen.style.display = 'none';
    }
  }

  /**
   * Task 5.1: Add ARIA attributes to dynamically created elements
   */
  function enhanceAccessibility() {
    // Add ARIA labels to buttons without explicit text
    document.querySelectorAll('button.modal-close').forEach(btn => {
      if (!btn.getAttribute('aria-label')) {
        btn.setAttribute('aria-label', 'Close modal');
      }
    });

    document.querySelectorAll('button.bottom-sheet-close').forEach(btn => {
      if (!btn.getAttribute('aria-label')) {
        btn.setAttribute('aria-label', 'Close dialog');
      }
    });

    // Add aria-live to success banners
    document.querySelectorAll('.success-banner, .success-banner-mobile').forEach(banner => {
      if (!banner.getAttribute('aria-live')) {
        banner.setAttribute('aria-live', 'polite');
        banner.setAttribute('role', 'status');
      }
    });

    // Add aria-live to error messages
    document.querySelectorAll('.error-message, .form-error').forEach(error => {
      if (!error.getAttribute('aria-live')) {
        error.setAttribute('aria-live', 'assertive');
        error.setAttribute('role', 'alert');
      }
    });

    // Add aria-describedby to form inputs with helper text
    document.querySelectorAll('.form-group').forEach(group => {
      const input = group.querySelector('input, select, textarea');
      const helperText = group.querySelector('.helper-text');

      if (input && helperText && !input.getAttribute('aria-describedby')) {
        const helperId = 'help-' + Math.random().toString(36).substr(2, 9);
        helperText.id = helperId;
        input.setAttribute('aria-describedby', helperId);
      }
    });
  }

  /**
   * Enhanced modal open with focus trap
   */
  function openModalWithFocusTrap(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    // Apply focus trap
    setTimeout(() => {
      trapFocus(modal.querySelector('.modal-content') || modal);
    }, 100);

    // Close on Escape key
    function handleEscape(e) {
      if (e.key === 'Escape') {
        closeModalWithFocusReturn(modalId);
      }
    }

    modal._escapeHandler = handleEscape;
    document.addEventListener('keydown', handleEscape);
  }

  /**
   * Enhanced modal close with focus return
   */
  function closeModalWithFocusReturn(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    // Remove focus trap
    const modalContent = modal.querySelector('.modal-content');
    if (modalContent) {
      removeFocusTrap(modalContent);
    }

    // Remove escape handler
    if (modal._escapeHandler) {
      document.removeEventListener('keydown', modal._escapeHandler);
      delete modal._escapeHandler;
    }

    modal.style.display = 'none';
    document.body.style.overflow = '';

    // Return focus to trigger element if stored
    if (modal._triggerElement) {
      modal._triggerElement.focus();
      delete modal._triggerElement;
    }
  }

  // Initialize endpoint integrations on DOM load
  document.addEventListener('DOMContentLoaded', function() {
    initUpdateRSVPModal();
    initCancelRSVPModal();
    initQRCodeButton();
    initCalendarExportButtons();

    // Phase 5 enhancements
    enhanceAccessibility();

    // Re-apply accessibility after dynamic content loads
    const observer = new MutationObserver(enhanceAccessibility);
    observer.observe(document.body, { childList: true, subtree: true });
  });

  /**
   * Sprint 4 - Task 4.3: Final UX Polish & Animations
   * Button loading states, error animations, micro-interactions
   */

  /**
   * Add loading spinner to button
   * @param {HTMLElement} button - The button element
   * @param {string} loadingText - Optional loading text
   */
  function setButtonLoading(button, loadingText = 'Loading...') {
    if (!button) return;

    // Store original content
    button._originalHTML = button.innerHTML;
    button._originalDisabled = button.disabled;

    // Add loading state
    button.disabled = true;
    button.classList.add('btn-loading');
    button.innerHTML = `
      <span class="btn-spinner" aria-hidden="true"></span>
      <span class="btn-loading-text">${loadingText}</span>
    `;
  }

  /**
   * Remove loading spinner from button
   * @param {HTMLElement} button - The button element
   */
  function removeButtonLoading(button) {
    if (!button || !button._originalHTML) return;

    button.disabled = button._originalDisabled || false;
    button.classList.remove('btn-loading');
    button.innerHTML = button._originalHTML;
    delete button._originalHTML;
    delete button._originalDisabled;
  }

  /**
   * Shake animation for validation errors
   * @param {HTMLElement} element - The element to shake
   */
  function shakeElement(element) {
    if (!element) return;

    element.classList.add('shake-animation');
    setTimeout(() => {
      element.classList.remove('shake-animation');
    }, 500);
  }

  /**
   * Show toast notification (replaces alert())
   * @param {string} message - The message to display
   * @param {string} type - 'success', 'error', 'info', 'warning'
   * @param {number} duration - Duration in ms (default 4000)
   */
  function showToast(message, type = 'info', duration = 4000) {
    // Remove existing toast
    const existingToast = document.querySelector('.weinvite-toast');
    if (existingToast) {
      existingToast.remove();
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `weinvite-toast weinvite-toast-${type}`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');

    // Icon based on type
    const icons = {
      success: '✓',
      error: '⚠',
      info: 'ℹ',
      warning: '⚠'
    };

    toast.innerHTML = `
      <span class="toast-icon" aria-hidden="true">${icons[type] || icons.info}</span>
      <span class="toast-message">${message}</span>
      <button type="button" class="toast-close" aria-label="Close notification">×</button>
    `;

    document.body.appendChild(toast);

    // Show animation
    setTimeout(() => {
      toast.classList.add('toast-show');
    }, 10);

    // Close button
    const closeBtn = toast.querySelector('.toast-close');
    closeBtn.addEventListener('click', () => {
      closeToast(toast);
    });

    // Auto-close
    setTimeout(() => {
      closeToast(toast);
    }, duration);
  }

  /**
   * Close toast notification
   * @param {HTMLElement} toast - The toast element
   */
  function closeToast(toast) {
    if (!toast) return;

    toast.classList.remove('toast-show');
    toast.classList.add('toast-hide');

    setTimeout(() => {
      if (toast.parentNode) {
        toast.remove();
      }
    }, 300);
  }

  /**
   * Truncate long text with ellipsis
   * @param {HTMLElement} element - The element containing text
   * @param {number} maxLines - Maximum number of lines
   */
  function truncateText(element, maxLines = 2) {
    if (!element) return;

    const lineHeight = parseInt(window.getComputedStyle(element).lineHeight);
    const maxHeight = lineHeight * maxLines;

    if (element.scrollHeight > maxHeight) {
      element.style.maxHeight = `${maxHeight}px`;
      element.style.overflow = 'hidden';
      element.style.textOverflow = 'ellipsis';
      element.style.display = '-webkit-box';
      element.style.webkitLineClamp = maxLines;
      element.style.webkitBoxOrient = 'vertical';
    }
  }

  /**
   * Normalize phone number format
   * @param {string} phone - Phone number input
   * @return {string} Normalized phone number
   */
  function normalizePhoneNumber(phone) {
    if (!phone) return '';

    // Remove all non-digit characters
    let normalized = phone.replace(/\D/g, '');

    // Remove leading country code if present (assume Bahrain +973)
    if (normalized.startsWith('973')) {
      normalized = normalized.substring(3);
    }

    return normalized;
  }

  /**
   * Escape HTML special characters (XSS prevention)
   * @param {string} text - Text to escape
   * @return {string} Escaped text
   */
  function escapeHTML(text) {
    if (!text) return '';

    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  /**
   * Add button tap feedback animation (mobile)
   */
  function addButtonTapFeedback() {
    if (!isMobileDevice()) return;

    document.addEventListener('touchstart', (e) => {
      const button = e.target.closest('button, .btn, a.btn-primary');
      if (button) {
        button.style.transform = 'scale(0.98)';
        button.style.transition = 'transform 0.15s ease';
      }
    }, { passive: true });

    document.addEventListener('touchend', (e) => {
      const button = e.target.closest('button, .btn, a.btn-primary');
      if (button) {
        setTimeout(() => {
          button.style.transform = '';
        }, 150);
      }
    }, { passive: true });
  }

  /**
   * Initialize UX polish on page load
   */
  function initUXPolish() {
    // Add button tap feedback for mobile
    addButtonTapFeedback();

    // Truncate long event titles (max 2 lines)
    document.addEventListener('DOMContentLoaded', () => {
      const eventTitle = document.querySelector('.event-title, h1');
      if (eventTitle) {
        truncateText(eventTitle, 2);
      }

      // Truncate long descriptions
      const eventDescription = document.querySelector('.event-description');
      if (eventDescription) {
        const fullText = eventDescription.textContent;
        if (fullText.length > 200) {
          eventDescription.textContent = fullText.substring(0, 197) + '...';

          // Add "Read more" button
          const readMore = document.createElement('button');
          readMore.type = 'button';
          readMore.className = 'btn-read-more';
          readMore.textContent = 'Read more';
          readMore.addEventListener('click', () => {
            eventDescription.textContent = fullText;
            readMore.remove();
          });

          eventDescription.after(readMore);
        }
      }
    });
  }

  // Initialize UX polish
  initUXPolish();

  // Export functions for Phase 2 implementation
  window.WeInviteRSVP = {
    showLoadingScreen,
    hideLoadingScreen,
    showErrorScreen,
    showEventContent,
    fetchEventData,
    config,
    // Mobile-specific exports
    isMobileDevice,
    openBottomSheet,
    closeBottomSheet,
    initMobileOTPInput,
    initMobileFeatures,
    // BEDEV endpoint integrations
    updateRSVP,
    cancelRSVP,
    getQRCode,
    exportCalendar,
    showQRCodeModal,
    // Sprint 4 - UX Polish exports
    setButtonLoading,
    removeButtonLoading,
    shakeElement,
    showToast,
    truncateText,
    normalizePhoneNumber,
    escapeHTML
  };

})();
