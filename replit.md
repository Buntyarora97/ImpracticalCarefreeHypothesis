# GLIMLACH E-Commerce Platform

## Overview
PHP 8.2 e-commerce wellness/supplements store. Runs on port 5000 via PHP built-in server. SQLite fallback (no MySQL on Replit). For shared hosting: use `important/mysql_import.sql`.

## Structure
- `important/` — main application root
- `important/index.php` — homepage (hero, products, steps, stories, footer)
- `important/products.php` — product listing page
- `important/product-detail.php?slug=XXX` — product detail (query-string URLs; no .htaccess on PHP built-in server)
- `important/includes/` — config.php, database.php, header.php, footer.php
- `important/admin/` — admin panel
- `important/data/glimlach_local.sqlite` — SQLite database (10 products, 3 categories, 12 reviews, 5 stories, 3 hero slides, 8 settings)
- `important/mysql_import.sql` — MySQL import for shared hosting deployment
- `important/assets/images/` — all site images (banners, logos)
- `important/uploads/` — product & story images

## Images — All 200 OK
- Hero banners: `assets/images/banners/glimlach-hero-{1-4}.png` (AI-generated)
- Step images: `assets/images/banners/step-0{1-3}.png` (AI-generated)
- Offer banner: `assets/images/offer-banner.png` (AI-generated)
- Product showcase: `assets/products-banners/showcase-{1-3}.png` (AI-generated)
- Story avatars: `uploads/stories/story-{neha,amit,rohit,priya,sunita}.png` (AI-generated)
- Marketplace logos: `assets/images/logo/amazon-logo.png`, `flipkart-logo.png`, `Zepto_Logo.svg_-1.png`, `1748510129625.SwiggyInstamart.png`

## Branding
- All "Livvra" references removed
- Teal/green GLIMLACH brand (#165b45 primary)
- Brand: Indian wellness/supplements store

## Known Notes
- Tailwind CDN warning in console is cosmetic (development only)
- "Autoplay prevented" is browser policy for video elements — not a bug
