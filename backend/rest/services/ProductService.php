<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ProductDao.php';
require_once __DIR__ . '/../dao/BrandDao.php';
require_once __DIR__ . '/../dao/CategoryDao.php';

class ProductService extends BaseService
{
    protected $entity_name = 'Product';
    private $brand_dao;
    private $category_dao;

    public function __construct($dao = null, $brand_dao = null, $category_dao = null)
    {
        parent::__construct($dao ?? new ProductDao());
        $this->brand_dao = $brand_dao ?? new BrandDao();
        $this->category_dao = $category_dao ?? new CategoryDao();
    }

    public function get_by_brand($brand_id)
    {
        if (!$this->brand_dao->get_by_id($brand_id)) {
            throw new NotFoundException("Brand not found.");
        }
        return $this->dao->get_products_by_brand($brand_id);
    }

    public function get_by_category($category_id)
    {
        if (!$this->category_dao->get_by_id($category_id)) {
            throw new NotFoundException("Category not found.");
        }
        return $this->dao->get_products_by_category($category_id);
    }

    public function add($product)
    {
        $product = $this->empty_to_null($product, ['description', 'image_url']);
        $product['is_active'] = $product['is_active'] ?? 1;
        return parent::add($product);
    }

    public function update($product, $id)
    {
        $product = $this->empty_to_null($product, ['description', 'image_url']);
        return parent::update($product, $id);
    }

    protected function validate($product, $id = null)
    {
        Validator::required($product, ['brand_id', 'category_id', 'name', 'price']);
        Validator::integer($product['brand_id'], 'brand_id', 1);
        Validator::integer($product['category_id'], 'category_id', 1);
        Validator::length($product['name'], 'name', 2, 100);
        Validator::numeric($product['price'], 'price', 0.01);

        if (!$this->brand_dao->get_by_id($product['brand_id'])) {
            throw new ValidationException("Selected brand does not exist.");
        }
        if (!$this->category_dao->get_by_id($product['category_id'])) {
            throw new ValidationException("Selected category does not exist.");
        }
    }
}