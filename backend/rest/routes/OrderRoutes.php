<?php

Flight::route('GET /orders', function () {
    $query = Flight::request()->query;
    if (isset($query['user_id'])) {
        Flight::json(Flight::order_service()->get_orders_by_user($query['user_id']));
        return;
    }
    Flight::json(Flight::order_service()->get_all());
});

Flight::route('GET /users/@id:[0-9]+/orders', function ($id) {
    Flight::json(Flight::order_service()->get_orders_by_user($id));
});

Flight::route('GET /orders/@id:[0-9]+', function ($id) {
    Flight::json(Flight::order_service()->get_by_id($id));
});

Flight::route('POST /orders', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::order_service()->add($data), 201);
});

Flight::route('POST /orders/checkout', function () {
    $data = Flight::request()->data->getData();
    $user_id = $data['user_id'] ?? null;
    $shipping_address = $data['shipping_address'] ?? null;
    Flight::json(Flight::order_service()->checkout_from_cart($user_id, $shipping_address), 201);
});

Flight::route('PUT /orders/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::order_service()->update($data, $id));
});

Flight::route('DELETE /orders/@id:[0-9]+', function ($id) {
    Flight::order_service()->delete($id);
    Flight::json(['message' => 'Order deleted.']);
});