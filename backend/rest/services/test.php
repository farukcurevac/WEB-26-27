<?php
require_once __DIR__ . '/BrandService.php';
require_once __DIR__ . '/CategoryService.php';
require_once __DIR__ . '/ProductService.php';
require_once __DIR__ . '/UserService.php';
require_once __DIR__ . '/CartItemService.php';
require_once __DIR__ . '/OrderService.php';
require_once __DIR__ . '/PaymentService.php';

function attempt($description, $action)
{
    echo str_pad($description, 48, '.') . ' ';
    try {
        $result = $action();
        echo "OK" . (isset($result['id']) ? " (id {$result['id']})" : '') . "\n";
        return $result;
    } catch (HttpException $e) {
        echo get_class($e) . " [{$e->get_status()}]: {$e->getMessage()}\n";
    }
}

$brands = new BrandService();
$categories = new CategoryService();
$products = new ProductService();
$users = new UserService();
$payments = new PaymentService();

attempt('Brand without name', fn() => $brands->add(['logo_url' => 'x']));
attempt('Duplicate brand (Nike)', fn() => $brands->add(['name' => 'Nike']));
attempt('Delete brand with products (id 1)', fn() => $brands->delete(1));
attempt('Product with negative price', fn() => $products->add(['brand_id' => 1, 'category_id' => 1, 'name' => 'Test', 'price' => -50]));
attempt('Product with non-existent brand', fn() => $products->add(['brand_id' => 999, 'category_id' => 1, 'name' => 'Test', 'price' => 100]));
attempt('User with invalid email', fn() => $users->add(['first_name' => 'Test', 'last_name' => 'User', 'email' => 'not-an-email', 'password' => 'secret123']));
attempt('Duplicate payment for order #1', fn() => $payments->add(['order_id' => 1, 'amount' => 100, 'method' => 'paypal']));
attempt('Get product #999', fn() => $products->get_by_id(999));