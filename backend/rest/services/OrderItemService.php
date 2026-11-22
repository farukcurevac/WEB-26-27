<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../dao/ProductDao.php';

class OrderItemService extends BaseService
{
    protected $entity_name = 'Order item';
    private $order_dao;
    private $product_dao;

    public function __construct($dao = null, $order_dao = null, $product_dao = null)
    {
        parent::__construct($dao ?? new OrderItemDao());
        $this->order_dao = $order_dao ?? new OrderDao();
        $this->product_dao = $product_dao ?? new ProductDao();
    }

    public function get_items_by_order($order_id)
    {
        if (!$this->order_dao->get_by_id($order_id)) {
            throw new NotFoundException("Order not found.");
        }
        return $this->dao->get_items_by_order($order_id);
    }

    protected function validate($item, $id = null)
    {
        Validator::required($item, ['order_id', 'product_id', 'quantity', 'unit_price']);
        Validator::integer($item['order_id'], 'order_id', 1);
        Validator::integer($item['product_id'], 'product_id', 1);
        Validator::integer($item['quantity'], 'quantity', 1);
        Validator::numeric($item['unit_price'], 'unit_price', 0.01);

        if (!$this->order_dao->get_by_id($item['order_id'])) {
            throw new ValidationException("Order does not exist.");
        }
        if (!$this->product_dao->get_by_id($item['product_id'])) {
            throw new ValidationException("Product does not exist.");
        }
    }
}