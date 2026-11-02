<?php
require_once __DIR__ . '/BaseDao.php';

class PaymentDao extends BaseDao {
    public function __construct() {
        parent::__construct('payments', ['order_id', 'amount', 'method', 'status', 'transaction_reference']);
    }

    public function get_payment_by_order($order_id) {
        return $this->query_unique("SELECT * FROM payments WHERE order_id = :order_id", ['order_id' => $order_id]);
    }
}