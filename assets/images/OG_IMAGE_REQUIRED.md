# Default OG Image Required

**Sprint 4 - Task 4.2: Social Sharing Cards**

## File Required
`og-default.jpg` - Default Open Graph image for events without custom images

## Specifications

### Dimensions
- **Width:** 1200px
- **Height:** 630px
- **Aspect Ratio:** 1.91:1 (Facebook/Twitter/LinkedIn recommended)

### Format
- **File Type:** JPG
- **Quality:** 85-90% (optimized)
- **File Size:** < 200KB
- **Color Mode:** RGB

### Design Requirements

#### Background
- Purple gradient (#7B3FF2 to #9C27B0)
- Direction: Top-left to bottom-right diagonal
- Smooth gradient transition

#### Logo
- WeInvite logo (white version)
- Width: 240px (maintain aspect ratio)
- Position: Centered horizontally and vertically (slight upward offset)
- Padding: Minimum 80px from edges

#### Text
- Content: "You're Invited to an Event"
- Font: Sans-serif (Roboto, Inter, or system font)
- Size: 32px
- Weight: Medium (500)
- Color: White (#FFFFFF)
- Position: Centered below logo, 40px gap
- Letter spacing: 0.5px

#### Border (Optional)
- Width: 2px
- Color: rgba(255, 255, 255, 0.2)
- Inset: 20px from all edges

### Design Tools

You can create this image using:
- **Adobe Photoshop:** Professional design tool
- **Figma:** Free design tool (https://figma.com)
- **Canva:** Easy online tool (https://canva.com) - Use "Facebook Post" template (1200x630)
- **Adobe Express:** Free tool (https://express.adobe.com)

### Design Template (CSS-equivalent)

```css
.og-image {
  width: 1200px;
  height: 630px;
  background: linear-gradient(135deg, #7B3FF2 0%, #9C27B0 100%);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
}

.og-image::before {
  content: '';
  position: absolute;
  top: 20px;
  left: 20px;
  right: 20px;
  bottom: 20px;
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: 0;
}

.og-image-logo {
  width: 240px;
  height: auto;
  margin-bottom: 40px;
}

.og-image-text {
  font-family: 'Roboto', 'Inter', sans-serif;
  font-size: 32px;
  font-weight: 500;
  color: #FFFFFF;
  letter-spacing: 0.5px;
  text-align: center;
}
```

### Testing

After creating the image, test it with:
- **Facebook Sharing Debugger:** https://developers.facebook.com/tools/debug/
- **Twitter Card Validator:** https://cards-dev.twitter.com/validator
- **LinkedIn Post Inspector:** https://www.linkedin.com/post-inspector/
- **WhatsApp:** Share test link on WhatsApp and verify preview

### File Location
Place the final image at:
```
/app/public/wp-content/themes/weinvite-theme/assets/images/og-default.jpg
```

---

**Status:** ⏳ **IMAGE CREATION REQUIRED**
**Priority:** 🔴 **P0 - CRITICAL** (blocks Task 4.2 testing)
**Assignee:** WEBUX or WPDEV (design asset)
**Estimated Time:** 30-45 minutes

---

**Note:** Until this image is created, the SEO implementation will fall back to this placeholder path. Social sharing will still work but won't show a preview image.
