<?php
require_once __DIR__ . '/BaseDao.php';

class CartItemDao extends BaseDao {
    public function __construct() {
        parent::__construct('cart_items', ['user_id', 'product_id', 'quantity']);
    }

    public function get_cart_by_user($user_id) {
        return $this->query(
            "SELECT ci.*, p.name, p.price, p.image_url 
             FROM cart_items ci 
             JOIN products p ON p.id = ci.product_id 
             WHERE ci.user_id = :user_id", 
            ['user_id' => $user_id]
        );
    }
}