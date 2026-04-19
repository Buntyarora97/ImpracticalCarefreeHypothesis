<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $config = $this->getMysqlConfig();
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ]);
            $this->initializeMysqlDatabase();
        } catch (PDOException $e) {
            http_response_code(500);
            die("MySQL connection failed. Please check MYSQL_HOST, MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD and MYSQL_PORT. Error: " . $e->getMessage());
        }
    }

    private function getMysqlConfig() {
        $url = getenv('MYSQL_URL') ?: getenv('JAWSDB_URL') ?: getenv('CLEARDB_DATABASE_URL') ?: getenv('DATABASE_URL');
        if ($url && preg_match('/^mysql:\/\//i', $url)) {
            $parts = parse_url($url);
            return [
                'host' => $parts['host'] ?? 'localhost',
                'port' => $parts['port'] ?? 3306,
                'database' => isset($parts['path']) ? ltrim($parts['path'], '/') : '',
                'username' => urldecode($parts['user'] ?? ''),
                'password' => urldecode($parts['pass'] ?? '')
            ];
        }

        return [
            'host' => getenv('MYSQL_HOST') ?: getenv('DB_HOST') ?: '127.0.0.1',
            'port' => getenv('MYSQL_PORT') ?: getenv('DB_PORT') ?: 3306,
            'database' => getenv('MYSQL_DATABASE') ?: getenv('DB_NAME') ?: '',
            'username' => getenv('MYSQL_USER') ?: getenv('DB_USER') ?: '',
            'password' => getenv('MYSQL_PASSWORD') ?: getenv('DB_PASSWORD') ?: ''
        ];
    }

    private function initializeMysqlDatabase() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL UNIQUE,
            description TEXT,
            image VARCHAR(255) DEFAULT NULL,
            video VARCHAR(255) DEFAULT NULL,
            icon_class VARCHAR(100) DEFAULT 'fa-leaf',
            icon_upload VARCHAR(255) DEFAULT NULL,
            sort_order INT DEFAULT 0,
            is_active TINYINT(1) DEFAULT 1,
            show_on_mobile_top_slider TINYINT(1) DEFAULT 1,
            show_on_mobile_concern TINYINT(1) DEFAULT 1,
            show_on_desktop_concern TINYINT(1) DEFAULT 1,
            show_in_top_menu TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            category_id INT DEFAULT NULL,
            name VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL UNIQUE,
            sku VARCHAR(100) DEFAULT NULL,
            price DECIMAL(10,2) NOT NULL,
            mrp DECIMAL(10,2) DEFAULT NULL,
            offer_price DECIMAL(10,2) DEFAULT 0.00,
            offer_label VARCHAR(100) DEFAULT NULL,
            short_description TEXT,
            long_description TEXT,
            benefits TEXT,
            usage_instructions TEXT,
            testing_info TEXT,
            image VARCHAR(255) DEFAULT NULL,
            video VARCHAR(255) DEFAULT NULL,
            stock_qty INT DEFAULT 100,
            stock_status VARCHAR(50) DEFAULT 'in_stock',
            rating DECIMAL(3,2) DEFAULT 4.80,
            reviews_count INT DEFAULT 0,
            reward_coins INT DEFAULT 0,
            is_featured TINYINT(1) DEFAULT 1,
            is_active TINYINT(1) DEFAULT 1,
            weight_kg DECIMAL(6,2) DEFAULT 0.50,
            length_cm DECIMAL(6,2) DEFAULT 15.00,
            width_cm DECIMAL(6,2) DEFAULT 10.00,
            height_cm DECIMAL(6,2) DEFAULT 8.00,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY category_id (category_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS hero_slides (
            id INT AUTO_INCREMENT PRIMARY KEY,
            badge VARCHAR(100) DEFAULT NULL,
            title VARCHAR(255) DEFAULT NULL,
            subtitle TEXT,
            price DECIMAL(10,2) DEFAULT NULL,
            discount VARCHAR(50) DEFAULT NULL,
            image VARCHAR(255) DEFAULT NULL,
            media_type VARCHAR(50) DEFAULT 'image',
            media_url VARCHAR(255) DEFAULT NULL,
            video_url VARCHAR(255) DEFAULT NULL,
            button_text VARCHAR(100) DEFAULT 'SHOP NOW',
            button_link VARCHAR(255) DEFAULT 'products.php',
            display_order INT DEFAULT 0,
            is_active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS product_media (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            media_type VARCHAR(50) DEFAULT 'image',
            media_url VARCHAR(255) NOT NULL,
            sort_order INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            KEY product_id (product_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS product_images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            image_path VARCHAR(255) NOT NULL,
            is_primary TINYINT(1) DEFAULT 0,
            display_order INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            KEY product_id (product_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT DEFAULT NULL,
            user_name VARCHAR(255) DEFAULT NULL,
            rating INT DEFAULT 5,
            review_text TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            KEY product_id (product_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS stories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) DEFAULT NULL,
            story_text TEXT,
            rating INT DEFAULT 5,
            image_path VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reels (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT DEFAULT NULL,
            video VARCHAR(255) DEFAULT NULL,
            views INT DEFAULT 0,
            is_active TINYINT(1) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            KEY product_id (product_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            `key` VARCHAR(100) NOT NULL UNIQUE,
            value TEXT,
            description VARCHAR(255) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL UNIQUE,
            phone VARCHAR(20) DEFAULT NULL,
            password VARCHAR(255) DEFAULT NULL,
            password_hash VARCHAR(255) DEFAULT NULL,
            reward_coins INT DEFAULT 0,
            address TEXT DEFAULT NULL,
            city VARCHAR(100) DEFAULT NULL,
            state VARCHAR(100) DEFAULT NULL,
            pincode VARCHAR(20) DEFAULT NULL,
            is_active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            email VARCHAR(255) DEFAULT NULL,
            is_active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_number VARCHAR(100) DEFAULT NULL,
            user_id INT DEFAULT NULL,
            customer_name VARCHAR(255) DEFAULT NULL,
            customer_email VARCHAR(255) DEFAULT NULL,
            customer_phone VARCHAR(20) DEFAULT NULL,
            shipping_address TEXT DEFAULT NULL,
            city VARCHAR(100) DEFAULT NULL,
            state VARCHAR(100) DEFAULT NULL,
            pincode VARCHAR(20) DEFAULT NULL,
            subtotal DECIMAL(10,2) DEFAULT 0.00,
            shipping_fee DECIMAL(10,2) DEFAULT 0.00,
            discount_amount DECIMAL(10,2) DEFAULT 0.00,
            total_amount DECIMAL(10,2) DEFAULT 0.00,
            payment_method VARCHAR(50) DEFAULT NULL,
            payment_status VARCHAR(50) DEFAULT 'pending',
            order_status VARCHAR(50) DEFAULT 'pending',
            promo_code VARCHAR(50) DEFAULT NULL,
            notes TEXT DEFAULT NULL,
            payment_id VARCHAR(255) DEFAULT NULL,
            bank_ref VARCHAR(255) DEFAULT NULL,
            payment_response TEXT DEFAULT NULL,
            transaction_id VARCHAR(255) DEFAULT NULL,
            shiprocket_order_id VARCHAR(100) DEFAULT NULL,
            shiprocket_shipment_id VARCHAR(100) DEFAULT NULL,
            awb_code VARCHAR(100) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            KEY order_number (order_number),
            KEY user_id (user_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            product_id INT DEFAULT NULL,
            product_name VARCHAR(255) DEFAULT NULL,
            quantity INT DEFAULT 1,
            price DECIMAL(10,2) DEFAULT 0.00,
            total DECIMAL(10,2) DEFAULT 0.00,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            KEY order_id (order_id),
            KEY product_id (product_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS promo_codes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            code VARCHAR(50) NOT NULL UNIQUE,
            influencer_name VARCHAR(100) DEFAULT NULL,
            influencer_email VARCHAR(255) DEFAULT NULL,
            discount_type VARCHAR(20) DEFAULT 'percentage',
            discount_value DECIMAL(10,2) DEFAULT 0.00,
            min_order DECIMAL(10,2) DEFAULT 0.00,
            min_order_amount DECIMAL(10,2) DEFAULT 0.00,
            max_discount DECIMAL(10,2) DEFAULT 0.00,
            max_uses INT DEFAULT NULL,
            usage_limit INT DEFAULT 0,
            used_count INT DEFAULT 0,
            commission_type VARCHAR(20) DEFAULT 'percentage',
            commission_value DECIMAL(10,2) DEFAULT 0.00,
            expires_at TIMESTAMP NULL DEFAULT NULL,
            expiry_date DATE DEFAULT NULL,
            is_active TINYINT(1) DEFAULT 1,
            notes TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS promo_code_usage (
            id INT AUTO_INCREMENT PRIMARY KEY,
            promo_code_id INT NOT NULL,
            order_id INT NOT NULL,
            order_number VARCHAR(50) NOT NULL,
            customer_name VARCHAR(255) DEFAULT NULL,
            customer_phone VARCHAR(20) DEFAULT NULL,
            order_total DECIMAL(10,2) DEFAULT 0.00,
            discount_given DECIMAL(10,2) DEFAULT 0.00,
            commission_earned DECIMAL(10,2) DEFAULT 0.00,
            used_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            KEY promo_code_id (promo_code_id),
            KEY order_id (order_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS contact_inquiries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL,
            phone VARCHAR(20) DEFAULT NULL,
            subject VARCHAR(255) DEFAULT NULL,
            message TEXT DEFAULT NULL,
            status VARCHAR(50) DEFAULT 'new',
            handled_by INT DEFAULT NULL,
            handled_at TIMESTAMP NULL DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS video_popups (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title TEXT,
            video_url VARCHAR(255) DEFAULT NULL,
            is_active TINYINT(1) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS pincodes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            pincode VARCHAR(10) NOT NULL UNIQUE,
            delivery_days INT DEFAULT 3,
            is_serviceable TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reward_coins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL UNIQUE,
            balance INT DEFAULT 0,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS coin_transactions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            amount INT NOT NULL,
            transaction_type VARCHAR(50) NOT NULL,
            description VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            KEY user_id (user_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $this->seedMysqlData();
    }

    private function seedMysqlData() {
        $this->pdo->exec("INSERT IGNORE INTO categories (id,name,slug,description,icon_class,icon_upload,sort_order,is_active,show_on_mobile_top_slider,show_on_mobile_concern,show_on_desktop_concern,show_in_top_menu) VALUES
            (1,'Health & Nutrition','health-nutrition','Premium supplements and everyday nutrition support','fa-capsules','health-nutrition.svg',1,1,1,1,1,1),
            (2,'Women''s Wellness & Care','womens-wellness-care','Essential health, beauty and wellness products designed for women''s lifestyle needs','fa-spa','women-wellness.svg',2,1,1,1,1,1),
            (3,'Personal Care','personal-care','Skin, body and daily personal care essentials','fa-pump-soap','personal-care.svg',3,1,1,1,1,1)");

        $this->pdo->exec("INSERT IGNORE INTO products (id,category_id,name,slug,sku,price,mrp,offer_price,offer_label,short_description,long_description,benefits,usage_instructions,testing_info,image,stock_qty,stock_status,rating,reviews_count,is_featured,is_active) VALUES
            (1,3,'GLIMLACH Calamine Powder for Skin Care Effectively Heals Rashes, Soothes Skin 200g','glimlach-calamine-powder-skin-care','GLM-CAL-200',399.00,399.00,249.00,'37% OFF','A gentle skin care powder to soothe rashes, calm irritation and keep skin comfortable.','Calamine based daily skin comfort support for prickly heat, sweat irritation and minor rashes. Helps absorb excess moisture while leaving skin fresh and calm all day long. Ideal for summer heat rashes and sensitive skin.','Soothes rashes and irritation|Absorbs excess moisture|Helps heal minor skin rashes|Keeps skin fresh and comfortable|Gentle enough for daily use','Apply gently on the affected area using a soft cloth or cotton pad. Use as needed. Avoid contact with eyes. Store in a cool dry place.','Quality checked and lab tested GLIMLACH wellness product. Safe for external use as directed.','calamine-powder-200g.jpg',100,'in_stock',4.8,156,1,1),
            (2,1,'GLIMLACH Calcium Magnesium Zinc with Vitamin D3 | 50 Tablets','glimlach-calcium-magnesium-zinc-vitamin-d3-50-tablets','GLM-CMZ-D3-50',339.00,339.00,199.00,'41% OFF','A daily mineral and Vitamin D3 supplement for bone, muscle and immune support.','A balanced calcium, magnesium, zinc and Vitamin D3 formula for men and women. Supports stronger bones, normal muscle function and everyday nutritional wellness. Each tablet delivers essential minerals in an easy-to-take format.','Bone strength support|Muscle function support|Immune system nutrition|Vitamin D3 for calcium absorption|Suitable for men and women','Take 1 tablet daily with water after a meal. Do not exceed the recommended daily dose. Store in a cool dry place away from sunlight.','Quality checked and lab tested GLIMLACH wellness product. Manufactured under GMP certified conditions.','calcium-magnesium-zinc-d3.jpg',100,'in_stock',4.8,203,1,1),
            (3,2,'GLIMLACH Glutathione Tablets 400mg with Vitamin C & Natural Extracts | 50 Tablets','glimlach-glutathione-tablets-400mg-vitamin-c','GLM-GLUTA-50',799.00,799.00,449.00,'43% OFF','Antioxidant and skin brightening support with Glutathione, Vitamin C and natural extracts.','Premium antioxidant tablets formulated with Glutathione and Vitamin C to support skin radiance, detox support and overall wellness from within. Contains 400mg of Glutathione per tablet along with natural botanical extracts for enhanced absorption.','Antioxidant skin support|Skin radiance from within|Vitamin C enriched formula|Detox wellness support|For men and women','Take 1 tablet daily with water in the morning on an empty stomach or as directed. Best results with consistent daily use.','Quality checked and lab tested GLIMLACH wellness product. GMP manufactured.','glutathione-vitamin-c-50-tablets.jpg',100,'in_stock',4.8,312,1,1),
            (4,1,'GLIMLACH L Arginine 1500mg Tablets | 120 Tablets','glimlach-l-arginine-1500mg-120-tablets','GLM-ARGININE-120',1999.00,1999.00,599.00,'70% OFF','Dietary supplement for active men and women, formulated with L-Arginine 1500mg.','L-Arginine is a popular amino acid supplement that supports active lifestyle, blood flow wellness and exercise nutrition. This 120 tablet pack provides great value for daily supplementation.','Active lifestyle support|Amino acid nutrition|Pre-workout wellness support|Blood flow nutrition|120 tablet value pack','Take 2 tablets daily 30 minutes before exercise with water. On rest days take 1 tablet in the morning. Store in a cool dry place.','Quality checked and lab tested GLIMLACH wellness product. GMP manufactured.','l-arginine-1500mg-120-tablets.jpg',100,'in_stock',4.8,189,1,1),
            (5,1,'GLIMLACH L-Glutamine 500mg Tablets | 50 Tablets','glimlach-l-glutamine-500mg-50-tablets','GLM-GLUTAMINE-50',799.00,799.00,395.00,'50% OFF','Supports immunity, muscle function and recovery nutrition for everyday wellness.','L-Glutamine tablets are designed for people with active routines who want convenient amino acid nutrition and daily muscle support. L-Glutamine is the most abundant amino acid in the body and plays a key role in muscle recovery and immune function.','Muscle function support|Recovery nutrition after exercise|Immune system wellness|Essential amino acid nutrition|Easy tablet format','Take 1-2 tablets daily with water. Best taken post-workout or before bedtime. Store in a cool dry place.','Quality checked and lab tested GLIMLACH wellness product. GMP manufactured.','l-glutamine-500mg-50-tablets.jpg',100,'in_stock',4.8,145,1,1),
            (6,1,'GLIMLACH L-Theanine 50 Capsules | Stress & Relaxation Support','glimlach-l-theanine-50-capsules','GLM-THEANINE-50',1999.00,1999.00,280.00,'85% OFF','Promotes calm focus, relaxation and daily stress support.','L-Theanine capsules are formulated to support natural relaxation, calm focus and everyday mental wellness. L-Theanine is a naturally occurring amino acid found in green tea that promotes a calm focused state of mind.','Calm focus support|Natural stress relief|Relaxation without drowsiness|Mental wellness support|50 capsule pack','Take 1 capsule daily with water preferably in the evening or before bed. Can be taken with or without food.','Quality checked and lab tested GLIMLACH wellness product. GMP manufactured.','l-theanine-50-capsules.jpg',100,'in_stock',4.8,267,1,1),
            (7,2,'GLIMLACH Magnesium Oil for Feet, Sleep Support, Pain Relief & Muscle Recovery 100ml','glimlach-magnesium-oil-100ml','GLM-MAG-OIL-100',749.00,749.00,249.00,'66% OFF','Topical magnesium oil for feet, sleep support, muscle recovery and relaxation.','A convenient topical magnesium spray for daily relaxation routines. Ideal for foot application, post-workout care and soothing muscle massage. Transdermal magnesium is absorbed directly through the skin for fast-acting wellness support.','Sleep routine support|Muscle recovery massage|Soothing pain relief|Topical magnesium absorption|Relaxation and calm support','Apply 5-10 sprays to the soles of your feet or affected area. Massage gently until absorbed. Best used at night before sleep. Rinse after 20 minutes if skin feels tingly.','Quality checked and lab tested GLIMLACH wellness product. Dermatologist approved. External use only.','magnesium-oil-100ml.jpg',100,'in_stock',4.9,421,1,1),
            (8,2,'GLIMLACH Marine Collagen Supplements Orange Flavour 200g','glimlach-marine-collagen-orange-flavour-200g','GLM-COLLAGEN-200',1099.00,1099.00,499.00,'54% OFF','Hydrolyzed marine collagen powder with amino acids for skin, hair, nails, bone and joint support.','Orange flavoured marine collagen supplement designed for beauty and wellness from within. Supports healthy skin, hair, nails, bones and joints. Our hydrolyzed collagen peptides are easily absorbed by the body for maximum benefit.','Skin hydration and glow support|Stronger hair and nails|Bone and joint wellness|Hydrolyzed peptides for easy absorption|Delicious orange flavour','Mix 1 scoop in 200ml water or juice. Stir well and drink daily. Best taken in the morning on an empty stomach. Can also be added to smoothies.','Quality checked and lab tested GLIMLACH wellness product. GMP manufactured.','marine-collagen-orange-200g.jpg',100,'in_stock',4.8,298,1,1),
            (9,1,'GLIMLACH Multivitamins For Men with Zinc, Vitamin C, Vitamin D3, Multiminerals & Ginseng | 50 Tablets','glimlach-multivitamins-for-men-50-tablets','GLM-MVM-MEN-50',499.00,499.00,295.00,'40% OFF','Daily multivitamin support for men with key vitamins, minerals and ginseng extract.','A complete multivitamin and multimineral tablet for men to support energy, stamina, immunity and daily nutritional balance. Fortified with Korean Ginseng extract for additional vitality and endurance support.','Daily energy and stamina support|Immunity and wellness nutrition|Zinc for testosterone support|Vitamin D3 and C for immunity|Ginseng extract for vitality','Take 1 tablet daily with water after breakfast. Do not exceed recommended dose. Store in a cool dry place away from children.','Quality checked and lab tested GLIMLACH wellness product. GMP manufactured.','multivitamins-men-50-tablets.jpg',100,'in_stock',4.8,534,1,1),
            (10,1,'GLIMLACH Multivitamins For Teenagers with Zinc, Vitamin C, Vitamin D3 & Multiminerals | 50 Tablets','glimlach-multivitamins-for-teenagers-50-tablets','GLM-MVT-TEEN-50',499.00,499.00,295.00,'40% OFF','Daily multivitamin tablets for teenagers to support energy, stamina and immunity.','A teenager-friendly multivitamin and multimineral supplement with Vitamin C, Vitamin D3 and zinc to support active growth years. Specially formulated to meet the nutritional needs of growing teenagers aged 13-19.','Teen energy and stamina support|Growing years nutritional support|Zinc Vitamin C and D3|Strong immunity for active teens|50 tablet pack','Take 1 tablet daily with water after a meal. Suitable for teenagers aged 13-19. Do not exceed recommended dose.','Quality checked and lab tested GLIMLACH wellness product. GMP manufactured.','multivitamins-teenagers-50-tablets.jpg',100,'in_stock',4.8,178,1,1)");

        $this->pdo->exec("INSERT IGNORE INTO hero_slides (id,badge,title,subtitle,price,discount,image,media_type,media_url,button_text,button_link,display_order,is_active) VALUES
            (1,'GLIMLACH','Wellness Starts with GLIMLACH','Relieve tension and stay energized daily.',249.00,'40% OFF','assets/images/banners/glimlach-hero-1.svg','image','assets/images/banners/glimlach-hero-1.svg','SHOP NOW','products.php',1,1),
            (2,'Best Sellers','Daily Nutrition Made Simple','Vitamins, minerals and recovery support for every routine.',199.00,'41% OFF','assets/images/banners/glimlach-hero-2.svg','image','assets/images/banners/glimlach-hero-2.svg','VIEW PRODUCTS','products.php',2,1),
            (3,'New Arrival','Skin & Wellness Care','Premium skincare and nutrition products for radiant health.',249.00,'43% OFF','assets/images/banners/glimlach-hero-3.svg','image','assets/images/banners/glimlach-hero-3.svg','SHOP NOW','products.php',3,1)");

        $this->pdo->exec("INSERT IGNORE INTO product_media (product_id,media_type,media_url,sort_order) VALUES
            (1,'image','calamine-powder-200g.jpg',1),(2,'image','calcium-magnesium-zinc-d3.jpg',1),(3,'image','glutathione-vitamin-c-50-tablets.jpg',1),(4,'image','l-arginine-1500mg-120-tablets.jpg',1),(5,'image','l-glutamine-500mg-50-tablets.jpg',1),(6,'image','l-theanine-50-capsules.jpg',1),(7,'image','magnesium-oil-100ml.jpg',1),(8,'image','marine-collagen-orange-200g.jpg',1),(9,'image','multivitamins-men-50-tablets.jpg',1),(10,'image','multivitamins-teenagers-50-tablets.jpg',1)");

        $this->pdo->exec("INSERT IGNORE INTO reviews (id,product_id,user_name,rating,review_text) VALUES
            (1,7,'Riya Sharma',5,'This magnesium oil is absolutely amazing! I apply it on my feet every night and sleep so much better. My muscle cramps have reduced a lot. Highly recommend!'),
            (2,9,'Amit Kumar',5,'Great multivitamin for daily use. I have been taking it for 3 months and feel much more energetic. Good value for money from GLIMLACH.'),
            (3,3,'Priya Singh',5,'The glutathione tablets have helped with my skin glow. I take one daily and see visible improvement in my complexion after just 4 weeks.')");

        $this->pdo->exec("INSERT IGNORE INTO stories (id,name,story_text,rating,image_path) VALUES
            (1,'Neha','GLIMLACH products fit perfectly into my daily wellness routine. I use the magnesium oil every night and the multivitamins every morning. My energy levels have never been better!',5,'story-neha.png'),
            (2,'Rohit','The nutrition range is easy to understand and affordable. GLIMLACH has the best quality at the best price in India. I recommend it to all my gym friends.',5,'story-rohit.png'),
            (3,'Priya','I started using GLIMLACH Glutathione tablets 2 months ago and my skin looks radiant now. Totally worth every rupee!',5,'story-priya.png')");

        $this->pdo->exec("INSERT IGNORE INTO settings (`key`,value,description) VALUES
            ('site_name','GLIMLACH','Website Name'),
            ('global_offer_percent','10','Default offer display percent'),
            ('UPI_ID','9953835017@ybl','UPI Payment ID'),
            ('UPI_HOLDER_NAME','GLIMLACH','UPI Holder Name'),
            ('free_shipping_above','300','Free shipping threshold in rupees'),
            ('shipping_fee','50','Flat shipping fee in rupees'),
            ('currency','₹','Currency symbol'),
            ('tagline','Wellness Starts with GLIMLACH','Site tagline'),
            ('contact_phone','+91 8958489684','Contact phone number'),
            ('contact_email','support@glimlach.in','Contact email address'),
            ('reward_redeem_rate','1','Reward coin redeem rate')");

        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT IGNORE INTO admins (id, username, password_hash, email, is_active) VALUES (1, 'admin', ?, 'admin@glimlach.in', 1)");
        $stmt->execute([$hash]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}

function db() {
    return Database::getInstance()->getConnection();
}
?>
