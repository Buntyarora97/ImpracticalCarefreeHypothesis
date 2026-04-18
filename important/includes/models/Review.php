<?php
require_once __DIR__ . '/../database.php';

class Review {

    public static function getAll() {
        try {
            $sql = "
                SELECT r.*, p.name AS product_name
                FROM reviews r
                LEFT JOIN products p ON r.product_id = p.id
                ORDER BY r.created_at DESC
            ";
            return db()->query($sql)->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Review::getAll error: " . $e->getMessage());
            return [];
        }
    }

    public static function create($data) {
        try {
            $stmt = db()->prepare("
                INSERT INTO reviews
                (product_id, user_name, rating, review_text, created_at)
                VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)
            ");

            return $stmt->execute([
                $data['product_id'],
                $data['name'] ?? 'Customer',
                $data['rating'],
                $data['comment'] ?? $data['review_text'] ?? ''
            ]);

        } catch (PDOException $e) {
            error_log("Review::create error: " . $e->getMessage());
            return false;
        }
    }

    public static function getByProduct($productId) {
        try {
            $stmt = db()->prepare("
                SELECT *
                FROM reviews
                WHERE product_id = ?
                ORDER BY created_at DESC
            ");
            $stmt->execute([$productId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Review::getByProduct error: " . $e->getMessage());
            return [];
        }
    }
}
