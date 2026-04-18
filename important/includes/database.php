<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            if (getenv('DATABASE_URL') && getenv('USE_POSTGRES_DATABASE')) {
                $db_url = getenv('DATABASE_URL');
                $db_url = str_replace('postgres://', 'postgresql://', $db_url);
                $db_parts = parse_url($db_url);
                $dsn = "pgsql:host={$db_parts['host']};port=" . ($db_parts['port'] ?? 5432) . ";dbname=" . ltrim($db_parts['path'], '/');
                $username = $db_parts['user'];
                $password = $db_parts['pass'];
                $driver_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false];
                $this->pdo = new PDO($dsn, $username, $password, $driver_options);
            } else {
                try {
                    $dsn = "mysql:host=localhost;dbname=u446139296_glimlach;charset=utf8mb4";
                    $username = "u446139296_glimlach";
                    $password = "Bunty@000@";
                    $driver_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"];
                    $this->pdo = new PDO($dsn, $username, $password, $driver_options);
                } catch (PDOException $mysqlError) {
                    $sqlitePath = __DIR__ . '/../data/glimlach_local.sqlite';
                    $this->pdo = new PDO('sqlite:' . $sqlitePath);
                    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    $this->initializeLocalDatabase();
                }
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
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
        $count = (int)$this->pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
        if ($count === 0) {
            $sql = file_get_contents(__DIR__ . '/../mysql_import.sql');
            $sql = preg_replace('/SET SQL_MODE.*?;|SET time_zone.*?;|START TRANSACTION;|COMMIT;/s', '', $sql);
            $sql = preg_replace('/DROP TABLE IF EXISTS `?[^;]+;/', '', $sql);
            $sql = preg_replace('/CREATE TABLE.*?ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;/s', '', $sql);
            $sql = str_replace('`', '', $sql);
            $this->pdo->exec($sql);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) { self::$instance = new self(); }
        return self::$instance;
    }

    public function getConnection() { return $this->pdo; }
}

function db() { return Database::getInstance()->getConnection(); }
?>
