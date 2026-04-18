# GLIMLACH E-Commerce Platform

## Overview
PHP 8.2 e-commerce wellness/supplements store for the Indian market. Runs on port 5000 via PHP built-in server. Uses Replit's built-in PostgreSQL database (with SQLite as local fallback).

## Tech Stack
- **Backend:** PHP 8.2 (native/procedural + OOP)
- **Database:** PostgreSQL (Replit built-in) via DATABASE_URL secret; SQLite fallback for local dev
- **Frontend:** HTML5/CSS3, Tailwind CSS (CDN), Swiper.js, Glider.js, Lucide/Font Awesome icons
- **Integrations:** Shiprocket (logistics), Razorpay/Cashfree/PayU/Instamojo (payments)

## Structure
- `important/` — main application root (served as document root)
- `important/index.php` — homepage (hero, products, steps, stories, footer)
- `important/products.php` — product listing page
- `important/product-detail.php?slug=XXX` — product detail
- `important/includes/` — config.php, database.php, header.php, footer.php, models/
- `important/admin/` — admin panel (login: admin / admin123)
- `important/assets/images/` — all site images (banners, logos)
- `important/uploads/` — product & story images

## Database
- Replit PostgreSQL is the primary database (auto-initialized on first PHP request)
- Tables auto-created: categories, products, product_media, reviews, hero_slides, stories, settings, orders, order_items, users, admins, promo_codes, promo_code_usage, contact_inquiries, reels, video_popups
- Seed data (10 products, 3 categories) is auto-inserted if products table is empty
- Default admin: username=`admin`, password=`admin123`

## Environment Variables / Secrets
All sensitive credentials should be stored as Replit secrets:
- `DATABASE_URL` — PostgreSQL connection (auto-set by Replit)
- `RAZORPAY_KEY_ID`, `RAZORPAY_KEY_SECRET` — Razorpay payment
- `CASHFREE_CLIENT_ID`, `CASHFREE_CLIENT_SECRET`, `CASHFREE_ENV`
- `PAYU_MERCHANT_KEY`, `PAYU_SALT`
- `IM_API_KEY`, `IM_AUTH_TOKEN` — Instamojo
- `SHIPROCKET_API_EMAIL`, `SHIPROCKET_API_PASSWORD`, `SHIPROCKET_PICKUP_LOCATION`
- `SITE_URL` — production domain (e.g. https://glimlach.in)

## Workflow
- **Start application:** `php -S 0.0.0.0:5000 -t important`

## Images
- Hero banners: `assets/images/banners/glimlach-hero-{1-4}.png`
- Step images: `assets/images/banners/step-0{1-3}.png`
- Product images: `uploads/products/`
- Story avatars: `uploads/stories/`

## Branding
- Teal/green GLIMLACH brand (#165b45 primary)
- Indian wellness/supplements store targeting Indian market
