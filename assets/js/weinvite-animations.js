/**
 * ============================================
 * WEINVITE ANIMATIONS UTILITIES
 * Phase 7: Sprint 3 Implementation
 * November 10, 2025
 * Version: 1.0.0
 * ============================================
 */

(function() {
  'use strict';

  /**
   * Animation Utilities Object
   */
  const WeInviteAnimations = {

    /**
     * Fade in element
     */
    fadeIn: function(element, duration = 300) {
      if (!element) return;

      element.style.opacity = '0';
      element.style.display = 'block';

      let start = null;
      function animate(timestamp) {
        if (!start) start = timestamp;
        const progress = timestamp - start;
        const opacity = Math.min(progress / duration, 1);

        element.style.opacity = opacity;

        if (progress < duration) {
          requestAnimationFrame(animate);
        }
      }

      requestAnimationFrame(animate);
    },

    /**
     * Fade out element
     */
    fadeOut: function(element, duration = 300) {
      if (!element) return;

      let start = null;
      function animate(timestamp) {
        if (!start) start = timestamp;
        const progress = timestamp - start;
        const opacity = 1 - Math.min(progress / duration, 1);

        element.style.opacity = opacity;

        if (progress < duration) {
          requestAnimationFrame(animate);
        } else {
          element.style.display = 'none';
        }
      }

      requestAnimationFrame(animate);
    },

    /**
     * Slide up animation
     */
    slideUp: function(element) {
      if (!element) return;
      element.classList.add('slide-up');
    },

    /**
     * Slide down animation
     */
    slideDown: function(element) {
      if (!element) return;
      element.classList.add('slide-down');
    },

    /**
     * Shake animation (for errors)
     */
    shake: function(element) {
      if (!element) return;
      element.classList.add('shake');
      setTimeout(() => {
        element.classList.remove('shake');
      }, 300);
    },

    /**
     * Success bounce animation
     */
    successBounce: function(element) {
      if (!element) return;
      element.style.animation = 'successBounce 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
    },

    /**
     * Reveal pulse animation (for revealed content)
     */
    revealPulse: function(element) {
      if (!element) return;
      element.style.animation = 'revealPulse 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
    },

    /**
     * Loading spinner animation
     */
    spin: function(element) {
      if (!element) return;
      element.style.animation = 'spin 0.8s linear infinite';
    },

    /**
     * ==========================================
     * PHASE 4 IMPLEMENTATION - TO BE BUILT
     * ==========================================
     *
     * Advanced animations to implement:
     *
     * 1. Modal Enter/Exit
     *    - Backdrop fade in/out
     *    - Content slide up/down
     *    - Elastic easing
     *
     * 2. Bottom Sheet (Mobile)
     *    - Slide up from bottom
     *    - Spring physics
     *    - Touch-drag animation
     *
     * 3. Content Reveal
     *    - Staggered animation
     *    - Fade + scale
     *    - Sequential reveals
     *
     * 4. Success State
     *    - Checkmark animation
     *    - Bounce effect
     *    - Confetti (optional)
     *
     * 5. Error State
     *    - Shake animation
     *    - Red pulse
     *    - Error icon bounce
     *
     * 6. OTP Input
     *    - Digit focus animation
     *    - Fill animation
     *    - Error shake
     *
     * 7. Loading States
     *    - Skeleton screens
     *    - Progress indicators
     *    - Shimmer effect
     *
     * 8. Button States
     *    - Hover lift
     *    - Click ripple
     *    - Loading spinner
     *
     * 9. RSVP Progress
     *    - Progress bar fill
     *    - Counter animation
     *    - Capacity warning
     *
     * 10. Page Transitions
     *     - Before RSVP → After RSVP
     *     - Smooth content swap
     *     - Scroll animations
     *
     * ==========================================
     */

  };

  // Export to global scope
  window.WeInviteAnimations = WeInviteAnimations;

  console.log('WeInvite Animations utilities loaded');

})();
