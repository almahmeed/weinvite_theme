# WeInvite Events WordPress Theme

Custom WordPress theme for WeInvite Events website - matching the mobile app design system.

**Version:** 1.0.0
**Author:** WeInvite Team
**Status:** In Development - Phase 1

---

## 📋 Project Overview

This is a custom WordPress theme built from scratch to complement the WeInvite Events mobile app (Flutter). The theme follows a 6-phase development plan totaling 12-16 weeks.

### Current Phase
**Phase 1: Marketing & Public Pages** (3-4 weeks)
- Landing Page
- Features Page
- Pricing Page
- About Us Page
- Contact Page
- FAQ Page
- Terms & Privacy Pages

---

## 🎯 Design System

### Colors
- **Primary:** Purple gradient (#6750A4, #7B3FF2)
- **Status:** Green (success), Orange (warning), Red (error), Blue (info)
- **Neutral:** Dark gray, Medium gray, Light gray

### Typography
- **Font:** System font stack (Apple SF Pro, Segoe UI, Roboto)
- **Base Size:** 16px
- **Scale:** 8px spacing unit

### Components
- Buttons (primary, secondary, outline, loading)
- Cards (basic, event, stat, package)
- Forms (inputs, dropdowns, checkboxes, file upload)
- Badges (status, pill, outline)
- Modals/Dialogs

---

## 🛠️ Tech Stack

**Frontend:**
- HTML5, CSS3 (SCSS), JavaScript (ES6+)
- Bootstrap 5 or Tailwind CSS (TBD)
- jQuery (WordPress default)
- Firebase Web SDK (authentication)
- Chart.js (data visualization)

**Build Tools:**
- Webpack 5 (bundling)
- Sass (CSS preprocessing)
- Babel (JavaScript transpiling)
- PostCSS (CSS optimization)

**Backend:**
- WordPress 6.x
- PHP 8.x
- Existing WordPress REST API plugin (17+ endpoints)
- TAP Payment Gateway integration

---

## 📁 Directory Structure

```
weinvite-theme/
├── assets/              # Compiled files
│   ├── css/            # Compiled CSS
│   ├── js/             # Compiled JavaScript
│   ├── images/         # Image assets
│   └── fonts/          # Custom fonts
├── src/                # Source files
│   ├── scss/           # SCSS source files
│   │   ├── main.scss
│   │   ├── _variables.scss
│   │   ├── _mixins.scss
│   │   ├── _buttons.scss
│   │   ├── _cards.scss
│   │   ├── _forms.scss
│   │   └── pages/      # Page-specific styles
│   └── js/             # JavaScript source files
│       ├── main.js
│       ├── modules/
│       │   ├── firebase-auth.js
│       │   ├── api-client.js
│       │   └── utils.js
│       └── components/
├── templates/          # Page templates
│   ├── template-landing.php
│   ├── template-features.php
│   └── ...
├── includes/           # PHP includes
│   ├── theme-setup.php
│   ├── helpers.php
│   └── api-integration.php
├── parts/              # Template parts
│   └── components/     # Reusable components
├── languages/          # Translation files
├── style.css           # Theme metadata
├── functions.php       # Theme functions
├── header.php          # Global header
├── footer.php          # Global footer
├── index.php           # Fallback template
├── 404.php             # 404 error page
├── package.json        # Node.js dependencies
├── webpack.config.js   # Webpack configuration
└── README.md           # This file
```

---

## 🚀 Getting Started

### Prerequisites
- Node.js 16+ and npm
- WordPress 6.x installation
- PHP 8.x
- Local development environment (Local by Flywheel)

### Installation

1. **Navigate to theme directory:**
   ```bash
   cd /path/to/wordpress/wp-content/themes/weinvite-theme
   ```

2. **Install dependencies:**
   ```bash
   npm install
   ```

3. **Build assets:**
   ```bash
   # Development build (with watch mode)
   npm run dev

   # Production build (minified)
   npm run build
   ```

4. **Activate theme in WordPress:**
   - Go to WordPress Admin → Appearance → Themes
   - Activate "WeInvite Events"

---

## 📝 Development Workflow

### SCSS Development
1. Edit SCSS files in `src/scss/`
2. Webpack watches for changes and compiles to `assets/css/`
3. Browser auto-refreshes (if using live reload)

### JavaScript Development
1. Edit JS files in `src/js/`
2. Webpack compiles and bundles to `assets/js/`
3. ES6+ syntax is transpiled to ES5 for compatibility

### Component Development
1. Create reusable PHP components in `parts/components/`
2. Example: `parts/components/event-card.php`
3. Include in templates: `get_template_part('parts/components/event-card')`

---

## 🔗 API Integration

### Firebase Authentication
- Phone number authentication (OTP)
- Session management
- ID token for WordPress API calls

### WordPress REST API
- Base URL: `/wp-json/weinvite/v1/`
- 17+ existing endpoints (events, invitations, credits, etc.)
- All requests include `idToken` parameter
- Response format: `{success: bool, ...data}`

### Example API Call
```javascript
// Get user events
const data = await WeInviteAPI.getUserEvents();

// Create event
const result = await WeInviteAPI.createEvent({
    title: 'My Event',
    description: 'Event description',
    date: '2025-10-20',
    time: '18:00'
});
```

---

## 📐 Responsive Breakpoints

- **xs:** 0px (mobile)
- **sm:** 576px (small tablets)
- **md:** 768px (tablets)
- **lg:** 992px (desktops)
- **xl:** 1200px (large desktops)
- **xxl:** 1400px (extra large)

**Mobile-First Approach:** Design for mobile first, then enhance for larger screens.

---

## ✅ Phase 1 Success Criteria

- [ ] All 7 pages responsive (mobile, tablet, desktop)
- [ ] SEO optimized (meta tags, schema markup)
- [ ] Fast load times (<3 seconds)
- [ ] Clear CTAs on every page
- [ ] Contact form working
- [ ] Analytics tracking installed (Google Analytics)
- [ ] A+ quality grade

---

## 📚 Documentation

**WEBUX Documents (must read):**
1. `WEBUX_WEBSITE_PHASES.md` - 6-phase implementation roadmap
2. `WEBUX_THEME_ARCHITECTURE.md` - Technical specifications
3. `WEBUX_FLUTTER_APP_ANALYSIS.md` - Mobile app feature reference

**Project Documents:**
- `TEAM_CODENAMES.md` - Team structure and roles
- `DAILY_TASKS_CURRENT.md` - Daily progress tracking
- `PROJECT_STATUS_2025-10-12.md` - Overall project status

---

## 👥 Team Coordination

**WPDEV (WordPress Developer):** Theme development lead
**WEBUX (Website Designer):** Design specifications and guidance
**BEDEV (Backend Developer):** WordPress REST API support
**PROJMAN (Project Manager):** Coordination and timeline management
**AZIZ (Project Owner):** Final approvals and decisions

**Communication:**
- Daily updates in `DAILY_TASKS_CURRENT.md`
- Report blockers immediately to PROJMAN
- Ask design questions to WEBUX
- Ask backend questions to BEDEV

---

## 🎯 Quality Standards

**Target Grade:** A+ (matching mobile app quality)

**Code Quality:**
- Follow WordPress coding standards
- Comment complex code
- DRY (Don't Repeat Yourself)
- Mobile-first responsive design
- Semantic HTML5

**Performance:**
- Google PageSpeed Score >90
- Page load times <3 seconds
- Optimized images (WebP format)
- Minified CSS/JS
- Lazy loading images

**Security:**
- Sanitize all inputs
- Escape all outputs
- CSRF protection (nonces)
- XSS prevention
- Validate on frontend AND backend

---

## 📅 Timeline

**Phase 1: Marketing & Public Pages** (3-4 weeks) - **CURRENT**
- Week 1-2: Theme setup, design system, component library
- Week 2-3: Landing, Features, Pricing pages
- Week 3-4: About, Contact, FAQ, Legal pages

**Phase 2: Authentication & Dashboard** (2-3 weeks)
**Phase 3: Event Management** (4-5 weeks)
**Phase 4: Credit System & Payments** (2-3 weeks)
**Phase 5: Advanced Features** (3-4 weeks)
**Phase 6: Final Polish & Launch** (2-3 weeks)

**Total:** 12-16 weeks

---

## 🐛 Troubleshooting

### Webpack not compiling
```bash
# Clear node_modules and reinstall
rm -rf node_modules package-lock.json
npm install
npm run build
```

### Theme not showing in WordPress
- Check `style.css` has proper header comment
- Verify theme directory name is correct
- Check file permissions

### Firebase not working
- Verify Firebase config in WordPress admin
- Check browser console for errors
- Ensure Firebase SDK is loaded before custom scripts

---

## 📄 License

GNU General Public License v2 or later

---

## 🔗 Useful Links

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/)
- [Firebase Web SDK](https://firebase.google.com/docs/web/setup)
- [Webpack Documentation](https://webpack.js.org/concepts/)
- [Sass Documentation](https://sass-lang.com/documentation)

---

**Last Updated:** October 15, 2025
**Theme Version:** 1.0.0
**Status:** In Development - Phase 1 Setup Complete
