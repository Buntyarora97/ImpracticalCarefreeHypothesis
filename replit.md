# GLIMLACH E-Commerce Platform

## Overview
PHP 8.2 e-commerce wellness/supplements store for the Indian market. Runs on port 5000 via PHP built-in server. Uses MySQL/phpMyAdmin-compatible database only.

## Tech Stack
- **Backend:** PHP 8.2 (native/procedural + OOP)
- **Database:** MySQL via `MYSQL_*` environment variables or a `mysql://` database URL
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
- MySQL is the primary database. Import `important/mysql_import.sql` in phpMyAdmin for a clean reset and fresh seed data.
- Tables auto-created if missing: categories, products, product_media, product_images, reviews, hero_slides, stories, settings, orders, order_items, users, admins, promo_codes, promo_code_usage, contact_inquiries, reels, video_popups, pincodes, reward_coins, coin_transactions
- Seed data (10 products, 3 categories, stories, settings, admin) auto-inserted if missing
- Default admin: username=`admin`, password=`admin123`
- Contact info: phone 8882728239, email support@glimlach.in, Delhi, Delhi, 110044

## Environment Variables / Secrets
All sensitive credentials should be stored as Replit secrets or hosting environment variables:
- `MYSQL_HOST`, `MYSQL_DATABASE`, `MYSQL_USER`, `MYSQL_PASSWORD`, `MYSQL_PORT` — MySQL/phpMyAdmin database connection
- Optional: `MYSQL_URL` or `DATABASE_URL` only if it starts with `mysql://`
- `RAZORPAY_KEY_ID`, `RAZORPAY_KEY_SECRET` — Razorpay payment
- `CASHFREE_CLIENT_ID`, `CASHFREE_CLIENT_SECRET`, `CASHFREE_ENV`
- `PAYU_MERCHANT_KEY`, `PAYU_SALT`
- `IM_API_KEY`, `IM_AUTH_TOKEN` — Instamojo
- `SHIPROCKET_API_EMAIL`, `SHIPROCKET_API_PASSWORD`, `SHIPROCKET_PICKUP_LOCATION`
- `FACEBOOK_CONVERSIONS_ACCESS_TOKEN`, `FACEBOOK_PIXEL_ID` — optional server-side purchase tracking
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
