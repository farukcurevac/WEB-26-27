<?php

Flight::route('GET /order-items', function () {
    $query = Flight::request()->query;
    if (isset($query['order_id'])) {
        Flight::json(Flight::order_item_service()->get_items_by_order($query['order_id']));
        return;
    }
    Flight::json(Flight::order_item_service()->get_all());
});

Flight::route('GET /orders/@id:[0-9]+/items', function ($id) {
    Flight::json(Flight::order_item_service()->get_items_by_order($id));
});

Flight::route('GET /order-items/@id:[0-9]+', function ($id) {
    Flight::json(Flight::order_item_service()->get_by_id($id));
});

Flight::route('POST /order-items', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::order_item_service()->add($data), 201);
});

Flight::route('PUT /order-items/@id:[0-9]+', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::order_item_service()->update($data, $id));
});

Flight::route('DELETE /order-items/@id:[0-9]+', function ($id) {
    Flight::order_item_service()->delete($id);
    Flight::json(['message' => 'Order item deleted.']);
});