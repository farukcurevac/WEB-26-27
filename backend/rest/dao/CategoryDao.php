<?php
require_once __DIR__ . '/BaseDao.php';

class CategoryDao extends BaseDao {
    public function __construct() {
        parent::__construct('categories', ['name', 'description']);
    }

    public function get_by_name($name) {
        return $this->query_unique("SELECT * FROM categories WHERE LOWER(name) = LOWER(:name)", ['name' => $name]);
    }

    public function count_products($category_id) {
        $row = $this->query_unique("SELECT COUNT(*) AS cnt FROM products WHERE category_id = :category_id", ['category_id' => $category_id]);
        return (int) ($row['cnt'] ?? 0);
    }
}