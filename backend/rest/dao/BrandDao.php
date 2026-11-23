<?php
require_once __DIR__ . '/BaseDao.php';

class BrandDao extends BaseDao {
    public function __construct() {
        parent::__construct('brands', ['name', 'logo_url']);
    }

    public function get_by_name($name) {
        return $this->query_unique("SELECT * FROM brands WHERE LOWER(name) = LOWER(:name)", ['name' => $name]);
    }

    public function count_products($brand_id) {
        $row = $this->query_unique("SELECT COUNT(*) AS cnt FROM products WHERE brand_id = :brand_id", ['brand_id' => $brand_id]);
        return (int) ($row['cnt'] ?? 0);
    }
}