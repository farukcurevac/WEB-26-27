<?php
require_once __DIR__ . '/BaseDao.php';

class ProductDao extends BaseDao {
    public function __construct() {
        parent::__construct('products', ['brand_id', 'category_id', 'name', 'description', 'price', 'image_url', 'is_active']);
    }

    public function get_products_by_brand($brand_id) {
        return $this->query("SELECT * FROM products WHERE brand_id = :brand_id AND is_active = 1", ['brand_id' => $brand_id]);
    }

    public function get_products_by_category($category_id) {
        return $this->query("SELECT * FROM products WHERE category_id = :category_id AND is_active = 1", ['category_id' => $category_id]);
    }
}