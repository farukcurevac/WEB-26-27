<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';
require_once __DIR__ . '/../dao/CartItemDao.php';
require_once __DIR__ . '/../dao/UserDao.php';

class OrderService extends BaseService
{
    protected $entity_name = 'Order';
    private $user_dao;
    private $cart_dao;
    private $order_item_dao;

    private const ALLOWED_STATUSES = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];

    public function __construct($dao = null, $user_dao = null, $cart_dao = null, $order_item_dao = null)
    {
        parent::__construct($dao ?? new OrderDao());
        $this->user_dao = $user_dao ?? new UserDao();
        $this->cart_dao = $cart_dao ?? new CartItemDao();
        $this->order_item_dao = $order_item_dao ?? new OrderItemDao();
    }

    public function get_orders_by_user($user_id)
    {
        if (!$this->user_dao->get_by_id($user_id)) {
            throw new NotFoundException("User not found.");
        }
        return $this->dao->get_orders_by_user($user_id);
    }

    public function add($order)
    {
        $order['status'] = $order['status'] ?? 'pending';
        return parent::add($order);
    }

    /**
     * Poslovno pravilo sa transakcijom (Lab 04 Korak 7):
     * Kreira narudžbu iz korisničke korpe, prebacuje stavke u order_items i prazni korpu.
     */
    public function checkout_from_cart($user_id, $shipping_address)
    {
        Validator::integer($user_id, 'user_id', 1);
        Validator::required(['shipping_address' => $shipping_address], ['shipping_address']);
        Validator::length($shipping_address, 'shipping_address', 5, 255);

        if (!$this->user_dao->get_by_id($user_id)) {
            throw new NotFoundException("User not found.");
        }

        $cart_items = $this->cart_dao->get_cart_by_user($user_id);
        if (empty($cart_items)) {
            throw new ValidationException("Cannot place an order with an empty cart.");
        }

        $total = 0;
        foreach ($cart_items as $item) {
            $total += (float) $item['price'] * (int) $item['quantity'];
        }

        $this->dao->begin_transaction();
        try {
            $order = $this->dao->add([
                'user_id' => $user_id,
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => trim($shipping_address)
            ]);

            foreach ($cart_items as $item) {
                $this->order_item_dao->add([
                    'order_id' => $order['id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price']
                ]);
            }

            $this->cart_dao->clear_user_cart($user_id);
            $this->dao->commit();
        } catch (Throwable $e) {
            $this->dao->rollback();
            throw $e;
        }

        return $this->dao->get_by_id($order['id']);
    }

    protected function validate($order, $id = null)
    {
        Validator::required($order, ['user_id', 'total_amount', 'shipping_address']);
        Validator::integer($order['user_id'], 'user_id', 1);
        Validator::numeric($order['total_amount'], 'total_amount', 0.01);
        Validator::length($order['shipping_address'], 'shipping_address', 5, 255);

        if (isset($order['status'])) {
            Validator::one_of($order['status'], 'status', self::ALLOWED_STATUSES);
        }

        if (!$this->user_dao->get_by_id($order['user_id'])) {
            throw new ValidationException("User does not exist.");
        }
    }
}