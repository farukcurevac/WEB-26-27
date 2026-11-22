<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/PaymentDao.php';
require_once __DIR__ . '/../dao/OrderDao.php';

class PaymentService extends BaseService
{
    protected $entity_name = 'Payment';
    private $order_dao;

    private const ALLOWED_METHODS = ['credit_card', 'paypal', 'cash_on_delivery', 'bank_transfer'];
    private const ALLOWED_STATUSES = ['pending', 'completed', 'failed', 'refunded'];

    public function __construct($dao = null, $order_dao = null)
    {
        parent::__construct($dao ?? new PaymentDao());
        $this->order_dao = $order_dao ?? new OrderDao();
    }

    public function get_payment_by_order($order_id)
    {
        if (!$this->order_dao->get_by_id($order_id)) {
            throw new NotFoundException("Order not found.");
        }
        $payment = $this->dao->get_payment_by_order($order_id);
        if (!$payment) {
            throw new NotFoundException("Payment for this order not found.");
        }
        return $payment;
    }

    public function add($payment)
    {
        $payment['status'] = $payment['status'] ?? 'completed';
        $payment = $this->empty_to_null($payment, ['transaction_reference']);
        return parent::add($payment);
    }

    protected function validate($payment, $id = null)
    {
        Validator::required($payment, ['order_id', 'amount', 'method']);
        Validator::integer($payment['order_id'], 'order_id', 1);
        Validator::numeric($payment['amount'], 'amount', 0.01);
        Validator::one_of($payment['method'], 'method', self::ALLOWED_METHODS);

        if (isset($payment['status'])) {
            Validator::one_of($payment['status'], 'status', self::ALLOWED_STATUSES);
        }

        $order = $this->order_dao->get_by_id($payment['order_id']);
        if (!$order) {
            throw new ValidationException("Order does not exist.");
        }

        // Pravilo: Jedna narudžba može imati samo jedno plaćanje (UNIQUE order_id u bazi)
        $existing = $this->dao->get_payment_by_order($payment['order_id']);
        if ($existing && $existing['id'] != $id) {
            throw new ValidationException("A payment already exists for order #{$payment['order_id']}.");
        }
    }
}