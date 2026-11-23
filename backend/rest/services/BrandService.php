<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/BrandDao.php';

class BrandService extends BaseService
{
    protected $entity_name = 'Brand';

    public function __construct($dao = null)
    {
        parent::__construct($dao ?? new BrandDao());
    }

    public function add($brand)
    {
        return parent::add($this->empty_to_null($brand, ['logo_url']));
    }

    public function update($brand, $id)
    {
        return parent::update($this->empty_to_null($brand, ['logo_url']), $id);
    }

    public function delete($id)
    {
        $this->get_by_id($id);
        $count = $this->dao->count_products($id);
        if ($count > 0) {
            throw new ValidationException("Cannot delete brand because it still has $count product(s).");
        }
        $this->dao->delete($id);
    }

    protected function validate($brand, $id = null)
    {
        Validator::required($brand, ['name']);
        Validator::length($brand['name'], 'name', 2, 50);

        $existing = $this->dao->get_by_name(trim($brand['name']));
        if ($existing && $existing['id'] != $id) {
            throw new ValidationException("A brand named '{$brand['name']}' already exists.");
        }
    }
}