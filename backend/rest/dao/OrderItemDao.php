<?php
require_once __DIR__ . '/BaseDao.php';

class OrderItemDao extends BaseDao {
    public function __construct() {
        parent::__construct('order_items', ['order_id', 'product_id', 'quantity', 'unit_price']);
    }

    public function get_items_by_order($order_id) {
        return $this->query(
            "SELECT oi.*, p.name 
             FROM order_items oi 
             JOIN products p ON p.id = oi.product_id 
             WHERE oi.order_id = :order_id", 
            ['order_id' => $order_id]
        );
    }
}