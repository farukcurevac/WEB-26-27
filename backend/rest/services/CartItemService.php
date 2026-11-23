<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/CartItemDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/ProductDao.php';

class CartItemService extends BaseService
{
    protected $entity_name = 'Cart item';
    private $user_dao;
    private $product_dao;

    public function __construct($dao = null, $user_dao = null, $product_dao = null)
    {
        parent::__construct($dao ?? new CartItemDao());
        $this->user_dao = $user_dao ?? new UserDao();
        $this->product_dao = $product_dao ?? new ProductDao();
    }

    public function get_cart_by_user($user_id)
    {
        if (!$this->user_dao->get_by_id($user_id)) {
            throw new NotFoundException("User not found.");
        }
        return $this->dao->get_cart_by_user($user_id);
    }

    public function add($item)
    {
        $item['quantity'] = $item['quantity'] ?? 1;
        $this->validate($item);

        // Ako patika već postoji u korpi tog korisnika, samo saberi količinu
        $existing = $this->dao->get_by_user_and_product($item['user_id'], $item['product_id']);
        if ($existing) {
            $new_qty = (int) $existing['quantity'] + (int) $item['quantity'];
            $this->dao->update(['quantity' => $new_qty], $existing['id']);
            return $this->dao->get_by_id($existing['id']);
        }

        $created = $this->dao->add($item);
        return $this->dao->get_by_id($created['id']);
    }

    protected function validate($item, $id = null)
    {
        Validator::required($item, ['user_id', 'product_id', 'quantity']);
        Validator::integer($item['user_id'], 'user_id', 1);
        Validator::integer($item['product_id'], 'product_id', 1);
        Validator::integer($item['quantity'], 'quantity', 1, 50);

        if (!$this->user_dao->get_by_id($item['user_id'])) {
            throw new ValidationException("User does not exist.");
        }
        $product = $this->product_dao->get_by_id($item['product_id']);
        if (!$product || !$product['is_active']) {
            throw new ValidationException("Product does not exist or is currently unavailable.");
        }
    }
}