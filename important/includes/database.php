<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $db_url = getenv('DATABASE_URL');
            if ($db_url) {
                $db_url = str_replace('postgres://', 'postgresql://', $db_url);
                $db_parts = parse_url($db_url);
                $dsn = "pgsql:host={$db_parts['host']};port=" . ($db_parts['port'] ?? 5432) . ";dbname=" . ltrim($db_parts['path'], '/');
                $username = $db_parts['user'];
                $password = $db_parts['pass'];
                $driver_options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $this->pdo = new PDO($dsn, $username, $password, $driver_options);
                $this->initializePostgresDatabase();
            } else {
                $sqlitePath = __DIR__ . '/../data/glimlach_local.sqlite';
                if (!is_dir(dirname($sqlitePath))) {
                    mkdir(dirname($sqlitePath), 0755, true);
                }
                $this->pdo = new PDO('sqlite:' . $sqlitePath);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->initializeLocalDatabase();
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    private function initializePostgresDatabase() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS categories (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL UNIQUE,
            description TEXT,
            image VARCHAR(255) DEFAULT NULL,
            video VARCHAR(255) DEFAULT NULL,
            icon_class VARCHAR(100) DEFAULT 'fa-leaf',
            icon_upload VARCHAR(255) DEFAULT NULL,
            sort_order INTEGER DEFAULT 0,
            is_active INTEGER DEFAULT 1,
            show_on_mobile_top_slider INTEGER DEFAULT 1,
            show_on_mobile_concern INTEGER DEFAULT 1,
            show_on_desktop_concern INTEGER DEFAULT 1,
            show_in_top_menu INTEGER DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS products (
            id SERIAL PRIMARY KEY,
            category_id INTEGER DEFAULT NULL,
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
            stock_qty INTEGER DEFAULT 100,
            stock_status VARCHAR(50) DEFAULT 'in_stock',
            rating DECIMAL(3,2) DEFAULT 4.80,
            reviews_count INTEGER DEFAULT 0,
            reward_coins INTEGER DEFAULT 0,
            is_featured INTEGER DEFAULT 1,
            is_active INTEGER DEFAULT 1,
            weight_kg DECIMAL(6,2) DEFAULT 0.50,
            length_cm DECIMAL(6,2) DEFAULT 15.00,
            width_cm DECIMAL(6,2) DEFAULT 10.00,
            height_cm DECIMAL(6,2) DEFAULT 8.00,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS product_media (
            id SERIAL PRIMARY KEY,
            product_id INTEGER NOT NULL,
            media_type VARCHAR(50) DEFAULT 'image',
            media_url VARCHAR(255) NOT NULL,
            sort_order INTEGER DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
            id SERIAL PRIMARY KEY,
            product_id INTEGER DEFAULT NULL,
            user_name VARCHAR(255) DEFAULT NULL,
            rating INTEGER DEFAULT 5,
            review_text TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS hero_slides (
            id SERIAL PRIMARY KEY,
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
            display_order INTEGER DEFAULT 0,
            is_active INTEGER DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS stories (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) DEFAULT NULL,
            story_text TEXT,
            rating INTEGER DEFAULT 5,
            image_path VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reels (
            id SERIAL PRIMARY KEY,
            product_id INTEGER DEFAULT NULL,
            video VARCHAR(255) DEFAULT NULL,
            views INTEGER DEFAULT 0,
            is_active INTEGER DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS settings (
            id SERIAL PRIMARY KEY,
            key VARCHAR(100) NOT NULL UNIQUE,
            value TEXT,
            description VARCHAR(255) DEFAULT NULL
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS orders (
            id SERIAL PRIMARY KEY,
            order_number VARCHAR(100) DEFAULT NULL,
            user_id INTEGER DEFAULT NULL,
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
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
            id SERIAL PRIMARY KEY,
            order_id INTEGER NOT NULL,
            product_id INTEGER DEFAULT NULL,
            product_name VARCHAR(255) DEFAULT NULL,
            quantity INTEGER DEFAULT 1,
            price DECIMAL(10,2) DEFAULT 0.00,
            total DECIMAL(10,2) DEFAULT 0.00,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL UNIQUE,
            phone VARCHAR(20) DEFAULT NULL,
            password_hash VARCHAR(255) DEFAULT NULL,
            address TEXT DEFAULT NULL,
            city VARCHAR(100) DEFAULT NULL,
            state VARCHAR(100) DEFAULT NULL,
            pincode VARCHAR(20) DEFAULT NULL,
            is_active INTEGER DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS admins (
            id SERIAL PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            email VARCHAR(255) DEFAULT NULL,
            is_active INTEGER DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS promo_codes (
            id SERIAL PRIMARY KEY,
            code VARCHAR(50) NOT NULL UNIQUE,
            discount_type VARCHAR(20) DEFAULT 'percent',
            discount_value DECIMAL(10,2) DEFAULT 0.00,
            min_order DECIMAL(10,2) DEFAULT 0.00,
            max_uses INTEGER DEFAULT NULL,
            used_count INTEGER DEFAULT 0,
            is_active INTEGER DEFAULT 1,
            expires_at TIMESTAMP DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS contact_inquiries (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL,
            phone VARCHAR(20) DEFAULT NULL,
            message TEXT DEFAULT NULL,
            status VARCHAR(50) DEFAULT 'new',
            handled_by INTEGER DEFAULT NULL,
            handled_at TIMESTAMP DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS video_popups (
            id SERIAL PRIMARY KEY,
            title TEXT,
            video_url VARCHAR(255) DEFAULT NULL,
            is_active INTEGER DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS promo_codes (
            id SERIAL PRIMARY KEY,
            code VARCHAR(50) NOT NULL UNIQUE,
            influencer_name VARCHAR(100) DEFAULT NULL,
            influencer_email VARCHAR(255) DEFAULT NULL,
            discount_type VARCHAR(20) DEFAULT 'percentage',
            discount_value DECIMAL(10,2) DEFAULT 0,
            max_discount DECIMAL(10,2) DEFAULT 0,
            min_order_amount DECIMAL(10,2) DEFAULT 0,
            usage_limit INTEGER DEFAULT 0,
            used_count INTEGER DEFAULT 0,
            commission_type VARCHAR(20) DEFAULT 'percentage',
            commission_value DECIMAL(10,2) DEFAULT 0,
            expiry_date DATE DEFAULT NULL,
            is_active INTEGER DEFAULT 1,
            notes TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS promo_code_usage (
            id SERIAL PRIMARY KEY,
            promo_code_id INTEGER NOT NULL,
            order_id INTEGER NOT NULL,
            order_number VARCHAR(50) NOT NULL,
            customer_name VARCHAR(255) DEFAULT NULL,
            customer_phone VARCHAR(20) DEFAULT NULL,
            order_total DECIMAL(10,2) DEFAULT 0,
            discount_given DECIMAL(10,2) DEFAULT 0,
            commission_earned DECIMAL(10,2) DEFAULT 0,
            used_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS pincodes (
            id SERIAL PRIMARY KEY,
            pincode VARCHAR(10) NOT NULL UNIQUE,
            delivery_days INTEGER DEFAULT 3,
            is_serviceable INTEGER DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $count = (int)$this->pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
        if ($count === 0) {
            $this->seedPostgresData();
        }

        $adminCount = (int)$this->pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
        if ($adminCount === 0) {
            $hash = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO admins (username, password_hash, email) VALUES (?, ?, ?)");
            $stmt->execute(['admin', $hash, 'admin@glimlach.in']);
        }
    }

    private function seedPostgresData() {
        $this->pdo->exec("INSERT INTO categories (id,name,slug,description,icon_class,icon_upload,sort_order,is_active,show_on_mobile_top_slider,show_on_mobile_concern,show_on_desktop_concern) VALUES
            (1,'Health & Nutrition','health-nutrition','Premium supplements and everyday nutrition support','fa-capsules','health-nutrition.svg',1,1,1,1,1),
            (2,'Women''s Wellness & Care','womens-wellness-care','Essential health, beauty and wellness products designed for women''s lifestyle needs','fa-spa','women-wellness.svg',2,1,1,1,1),
            (3,'Personal Care','personal-care','Skin, body and daily personal care essentials','fa-pump-soap','personal-care.svg',3,1,1,1,1)
        ON CONFLICT (id) DO NOTHING");

        $this->pdo->exec("SELECT setval('categories_id_seq', (SELECT MAX(id) FROM categories))");

        $this->pdo->exec("INSERT INTO products (id,category_id,name,slug,sku,price,mrp,offer_price,offer_label,short_description,long_description,benefits,usage_instructions,testing_info,image,stock_qty,stock_status,rating,reviews_count,is_featured,is_active) VALUES
            (1,1,'GLIMLACH Calamine Powder for Skin Care Effectively Heals Rashes, Soothes Skin 200g','glimlach-calamine-powder-skin-care','GLM-CAL-200',399.00,399.00,249.00,'37% OFF','A gentle skin care powder designed to soothe rashes, calm irritation and keep skin comfortable.','Calamine based daily skin comfort support for prickly heat, sweat irritation and minor rashes. Helps absorb excess moisture while leaving skin fresh and calm.','Soothes rashes|Helps calm irritated skin|Absorbs excess moisture|Daily summer skin care','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','calamine-powder-200g.jpg',100,'in_stock',4.8,24,1,1),
            (2,1,'GLIMLACH Calcium Magnesium Zinc with Vitamin D3 | 50 Tablets','glimlach-calcium-magnesium-zinc-vitamin-d3-50-tablets','GLM-CMZ-D3-50',339.00,339.00,199.00,'41% OFF','A daily mineral and Vitamin D3 supplement for bone, muscle and immune support.','A balanced calcium, magnesium, zinc and Vitamin D3 formula for men and women. Supports stronger bones, normal muscle function and everyday nutritional wellness.','Bone strength support|Muscle function support|Vitamin D3 nutrition|For men and women','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','calcium-magnesium-zinc-d3.jpg',100,'in_stock',4.8,24,1,1),
            (3,1,'GLIMLACH Glutathione Tablets 400mg with Vitamin C & Natural Extracts | 50 Tablets','glimlach-glutathione-tablets-400mg-vitamin-c','GLM-GLUTA-50',799.00,799.00,449.00,'43% OFF','Antioxidant and skin brightening support with Glutathione, Vitamin C and natural extracts.','Premium antioxidant tablets formulated with Glutathione and Vitamin C to support skin radiance, detox support and overall wellness from within.','Antioxidant support|Skin radiance support|Vitamin C enriched|For men and women','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','glutathione-vitamin-c-50-tablets.jpg',100,'in_stock',4.8,24,1,1),
            (4,1,'GLIMLACH L Arginine 1500mg Tablets | 120 Tablets','glimlach-l-arginine-1500mg-120-tablets','GLM-ARGININE-120',1999.00,1999.00,599.00,'70% OFF','Dietary supplement for active men and women, formulated with L-Arginine 1500mg.','L-Arginine is a popular amino acid supplement that supports active lifestyle, blood flow wellness and exercise nutrition when used as directed.','Active lifestyle support|Amino acid nutrition|Workout wellness|120 tablets pack','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','l-arginine-1500mg-120-tablets.jpg',100,'in_stock',4.8,24,1,1),
            (5,1,'GLIMLACH L-Glutamine 500mg Tablets | 50 Tablets','glimlach-l-glutamine-500mg-50-tablets','GLM-GLUTAMINE-50',799.00,799.00,395.00,'50% OFF','Supports immunity, muscle function and recovery nutrition for everyday wellness.','L-Glutamine tablets are designed for people with active routines who want convenient amino acid nutrition and daily muscle support.','Muscle function support|Recovery nutrition|Immune wellness|Easy tablet format','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','l-glutamine-500mg-50-tablets.jpg',100,'in_stock',4.8,24,1,1),
            (6,1,'GLIMLACH L-Theanine 50 Capsules | Stress & Relaxation Support','glimlach-l-theanine-50-capsules','GLM-THEANINE-50',1999.00,1999.00,280.00,'85% OFF','Promotes calm focus, relaxation and daily stress support.','L-Theanine capsules are formulated to support natural relaxation, calm focus and everyday mental wellness without complicated routines.','Stress support|Relaxation support|Calm focus|50 capsules','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','l-theanine-50-capsules.jpg',100,'in_stock',4.8,24,1,1),
            (7,2,'GLIMLACH Magnesium Oil for Feet, Sleep Support, Pain Relief & Muscle Recovery 100ml','glimlach-magnesium-oil-100ml','GLM-MAG-OIL-100',749.00,749.00,249.00,'66% OFF','Topical magnesium oil for feet, sleep support, muscle recovery and relaxation.','A convenient topical magnesium spray/oil for daily relaxation routines. Ideal for foot application, post-workout care and soothing muscle massage.','Sleep routine support|Muscle recovery massage|Pain relief support|Topical magnesium care','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','magnesium-oil-100ml.jpg',100,'in_stock',4.8,24,1,1),
            (8,1,'GLIMLACH Marine Collagen Supplements Orange Flavour 200g','glimlach-marine-collagen-orange-flavour-200g','GLM-COLLAGEN-200',1099.00,1099.00,499.00,'54% OFF','Hydrolyzed marine collagen powder with amino acids for skin, hair, nails, bone and joint support.','Orange flavoured marine collagen supplement designed for beauty and wellness from within. Supports healthy skin, hair, nails, bones and joints.','Skin hair nail support|Hydrolyzed collagen|Bone and joint wellness|Orange flavour','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','marine-collagen-orange-200g.jpg',100,'in_stock',4.8,24,1,1),
            (9,1,'GLIMLACH Multivitamins For Men with Zinc, Vitamin C, Vitamin D3, Multiminerals & Ginseng | 50 Tablets','glimlach-multivitamins-for-men-50-tablets','GLM-MVM-MEN-50',499.00,499.00,295.00,'40% OFF','Daily multivitamin support for men with key vitamins, minerals and ginseng extract.','A complete multivitamin and multimineral tablet for men to support energy, stamina, immunity and daily nutritional balance.','Energy support|Immunity support|Zinc and Vitamin C|Ginseng extract','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','multivitamins-men-50-tablets.jpg',100,'in_stock',4.8,24,1,1),
            (10,1,'GLIMLACH Multivitamins For Teenagers with Zinc, Vitamin C, Vitamin D3 & Multiminerals | 50 Tablets','glimlach-multivitamins-for-teenagers-50-tablets','GLM-MVT-TEEN-50',499.00,499.00,295.00,'40% OFF','Daily multivitamin tablets for teenagers to support energy, stamina and immunity.','A teenager-friendly multivitamin and multimineral supplement with Vitamin C, Vitamin D3 and zinc to support active growth years.','Teen nutrition support|Energy and stamina|Immunity support|50 tablets','Use as directed on the label. Store in a cool, dry place.','Quality checked GLIMLACH wellness product.','multivitamins-teenagers-50-tablets.jpg',100,'in_stock',4.8,24,1,1)
        ON CONFLICT (id) DO NOTHING");

        $this->pdo->exec("SELECT setval('products_id_seq', (SELECT MAX(id) FROM products))");

        $this->pdo->exec("INSERT INTO hero_slides (id,badge,title,subtitle,price,image,media_type,media_url,button_text,button_link,display_order,is_active) VALUES
            (1,'Featured','Wellness Starts with GLIMLACH','Relieve tension and stay energized daily.',249.00,'assets/images/banners/glimlach-hero-1.svg','image','assets/images/banners/glimlach-hero-1.svg','SHOP NOW','products.php',1,1),
            (2,'Best Sellers','Daily Nutrition Made Simple','Premium health and nutrition products for everyday wellness.',199.00,'assets/images/banners/glimlach-hero-2.svg','image','assets/images/banners/glimlach-hero-2.svg','VIEW PRODUCTS','products.php',2,1)
        ON CONFLICT (id) DO NOTHING");

        $this->pdo->exec("SELECT setval('hero_slides_id_seq', (SELECT MAX(id) FROM hero_slides))");

        $this->pdo->exec("INSERT INTO product_media (product_id,media_type,media_url,sort_order) VALUES
            (1,'image','calamine-powder-200g.jpg',1),
            (2,'image','calcium-magnesium-zinc-d3.jpg',1),
            (3,'image','glutathione-vitamin-c-50-tablets.jpg',1),
            (4,'image','l-arginine-1500mg-120-tablets.jpg',1),
            (5,'image','l-glutamine-500mg-50-tablets.jpg',1),
            (6,'image','l-theanine-50-capsules.jpg',1),
            (7,'image','magnesium-oil-100ml.jpg',1),
            (8,'image','marine-collagen-orange-200g.jpg',1),
            (9,'image','multivitamins-men-50-tablets.jpg',1),
            (10,'image','multivitamins-teenagers-50-tablets.jpg',1)");

        $this->pdo->exec("INSERT INTO reviews (product_id,user_name,rating,review_text) VALUES
            (7,'Aarav',5,'Magnesium Oil is now part of my night routine.'),
            (9,'Rohit',5,'Good daily multivitamin with simple pricing.'),
            (3,'Priya',5,'Great antioxidant support and easy to use.')");

        $this->pdo->exec("INSERT INTO stories (name,story_text,rating,image_path) VALUES
            ('Neha','GLIMLACH products fit perfectly into my daily wellness routine.',5,'story-1.svg'),
            ('Rohit','The nutrition range is easy to understand and affordable.',5,'story-2.svg')");

        $this->pdo->exec("INSERT INTO settings (key,value,description) VALUES
            ('site_name','GLIMLACH','Website Name'),
            ('global_offer_percent','10','Default offer display'),
            ('UPI_HOLDER_NAME','GLIMLACH','UPI holder name')
        ON CONFLICT (key) DO NOTHING");
    }

    private function initializeLocalDatabase() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS categories (id INTEGER PRIMARY KEY, name TEXT, slug TEXT UNIQUE, description TEXT, image TEXT, video TEXT, icon_class TEXT, icon_upload TEXT, sort_order INTEGER DEFAULT 0, is_active INTEGER DEFAULT 1, show_on_mobile_top_slider INTEGER DEFAULT 1, show_on_mobile_concern INTEGER DEFAULT 1, show_on_desktop_concern INTEGER DEFAULT 1, show_in_top_menu INTEGER DEFAULT 1, created_at TEXT DEFAULT CURRENT_TIMESTAMP, updated_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS products (id INTEGER PRIMARY KEY, category_id INTEGER, name TEXT, slug TEXT UNIQUE, sku TEXT, price REAL, mrp REAL, offer_price REAL DEFAULT 0, offer_label TEXT, short_description TEXT, long_description TEXT, benefits TEXT, usage_instructions TEXT, testing_info TEXT, image TEXT, video TEXT, stock_qty INTEGER DEFAULT 100, stock_status TEXT DEFAULT 'in_stock', rating REAL DEFAULT 4.8, reviews_count INTEGER DEFAULT 0, reward_coins INTEGER DEFAULT 0, is_featured INTEGER DEFAULT 1, is_active INTEGER DEFAULT 1, weight_kg REAL DEFAULT 0.5, length_cm REAL DEFAULT 15, width_cm REAL DEFAULT 10, height_cm REAL DEFAULT 8, created_at TEXT DEFAULT CURRENT_TIMESTAMP, updated_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS product_media (id INTEGER PRIMARY KEY, product_id INTEGER, media_type TEXT DEFAULT 'image', media_url TEXT, sort_order INTEGER DEFAULT 0, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reviews (id INTEGER PRIMARY KEY, product_id INTEGER, user_name TEXT, rating INTEGER DEFAULT 5, review_text TEXT, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS hero_slides (id INTEGER PRIMARY KEY, badge TEXT, title TEXT, subtitle TEXT, price REAL, discount TEXT, image TEXT, media_type TEXT DEFAULT 'image', media_url TEXT, video_url TEXT, button_text TEXT DEFAULT 'SHOP NOW', button_link TEXT DEFAULT 'products.php', display_order INTEGER DEFAULT 0, is_active INTEGER DEFAULT 1, created_at TEXT DEFAULT CURRENT_TIMESTAMP, updated_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS stories (id INTEGER PRIMARY KEY, name TEXT, story_text TEXT, rating INTEGER DEFAULT 5, image_path TEXT, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reels (id INTEGER PRIMARY KEY, product_id INTEGER, video TEXT, views INTEGER DEFAULT 0, is_active INTEGER DEFAULT 0, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS settings (id INTEGER PRIMARY KEY, key TEXT UNIQUE, value TEXT, description TEXT)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS video_popups (id INTEGER PRIMARY KEY, title TEXT, video_url TEXT, is_active INTEGER DEFAULT 0, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS orders (id INTEGER PRIMARY KEY, order_number TEXT, user_id INTEGER, customer_name TEXT, customer_email TEXT, customer_phone TEXT, shipping_address TEXT, city TEXT, state TEXT, pincode TEXT, subtotal REAL DEFAULT 0, shipping_fee REAL DEFAULT 0, discount_amount REAL DEFAULT 0, total_amount REAL DEFAULT 0, payment_method TEXT, payment_status TEXT DEFAULT 'pending', order_status TEXT DEFAULT 'pending', promo_code TEXT, notes TEXT, payment_id TEXT, bank_ref TEXT, payment_response TEXT, transaction_id TEXT, shiprocket_order_id TEXT, shiprocket_shipment_id TEXT, awb_code TEXT, created_at TEXT DEFAULT CURRENT_TIMESTAMP, updated_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS order_items (id INTEGER PRIMARY KEY, order_id INTEGER, product_id INTEGER, product_name TEXT, quantity INTEGER DEFAULT 1, price REAL DEFAULT 0, total REAL DEFAULT 0, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT, email TEXT UNIQUE, phone TEXT, password_hash TEXT, address TEXT, city TEXT, state TEXT, pincode TEXT, is_active INTEGER DEFAULT 1, created_at TEXT DEFAULT CURRENT_TIMESTAMP, updated_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS admins (id INTEGER PRIMARY KEY, username TEXT UNIQUE, password_hash TEXT, email TEXT, is_active INTEGER DEFAULT 1, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS promo_codes (id INTEGER PRIMARY KEY, code TEXT UNIQUE, discount_type TEXT DEFAULT 'percent', discount_value REAL DEFAULT 0, min_order REAL DEFAULT 0, max_uses INTEGER, used_count INTEGER DEFAULT 0, is_active INTEGER DEFAULT 1, expires_at TEXT, created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS contact_inquiries (id INTEGER PRIMARY KEY, name TEXT, email TEXT, phone TEXT, message TEXT, status TEXT DEFAULT 'new', created_at TEXT DEFAULT CURRENT_TIMESTAMP)");

        $count = (int)$this->pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
        if ($count === 0) {
            $this->seedLocalData();
        }

        $adminCount = (int)$this->pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
        if ($adminCount === 0) {
            $hash = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO admins (username, password_hash, email) VALUES (?, ?, ?)");
            $stmt->execute(['admin', $hash, 'admin@glimlach.in']);
        }
    }

    private function seedLocalData() {
        $this->pdo->exec("INSERT OR IGNORE INTO categories (id,name,slug,description,icon_class,icon_upload,sort_order,is_active,show_on_mobile_top_slider,show_on_mobile_concern,show_on_desktop_concern) VALUES
            (1,'Health & Nutrition','health-nutrition','Premium supplements and everyday nutrition support','fa-capsules','health-nutrition.svg',1,1,1,1,1),
            (2,'Women''s Wellness & Care','womens-wellness-care','Essential health, beauty and wellness products designed for women''s lifestyle needs','fa-spa','women-wellness.svg',2,1,1,1,1),
            (3,'Personal Care','personal-care','Skin, body and daily personal care essentials','fa-pump-soap','personal-care.svg',3,1,1,1,1)");

        $this->pdo->exec("INSERT OR IGNORE INTO products (id,category_id,name,slug,sku,price,mrp,offer_price,offer_label,short_description,long_description,benefits,usage_instructions,testing_info,image,stock_qty,stock_status,rating,reviews_count,is_featured,is_active) VALUES
            (1,1,'GLIMLACH Calamine Powder for Skin Care','glimlach-calamine-powder-skin-care','GLM-CAL-200',399.00,399.00,249.00,'37% OFF','A gentle skin care powder.','Calamine based daily skin comfort support.','Soothes rashes|Helps calm irritated skin','Use as directed.','Quality checked.','calamine-powder-200g.jpg',100,'in_stock',4.8,24,1,1),
            (2,1,'GLIMLACH Calcium Magnesium Zinc with Vitamin D3','glimlach-calcium-magnesium-zinc-vitamin-d3-50-tablets','GLM-CMZ-D3-50',339.00,339.00,199.00,'41% OFF','A daily mineral supplement.','Balanced formula for bone and muscle support.','Bone strength support|Muscle function support','Use as directed.','Quality checked.','calcium-magnesium-zinc-d3.jpg',100,'in_stock',4.8,24,1,1),
            (3,1,'GLIMLACH Glutathione Tablets 400mg','glimlach-glutathione-tablets-400mg-vitamin-c','GLM-GLUTA-50',799.00,799.00,449.00,'43% OFF','Antioxidant skin brightening support.','Premium antioxidant tablets with Vitamin C.','Antioxidant support|Skin radiance support','Use as directed.','Quality checked.','glutathione-vitamin-c-50-tablets.jpg',100,'in_stock',4.8,24,1,1)");

        $this->pdo->exec("INSERT OR IGNORE INTO hero_slides (id,badge,title,subtitle,price,image,media_type,media_url,button_text,button_link,display_order,is_active) VALUES
            (1,'Featured','Wellness Starts with GLIMLACH','Relieve tension and stay energized daily.',249.00,'assets/images/banners/glimlach-hero-1.svg','image','assets/images/banners/glimlach-hero-1.svg','SHOP NOW','products.php',1,1)");

        $this->pdo->exec("INSERT OR IGNORE INTO settings (key,value,description) VALUES
            ('site_name','GLIMLACH','Website Name'),
            ('global_offer_percent','10','Default offer display'),
            ('UPI_HOLDER_NAME','GLIMLACH','UPI holder name')");
    }

    public static function getInstance() {
        if (self::$instance === null) { self::$instance = new self(); }
        return self::$instance;
    }

    public function getConnection() { return $this->pdo; }
}

function db() { return Database::getInstance()->getConnection(); }
?>
