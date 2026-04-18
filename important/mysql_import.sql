SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

DROP TABLE IF EXISTS `product_media`;

DROP TABLE IF EXISTS `reviews`;

DROP TABLE IF EXISTS `reels`;

DROP TABLE IF EXISTS `stories`;

DROP TABLE IF EXISTS `hero_slides`;

DROP TABLE IF EXISTS `products`;

DROP TABLE IF EXISTS `categories`;

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `categories` (`id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL, `slug` varchar(255) NOT NULL, `description` text, `image` varchar(255) DEFAULT NULL, `video` varchar(255) DEFAULT NULL, `icon_class` varchar(100) DEFAULT "fa-leaf", `icon_upload` varchar(255) DEFAULT NULL, `sort_order` int(11) DEFAULT 0, `is_active` tinyint(1) DEFAULT 1, `show_on_mobile_top_slider` tinyint(1) DEFAULT 1, `show_on_mobile_concern` tinyint(1) DEFAULT 1, `show_on_desktop_concern` tinyint(1) DEFAULT 1, `show_in_top_menu` tinyint(1) DEFAULT 1, `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `slug` (`slug`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `products` (`id` int(11) NOT NULL AUTO_INCREMENT, `category_id` int(11) DEFAULT NULL, `name` varchar(255) NOT NULL, `slug` varchar(255) NOT NULL, `sku` varchar(100) DEFAULT NULL, `price` decimal(10,2) NOT NULL, `mrp` decimal(10,2) DEFAULT NULL, `offer_price` decimal(10,2) DEFAULT 0.00, `offer_label` varchar(100) DEFAULT NULL, `short_description` text, `long_description` text, `benefits` text, `usage_instructions` text, `testing_info` text, `image` varchar(255) DEFAULT NULL, `video` varchar(255) DEFAULT NULL, `stock_qty` int(11) DEFAULT 100, `stock_status` varchar(50) DEFAULT "in_stock", `rating` decimal(3,2) DEFAULT 4.80, `reviews_count` int(11) DEFAULT 0, `reward_coins` int(11) DEFAULT 0, `is_featured` tinyint(1) DEFAULT 1, `is_active` tinyint(1) DEFAULT 1, `weight_kg` decimal(6,2) DEFAULT 0.50, `length_cm` decimal(6,2) DEFAULT 15.00, `width_cm` decimal(6,2) DEFAULT 10.00, `height_cm` decimal(6,2) DEFAULT 8.00, `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`), UNIQUE KEY `slug` (`slug`), KEY `category_id` (`category_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hero_slides` (`id` int(11) NOT NULL AUTO_INCREMENT, `badge` varchar(100) DEFAULT NULL, `title` varchar(255) DEFAULT NULL, `subtitle` text, `price` decimal(10,2) DEFAULT NULL, `discount` varchar(50) DEFAULT NULL, `image` varchar(255) DEFAULT NULL, `media_type` varchar(50) DEFAULT "image", `media_url` varchar(255) DEFAULT NULL, `video_url` varchar(255) DEFAULT NULL, `button_text` varchar(100) DEFAULT "SHOP NOW", `button_link` varchar(255) DEFAULT "products.php", `display_order` int(11) DEFAULT 0, `is_active` tinyint(1) DEFAULT 1, `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `product_media` (`id` int(11) NOT NULL AUTO_INCREMENT, `product_id` int(11) NOT NULL, `media_type` varchar(50) DEFAULT "image", `media_url` varchar(255) NOT NULL, `sort_order` int(11) DEFAULT 0, `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `reviews` (`id` int(11) NOT NULL AUTO_INCREMENT, `product_id` int(11) DEFAULT NULL, `user_name` varchar(255) DEFAULT NULL, `rating` int(11) DEFAULT 5, `review_text` text, `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `stories` (`id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(255) DEFAULT NULL, `story_text` text, `rating` int(11) DEFAULT 5, `image_path` varchar(255) DEFAULT NULL, `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `reels` (`id` int(11) NOT NULL AUTO_INCREMENT, `product_id` int(11) DEFAULT NULL, `video` varchar(255) DEFAULT NULL, `views` int(11) DEFAULT 0, `is_active` tinyint(1) DEFAULT 0, `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `settings` (`id` int(11) NOT NULL AUTO_INCREMENT, `key` varchar(100) NOT NULL, `value` text, `description` varchar(255) DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `key` (`key`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categories` (`id`,`name`,`slug`,`description`,`icon_class`,`icon_upload`,`sort_order`,`is_active`,`show_on_mobile_top_slider`,`show_on_mobile_concern`,`show_on_desktop_concern`) VALUES

(1,'Health & Nutrition','health-nutrition','Premium supplements and everyday nutrition support','fa-capsules','health-nutrition.svg',1,1,1,1,1),
(2,'Women''s Wellness & Care','womens-wellness-care','Essential health, beauty and wellness products designed for women''s lifestyle needs','fa-spa','women-wellness.svg',2,1,1,1,1),
(3,'Personal Care','personal-care','Skin, body and daily personal care essentials','fa-pump-soap','personal-care.svg',3,1,1,1,1);

INSERT INTO `products` (`id`,`category_id`,`name`,`slug`,`sku`,`price`,`mrp`,`offer_price`,`offer_label`,`short_description`,`long_description`,`benefits`,`usage_instructions`,`testing_info`,`image`,`stock_qty`,`stock_status`,`rating`,`reviews_count`,`is_featured`,`is_active`) VALUES

(1,1,'GLIMLACH Calamine Powder for Skin Care Effectively Heals Rashes, Soothes Skin 200g','glimlach-calamine-powder-skin-care','GLM-CAL-200',399.00,399.00,249.00,'37% OFF','A gentle skin care powder designed to soothe rashes, calm irritation and keep skin comfortable.','Calamine based daily skin comfort support for prickly heat, sweat irritation and minor rashes. Helps absorb excess moisture while leaving skin fresh and calm.','Soothes rashes|Helps calm irritated skin|Absorbs excess moisture|Daily summer skin care','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','calamine-powder-200g.jpg',100,'in_stock',4.8,24,1,1),
(2,1,'GLIMLACH Calcium Magnesium Zinc with Vitamin D3 | 50 Tablets','glimlach-calcium-magnesium-zinc-vitamin-d3-50-tablets','GLM-CMZ-D3-50',339.00,339.00,199.00,'41% OFF','A daily mineral and Vitamin D3 supplement for bone, muscle and immune support.','A balanced calcium, magnesium, zinc and Vitamin D3 formula for men and women. Supports stronger bones, normal muscle function and everyday nutritional wellness.','Bone strength support|Muscle function support|Vitamin D3 nutrition|For men and women','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','calcium-magnesium-zinc-d3.jpg',100,'in_stock',4.8,24,1,1),
(3,1,'GLIMLACH Glutathione Tablets 400mg with Vitamin C & Natural Extracts | 50 Tablets','glimlach-glutathione-tablets-400mg-vitamin-c','GLM-GLUTA-50',799.00,799.00,449.00,'43% OFF','Antioxidant and skin brightening support with Glutathione, Vitamin C and natural extracts.','Premium antioxidant tablets formulated with Glutathione and Vitamin C to support skin radiance, detox support and overall wellness from within.','Antioxidant support|Skin radiance support|Vitamin C enriched|For men and women','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','glutathione-vitamin-c-50-tablets.jpg',100,'in_stock',4.8,24,1,1),
(4,1,'GLIMLACH L Arginine 1500mg Tablets | 120 Tablets','glimlach-l-arginine-1500mg-120-tablets','GLM-ARGININE-120',1999.00,1999.00,599.00,'70% OFF','Dietary supplement for active men and women, formulated with L-Arginine 1500mg.','L-Arginine is a popular amino acid supplement that supports active lifestyle, blood flow wellness and exercise nutrition when used as directed.','Active lifestyle support|Amino acid nutrition|Workout wellness|120 tablets pack','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','l-arginine-1500mg-120-tablets.jpg',100,'in_stock',4.8,24,1,1),
(5,1,'GLIMLACH L-Glutamine 500mg Tablets | 50 Tablets','glimlach-l-glutamine-500mg-50-tablets','GLM-GLUTAMINE-50',799.00,799.00,395.00,'50% OFF','Supports immunity, muscle function and recovery nutrition for everyday wellness.','L-Glutamine tablets are designed for people with active routines who want convenient amino acid nutrition and daily muscle support.','Muscle function support|Recovery nutrition|Immune wellness|Easy tablet format','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','l-glutamine-500mg-50-tablets.jpg',100,'in_stock',4.8,24,1,1),
(6,1,'GLIMLACH L-Theanine 50 Capsules | Stress & Relaxation Support','glimlach-l-theanine-50-capsules','GLM-THEANINE-50',1999.00,1999.00,280.00,'85% OFF','Promotes calm focus, relaxation and daily stress support.','L-Theanine capsules are formulated to support natural relaxation, calm focus and everyday mental wellness without complicated routines.','Stress support|Relaxation support|Calm focus|50 capsules','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','l-theanine-50-capsules.jpg',100,'in_stock',4.8,24,1,1),
(7,2,'GLIMLACH Magnesium Oil for Feet, Sleep Support, Pain Relief & Muscle Recovery 100ml','glimlach-magnesium-oil-100ml','GLM-MAG-OIL-100',749.00,749.00,249.00,'66% OFF','Topical magnesium oil for feet, sleep support, muscle recovery and relaxation.','A convenient topical magnesium spray/oil for daily relaxation routines. Ideal for foot application, post-workout care and soothing muscle massage.','Sleep routine support|Muscle recovery massage|Pain relief support|Topical magnesium care','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','magnesium-oil-100ml.jpg',100,'in_stock',4.8,24,1,1),
(8,1,'GLIMLACH Marine Collagen Supplements Orange Flavour 200g','glimlach-marine-collagen-orange-flavour-200g','GLM-COLLAGEN-200',1099.00,1099.00,499.00,'54% OFF','Hydrolyzed marine collagen powder with amino acids for skin, hair, nails, bone and joint support.','Orange flavoured marine collagen supplement designed for beauty and wellness from within. Supports healthy skin, hair, nails, bones and joints.','Skin hair nail support|Hydrolyzed collagen|Bone and joint wellness|Orange flavour','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','marine-collagen-orange-200g.jpg',100,'in_stock',4.8,24,1,1),
(9,1,'GLIMLACH Multivitamins For Men with Zinc, Vitamin C, Vitamin D3, Multiminerals & Ginseng | 50 Tablets','glimlach-multivitamins-for-men-50-tablets','GLM-MVM-MEN-50',499.00,499.00,295.00,'40% OFF','Daily multivitamin support for men with key vitamins, minerals and ginseng extract.','A complete multivitamin and multimineral tablet for men to support energy, stamina, immunity and daily nutritional balance.','Energy support|Immunity support|Zinc and Vitamin C|Ginseng extract','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','multivitamins-men-50-tablets.jpg',100,'in_stock',4.8,24,1,1),
(10,1,'GLIMLACH Multivitamins For Teenagers with Zinc, Vitamin C, Vitamin D3 & Multiminerals | 50 Tablets','glimlach-multivitamins-for-teenagers-50-tablets','GLM-MVT-TEEN-50',499.00,499.00,295.00,'40% OFF','Daily multivitamin tablets for teenagers to support energy, stamina and immunity.','A teenager-friendly multivitamin and multimineral supplement with Vitamin C, Vitamin D3 and zinc to support active growth years.','Teen nutrition support|Energy and stamina|Immunity support|50 tablets','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','multivitamins-teenagers-50-tablets.jpg',100,'in_stock',4.8,24,1,1);

INSERT INTO `hero_slides` (`id`,`badge`,`title`,`subtitle`,`price`,`image`,`media_type`,`media_url`,`button_text`,`button_link`,`display_order`,`is_active`) VALUES
(1,'Featured','Wellness Starts with GLIMLACH','Relieve tension and stay energized daily.',249.00,'assets/images/banners/glimlach-hero-1.svg','image','assets/images/banners/glimlach-hero-1.svg','SHOP NOW','products.php',1,1),
(2,'Best Sellers','Daily Nutrition Made Simple','Premium health and nutrition products for everyday wellness.',199.00,'assets/images/banners/glimlach-hero-2.svg','image','assets/images/banners/glimlach-hero-2.svg','VIEW PRODUCTS','products.php',2,1);

INSERT INTO `product_media` (`product_id`,`media_type`,`media_url`,`sort_order`) VALUES

(1,'image','calamine-powder-200g.jpg',1),
(2,'image','calcium-magnesium-zinc-d3.jpg',1),
(3,'image','glutathione-vitamin-c-50-tablets.jpg',1),
(4,'image','l-arginine-1500mg-120-tablets.jpg',1),
(5,'image','l-glutamine-500mg-50-tablets.jpg',1),
(6,'image','l-theanine-50-capsules.jpg',1),
(7,'image','magnesium-oil-100ml.jpg',1),
(8,'image','marine-collagen-orange-200g.jpg',1),
(9,'image','multivitamins-men-50-tablets.jpg',1),
(10,'image','multivitamins-teenagers-50-tablets.jpg',1);

INSERT INTO `reviews` (`product_id`,`user_name`,`rating`,`review_text`) VALUES
(7,'Aarav',5,'Magnesium Oil is now part of my night routine.'),
(9,'Rohit',5,'Good daily multivitamin with simple pricing.'),
(3,'Priya',5,'Great antioxidant support and easy to use.');

INSERT INTO `stories` (`name`,`story_text`,`rating`,`image_path`) VALUES
('Neha','GLIMLACH products fit perfectly into my daily wellness routine.',5,'story-1.svg'),
('Rohit','The nutrition range is easy to understand and affordable.',5,'story-2.svg');

INSERT INTO `settings` (`key`,`value`,`description`) VALUES
('site_name','GLIMLACH','Website Name'),
('global_offer_percent','10','Default offer display'),
('UPI_HOLDER_NAME','GLIMLACH','UPI holder name');

COMMIT;
